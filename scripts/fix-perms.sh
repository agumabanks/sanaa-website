#!/usr/bin/env bash
set -euo pipefail

# Fix Laravel storage and cache permissions
# Usage:
#   scripts/fix-perms.sh [-u user[:group]] [-p project_path] [--clear]
#
# -u, --user   Web server/PHP-FPM user (default: auto-detect, fallback www-data)
# -p, --path   Project root path (default: script's git root or current dir)
# --clear      Also clear caches (view, cache, config, route)

detect_web_user() {
  # Try common processes to infer the runtime user
  local u=""
  if command -v ps >/dev/null 2>&1; then
    # php-fpm (prefer non-root worker)
    u=$(ps -eo user,comm | awk '/php-fpm/ && $1!="root" {print $1; exit}') || true
    if [[ -z "${u}" ]]; then
      # apache (prefer non-root)
      u=$(ps -eo user,comm | awk '/apache2|httpd/ && $1!="root" {print $1; exit}') || true
    fi
    if [[ -z "${u}" ]]; then
      # nginx (prefer non-root)
      u=$(ps -eo user,comm | awk '/nginx/ && $1!="root" {print $1; exit}') || true
    fi
    if [[ -z "${u}" ]]; then
      # As a last resort, try any php-fpm
      u=$(ps -eo user,comm | awk '/php-fpm/ {print $1; exit}') || true
    fi
  fi
  echo "${u:-www-data}"
}

ROOT=""
TARGET_USER=""
CLEAR=false

while [[ $# -gt 0 ]]; do
  case "$1" in
    -u|--user)
      TARGET_USER="$2"
      shift 2
      ;;
    -p|--path)
      ROOT="$2"
      shift 2
      ;;
    --clear)
      CLEAR=true
      shift
      ;;
    *)
      echo "Unknown option: $1" >&2
      exit 1
      ;;
  esac
done

# Determine project root
if [[ -z "${ROOT}" ]]; then
  if command -v git >/dev/null 2>&1 && git rev-parse --show-toplevel >/dev/null 2>&1; then
    ROOT=$(git rev-parse --show-toplevel)
  else
    ROOT=$(cd "$(dirname "$0")/.." && pwd -P)
  fi
fi

cd "$ROOT"

# Determine user:group
if [[ -z "${TARGET_USER}" ]]; then
  TARGET_USER=$(detect_web_user)
fi

if ! id "${TARGET_USER%%:*}" >/dev/null 2>&1; then
  echo "User '${TARGET_USER}' not found on system. Please pass a valid user via --user." >&2
  exit 2
fi

echo "Using project root: $ROOT"
echo "Applying ownership to: $TARGET_USER"

# Ensure required directories exist
mkdir -p storage/framework/{cache,views,sessions} bootstrap/cache

# Ownership and permissions
chown -R "$TARGET_USER":"${TARGET_USER#*:}$([[ "$TARGET_USER" == *:* ]] || echo "")" storage bootstrap/cache 2>/dev/null || true

# If group not supplied, default to user's primary group
if [[ "$TARGET_USER" != *:* ]]; then
  PRIMARY_GROUP=$(id -gn "$TARGET_USER")
  chown -R "$TARGET_USER":"$PRIMARY_GROUP" storage bootstrap/cache
fi

find storage -type d -exec chmod 0775 {} +
find storage -type f -exec chmod 0664 {} +
chmod -R ug+rwX bootstrap/cache

echo "Permissions normalized for storage/ and bootstrap/cache."

if [[ "$CLEAR" == true ]]; then
  if command -v php >/dev/null 2>&1 && [[ -f artisan ]]; then
    echo "Clearing caches via Artisan..."
    php artisan view:clear || true
    php artisan cache:clear || true
    php artisan config:clear || true
    php artisan route:clear || true
  else
    echo "Skipped Artisan cache clears (php or artisan not found)."
  fi
fi

echo "Done."

#!/usr/bin/env bash
set -euo pipefail

# Provision or refresh this Laravel site on an Ubuntu/Debian VPS.
#
# Typical first run:
#   sudo APP_URL="https://example.com" \
#     DB_PASSWORD="change-this-password" \
#     BACKUP_SQL="/root/sanaa_20260630_014055.sql" \
#     bash scripts/deploy-vps.sh
#
# If the repo is not already present on the VPS:
#   curl -fsSL https://raw.githubusercontent.com/agumabanks/sanaa-website/main/scripts/deploy-vps.sh | \
#     sudo APP_URL="https://example.com" DB_PASSWORD="change-this-password" bash
#
# Important:
# - Copy the SQL dump to the VPS first, then pass BACKUP_SQL=/path/to/dump.sql.
# - Or put a .sql file in APP_DIR/backups; the newest dump there is used automatically.
# - Or pass BACKUP_SQL_URL=https://private-url.example/dump.sql to download it during deploy.
# - Copy any uploaded files separately if needed, then pass STORAGE_ARCHIVE=/path/to/storage.tar.gz.
# - This script assumes Ubuntu/Debian with apt, MySQL/MariaDB, PHP 8.2+, Composer, Node/npm.

REPO_URL="${REPO_URL:-https://github.com/agumabanks/sanaa-website.git}"
BRANCH="${BRANCH:-main}"
APP_DIR="${APP_DIR:-/var/www/html/sanaa}"
APP_ENV="${APP_ENV:-production}"
APP_URL="${APP_URL:-http://localhost}"
WEB_USER="${WEB_USER:-www-data}"
PHP_FPM_SOCKET="${PHP_FPM_SOCKET:-}"

DB_CONNECTION="${DB_CONNECTION:-mysql}"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE:-sanaa}"
DB_USERNAME="${DB_USERNAME:-sanaa_user}"
DB_PASSWORD="${DB_PASSWORD:-}"

MYSQL_ADMIN_USER="${MYSQL_ADMIN_USER:-root}"
MYSQL_ADMIN_PASSWORD="${MYSQL_ADMIN_PASSWORD:-}"

BACKUP_SQL="${BACKUP_SQL:-}"
BACKUP_SQL_URL="${BACKUP_SQL_URL:-}"
STORAGE_ARCHIVE="${STORAGE_ARCHIVE:-}"
INSTALL_PACKAGES="${INSTALL_PACKAGES:-true}"
RUN_MIGRATIONS="${RUN_MIGRATIONS:-false}"
CONFIGURE_NGINX="${CONFIGURE_NGINX:-false}"
DOMAIN="${DOMAIN:-}"

log() {
  printf '\n[%s] %s\n' "$(date +'%Y-%m-%d %H:%M:%S')" "$*"
}

fail() {
  echo "ERROR: $*" >&2
  exit 1
}

need_root() {
  if [[ "$(id -u)" -ne 0 ]]; then
    fail "Run this script with sudo/root."
  fi
}

require_command() {
  command -v "$1" >/dev/null 2>&1 || fail "Missing required command: $1"
}

absolute_path() {
  local path="$1"
  [[ -z "$path" ]] && return 0
  readlink -f "$path"
}

sql_escape() {
  printf '%s' "$1" | sed "s/'/''/g"
}

env_escape() {
  printf '%s' "$1" | sed 's/\\/\\\\/g; s/"/\\"/g'
}

detect_php_fpm_socket() {
  if [[ -n "${PHP_FPM_SOCKET}" ]]; then
    echo "${PHP_FPM_SOCKET}"
    return
  fi

  local socket
  socket=$(find /var/run/php /run/php -maxdepth 1 -type s -name 'php*-fpm.sock' 2>/dev/null | sort -V | tail -n 1 || true)
  [[ -n "$socket" ]] || fail "Could not find a PHP-FPM socket. Set PHP_FPM_SOCKET=/path/to/php-fpm.sock."
  echo "$socket"
}

mysql_client_file() {
  local file
  file=$(mktemp)
  chmod 600 "$file"
  {
    echo "[client]"
    echo "user=${MYSQL_ADMIN_USER}"
    if [[ -n "${MYSQL_ADMIN_PASSWORD}" ]]; then
      echo "password=${MYSQL_ADMIN_PASSWORD}"
    fi
    echo "host=${DB_HOST}"
    echo "port=${DB_PORT}"
  } > "$file"
  echo "$file"
}

run_mysql_admin() {
  local sql="$1"

  if [[ -z "${MYSQL_ADMIN_PASSWORD}" && "${MYSQL_ADMIN_USER}" == "root" ]]; then
    mysql -u root -e "$sql" 2>/dev/null || sudo mysql -e "$sql"
    return
  fi

  local cnf
  cnf=$(mysql_client_file)
  mysql --defaults-extra-file="$cnf" -e "$sql"
  rm -f "$cnf"
}

import_database() {
  local dump="$1"
  [[ -f "$dump" ]] || fail "BACKUP_SQL file not found: $dump"

  log "Importing database dump: $dump"
  if [[ -z "${MYSQL_ADMIN_PASSWORD}" && "${MYSQL_ADMIN_USER}" == "root" ]]; then
    mysql -u root < "$dump" 2>/dev/null || sudo mysql < "$dump"
    return
  fi

  local cnf
  cnf=$(mysql_client_file)
  mysql --defaults-extra-file="$cnf" < "$dump"
  rm -f "$cnf"
}

resolve_database_dump() {
  if [[ -n "${BACKUP_SQL_URL}" ]]; then
    local downloaded="/tmp/sanaa-database-$(date +%Y%m%d%H%M%S).sql"
    log "Downloading database dump"
    curl -fsSL "$BACKUP_SQL_URL" -o "$downloaded"
    BACKUP_SQL="$downloaded"
    return
  fi

  if [[ -n "${BACKUP_SQL}" ]]; then
    return
  fi

  local latest_dump
  latest_dump=$(find backups -maxdepth 1 -type f -name '*.sql' -printf '%T@ %p\n' 2>/dev/null | sort -nr | awk 'NR==1 {print $2}' || true)
  if [[ -n "${latest_dump}" ]]; then
    BACKUP_SQL="$latest_dump"
    log "Using newest local database dump: ${BACKUP_SQL}"
  fi
}

write_env() {
  local app_key
  local escaped_db_password
  app_key=$(php artisan key:generate --show)
  escaped_db_password=$(env_escape "$DB_PASSWORD")

  cat > .env <<EOF
APP_NAME=Sanaa
APP_ENV=${APP_ENV}
APP_KEY=${app_key}
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=${APP_URL}

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=${DB_CONNECTION}
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD="${escaped_db_password}"

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"

VITE_APP_NAME="\${APP_NAME}"
EOF
}

configure_nginx() {
  [[ "${CONFIGURE_NGINX}" == "true" ]] || return 0
  [[ -n "${DOMAIN}" ]] || fail "Set DOMAIN when CONFIGURE_NGINX=true"
  require_command nginx

  local fpm_socket
  fpm_socket=$(detect_php_fpm_socket)

  log "Writing nginx site for ${DOMAIN}"
  cat > "/etc/nginx/sites-available/${DOMAIN}" <<EOF
server {
    listen 80;
    server_name ${DOMAIN};
    root ${APP_DIR}/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:${fpm_socket};
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF
  ln -sfn "/etc/nginx/sites-available/${DOMAIN}" "/etc/nginx/sites-enabled/${DOMAIN}"
  nginx -t
  systemctl reload nginx
}

main() {
  need_root

  if [[ -z "${DB_PASSWORD}" ]]; then
    fail "Set DB_PASSWORD before running, for example: sudo DB_PASSWORD='strong-password' bash scripts/deploy-vps.sh"
  fi

  if [[ "${INSTALL_PACKAGES}" == "true" ]]; then
    log "Installing system packages"
    apt-get update
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
      git unzip curl ca-certificates nginx mysql-server \
      php-cli php-fpm php-mysql php-xml php-mbstring \
      php-curl php-zip php-bcmath php-intl \
      composer nodejs npm
  fi

  require_command git
  require_command php
  require_command composer
  require_command npm
  require_command mysql

  BACKUP_SQL=$(absolute_path "$BACKUP_SQL")
  STORAGE_ARCHIVE=$(absolute_path "$STORAGE_ARCHIVE")

  local escaped_db_password
  escaped_db_password=$(sql_escape "$DB_PASSWORD")

  log "Creating database and database user"
  run_mysql_admin "CREATE DATABASE IF NOT EXISTS \`${DB_DATABASE}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
  run_mysql_admin "CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'%' IDENTIFIED BY '${escaped_db_password}';"
  run_mysql_admin "CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'localhost' IDENTIFIED BY '${escaped_db_password}';"
  run_mysql_admin "GRANT ALL PRIVILEGES ON \`${DB_DATABASE}\`.* TO '${DB_USERNAME}'@'%';"
  run_mysql_admin "GRANT ALL PRIVILEGES ON \`${DB_DATABASE}\`.* TO '${DB_USERNAME}'@'localhost';"
  run_mysql_admin "FLUSH PRIVILEGES;"

  log "Cloning or updating ${REPO_URL}"
  mkdir -p "$(dirname "$APP_DIR")"
  if [[ -d "${APP_DIR}/.git" ]]; then
    git -C "$APP_DIR" fetch origin "$BRANCH"
    git -C "$APP_DIR" checkout "$BRANCH"
    git -C "$APP_DIR" pull --ff-only origin "$BRANCH"
  else
    git clone --branch "$BRANCH" "$REPO_URL" "$APP_DIR"
  fi

  cd "$APP_DIR"

  log "Installing PHP dependencies"
  composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

  log "Writing production .env"
  write_env

  resolve_database_dump

  if [[ -n "${BACKUP_SQL}" ]]; then
    import_database "$BACKUP_SQL"
  fi

  if [[ "${RUN_MIGRATIONS}" == "true" ]]; then
    log "Running migrations"
    php artisan migrate --force
  fi

  if [[ -n "${STORAGE_ARCHIVE}" ]]; then
    [[ -f "${STORAGE_ARCHIVE}" ]] || fail "STORAGE_ARCHIVE file not found: ${STORAGE_ARCHIVE}"
    log "Restoring storage archive: ${STORAGE_ARCHIVE}"
    tar -xzf "${STORAGE_ARCHIVE}" -C "$APP_DIR"
  fi

  log "Building frontend assets"
  npm ci
  npm run build

  log "Preparing Laravel runtime"
  mkdir -p storage/framework/{cache,views,sessions} bootstrap/cache
  php artisan storage:link || true
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  php artisan optimize

  log "Applying permissions"
  chown -R root:root "$APP_DIR"
  chown -R "$WEB_USER":"$WEB_USER" storage bootstrap/cache
  chmod -R ug+rwX storage bootstrap/cache

  configure_nginx

  log "Deployment complete"
  echo "App directory: ${APP_DIR}"
  echo "Public root:   ${APP_DIR}/public"
  echo "App URL:       ${APP_URL}"
}

main "$@"

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        // 1) Columns (idempotent)
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('body');
            }
            if (!Schema::hasColumn('blogs', 'author_id')) {
                // add the column ONLY here (no FK yet)
                $table->unsignedBigInteger('author_id')->nullable()->after('featured_image');
            }
            if (!Schema::hasColumn('blogs', 'status')) {
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->after('author_id');
            }
            if (!Schema::hasColumn('blogs', 'featured')) {
                $table->boolean('featured')->default(false)->after('status');
            }
            if (!Schema::hasColumn('blogs', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('featured');
            }
            if (!Schema::hasColumn('blogs', 'reading_time')) {
                $table->integer('reading_time')->nullable()->after('published_at');
            }
            if (!Schema::hasColumn('blogs', 'bookmarks')) {
                $table->unsignedBigInteger('bookmarks')->default(0)->after('saves');
            }
            if (!Schema::hasColumn('blogs', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('bookmarks');
            }
            if (!Schema::hasColumn('blogs', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('blogs', 'keywords')) {
                $table->text('keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('blogs', 'category_id')) {
                // add the column ONLY here (no FK yet)
                $table->unsignedBigInteger('category_id')->nullable()->after('keywords');
            }
        });

        // 2) Foreign keys (only if targets exist, and if FK not present yet)
        if (Schema::hasTable('users') && Schema::hasColumn('blogs', 'author_id')) {
            $this->addForeignIfMissing(
                table: 'blogs',
                indexName: 'blogs_author_id_foreign',
                columns: ['author_id'],
                referencedTable: 'users',
                referencedColumn: 'id',
                onDelete: 'set null'
            );
        }

        if (Schema::hasTable('blog_categories') && Schema::hasColumn('blogs', 'category_id')) {
            $this->addForeignIfMissing(
                table: 'blogs',
                indexName: 'blogs_category_id_foreign',
                columns: ['category_id'],
                referencedTable: 'blog_categories',
                referencedColumn: 'id',
                onDelete: 'set null'
            );
        }

        // 3) Indexes (idempotent)
        $this->addIndexIfMissing('blogs', 'blogs_status_published_at_index', ['status', 'published_at']);
        $this->addIndexIfMissing('blogs', 'blogs_featured_published_at_index', ['featured', 'published_at']);
        $this->addIndexIfMissing('blogs', 'blogs_views_index', ['views']);
        $this->addIndexIfMissing('blogs', 'blogs_likes_index', ['likes']);

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        // Drop FKs if they exist
        $this->dropForeignIfExists('blogs', 'blogs_author_id_foreign');
        $this->dropForeignIfExists('blogs', 'blogs_category_id_foreign');

        // Drop indexes if they exist
        $this->dropIndexIfExists('blogs', 'blogs_status_published_at_index');
        $this->dropIndexIfExists('blogs', 'blogs_featured_published_at_index');
        $this->dropIndexIfExists('blogs', 'blogs_views_index');
        $this->dropIndexIfExists('blogs', 'blogs_likes_index');

        // Drop columns if they exist
        Schema::table('blogs', function (Blueprint $table) {
            foreach ([
                'featured_image','author_id','status','featured','published_at',
                'reading_time','bookmarks','meta_title','meta_description','keywords','category_id'
            ] as $col) {
                if (Schema::hasColumn('blogs', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        Schema::enableForeignKeyConstraints();
    }

    // ---------- helpers ----------

    private function addForeignIfMissing(
        string $table,
        string $indexName,
        array $columns,
        string $referencedTable,
        string $referencedColumn = 'id',
        string $onDelete = null
    ): void {
        if (!$this->foreignExists($table, $indexName)) {
            Schema::table($table, function (Blueprint $t) use ($columns, $referencedTable, $referencedColumn, $onDelete, $indexName) {
                $fk = $t->foreign($columns, $indexName)->references($referencedColumn)->on($referencedTable);
                if ($onDelete === 'set null') {
                    $fk->nullOnDelete();
                } elseif ($onDelete === 'cascade') {
                    $fk->cascadeOnDelete();
                } elseif ($onDelete === 'restrict') {
                    $fk->restrictOnDelete();
                }
            });
        }
    }

    private function addIndexIfMissing(string $table, string $indexName, array $columns): void
    {
        if (!$this->indexExists($table, $indexName)) {
            Schema::table($table, function (Blueprint $t) use ($columns, $indexName) {
                $t->index($columns, $indexName);
            });
        }
    }

    private function dropForeignIfExists(string $table, string $indexName): void
    {
        if ($this->foreignExists($table, $indexName)) {
            Schema::table($table, function (Blueprint $t) use ($indexName) {
                $t->dropForeign($indexName);
            });
        }
    }

    private function dropIndexIfExists(string $table, string $indexName): void
    {
        if ($this->indexExists($table, $indexName)) {
            Schema::table($table, function (Blueprint $t) use ($indexName) {
                $t->dropIndex($indexName);
            });
        }
    }

    private function foreignExists(string $table, string $fkName): bool
    {
        $db = DB::getDatabaseName();
        $exists = DB::selectOne(
            "SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
             WHERE CONSTRAINT_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND CONSTRAINT_TYPE = 'FOREIGN KEY'",
            [$db, $table, $fkName]
        );
        return (bool) $exists;
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $db = DB::getDatabaseName();
        $exists = DB::selectOne(
            "SELECT INDEX_NAME FROM information_schema.STATISTICS
             WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND INDEX_NAME = ?",
            [$db, $table, $indexName]
        );
        return (bool) $exists;
    }
};

<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Services\SEOOptimizationService;
use Illuminate\Console\Command;

class BackfillBlogSeo extends Command
{
    protected $signature = 'blog:backfill-seo
        {--force : Overwrite existing SEO fields too}
        {--dry-run : Preview changes without writing}
        {--published-only : Process only published blogs}
        {--limit=0 : Limit number of blogs processed}';

    protected $description = 'Generate missing SEO data for blog posts from their content';

    public function __construct(private readonly SEOOptimizationService $seoService)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $force = (bool) $this->option('force');
        $dryRun = (bool) $this->option('dry-run');
        $limit = max(0, (int) $this->option('limit'));

        $query = Blog::query()
            ->with(['category', 'tags'])
            ->orderBy('id');

        if ($this->option('published-only')) {
            $query->published();
        }

        if (! $force) {
            $query->where(function ($builder) {
                $builder->whereNull('meta_title')
                    ->orWhere('meta_title', '')
                    ->orWhereNull('meta_description')
                    ->orWhere('meta_description', '')
                    ->orWhereNull('keywords')
                    ->orWhere('keywords', '')
                    ->orWhereNull('excerpt')
                    ->orWhere('excerpt', '')
                    ->orWhereNull('reading_time');
            });
        }

        if ($limit > 0) {
            $query->limit($limit);
        }

        $blogs = $query->get();

        if ($blogs->isEmpty()) {
            $this->info('No blogs require SEO backfill.');
            return self::SUCCESS;
        }

        $updated = 0;
        $preview = 0;

        $this->info(sprintf(
            'Processing %d blog(s)%s%s.',
            $blogs->count(),
            $force ? ' with overwrite' : '',
            $dryRun ? ' in dry-run mode' : ''
        ));

        $bar = $this->output->createProgressBar($blogs->count());
        $bar->start();

        foreach ($blogs as $blog) {
            $payload = $this->seoService->generateMetadata($blog, $force);

            if (empty($payload)) {
                $bar->advance();
                continue;
            }

            if ($dryRun) {
                $preview++;
                $this->newLine();
                $this->line(sprintf(
                    '#%d %s',
                    $blog->id,
                    $blog->title
                ));
                foreach ($payload as $field => $value) {
                    $this->line(sprintf('  %s: %s', $field, $value));
                }
            } else {
                $blog->forceFill($payload)->save();
                $updated++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        if ($dryRun) {
            $this->info("Dry run complete. {$preview} blog(s) would be updated.");
        } else {
            $this->info("SEO backfill complete. {$updated} blog(s) updated.");
        }

        return self::SUCCESS;
    }
}

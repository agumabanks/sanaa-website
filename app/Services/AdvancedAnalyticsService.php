<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\BlogAnalytics;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Collection;

class AdvancedAnalyticsService
{
    public function getKeyMetrics(int $days): array
    {
        $startDate = now()->subDays($days);
        $previousStart = now()->subDays($days * 2);
        $previousEnd = now()->subDays($days);

        $current = $this->getMetricsForPeriod($startDate, now());
        $previous = $this->getMetricsForPeriod($previousStart, $previousEnd);

        return [
            'totalViews' => ['current' => $current['views'], 'previous' => $previous['views']],
            'uniqueVisitors' => ['current' => $current['unique_visitors'], 'previous' => $previous['unique_visitors']],
            'avgReadTime' => ['current' => $current['avg_read_time'], 'previous' => $previous['avg_read_time']],
            'engagementRate' => ['current' => $current['engagement_rate'], 'previous' => $previous['engagement_rate']],
        ];
    }

    public function getChartData(int $days): array
    {
        return [
            'traffic' => $this->getTrafficChartData($days),
            'performance' => $this->getPerformanceChartData($days),
            'engagement' => $this->getEngagementChartData($days),
            'seo' => $this->getSEOChartData($days),
        ];
    }

    public function getDetailedAnalytics(int $days): array
    {
        return [
            'topContent' => $this->getTopPerformingContent($days),
            'audience' => $this->getAudienceInsights($days),
            'trafficSources' => $this->getTrafficSources($days),
            'seo' => $this->getSEOMetrics($days),
        ];
    }

    public function getRealTimeData(): array
    {
        return [
            'activeUsers' => $this->getActiveUsersCount(),
            'pageViewsLastHour' => $this->getPageViewsLastHour(),
            'avgSessionDuration' => $this->getAverageSessionDuration(),
            'recentActivity' => $this->getRecentActivity(),
        ];
    }

    public function trackAdvancedEvent(array $data): void
    {
        BlogAnalytics::create([
            'blog_id' => $data['blog_id'],
            'ip_address' => request()->ip(),
            'user_agent' => $data['user_agent'] ?? request()->userAgent(),
            'event_type' => $data['event_type'],
            'metadata' => $data['event_data'] ?? [],
        ]);

        $this->storeRealTimeEvent($data);
        // Broadcasting wire-up is optional; events can be consumed by Echo if configured
        // event(new \App\Events\AnalyticsEvent($data));
    }

    // ----- internals -----

    private function getMetricsForPeriod($start, $end): array
    {
        $analytics = BlogAnalytics::whereBetween('created_at', [$start, $end]);

        $views = (clone $analytics)->where('event_type', 'page_view')->count();
        $unique = (clone $analytics)->where('event_type', 'page_view')->distinct('ip_address')->count('ip_address');
        $avgRead = (clone $analytics)->where('event_type', 'reading_time')->avg('value') ?? 0;
        $engagement = $this->calculateEngagementRate($start, $end);

        return [
            'views' => $views,
            'unique_visitors' => $unique,
            'avg_read_time' => (int) $avgRead,
            'engagement_rate' => $engagement,
        ];
    }

    private function calculateEngagementRate($start, $end): float
    {
        $totalViews = BlogAnalytics::where('event_type', 'page_view')
            ->whereBetween('created_at', [$start, $end])->count();
        $engagements = BlogAnalytics::whereIn('event_type', ['like', 'share', 'bookmark', 'comment'])
            ->whereBetween('created_at', [$start, $end])->count();
        return $totalViews > 0 ? round(($engagements / $totalViews) * 100, 2) : 0.0;
    }

    private function getTrafficChartData(int $days): array
    {
        $rows = BlogAnalytics::where('event_type', 'page_view')
            ->where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as views, COUNT(DISTINCT ip_address) as unique_visitors')
            ->groupBy('date')->orderBy('date')->get();

        return [
            'labels' => $rows->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M j')),
            'pageViews' => $rows->pluck('views'),
            'uniqueVisitors' => $rows->pluck('unique_visitors'),
        ];
    }

    private function getPerformanceChartData(int $days): array
    {
        $rows = BlogAnalytics::where('event_type', 'reading_time')
            ->where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, AVG(value) as avg_read_time')
            ->groupBy('date')->orderBy('date')->get();

        return [
            'labels' => $rows->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M j')),
            'avgReadTime' => $rows->pluck('avg_read_time'),
        ];
    }

    private function getEngagementChartData(int $days): array
    {
        $events = ['like', 'share', 'bookmark', 'comment'];
        $data = [];
        foreach ($events as $e) {
            $rows = BlogAnalytics::where('event_type', $e)
                ->where('created_at', '>=', now()->subDays($days))
                ->selectRaw('DATE(created_at) as date, COUNT(*) as cnt')
                ->groupBy('date')->orderBy('date')->get();
            $data[$e] = [
                'labels' => $rows->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M j')),
                'values' => $rows->pluck('cnt'),
            ];
        }
        return $data;
    }

    private function getSEOChartData(int $days): array
    {
        // Placeholder for SEO chart data
        return [
            'labels' => collect(range($days, 0))->map(fn($i) => now()->subDays($i)->format('M j')),
            'score' => collect(range($days, 0))->map(fn() => rand(60, 90)),
        ];
    }

    private function getTopPerformingContent(int $days): Collection
    {
        $threshold = now()->subDays($days);
        $blogs = Blog::published()
            ->withCount(['analytics as views_count' => function($q) use ($threshold) {
                $q->where('event_type', 'page_view')->where('created_at', '>=', $threshold);
            }])
            ->orderByDesc('views_count')
            ->limit(10)
            ->get();

        return $blogs->map(function (Blog $b) {
            $engagement = ($b->views ?? 0) + ($b->likes ?? 0) * 5 + ($b->shares ?? 0) * 10 + ($b->bookmarks ?? 0) * 3;
            return [
                'id' => $b->id,
                'title' => $b->title,
                'views' => $b->views ?? 0,
                'engagement' => $engagement,
                'avgReadTime' => $b->reading_time ?? 0,
                'performance' => min(100, ($engagement / 10) * 100),
            ];
        });
    }

    private function getAudienceInsights(int $days): array
    {
        // Placeholder breakdowns
        return [
            'locations' => [
                ['label' => 'Uganda', 'value' => 42],
                ['label' => 'Kenya', 'value' => 27],
                ['label' => 'Tanzania', 'value' => 18],
                ['label' => 'Other', 'value' => 13],
            ],
        ];
    }

    private function getTrafficSources(int $days): array
    {
        return [
            ['label' => 'Direct', 'value' => 45],
            ['label' => 'Search', 'value' => 30],
            ['label' => 'Social', 'value' => 15],
            ['label' => 'Referral', 'value' => 10],
        ];
    }

    private function getSEOMetrics(int $days): array
    {
        return [
            'avgScore' => 78,
            'issues' => ['Missing alt tags', 'Weak meta descriptions'],
        ];
    }

    private function getActiveUsersCount(): int
    {
        $key = 'active_users:' . now()->format('Y-m-d-H-i');
        return (int) (Redis::scard($key) ?: 0);
    }

    private function getPageViewsLastHour(): int
    {
        return BlogAnalytics::where('event_type', 'page_view')
            ->where('created_at', '>=', now()->subHour())->count();
    }

    private function getAverageSessionDuration(): int
    {
        // Placeholder: derive from reading_time events if available
        return (int) BlogAnalytics::where('event_type', 'reading_time')
            ->where('created_at', '>=', now()->subDay())->avg('value') ?: 0;
    }

    private function getRecentActivity(): array
    {
        $events = BlogAnalytics::latest()->limit(10)->get(['event_type','created_at']);
        return $events->map(fn($e) => ['type' => $e->event_type, 'at' => $e->created_at])->toArray();
    }

    private function storeRealTimeEvent(array $data): void
    {
        $key = 'realtime:events:' . now()->format('Y-m-d-H-i');
        Redis::lpush($key, json_encode($data));
        Redis::expire($key, 3600);
    }
}


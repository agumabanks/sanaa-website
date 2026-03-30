<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\AdvancedAnalyticsService;
use App\Services\CollaborationService;
use App\Services\AIContentService;
use App\Services\SEOOptimizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EnhancedBlogController extends Controller
{
    protected AdvancedAnalyticsService $analyticsService;
    protected CollaborationService $collaborationService;
    protected AIContentService $aiContentService;
    protected SEOOptimizationService $seoService;

    public function __construct(
        AdvancedAnalyticsService $analyticsService,
        CollaborationService $collaborationService,
        AIContentService $aiContentService,
        SEOOptimizationService $seoService
    ) {
        $this->analyticsService = $analyticsService;
        $this->collaborationService = $collaborationService;
        $this->aiContentService = $aiContentService;
        $this->seoService = $seoService;
    }

    public function getAnalyticsDashboard(Request $request)
    {
        $days = (int) $request->input('days', 30);
        $cacheKey = "analytics_dashboard_{$days}_" . optional($request->user())->id;

        $data = Cache::remember($cacheKey, 1800, function () use ($days) {
            return [
                'metrics' => $this->analyticsService->getKeyMetrics($days),
                'charts' => $this->analyticsService->getChartData($days),
                'detailed' => $this->analyticsService->getDetailedAnalytics($days),
            ];
        });

        return response()->json($data);
    }

    public function getRealTimeAnalytics()
    {
        return response()->json($this->analyticsService->getRealTimeData());
    }

    public function trackAdvancedAnalytics(Request $request)
    {
        $validated = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'event_type' => 'required|string',
            'event_data' => 'required|array',
            'session_id' => 'nullable|string',
            'user_agent' => 'nullable|string',
        ]);

        $this->analyticsService->trackAdvancedEvent($validated);
        return response()->json(['status' => 'tracked']);
    }

    public function autoSave(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);
        $validated = $request->validate([
            'content' => 'required|array',
            'version' => 'required|integer',
            'pending_operations' => 'array',
        ]);
        $result = $this->collaborationService->autoSave($blog, $validated);
        return response()->json($result);
    }

    public function handleCollaborativeOperation(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);
        $validated = $request->validate([
            'operation' => 'required|array',
            'session_id' => 'required|string',
        ]);
        $result = $this->collaborationService->processOperation($blog, $validated);
        return response()->json($result);
    }

    public function getContentSuggestions(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);
        return response()->json($this->aiContentService->generateSuggestions($blog));
    }

    public function getSEORecommendations(Request $request, Blog $blog)
    {
        return response()->json($this->seoService->analyzeContent($blog));
    }

    public function exportAnalytics(Request $request)
    {
        $validated = $request->validate([
            'date_range' => 'required|integer|min:1|max:365',
            'format' => 'required|in:csv,json',
            'metrics' => 'array',
        ]);

        // Minimal export implementation
        $days = (int) $validated['date_range'];
        $data = [
            'metrics' => $this->analyticsService->getKeyMetrics($days),
            'charts' => $this->analyticsService->getChartData($days),
        ];

        if ($validated['format'] === 'json') {
            $path = storage_path('app/analytics-export.json');
            file_put_contents($path, json_encode($data));
            return response()->download($path, 'analytics-export.json');
        }

        // CSV (simple)
        $path = storage_path('app/analytics-export.csv');
        $fh = fopen($path, 'w');
        fputcsv($fh, ['metric', 'current', 'previous']);
        foreach ($data['metrics'] as $k => $v) {
            fputcsv($fh, [$k, $v['current'] ?? '', $v['previous'] ?? '']);
        }
        fclose($fh);
        return response()->download($path, 'analytics-export.csv');
    }
}


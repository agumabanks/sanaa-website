<?php

namespace App\Services;

use App\Models\Blog;

class AIContentService
{
    public function generateSuggestions(Blog $blog): array
    {
        $content = strip_tags($blog->body ?? '');
        $title = $blog->title ?? '';

        return [
            'seo_suggestions' => $this->generateSEOSuggestions($title, $content),
            'content_improvements' => $this->generateContentImprovements($content),
            'related_topics' => $this->generateRelatedTopics($content),
            'headline_alternatives' => $this->generateHeadlineAlternatives($title),
        ];
    }

    private function generateSEOSuggestions(string $title, string $content): array
    {
        $length = strlen($title);
        $suggestions = [];
        if ($length < 30) { $suggestions[] = 'Consider lengthening your title (30–60 chars).'; }
        if ($length > 60) { $suggestions[] = 'Consider shortening your title (<60 chars).'; }
        if (!preg_match('/\d/', $title)) { $suggestions[] = 'Numbers can increase CTR in headlines.'; }
        $keywords = $this->suggestKeywords($content);
        return [
            'title_optimization' => ['score' => $this->calculateTitleScore($title), 'suggestions' => $suggestions],
            'keyword_suggestions' => $keywords,
            'meta_description' => $this->generateMetaDescription($content),
            'internal_linking' => $this->suggestInternalLinks($content),
        ];
    }

    private function generateContentImprovements(string $content): array
    {
        $improvements = [];
        $wordCount = str_word_count($content);
        if ($wordCount < 600) { $improvements[] = 'Consider expanding the article to >600 words.'; }
        if (!preg_match('/<h2>/', $content)) { $improvements[] = 'Add subheadings (H2/H3) to structure the content.'; }
        if (!preg_match('/<img /', $content)) { $improvements[] = 'Include images with alt text to improve engagement.'; }
        return $improvements;
    }

    private function generateRelatedTopics(string $content): array
    {
        $keywords = $this->suggestKeywords($content);
        return array_slice(array_map(fn($k) => ucfirst($k), $keywords), 0, 5);
    }

    private function generateHeadlineAlternatives(string $title): array
    {
        $base = trim($title) ?: 'Your Headline';
        return [
            $base . ' — A Complete Guide',
            'Top 10 Things About ' . $base,
            'How To ' . $base,
            $base . ' (Step-by-Step)',
            'The Ultimate ' . $base . ' Checklist',
        ];
    }

    private function calculateTitleScore(string $title): int
    {
        $score = 70;
        if (preg_match('/\d/', $title)) { $score += 10; }
        $len = strlen($title);
        if ($len >= 30 && $len <= 60) { $score += 10; } else { $score -= 5; }
        return max(0, min(100, $score));
    }

    private function suggestKeywords(string $content): array
    {
        $words = str_word_count(strtolower(strip_tags($content)), 1);
        $counts = array_count_values($words);
        $common = ['the','and','or','but','in','on','at','to','for','of','with','by','a','an','is','it','this','that'];
        foreach ($common as $c) { unset($counts[$c]); }
        arsort($counts);
        return array_slice(array_keys($counts), 0, 10);
    }

    private function generateMetaDescription(string $content): string
    {
        $text = trim(strip_tags($content));
        if (strlen($text) <= 160) { return $text; }
        return substr($text, 0, 157) . '...';
    }

    private function suggestInternalLinks(string $content): array
    {
        // Placeholder: in a full setup, scan site content for related slugs
        return [];
    }
}


<?php

namespace App\Services;

use App\Models\Blog;

class SEOOptimizationService
{
    public function analyzeContent(Blog $blog): array
    {
        $titleScore = $this->getTitleScore($blog->title ?? '');
        $contentScore = $this->getContentScore($blog->body ?? '');
        $metaScore = $this->getMetaScore($blog);
        $readability = $this->analyzeReadability($blog->body ?? '');

        return [
            'overall_score' => round(($titleScore + $contentScore + $metaScore + ($readability['score'] ?? 0)) / 4),
            'title_analysis' => $this->analyzeTitleSEO($blog->title ?? ''),
            'content_analysis' => $this->analyzeContentSEO($blog->body ?? ''),
            'meta_analysis' => $this->analyzeMetaTags($blog),
            'readability' => $readability,
            'suggestions' => $this->generateSEOSuggestions($blog),
        ];
    }

    public function analyzeTitleSEO(string $title): array
    {
        $length = strlen($title);
        $suggestions = [];
        if ($length < 30) { $suggestions[] = 'Consider lengthening your title (30–60 chars).'; }
        if ($length > 60) { $suggestions[] = 'Consider shortening your title (<60 chars).'; }
        if (!preg_match('/\d/', $title)) { $suggestions[] = 'Numbers can increase CTR in headlines.'; }
        return [
            'score' => $this->getTitleScore($title),
            'suggestions' => $suggestions,
        ];
    }

    public function analyzeContentSEO(string $content): array
    {
        $words = str_word_count(strip_tags($content));
        return [
            'word_count' => $words,
            'score' => $this->getContentScore($content),
        ];
    }

    public function analyzeMetaTags(Blog $blog): array
    {
        $desc = trim((string) $blog->meta_description);
        return [
            'has_meta_title' => !empty($blog->meta_title),
            'has_meta_description' => !empty($desc),
            'meta_description_length' => strlen($desc),
            'score' => $this->getMetaScore($blog),
        ];
    }

    public function analyzeReadability(string $content): array
    {
        $text = strip_tags($content);
        $sentences = preg_split('/[.!?]+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $wordsCount = str_word_count($text);
        $avgWordsPerSentence = $wordsCount / max(1, count($sentences));

        $score = 206.835 - (1.015 * $avgWordsPerSentence) - (84.6 * $this->getAvgSyllables($text));
        $score = max(0, min(100, $score));

        return [
            'score' => (int) round($score),
            'level' => $this->getReadabilityLevel($score),
            'avg_sentence_length' => round($avgWordsPerSentence, 1),
        ];
    }

    public function generateSEOSuggestions(Blog $blog): array
    {
        $s = [];
        if (strlen((string) $blog->meta_description) < 120) { $s[] = 'Improve meta description (120–160 chars).'; }
        if (!str_contains(strtolower((string) $blog->title), strtolower((string) $blog->keywords))) { $s[] = 'Include primary keyword in title.'; }
        return $s;
    }

    // ----- helpers -----
    private function getAvgSyllables(string $content): float
    {
        $words = str_word_count(strtolower(strip_tags($content)), 1);
        $total = 0;
        foreach ($words as $w) {
            $total += $this->countSyllables($w);
        }
        return $total / max(1, count($words));
    }

    private function countSyllables(string $word): int
    {
        $word = strtolower($word);
        preg_match_all('/[aeiouy]+/', $word, $matches);
        $syllables = count($matches[0]);
        if (str_ends_with($word, 'e')) { $syllables--; }
        return max(1, $syllables);
    }

    private function getReadabilityLevel(float $score): string
    {
        return match (true) {
            $score >= 90 => 'Very Easy',
            $score >= 80 => 'Easy',
            $score >= 70 => 'Fairly Easy',
            $score >= 60 => 'Standard',
            $score >= 50 => 'Fairly Difficult',
            $score >= 30 => 'Difficult',
            default => 'Very Difficult',
        };
    }

    public function getTitleScore(string $title): int
    {
        $score = 70;
        if (preg_match('/\d/', $title)) { $score += 10; }
        $len = strlen($title);
        if ($len >= 30 && $len <= 60) { $score += 10; } else { $score -= 5; }
        return max(0, min(100, $score));
    }

    public function getContentScore(string $content): int
    {
        $count = str_word_count(strip_tags($content));
        return (int) max(0, min(100, $count / 15));
    }

    public function getMetaScore(Blog $blog): int
    {
        $score = 0;
        if (!empty($blog->meta_title)) { $score += 50; }
        $len = strlen((string) $blog->meta_description);
        if ($len >= 120 && $len <= 160) { $score += 50; } else { $score += 20; }
        return $score;
    }
}


<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Str;

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

    public function generateMetadata(Blog $blog, bool $overwrite = false): array
    {
        $plainText = $this->extractPlainText($blog->body ?? '');
        $title = trim((string) $blog->title);
        $primaryTopic = $this->buildPrimaryTopic($blog, $plainText);

        $metaTitle = $this->buildMetaTitle($blog, $primaryTopic);
        $metaDescription = $this->buildMetaDescription($blog, $plainText, $primaryTopic);
        $keywords = $this->buildKeywords($blog, $plainText, $primaryTopic);

        $payload = [];

        if ($overwrite || blank($blog->meta_title)) {
            $payload['meta_title'] = $metaTitle;
        }

        if ($overwrite || blank($blog->meta_description)) {
            $payload['meta_description'] = $metaDescription;
        }

        if ($overwrite || blank($blog->keywords)) {
            $payload['keywords'] = $keywords;
        }

        if ($overwrite || blank($blog->excerpt)) {
            $payload['excerpt'] = $this->buildExcerpt($blog, $plainText, $primaryTopic, $overwrite);
        }

        if (($overwrite || blank($blog->reading_time)) && !blank($plainText)) {
            $payload['reading_time'] = max(1, (int) ceil(str_word_count($plainText) / 200));
        }

        return $payload;
    }

    // ----- helpers -----
    private function buildMetaTitle(Blog $blog, string $primaryTopic): string
    {
        $title = trim((string) $blog->title);
        $category = trim((string) optional($blog->category)->name);

        $candidates = array_filter([
            $title,
            $title && $category ? "{$title} | {$category} Insights" : null,
            $title && $primaryTopic ? "{$title} | {$primaryTopic}" : null,
            $title ? "{$title} | Sanaa" : null,
        ]);

        foreach ($candidates as $candidate) {
            $candidate = trim($candidate);
            if (Str::length($candidate) >= 30 && Str::length($candidate) <= 60) {
                return $candidate;
            }
        }

        return Str::limit($title ?: 'Sanaa Blog', 60, '');
    }

    private function buildMetaDescription(Blog $blog, string $plainText, string $primaryTopic): string
    {
        $excerpt = trim((string) $blog->excerpt);
        if ($excerpt !== '' && Str::length($excerpt) >= 120 && Str::length($excerpt) <= 160) {
            return $excerpt;
        }

        $sentences = preg_split('/(?<=[.!?])\s+/', $plainText, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $description = '';

        foreach ($sentences as $sentence) {
            $candidate = trim($description . ' ' . $sentence);
            if (Str::length($candidate) > 160) {
                break;
            }
            $description = $candidate;
            if (Str::length($description) >= 130) {
                break;
            }
        }

        if ($description === '') {
            $description = $plainText;
        }

        if ($primaryTopic !== '' && !str_contains(strtolower($description), strtolower($primaryTopic))) {
            $description = trim($primaryTopic . '. ' . ltrim($description, '. '));
        }

        return $this->finishSentence(Str::limit($description, 160, ''));
    }

    private function buildKeywords(Blog $blog, string $plainText, string $primaryTopic): string
    {
        $keywords = [];

        $titleWords = collect(preg_split('/\s+/', strtolower((string) $blog->title), -1, PREG_SPLIT_NO_EMPTY))
            ->map(fn ($word) => trim($word, " \t\n\r\0\x0B.,:;!?()[]{}'\""))
            ->filter(fn ($word) => Str::length($word) > 3);

        foreach ($titleWords as $word) {
            $keywords[] = Str::headline($word);
        }

        if ($primaryTopic !== '') {
            $keywords[] = $primaryTopic;
        }

        if ($blog->category?->name) {
            $keywords[] = $blog->category->name;
        }

        foreach ($blog->tags as $tag) {
            $keywords[] = $tag->name;
        }

        foreach ($this->extractKeywordCandidates($plainText) as $candidate) {
            $keywords[] = $candidate;
        }

        $keywords[] = 'Sanaa';
        $keywords[] = 'Sanaa Uganda';
        $keywords[] = 'Sanaa Blog';

        $normalized = collect($keywords)
            ->map(fn ($keyword) => trim((string) $keyword))
            ->filter()
            ->unique(fn ($keyword) => strtolower($keyword))
            ->values();

        $result = [];
        foreach ($normalized as $keyword) {
            $candidate = implode(', ', array_merge($result, [$keyword]));
            if (Str::length($candidate) > 255) {
                break;
            }
            $result[] = $keyword;
        }

        return implode(', ', $result);
    }

    private function buildExcerpt(Blog $blog, string $plainText, string $primaryTopic, bool $overwrite = false): string
    {
        $excerpt = trim((string) $blog->excerpt);
        if (! $overwrite && $excerpt !== '') {
            return Str::limit($excerpt, 500, '');
        }

        $description = $this->buildMetaDescription($blog, $plainText, $primaryTopic);
        return Str::limit($description, 500, '');
    }

    private function buildPrimaryTopic(Blog $blog, string $plainText): string
    {
        foreach ([
            trim((string) optional($blog->tags->first())->name),
            trim((string) optional($blog->category)->name),
        ] as $candidate) {
            if ($candidate !== '') {
                return $candidate;
            }
        }

        return $this->extractKeywordCandidates($plainText)[0] ?? '';
    }

    private function extractPlainText(string $content): string
    {
        $text = preg_replace('/<[^>]+>/', ' ', $content);
        $text = html_entity_decode((string) $text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return trim((string) preg_replace('/\s+/', ' ', $text));
    }

    private function extractKeywordCandidates(string $plainText): array
    {
        $words = str_word_count(strtolower($plainText), 1);
        $stopWords = [
            'the','and','or','but','with','from','this','that','have','will','your','about','into','their','there',
            'they','them','were','been','being','also','than','then','when','what','where','which','while','because',
            'over','under','after','before','between','through','across','could','should','would','these','those',
            'using','used','use','into','onto','such','only','more','most','some','many','each','much','very',
            'here','just','like','make','made','does','doesn','dont','isnt','cant','blog','sanaa'
        ];

        $counts = [];
        foreach ($words as $word) {
            $word = trim($word);
            if (Str::length($word) < 4 || in_array($word, $stopWords, true) || is_numeric($word)) {
                continue;
            }
            $counts[$word] = ($counts[$word] ?? 0) + 1;
        }

        arsort($counts);

        return collect(array_keys($counts))
            ->take(8)
            ->map(fn ($word) => Str::headline($word))
            ->values()
            ->all();
    }

    private function finishSentence(string $text): string
    {
        $text = trim($text);
        if ($text === '') {
            return '';
        }

        if (!preg_match('/[.!?]$/', $text)) {
            $text .= '.';
        }

        return $text;
    }

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

@extends('layouts.landing')

@section('title', 'Sanaa API | Blog Syndication Docs')
@section('seo_title', 'Sanaa API | Blog Syndication Docs')
@section('seo_description', 'Technical documentation for the Sanaa Blog Syndication API. Share Sanaa insights across your websites, apps, and partner experiences.')
@section('seo_keywords', 'Sanaa API, blog API, syndication API, developer docs, Sanaa insights API')

@section('content')
    <style>
        :root {
            --docs-ink: #09111f;
            --docs-muted: #5f6f88;
            --docs-line: rgba(9, 17, 31, 0.10);
            --docs-cream: #f4efe7;
            --docs-card: #ffffff;
            --docs-accent: #be4d25;
            --docs-accent-soft: rgba(190, 77, 37, 0.12);
            --docs-slate: #10243d;
            --docs-mint: #ccecdf;
        }

        .docs-shell {
            background:
                radial-gradient(circle at top left, rgba(204, 236, 223, 0.9), transparent 32%),
                linear-gradient(180deg, #fffdf8 0%, #f6f1e9 52%, #ffffff 100%);
            color: var(--docs-ink);
        }

        .docs-container {
            width: min(1180px, calc(100% - 2rem));
            margin: 0 auto;
        }

        .docs-hero {
            padding: 6rem 0 3rem;
        }

        .docs-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.5rem 0.9rem;
            border-radius: 999px;
            border: 1px solid rgba(9, 17, 31, 0.12);
            background: rgba(255, 255, 255, 0.68);
            color: var(--docs-slate);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .docs-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(280px, 0.9fr);
            gap: 1.5rem;
            align-items: start;
        }

        .docs-headline {
            margin-top: 1.25rem;
            font-size: clamp(2.4rem, 6vw, 4.8rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
            max-width: 10ch;
        }

        .docs-summary {
            margin-top: 1.35rem;
            max-width: 62ch;
            color: var(--docs-muted);
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .docs-panel,
        .docs-card,
        .docs-code,
        .docs-table-wrap {
            background: var(--docs-card);
            border: 1px solid var(--docs-line);
            border-radius: 28px;
            box-shadow: 0 22px 44px rgba(16, 36, 61, 0.06);
        }

        .docs-panel {
            padding: 1.25rem;
        }

        .docs-panel-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--docs-muted);
            margin-bottom: 0.75rem;
        }

        .docs-panel-list {
            display: grid;
            gap: 0.8rem;
        }

        .docs-panel-item {
            padding: 0.95rem 1rem;
            border-radius: 20px;
            background: linear-gradient(180deg, rgba(244, 239, 231, 0.72), rgba(255, 255, 255, 0.95));
            border: 1px solid rgba(9, 17, 31, 0.08);
        }

        .docs-panel-item strong,
        .docs-panel-item a {
            display: block;
            color: var(--docs-ink);
            font-weight: 700;
            word-break: break-word;
        }

        .docs-panel-item span {
            display: block;
            color: var(--docs-muted);
            margin-top: 0.3rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .docs-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            margin-top: 1.5rem;
        }

        .docs-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0.85rem 1.15rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        }

        .docs-link:hover {
            transform: translateY(-1px);
        }

        .docs-link-primary {
            background: var(--docs-ink);
            color: #fff;
        }

        .docs-link-secondary {
            background: rgba(255, 255, 255, 0.82);
            color: var(--docs-ink);
            border-color: rgba(9, 17, 31, 0.12);
        }

        .docs-stat-grid,
        .docs-section-grid,
        .docs-code-grid {
            display: grid;
            gap: 1rem;
        }

        .docs-stat-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 1.5rem;
        }

        .docs-stat {
            padding: 1.25rem;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(9, 17, 31, 0.08);
        }

        .docs-stat strong {
            display: block;
            font-size: 1.55rem;
            letter-spacing: -0.04em;
        }

        .docs-stat span {
            display: block;
            margin-top: 0.45rem;
            color: var(--docs-muted);
            line-height: 1.6;
        }

        .docs-section {
            padding: 1rem 0 1.5rem;
        }

        .docs-section-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .docs-section-title {
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            line-height: 1;
            letter-spacing: -0.04em;
        }

        .docs-section-copy {
            max-width: 52ch;
            color: var(--docs-muted);
            line-height: 1.75;
        }

        .docs-section-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .docs-card {
            padding: 1.25rem;
        }

        .docs-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.65rem;
            border-radius: 999px;
            background: var(--docs-accent-soft);
            color: var(--docs-accent);
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .docs-card h3 {
            margin-top: 1rem;
            font-size: 1.1rem;
            line-height: 1.4;
        }

        .docs-card p,
        .docs-card li {
            color: var(--docs-muted);
            line-height: 1.7;
        }

        .docs-card code,
        .docs-code code,
        .docs-table code {
            font-size: 0.92rem;
            color: var(--docs-slate);
        }

        .docs-inline-link {
            color: var(--docs-accent);
            font-weight: 700;
            text-decoration: none;
        }

        .docs-inline-link:hover {
            text-decoration: underline;
        }

        .docs-list {
            display: grid;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .docs-list-item {
            padding: 1rem;
            border-radius: 20px;
            background: rgba(244, 239, 231, 0.55);
        }

        .docs-list-item strong {
            display: block;
            color: var(--docs-ink);
        }

        .docs-list-item span {
            display: block;
            margin-top: 0.25rem;
        }

        .docs-table-wrap {
            overflow: hidden;
        }

        .docs-table {
            width: 100%;
            border-collapse: collapse;
        }

        .docs-table th,
        .docs-table td {
            padding: 1rem 1.1rem;
            text-align: left;
            vertical-align: top;
            border-bottom: 1px solid var(--docs-line);
        }

        .docs-table th {
            font-size: 0.78rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--docs-muted);
            background: rgba(16, 36, 61, 0.03);
        }

        .docs-table tr:last-child td {
            border-bottom: 0;
        }

        .docs-code-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .docs-code {
            overflow: hidden;
        }

        .docs-code header {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            align-items: center;
            padding: 1rem 1.2rem 0;
        }

        .docs-code header h3 {
            margin: 0;
            font-size: 1rem;
        }

        .docs-code pre {
            margin: 0;
            padding: 1.2rem;
            overflow-x: auto;
            color: #dce8f7;
            background: #0f1b2d;
            font-size: 0.92rem;
            line-height: 1.7;
        }

        .docs-footer-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, 0.8fr);
            gap: 1rem;
            padding-bottom: 5rem;
        }

        .docs-note {
            padding: 1.3rem;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(204, 236, 223, 0.75), rgba(255, 255, 255, 0.95));
            border: 1px solid rgba(9, 17, 31, 0.08);
        }

        @media (max-width: 960px) {
            .docs-grid,
            .docs-section-grid,
            .docs-code-grid,
            .docs-footer-grid,
            .docs-stat-grid {
                grid-template-columns: 1fr;
            }

            .docs-hero {
                padding-top: 4.5rem;
            }
        }
    </style>

    <div class="docs-shell">
        <section class="docs-hero">
            <div class="docs-container">
                <div class="docs-grid">
                    <div>
                        <div class="docs-kicker">Sanaa API / Developer Docs</div>
                        <h1 class="docs-headline">{{ $docs['name'] }}</h1>
                        <p class="docs-summary">{{ $docs['summary'] }}</p>

                        <div class="docs-links">
                            <a class="docs-link docs-link-primary" href="{{ $docs['endpoints'][0]['url'] }}" target="_blank" rel="noopener noreferrer">Open Live Endpoint</a>
                            <a class="docs-link docs-link-secondary" href="{{ $docs['feeds'][2]['url'] }}" target="_blank" rel="noopener noreferrer">View Manifest</a>
                            <a class="docs-link docs-link-secondary" href="{{ route('blog.index') }}" target="_blank" rel="noopener noreferrer">Browse Blog</a>
                        </div>

                        <div class="docs-stat-grid">
                            <div class="docs-stat">
                                <strong>Public JSON</strong>
                                <span>{{ $docs['auth'] }}</span>
                            </div>
                            <div class="docs-stat">
                                <strong>Cross-site Ready</strong>
                                <span>{{ $docs['cors'] }}</span>
                            </div>
                            <div class="docs-stat">
                                <strong>Cache-aware</strong>
                                <span>{{ $docs['cache'] }}</span>
                            </div>
                        </div>
                    </div>

                    <aside class="docs-panel">
                        <div class="docs-panel-title">Quick Start</div>
                        <div class="docs-panel-list">
                            <div class="docs-panel-item">
                                <strong>Base URL</strong>
                                <span><code>{{ $docs['base_url'] }}</code></span>
                            </div>
                            @foreach($docs['feeds'] as $feed)
                                <div class="docs-panel-item">
                                    <a href="{{ $feed['url'] }}" target="_blank" rel="noopener noreferrer">{{ $feed['label'] }}</a>
                                    <span>{{ $feed['url'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="docs-section">
            <div class="docs-container">
                <div class="docs-section-head">
                    <div>
                        <h2 class="docs-section-title">Endpoints</h2>
                        <p class="docs-section-copy">Use the list endpoint for paginated archives, the latest endpoint for homepage widgets, the detail endpoint for a single article, and the manifest endpoint for integration discovery.</p>
                    </div>
                </div>

                <div class="docs-section-grid">
                    @foreach($docs['endpoints'] as $endpoint)
                        <article class="docs-card">
                            <span class="docs-pill">{{ $endpoint['method'] }}</span>
                            <h3><code>{{ $endpoint['path'] }}</code></h3>
                            <p>{{ $endpoint['purpose'] }}</p>
                            <p><a class="docs-inline-link" href="{{ $endpoint['url'] }}" target="_blank" rel="noopener noreferrer">{{ $endpoint['url'] }}</a></p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="docs-section">
            <div class="docs-container">
                <div class="docs-section-head">
                    <div>
                        <h2 class="docs-section-title">Query Parameters</h2>
                        <p class="docs-section-copy">These filters let other Sanaa properties pull only the content they need, with body inclusion available when a downstream site needs to render the full article.</p>
                    </div>
                </div>

                <div class="docs-table-wrap">
                    <table class="docs-table">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Type</th>
                                <th>Scope</th>
                                <th>Description</th>
                                <th>Example</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docs['query_parameters'] as $parameter)
                                <tr>
                                    <td><code>{{ $parameter['name'] }}</code></td>
                                    <td>{{ $parameter['type'] }}</td>
                                    <td>{{ $parameter['scope'] }}</td>
                                    <td>{{ $parameter['description'] }}</td>
                                    <td><code>{{ $parameter['example'] }}</code></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="docs-section">
            <div class="docs-container">
                <div class="docs-section-head">
                    <div>
                        <h2 class="docs-section-title">Response Shape</h2>
                        <p class="docs-section-copy">Each post includes canonical URLs, taxonomy, author data, public engagement counts, and reusable SEO fields so downstream sites can render both cards and article pages without extra lookups.</p>
                    </div>
                </div>

                <div class="docs-section-grid">
                    <div class="docs-table-wrap">
                        <table class="docs-table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docs['response_fields'] as $field)
                                    <tr>
                                        <td><code>{{ $field['field'] }}</code></td>
                                        <td>{{ $field['description'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="docs-code">
                        <header>
                            <h3>Sample Payload</h3>
                            <span class="docs-pill">JSON</span>
                        </header>
                        <pre><code>{{ $docs['sample_response'] }}</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <section class="docs-section">
            <div class="docs-container">
                <div class="docs-section-head">
                    <div>
                        <h2 class="docs-section-title">Usage Examples</h2>
                        <p class="docs-section-copy">These are the most common pull patterns for Sanaa properties: homepage rails, featured sections, category pages, and incremental refresh jobs.</p>
                    </div>
                </div>

                <div class="docs-section-grid">
                    @foreach($docs['examples'] as $example)
                        <article class="docs-card">
                            <span class="docs-pill">{{ $example['label'] }}</span>
                            <div class="docs-list">
                                <div class="docs-list-item">
                                    <strong>Request URL</strong>
                                    <span><a class="docs-inline-link" href="{{ $example['url'] }}" target="_blank" rel="noopener noreferrer">{{ $example['url'] }}</a></span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="docs-section">
            <div class="docs-container">
                <div class="docs-section-head">
                    <div>
                        <h2 class="docs-section-title">Copy-Paste Snippets</h2>
                        <p class="docs-section-copy">Start with these server-side or frontend examples, then cache and render the API data in your target experience.</p>
                    </div>
                </div>

                <div class="docs-code-grid">
                    <article class="docs-code">
                        <header>
                            <h3>JavaScript</h3>
                            <span class="docs-pill">Fetch</span>
                        </header>
                        <pre><code>{{ $docs['javascript_example'] }}</code></pre>
                    </article>

                    <article class="docs-code">
                        <header>
                            <h3>Laravel / PHP</h3>
                            <span class="docs-pill">HTTP Client</span>
                        </header>
                        <pre><code>{{ $docs['php_example'] }}</code></pre>
                    </article>
                </div>
            </div>
        </section>

        <section class="docs-section">
            <div class="docs-container">
                <div class="docs-footer-grid">
                    <div class="docs-note">
                        <h2 class="docs-section-title" style="font-size: 1.7rem;">Integration Notes</h2>
                        <div class="docs-list">
                            <div class="docs-list-item">
                                <strong>Best for shared rails and cards</strong>
                                <span>Use <code>/api/v1/insights/latest</code> for small card sets and <code>/api/v1/insights</code> for paginated archive pages.</span>
                            </div>
                            <div class="docs-list-item">
                                <strong>When to include body content</strong>
                                <span>Only request <code>include=body</code> when the downstream site actually renders the full article. Card views should keep payloads lean.</span>
                            </div>
                            <div class="docs-list-item">
                                <strong>Canonical handling</strong>
                                <span>Reuse the API’s <code>seo</code> block for metadata, but keep <code>url</code> available when you want the canonical source to remain the original blog post.</span>
                            </div>
                        </div>
                    </div>

                    <aside class="docs-panel">
                        <div class="docs-panel-title">Other Developer Platforms</div>
                        @if($items->count())
                            <div class="docs-panel-list">
                                @foreach($items as $platform)
                                    <div class="docs-panel-item">
                                        <strong>{{ $platform->name }}</strong>
                                        <span>{{ $platform->description ?: 'No description yet.' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="docs-panel-item">
                                <strong>More APIs coming</strong>
                                <span>The blog syndication API is documented first because it is already public and ready for shared use across the Sanaa stack.</span>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </section>
    </div>
@endsection

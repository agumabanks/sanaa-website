{{-- Blog Section Partial --}}
<div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Section Header --}}
    <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-thin text-white mb-6 tracking-tight">
            Latest <span class="text-emerald-400 font-normal">Insights</span>
        </h2>
        <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
            Stay updated with the latest trends, insights, and innovations in digital infrastructure and technology.
        </p>
    </div>

    {{-- Blog Posts Grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @php
            try {
                $blogs = \App\Models\Blog::published()->latest()->take(3)->get();
            } catch (\Exception $e) {
                $blogs = collect(); // Empty collection if there's an error
            }
        @endphp
        
        @forelse($blogs as $index => $blog)
            <article class="group bg-gray-900/30 rounded-2xl overflow-hidden border border-gray-800 hover:border-emerald-500/30 transition-all duration-500 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-emerald-500/10" style="--delay: {{ $index + 1 }}">
                {{-- Featured Image --}}
                @if($blog->featured_image)
                    <div class="relative h-48 overflow-hidden">
                        @php
                            try {
                                $imageUrl = $blog->featured_image_url;
                            } catch (\Exception $e) {
                                $imageUrl = asset('storage/' . $blog->featured_image);
                            }
                        @endphp
                        <img src="{{ $imageUrl }}"
                             alt="{{ $blog->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                             onerror="this.parentElement.innerHTML='<div class=\'h-48 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center\'><svg class=\'w-16 h-16 text-gray-600\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path fill-rule=\'evenodd\' d=\'M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z\' clip-rule=\'evenodd\'/></svg></div>'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        
                        {{-- Category Badge --}}
                        @if($blog->category)
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-emerald-600/90 text-black text-xs font-semibold rounded-full backdrop-blur-sm">
                                    {{ $blog->category->name }}
                                </span>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                @endif

                {{-- Content --}}
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-3 leading-tight group-hover:text-emerald-400 transition-colors duration-300">
                        @php
                            try {
                                $blogUrl = $blog->url;
                            } catch (\Exception $e) {
                                $blogUrl = route('blog.show', $blog->slug ?? $blog->id);
                            }
                        @endphp
                        <a href="{{ $blogUrl }}" class="block">
                            {{ Str::limit($blog->title, 60) }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-400 text-sm mb-4 leading-relaxed">
                        @php
                            try {
                                $excerpt = $blog->excerpt;
                            } catch (\Exception $e) {
                                $excerpt = Str::limit(strip_tags($blog->body ?? ''), 100);
                            }
                        @endphp
                        {{ Str::limit($excerpt, 100) }}
                    </p>
                    
                    {{-- Meta Information --}}
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 bg-emerald-600 rounded-full flex items-center justify-center">
                                    <span class="text-black font-semibold text-xs">
                                        {{ substr($blog->author->name ?? 'S', 0, 1) }}
                                    </span>
                                </div>
                                <span class="text-gray-400">{{ $blog->author->name ?? 'Sanaa Team' }}</span>
                            </div>
                            @php
                                try {
                                    $formattedDate = $blog->formatted_date;
                                } catch (\Exception $e) {
                                    $formattedDate = $blog->created_at->format('M d, Y');
                                }
                            @endphp
                            <span class="text-gray-500">{{ $formattedDate }}</span>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center space-x-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ number_format($blog->views ?? 0) }}</span>
                            </span>
                            <span class="text-gray-600">•</span>
                            @php
                                try {
                                    $readingTime = $blog->reading_time ?? 5;
                                } catch (\Exception $e) {
                                    $readingTime = 5;
                                }
                            @endphp
                            <span>{{ $readingTime }} min</span>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            {{-- Placeholder when no blogs exist --}}
            @for($i = 1; $i <= 3; $i++)
                <article class="group bg-gray-900/30 rounded-2xl overflow-hidden border border-gray-800 hover:border-emerald-500/30 transition-all duration-500">
                    <div class="h-48 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-white mb-3">
                            Coming Soon: Exciting Content
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">
                            We're working on bringing you insightful articles about technology, innovation, and digital transformation.
                        </p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-emerald-600 rounded-full flex items-center justify-center">
                                        <span class="text-black font-semibold text-xs">S</span>
                                    </div>
                                    <span class="text-gray-400">Sanaa Team</span>
                                </div>
                                <span class="text-gray-500">Coming Soon</span>
                            </div>
                            <span>5 min</span>
                        </div>
                    </div>
                </article>
            @endfor
        @endforelse
    </div>

    {{-- Call to Action --}}
    <div class="text-center">
        @php
            try {
                $blogIndexUrl = route('blog.index');
            } catch (\Exception $e) {
                $blogIndexUrl = '/blog';
            }
        @endphp
        <a href="{{ $blogIndexUrl }}"
           class="inline-flex items-center px-8 py-4 bg-transparent border border-emerald-500/30 text-emerald-400 hover:bg-emerald-600 hover:text-black font-medium rounded-full transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-emerald-500/20 group">
            <span>Explore All Articles</span>
            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </a>
    </div>
</div>

{{-- Background Effects --}}
<div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-emerald-400/3 rounded-full blur-3xl"></div>
</div>
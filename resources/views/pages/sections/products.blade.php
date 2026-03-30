<section id="products" class="products-premium">
    <div class="section-header">
        <h2 class="section-title reveal-element">{{ $section->getTranslation('title') }}</h2>
        <p class="section-subtitle reveal-element" style="color: var(--light-gray); margin-top: 1rem;">{{ $section->getTranslation('subtitle') }}</p>
    </div>
    
    <!-- Loading State -->
    <div id="products-loading" class="products-grid">
        @for ($i = 0; $i < 8; $i++)
            <div class="product-card-premium skeleton">
                <div class="skeleton-img"></div>
                <div style="padding: 1.5rem;">
                    <div class="skeleton-title"></div>
                    <div class="skeleton-price"></div>
                </div>
            </div>
        @endfor
    </div>
    
    <!-- Products Container -->
    <div class="products-grid" id="product-container" style="display: none;">
        @if(isset($sokoProducts['data']) && count($sokoProducts['data']) > 0)
            @foreach(array_slice($sokoProducts['data'], 0, 8) as $index => $product)
                <div 
                    class="product-card-premium" 
                    data-product-id="{{ $product['id'] }}" 
                    data-product-slug="{{ $product['slug'] ?? Str::slug($product['name']) }}" 
                    style="--delay: {{ $index + 1 }}">
                    <div class="product-image-wrapper">
                        <img src="{{ $product['thumbnail_image'] }}" alt="{{ $product['name'] }}" class="product-image" loading="lazy" onerror="this.src='/img/placeholder-product.jpg';">
                        @if($product['has_discount'])
                            <span class="product-badge">{{ $product['discount'] }}</span>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $product['name'] }}</h3>
                        <div class="product-price">
                            <span class="price-current">{{ str_replace('/=', '', $product['main_price']) }}</span>
                            @if($product['has_discount'])
                                <span class="price-original">{{ str_replace('/=', '', $product['stroked_price']) }}</span>
                            @endif
                        </div>
                        <button class="product-action quick-view-btn">{{ __('Quick View') }}</button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    
    <div style="text-align: center; margin-top: 4rem;">
        <a href="https://soko.sanaa.co" class="btn-cta" target="_blank">
            <span>{{ $section->getTranslation('cta_text') }}</span>
        </a>
    </div>
</section>

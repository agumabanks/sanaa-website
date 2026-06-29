<footer class="bg-black text-white py-16" role="contentinfo">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Footer Navigation Sections -->
        <nav class="grid grid-cols-2 md:grid-cols-4 gap-12" aria-label="Footer navigation">
            @foreach($footerMenu as $section)
                <div>
                    <h4 class="font-bold mb-6 text-gray-500 uppercase tracking-widest text-xs">{{ $section->label }}</h4>
                    <ul class="space-y-3" role="list">
                        @foreach($section->children as $link)
                            @php
                                $isActive = $link->route_name
                                    ? isActiveRoute($link->route_name)
                                    : isActiveUrl($link->url);
                            @endphp
                            <li>
                                <a
                                    href="{{ $link->resolved_url }}"
                                    class="text-sm text-gray-400 hover:text-emerald-500 transition-colors duration-200 flex items-center group {{ $isActive ? 'text-emerald-500' : '' }}"
                                    @if($link->is_external)
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        aria-label="{{ $link->label }} (opens in new tab)"
                                    @endif
                                >
                                    <span>{{ $link->label }}</span>
                                    @if($link->is_external)
                                        <svg
                                            class="w-3 h-3 ml-1.5 opacity-0 group-hover:opacity-100 transition-opacity"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <!-- Contact/Support Special Section -->
            <div>
                <h4 class="font-bold mb-6 text-gray-500 uppercase tracking-widest text-xs">Help & Support</h4>
                <div class="space-y-6">
                    @if(config('footer.support.customer'))
                        <div>
                            <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">
                                {{ config('footer.support.customer.label') }}
                            </p>
                            <a
                                href="tel:{{ config('footer.support.customer.phone_raw') }}"
                                class="text-sm font-bold hover:text-emerald-500 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-black rounded"
                                aria-label="Call customer support at {{ config('footer.support.customer.phone') }}"
                            >
                                {{ config('footer.support.customer.phone') }}
                            </a>
                        </div>
                    @endif

                    @if(config('footer.support.sales'))
                        <div>
                            <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">
                                {{ config('footer.support.sales.label') }}
                            </p>
                            <a
                                href="tel:{{ config('footer.support.sales.phone_raw') }}"
                                class="text-sm font-bold hover:text-emerald-500 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-black rounded"
                                aria-label="Call sales enquiries at {{ config('footer.support.sales.phone') }}"
                            >
                                {{ config('footer.support.sales.phone') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Social & Copyright Bottom Bar -->
        <div class="mt-16 pt-8 border-t border-gray-900 flex flex-col md:flex-row items-center justify-between gap-6">
            <!-- Social Links -->
            <div class="flex items-center space-x-6" role="navigation" aria-label="Social media links">
                @foreach(config('footer.social', []) as $platform => $social)
                    <a
                        href="{{ $social['url'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-gray-500 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-black rounded-full p-1"
                        aria-label="{{ $social['label'] }}"
                    >
                        @if($platform === 'twitter')
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M23.444 4.834c-.835.37-1.73.62-2.675.73a4.66 4.66 0 002.047-2.572 9.26 9.26 0 01-2.93 1.124A4.644 4.644 0 0016.292 3a4.673 4.673 0 00-4.668 4.668c0 .366.041.722.12 1.065A13.226 13.226 0 011.64 3.162a4.65 4.65 0 00-.633 2.347 4.66 4.66 0 002.073 3.883 4.605 4.605 0 01-2.115-.584v.06c0 2.258 1.606 4.141 3.73 4.568a4.66 4.66 0 01-2.105.08 4.67 4.67 0 004.36 3.238A9.351 9.351 0 010 19.54a13.17 13.17 0 007.118 2.087c8.54 0 13.213-7.075 13.213-13.213 0-.202 0-.404-.014-.605a9.344 9.344 0 002.298-2.386z"></path>
                            </svg>
                        @elseif($platform === 'linkedin')
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
                            </svg>
                        @elseif($platform === 'instagram')
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.346 3.608 1.321.976.976 1.259 2.243 1.321 3.609.058 1.265.07 1.645.07 4.848 0 3.204-.012 3.584-.07 4.849-.062 1.365-.346 2.632-1.321 3.608-.976.975-2.243 1.259-3.609 1.321-1.264.059-1.644.07-4.848.07-3.204 0-3.584-.012-4.849-.07-1.366-.062-2.633-.346-3.609-1.321-.975-.976-1.259-2.243-1.321-3.608-.059-1.264-.07-1.644-.07-4.848 0-3.204.011-3.584.07-4.849.062-1.366.346-2.633 1.321-3.609.976-.975 2.243-1.259 3.609-1.321C8.416 2.175 8.796 2.163 12 2.163zM12 0C8.74 0 8.332.013 7.052.07 5.77.128 4.559.417 3.47 1.506 2.38 2.597 2.091 3.808 2.033 5.09.975 6.372.962 6.78.962 10.04c0 3.26.013 3.668.07 4.948.058 1.282.347 2.493 1.436 3.583 1.091 1.09 2.302 1.379 3.584 1.437 1.281.057 1.689.07 4.949.07 3.26 0 3.668-.013 4.948-.07 1.282-.058 2.493-.347 3.583-1.437 1.09-1.09 1.379-2.301 1.437-3.583.057-1.28.07-1.688.07-4.948 0-3.26-.013-3.668-.07-4.949-.058-1.281-.347-2.492-1.437-3.582C19.443.417 18.232.128 16.95.07 15.668.013 15.26 0 12 0zm0 5.838a6.163 6.163 0 100 12.325 6.163 6.163 0 000-12.325zm6.406-11.845a1.44 1.44 0 10-.001-2.88 1.44 1.44 0 00.001 2.88z"></path>
                            </svg>
                        @endif
                        <span class="nav-sr-only">{{ $social['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Legal Links & Copyright -->
            <div class="text-xs text-gray-500 flex flex-wrap items-center justify-center gap-x-4 gap-y-2">
                @if(config('footer.copyright.show_year'))
                    <span>&copy; {{ date('Y') }} {{ config('footer.copyright.text') }}</span>
                @else
                    <span>&copy; {{ config('footer.copyright.text') }}</span>
                @endif

                @foreach(config('footer.legal_links', []) as $link)
                    @php
                        $isActive = isActiveRoute($link['route']);
                    @endphp
                    <a
                        href="{{ route($link['route']) }}"
                        class="hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-black rounded {{ $isActive ? 'text-emerald-500' : '' }}"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="mt-6 text-xs text-gray-500 leading-6">
            Sanaa Brands Ltd is registered in Uganda (URSB). Sanaa Finance Cooperative is registered in Uganda (2022). Sanaa Co. is the trading brand of the Sanaa ecosystem.
        </div>
    </div>
</footer>

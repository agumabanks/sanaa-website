// resources/js/blog.js

class BlogManager {
    constructor() {
        this.init();
        this.bindEvents();
        this.initializeFeatures();
    }

    init() {
        // Initialize core variables
        this.currentFontSize = 18;
        this.isReading = false;
        this.speech = null;
        this.readingStartTime = Date.now();
        this.totalReadingTime = 0;
        this.maxScrollDepth = 0;
        this.isInfiniteScrollEnabled = true;
        this.currentPage = 1;
        this.isLoading = false;
        this.hasMorePages = document.querySelector('[data-has-more-pages]')?.dataset.hasMorePages === 'true';
        
        // Get CSRF token
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Get blog ID if on article page
        this.blogId = document.querySelector('[data-blog-id]')?.dataset.blogId;
        
        // Initialize intersection observer for infinite scroll
        this.initInfiniteScroll();
        
        // Initialize reading progress
        this.updateReadingProgress();
    }

    bindEvents() {
        // Scroll events
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            this.updateReadingProgress();
            this.trackScrollDepth();
            
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => this.trackReadingTime(), 1000);
        });

        // Visibility change tracking
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') {
                this.readingStartTime = Date.now();
            } else {
                this.trackReadingTime();
            }
        });

        // Font size controls
        document.getElementById('increase-font')?.addEventListener('click', () => this.increaseFontSize());
        document.getElementById('decrease-font')?.addEventListener('click', () => this.decreaseFontSize());

        // Text-to-speech
        document.getElementById('text-to-speech')?.addEventListener('click', () => this.toggleTextToSpeech());

        // Engagement buttons
        document.querySelectorAll('.engagement-btn').forEach(button => {
            button.addEventListener('click', (e) => this.handleEngagement(e));
        });

        // Share buttons
        document.querySelectorAll('.share-btn, .share-platform-btn, .share-platform-btn-large').forEach(button => {
            button.addEventListener('click', (e) => this.handleShare(e));
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => this.handleKeyboardShortcuts(e));

        // Mobile menu
        document.getElementById('mobile-menu-button')?.addEventListener('click', () => this.toggleMobileMenu());

        // Filter tabs
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', (e) => this.handleFilterChange(e));
        });

        // Category and tag filters
        document.querySelectorAll('.category-item, .tag-item').forEach(item => {
            item.addEventListener('click', (e) => this.handleFilterChange(e));
        });

        // Load more button
        document.getElementById('load-more-btn')?.addEventListener('click', () => this.loadMoreArticles());

        // Newsletter form
        document.querySelector('.newsletter-form')?.addEventListener('submit', (e) => this.handleNewsletterSubmit(e));
    }

    initializeFeatures() {
        // Initialize animations
        this.initAnimations();
        
        // Initialize tooltips
        this.initTooltips();
        
        // Initialize lazy loading
        this.initLazyLoading();
        
        // Initialize PWA features
        this.initPWA();
        
        // Initialize performance monitoring
        this.initPerformanceMonitoring();
    }

    // Reading Progress Bar
    updateReadingProgress() {
        const article = document.getElementById('article-content');
        if (!article) return;

        const articleHeight = article.offsetHeight;
        const articleTop = article.offsetTop;
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;
        
        const articleStart = articleTop - windowHeight * 0.3;
        const articleEnd = articleTop + articleHeight - windowHeight * 0.7;
        
        let progress = 0;
        if (scrollPosition < articleStart) {
            progress = 0;
        } else if (scrollPosition > articleEnd) {
            progress = 100;
        } else {
            progress = ((scrollPosition - articleStart) / (articleEnd - articleStart)) * 100;
            progress = Math.max(0, Math.min(100, progress));
        }
        
        this.setProgress(progress);
    }

    setProgress(percentage) {
        const progressBar = document.getElementById('reading-progress');
        if (progressBar) {
            progressBar.style.width = percentage + '%';
        }
    }

    // Scroll Depth Tracking
    trackScrollDepth() {
        const scrollPercent = Math.round(
            (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100
        );
        
        if (scrollPercent > this.maxScrollDepth) {
            this.maxScrollDepth = scrollPercent;
            
            // Track milestone scroll depths
            const milestones = [25, 50, 75, 100];
            milestones.forEach(milestone => {
                if (this.maxScrollDepth >= milestone && this.maxScrollDepth < milestone + 5) {
                    this.trackAnalytics('scroll_depth', milestone);
                }
            });
        }
    }

    // Reading Time Tracking
    trackReadingTime() {
        if (!this.blogId) return;
        
        const currentTime = Date.now();
        const sessionTime = Math.round((currentTime - this.readingStartTime) / 1000);
        this.totalReadingTime += sessionTime;
        
        if (sessionTime >= 30) {
            this.trackAnalytics('reading_time', sessionTime);
        }
        
        this.readingStartTime = currentTime;
    }

    // Font Size Controls
    increaseFontSize() {
        this.currentFontSize = Math.min(this.currentFontSize + 2, 24);
        this.updateFontSize();
        this.trackAnalytics('font_change', this.currentFontSize);
        this.showToast('Font size increased');
    }

    decreaseFontSize() {
        this.currentFontSize = Math.max(this.currentFontSize - 2, 14);
        this.updateFontSize();
        this.trackAnalytics('font_change', this.currentFontSize);
        this.showToast('Font size decreased');
    }

    updateFontSize() {
        const content = document.getElementById('article-content');
        if (content) {
            content.style.fontSize = this.currentFontSize + 'px';
            
            // Store preference in localStorage
            try {
                localStorage.setItem('blogFontSize', this.currentFontSize.toString());
            } catch (e) {
                // Fallback if localStorage is not available
                console.log('localStorage not available');
            }
        }
    }

    // Text-to-Speech
    toggleTextToSpeech() {
        if (!this.isReading) {
            this.startReading();
        } else {
            this.stopReading();
        }
    }

    startReading() {
        if ('speechSynthesis' in window) {
            const content = document.getElementById('article-content');
            if (!content) return;
            
            const text = content.textContent;
            
            this.speech = new SpeechSynthesisUtterance(text);
            this.speech.rate = 0.9;
            this.speech.pitch = 1;
            this.speech.volume = 1;
            
            this.speech.onstart = () => {
                this.isReading = true;
                document.getElementById('text-to-speech')?.classList.add('active');
                this.showToast('Text-to-speech started');
            };
            
            this.speech.onend = () => {
                this.isReading = false;
                document.getElementById('text-to-speech')?.classList.remove('active');
                this.showToast('Text-to-speech finished');
            };
            
            this.speech.onerror = () => {
                this.isReading = false;
                document.getElementById('text-to-speech')?.classList.remove('active');
                this.showToast('Text-to-speech error', 'error');
            };
            
            speechSynthesis.speak(this.speech);
            this.trackAnalytics('text_to_speech', 1);
        } else {
            this.showToast('Text-to-speech not supported', 'error');
        }
    }

    stopReading() {
        if (speechSynthesis.speaking) {
            speechSynthesis.cancel();
            this.isReading = false;
            document.getElementById('text-to-speech')?.classList.remove('active');
            this.showToast('Text-to-speech stopped');
        }
    }

    // Engagement Handling
    async handleEngagement(event) {
        const button = event.currentTarget;
        const action = button.dataset.action;
        const blogId = button.dataset.blogId;
        
        if (!action || !blogId) return;
        
        try {
            const response = await fetch(`/blog/${blogId}/${action}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.updateEngagementUI(button, action, data);
                this.showToast(data.message || `${action.charAt(0).toUpperCase() + action.slice(1)} successful!`);
            } else {
                this.showToast(data.message || 'Action already performed!', 'warning');
            }
        } catch (error) {
            console.error('Engagement error:', error);
            this.showToast('An error occurred. Please try again.', 'error');
        }
    }

    updateEngagementUI(button, action, data) {
        // Update count
        const countElement = button.querySelector(`.${action}-count`);
        if (countElement && data[action + 's']) {
            countElement.textContent = data[action + 's'];
            
            // Animate count change
            countElement.style.transform = 'scale(1.2)';
            setTimeout(() => {
                countElement.style.transform = 'scale(1)';
            }, 200);
        }
        
        // Add active state
        button.classList.add('active');
        
        // Trigger animation
        if (action === 'like') {
            button.querySelector('svg')?.classList.add('animate-bounce');
            setTimeout(() => {
                button.querySelector('svg')?.classList.remove('animate-bounce');
            }, 600);
        }
    }

    // Share Handling
    handleShare(event) {
        const button = event.currentTarget;
        const platform = button.dataset.platform;
        
        if (platform) {
            this.shareOnPlatform(platform);
        } else {
            this.openShareModal();
        }
    }

    shareOnPlatform(platform) {
        const url = window.location.href;
        const title = document.querySelector('h1')?.textContent || document.title;
        const description = document.querySelector('meta[name="description"]')?.content || '';
        
        let shareUrl = '';
        
        switch (platform) {
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`;
                break;
            case 'linkedin':
                shareUrl = `https://linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                break;
            case 'facebook':
                shareUrl = `https://facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                break;
            case 'copy':
                this.copyToClipboard(url);
                return;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400,scrollbars=yes,resizable=yes');
            this.trackShare(platform);
        }
    }

    async trackShare(platform) {
        if (!this.blogId) return;
        
        try {
            const response = await fetch(`/blog/${this.blogId}/share`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ platform })
            });
            
            const data = await response.json();
            
            if (data.success) {
                document.querySelectorAll('.share-count').forEach(el => {
                    el.textContent = data.shares;
                });
            }
        } catch (error) {
            console.error('Share tracking error:', error);
        }
    }

    // Analytics Tracking
    async trackAnalytics(eventType, value, metadata = {}) {
        if (!this.blogId) return;
        
        try {
            await fetch('/api/analytics/track', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    blog_id: this.blogId,
                    event_type: eventType,
                    value: value,
                    metadata: {
                        ...metadata,
                        timestamp: Date.now(),
                        user_agent: navigator.userAgent,
                        screen_resolution: `${screen.width}x${screen.height}`,
                        viewport_size: `${window.innerWidth}x${window.innerHeight}`
                    }
                })
            });
        } catch (error) {
            console.error('Analytics tracking error:', error);
        }
    }

    // Keyboard Shortcuts
    handleKeyboardShortcuts(event) {
        // Only trigger shortcuts if user is not typing in an input
        if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') {
            return;
        }
        
        switch(event.key.toLowerCase()) {
            case 'l':
                event.preventDefault();
                document.querySelector('.like-btn')?.click();
                break;
            case 's':
                event.preventDefault();
                document.querySelector('.bookmark-btn')?.click();
                break;
            case 'h':
                event.preventDefault();
                this.openShareModal();
                break;
            case 't':
                event.preventDefault();
                this.toggleTextToSpeech();
                break;
            case '+':
            case '=':
                event.preventDefault();
                this.increaseFontSize();
                break;
            case '-':
                event.preventDefault();
                this.decreaseFontSize();
                break;
            case '?':
                event.preventDefault();
                this.showShortcuts();
                break;
            case 'escape':
                this.closeShareModal();
                this.hideShortcuts();
                break;
        }
    }

    // Infinite Scroll
    initInfiniteScroll() {
        const loadingIndicator = document.getElementById('loading-indicator');
        
        if (!loadingIndicator || !this.isInfiniteScrollEnabled) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && this.hasMorePages && !this.isLoading) {
                    this.loadMoreArticles();
                }
            });
        }, {
            rootMargin: '100px'
        });
        
        observer.observe(loadingIndicator);
    }

    async loadMoreArticles() {
        if (this.isLoading || !this.hasMorePages) return;
        
        this.isLoading = true;
        this.showLoading();
        
        try {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('page', this.currentPage + 1);
            
            const response = await fetch(currentUrl.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.articles && data.articles.length > 0) {
                this.appendArticles(data.articles);
                this.currentPage++;
                this.hasMorePages = data.has_more;
                
                if (!this.hasMorePages) {
                    document.getElementById('load-more-btn')?.style.setProperty('display', 'none');
                }
            }
        } catch (error) {
            console.error('Error loading articles:', error);
            this.showToast('Error loading more articles', 'error');
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }
    }

    appendArticles(articles) {
        const container = document.getElementById('articles-container');
        const template = document.getElementById('article-template');
        
        if (!container || !template) return;
        
        articles.forEach((article, index) => {
            const articleElement = this.createArticleElement(article, template);
            container.appendChild(articleElement);
            
            // Trigger staggered fade-in animation
            setTimeout(() => {
                articleElement.classList.add('fade-in');
            }, index * 100);
        });
    }

    createArticleElement(article, template) {
        const clone = template.content.cloneNode(true);
        
        // Set article data
        clone.querySelector('.article-title').textContent = article.title;
        clone.querySelector('.article-title').href = `/blog/${article.slug}`;
        clone.querySelector('.article-excerpt').textContent = this.truncateText(article.excerpt, 120);
        clone.querySelector('.article-author').textContent = article.author;
        clone.querySelector('.author-initial').textContent = article.author.charAt(0);
        clone.querySelector('.article-date').textContent = article.formatted_date;
        clone.querySelector('.article-reading-time').textContent = article.reading_time + ' min';
        clone.querySelector('.article-views').textContent = article.views;
        clone.querySelector('.article-likes').textContent = article.likes;
        
        // Handle category
        const categoryEl = clone.querySelector('.article-category');
        if (article.category) {
            categoryEl.textContent = article.category;
        } else {
            categoryEl.style.display = 'none';
        }
        
        // Handle featured image
        const imageContainer = clone.querySelector('.article-image');
        if (article.featured_image_url) {
            const img = imageContainer.querySelector('img');
            img.src = article.featured_image_url;
            img.alt = article.title;
            imageContainer.style.display = 'block';
        }
        
        // Handle featured status
        const featuredEl = clone.querySelector('.article-featured');
        if (article.featured) {
            featuredEl.style.display = 'inline-block';
        }
        
        return clone;
    }

    showLoading() {
        const loadingIndicator = document.getElementById('loading-indicator');
        const loadMoreBtn = document.getElementById('load-more-btn');
        
        if (loadingIndicator) {
            loadingIndicator.classList.remove('hidden');
        }
        if (loadMoreBtn) {
            loadMoreBtn.disabled = true;
            loadMoreBtn.textContent = 'Loading...';
        }
    }

    hideLoading() {
        const loadingIndicator = document.getElementById('loading-indicator');
        const loadMoreBtn = document.getElementById('load-more-btn');
        
        if (loadingIndicator) {
            loadingIndicator.classList.add('hidden');
        }
        if (loadMoreBtn) {
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent = 'Load More Articles';
        }
    }

    // UI Helpers
    toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu) {
            mobileMenu.classList.toggle('hidden');
        }
    }

    async handleFilterChange(event) {
        event.preventDefault();

        const clickedTab = event.currentTarget;
        const filter = clickedTab.dataset.filter;
        const type = clickedTab.dataset.type || 'category';

        if (clickedTab.classList.contains('filter-tab')) {
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active', 'border-green-500', 'text-green-400');
                tab.classList.add('text-gray-400');
            });

            clickedTab.classList.add('active', 'border-green-500', 'text-green-400');
            clickedTab.classList.remove('text-gray-400');
        }

        const url = new URL(window.location);
        url.searchParams.delete('page');

        if (filter === 'all') {
            url.searchParams.delete('category');
            url.searchParams.delete('tag');
        } else if (type === 'tag') {
            url.searchParams.set('tag', filter);
            url.searchParams.delete('category');
        } else {
            url.searchParams.set('category', filter);
            url.searchParams.delete('tag');
        }

        history.pushState({}, '', url);

        try {
            this.isLoading = true;
            this.showLoading();

            const response = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            const container = document.getElementById('articles-container');
            if (container) {
                container.innerHTML = '';
            }

            if (data.articles) {
                this.appendArticles(data.articles);
            }

            this.currentPage = data.current_page || 1;
            this.hasMorePages = data.has_more;

            const loadMoreBtn = document.getElementById('load-more-btn');
            if (loadMoreBtn) {
                if (this.hasMorePages) {
                    loadMoreBtn.style.removeProperty('display');
                } else {
                    loadMoreBtn.style.setProperty('display', 'none');
                }
            }
        } catch (error) {
            console.error('Error loading articles:', error);
            this.showToast('Error loading articles', 'error');
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }

        this.trackAnalytics('filter_change', 0, { type, filter });
    }

    async handleNewsletterSubmit(event) {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);
        const email = formData.get('email');
        
        if (!email || !this.isValidEmail(email)) {
            this.showToast('Please enter a valid email address', 'error');
            return;
        }
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showToast('Successfully subscribed to newsletter!');
                form.reset();
            } else {
                this.showToast(data.message || 'Subscription failed', 'error');
            }
        } catch (error) {
            console.error('Newsletter subscription error:', error);
            this.showToast('An error occurred. Please try again.', 'error');
        }
    }

    // Modal Management
    openShareModal() {
        const modal = document.getElementById('share-modal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    closeShareModal() {
        const modal = document.getElementById('share-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }

    showShortcuts() {
        const shortcuts = document.getElementById('shortcuts-help');
        if (shortcuts) {
            shortcuts.classList.remove('hidden');
            shortcuts.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    hideShortcuts() {
        const shortcuts = document.getElementById('shortcuts-help');
        if (shortcuts) {
            shortcuts.classList.add('hidden');
            shortcuts.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }

    // Utility Functions
    copyToClipboard(text = window.location.href) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(() => {
                this.showToast('Link copied to clipboard!');
                this.closeShareModal();
            }).catch(() => {
                this.fallbackCopyToClipboard(text);
            });
        } else {
            this.fallbackCopyToClipboard(text);
        }
    }

    fallbackCopyToClipboard(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            this.showToast('Link copied to clipboard!');
            this.closeShareModal();
        } catch (err) {
            this.showToast('Failed to copy link', 'error');
        } finally {
            textArea.remove();
        }
    }

    showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        
        if (!toast || !toastMessage) return;
        
        toastMessage.textContent = message;
        
        // Set toast color based on type
        toast.className = toast.className.replace(/bg-\w+-\d+/, '');
        switch (type) {
            case 'error':
                toast.classList.add('bg-red-600');
                break;
            case 'warning':
                toast.classList.add('bg-yellow-600');
                break;
            case 'info':
                toast.classList.add('bg-blue-600');
                break;
            default:
                toast.classList.add('bg-green-600');
        }
        
        toast.classList.remove('translate-y-full');
        
        setTimeout(() => {
            toast.classList.add('translate-y-full');
        }, 3000);
    }

    truncateText(text, maxLength) {
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength).trim() + '...';
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Advanced Features
    initAnimations() {
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observe all elements with fade-in class that aren't already visible
        document.querySelectorAll('.fade-in:not(.fade-in)').forEach(el => {
            observer.observe(el);
        });
    }

    initTooltips() {
        // Simple tooltip implementation
        document.querySelectorAll('[title]').forEach(element => {
            element.addEventListener('mouseenter', this.showTooltip.bind(this));
            element.addEventListener('mouseleave', this.hideTooltip.bind(this));
        });
    }

    showTooltip(event) {
        const element = event.target;
        const title = element.getAttribute('title');
        
        if (!title) return;
        
        // Create tooltip
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip fixed bg-gray-900 text-white text-sm px-2 py-1 rounded shadow-lg z-50 pointer-events-none';
        tooltip.textContent = title;
        
        document.body.appendChild(tooltip);
        
        // Position tooltip
        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
        
        // Store reference
        element._tooltip = tooltip;
        
        // Hide original title
        element.setAttribute('data-original-title', title);
        element.removeAttribute('title');
    }

    hideTooltip(event) {
        const element = event.target;
        const tooltip = element._tooltip;
        
        if (tooltip) {
            tooltip.remove();
            delete element._tooltip;
        }
        
        // Restore original title
        const originalTitle = element.getAttribute('data-original-title');
        if (originalTitle) {
            element.setAttribute('title', originalTitle);
            element.removeAttribute('data-original-title');
        }
    }

    initLazyLoading() {
        // Lazy loading for images
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.getAttribute('data-src');
                    
                    if (src) {
                        img.src = src;
                        img.removeAttribute('data-src');
                        img.classList.remove('loading-skeleton');
                        imageObserver.unobserve(img);
                    }
                }
            });
        }, { rootMargin: '50px' });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    initPWA() {
        // Register service worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('SW registered: ', registration);
                    })
                    .catch(registrationError => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
        
        // Handle install prompt
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            this.showInstallPrompt();
        });
    }

    showInstallPrompt() {
        // Create install prompt (you can customize this)
        const installBanner = document.createElement('div');
        installBanner.className = 'fixed bottom-4 left-4 right-4 bg-gray-900 border border-green-500 rounded-lg p-4 flex items-center justify-between z-50';
        installBanner.innerHTML = `
            <div>
                <h3 class="font-semibold text-white">Install Sanaa Blog</h3>
                <p class="text-sm text-gray-400">Get the full experience with our app!</p>
            </div>
            <div class="flex space-x-2">
                <button id="install-dismiss" class="px-3 py-1 text-gray-400 hover:text-white">Later</button>
                <button id="install-accept" class="px-3 py-1 bg-green-600 text-black rounded">Install</button>
            </div>
        `;
        
        document.body.appendChild(installBanner);
        
        // Handle install actions
        document.getElementById('install-accept').addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const result = await deferredPrompt.userChoice;
                console.log('Install prompt result:', result);
                deferredPrompt = null;
            }
            installBanner.remove();
        });
        
        document.getElementById('install-dismiss').addEventListener('click', () => {
            installBanner.remove();
        });
    }

    initPerformanceMonitoring() {
        // Basic performance monitoring
        window.addEventListener('load', () => {
            setTimeout(() => {
                const perfData = performance.getEntriesByType('navigation')[0];
                const loadTime = perfData.loadEventEnd - perfData.loadEventStart;
                
                if (loadTime > 0) {
                    this.trackAnalytics('page_load_time', Math.round(loadTime), {
                        navigation_type: perfData.type,
                        redirect_count: perfData.redirectCount
                    });
                }
            }, 0);
        });
        
        // Track Core Web Vitals if available
        if ('web-vital' in window) {
            import('web-vitals').then(({ getCLS, getFID, getFCP, getLCP, getTTFB }) => {
                getCLS(metric => this.trackAnalytics('cls', metric.value));
                getFID(metric => this.trackAnalytics('fid', metric.value));
                getFCP(metric => this.trackAnalytics('fcp', metric.value));
                getLCP(metric => this.trackAnalytics('lcp', metric.value));
                getTTFB(metric => this.trackAnalytics('ttfb', metric.value));
            });
        }
    }

    // Load saved preferences
    loadPreferences() {
        try {
            const savedFontSize = localStorage.getItem('blogFontSize');
            if (savedFontSize) {
                this.currentFontSize = parseInt(savedFontSize);
                this.updateFontSize();
            }
        } catch (e) {
            // localStorage not available
            console.log('localStorage not available for preferences');
        }
    }

    // Cleanup
    destroy() {
        // Clean up event listeners and observers
        if (this.speech) {
            speechSynthesis.cancel();
        }
        
        // Remove any created elements
        document.querySelectorAll('.tooltip').forEach(tooltip => tooltip.remove());
        
        // Clear timeouts and intervals
        // (Add any cleanup code here)
    }
}

// Global functions for template usage
window.openShareModal = function() {
    if (window.blogManager) {
        window.blogManager.openShareModal();
    }
};

window.closeShareModal = function() {
    if (window.blogManager) {
        window.blogManager.closeShareModal();
    }
};

window.copyToClipboard = function() {
    if (window.blogManager) {
        window.blogManager.copyToClipboard();
    }
};

window.showShortcuts = function() {
    if (window.blogManager) {
        window.blogManager.showShortcuts();
    }
};

window.hideShortcuts = function() {
    if (window.blogManager) {
        window.blogManager.hideShortcuts();
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.blogManager = new BlogManager();
    window.blogManager.loadPreferences();
});

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    if (window.blogManager) {
        window.blogManager.destroy();
    }
});
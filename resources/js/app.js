import './bootstrap';

// Import Alpine.js
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Register Alpine plugins
Alpine.plugin(collapse);

// Make Alpine available globally
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

// Theme initialization (FOUC prevention)
const initTheme = () => {
    const root = document.documentElement;
    const stored = localStorage.getItem('theme');
    if (stored === 'dark' || (!stored && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
};

// Initialize theme immediately (before DOMContentLoaded to prevent flash)
initTheme();

document.addEventListener('DOMContentLoaded', () => {
    // Fallback toggle for non-Alpine pages (if any)
    const toggle = document.getElementById('theme-toggle');
    if (toggle) {
        toggle.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }
});

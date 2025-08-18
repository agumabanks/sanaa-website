import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('theme-toggle');
    if (toggle) {
        const root = document.documentElement;
        const stored = localStorage.getItem('theme');
        if (stored === 'dark') {
            root.classList.add('dark');
        }
        toggle.addEventListener('click', () => {
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }
});

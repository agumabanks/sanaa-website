// Dashboard Utilities - Helper Functions

// Auto-save functionality for forms
class AutoSaver {
    constructor(formId, storageKey, interval = 2000) {
        this.form = document.getElementById(formId);
        this.storageKey = storageKey;
        this.interval = interval;
        this.timer = null;
        this.init();
    }

    init() {
        if (!this.form) return;

        const inputs = this.form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('input', () => this.scheduleave());
        });

        // Load saved data
        this.loadSavedData();
    }

    scheduleSave() {
        clearTimeout(this.timer);
        this.showSaving();
        this.timer = setTimeout(() => this.save(), this.interval);
    }

    save() {
        const formData = new FormData(this.form);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        data.timestamp = Date.now();
        
        localStorage.setItem(this.storageKey, JSON.stringify(data));
        this.showSaved();
    }

    loadSavedData() {
        const saved = localStorage.getItem(this.storageKey);
        if (!saved) return;

        const data = JSON.parse(saved);
        const timeSince = Date.now() - data.timestamp;
        
        // Only load if less than 24 hours old
        if (timeSince < 24 * 60 * 60 * 1000) {
            if (confirm(`Recover unsaved work from ${new Date(data.timestamp).toLocaleString()}?`)) {
                Object.keys(data).forEach(key => {
                    const field = this.form.querySelector(`[name="${key}"]`);
                    if (field && key !== 'timestamp') {
                        field.value = data[key];
                    }
                });
            }
        }
    }

    clearSaved() {
        localStorage.removeItem(this.storageKey);
    }

    showSaving() {
        const indicator = document.getElementById('autoSaveIndicator');
        const saved = document.getElementById('autoSaveSaved');
        if (indicator) indicator.classList.remove('hidden');
        if (saved) saved.classList.add('hidden');
    }

    showSaved() {
        const indicator = document.getElementById('autoSaveIndicator');
        const saved = document.getElementById('autoSaveSaved');
        if (indicator) indicator.classList.add('hidden');
        if (saved) {
            saved.classList.remove('hidden');
            setTimeout(() => saved.classList.add('hidden'), 2000);
        }
    }
}

// Toast Notification System
class ToastNotification {
    static show(message, type = 'info', duration = 3000) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div class="flex items-center gap-3">
                ${this.getIcon(type)}
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }

    static getIcon(type) {
        const icons = {
            success: '<svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>',
            error: '<svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>',
            warning: '<svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>',
            info: '<svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>'
        };
        return icons[type] || icons.info;
    }
}

// Confirmation Dialog
function confirmAction(message, callback) {
    if (confirm(message)) {
        callback();
    }
}

// Copy to Clipboard
async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        ToastNotification.show('Copied to clipboard!', 'success');
    } catch (err) {
        ToastNotification.show('Failed to copy', 'error');
    }
}

// Debounce Function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Format Number
function formatNumber(num) {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    }
    if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString();
}

// Time Ago
function timeAgo(date) {
    const seconds = Math.floor((new Date() - new Date(date)) / 1000);
    
    const intervals = {
        year: 31536000,
        month: 2592000,
        week: 604800,
        day: 86400,
        hour: 3600,
        minute: 60
    };
    
    for (const [unit, secondsInUnit] of Object.entries(intervals)) {
        const interval = Math.floor(seconds / secondsInUnit);
        if (interval >= 1) {
            return interval === 1 ? `1 ${unit} ago` : `${interval} ${unit}s ago`;
        }
    }
    
    return 'just now';
}

// Export utilities
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        AutoSaver,
        ToastNotification,
        confirmAction,
        copyToClipboard,
        debounce,
        formatNumber,
        timeAgo
    };
}

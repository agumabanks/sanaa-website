@extends('layouts.landing')

@section('title', 'Support | ' . config('app.name'))

@section('content')
<style>
    /* Reset and base styles */
     .support-page {
        font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .support-page * {
        box-sizing: border-box;
    }
    
    .hero {
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: white;
        text-align: center;
        padding: 80px 20px 60px;
    }
    
    .hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 600;
        color: white !important;
        margin-bottom: 20px;
        letter-spacing: -0.02em;
    }
    
    .hero p {
        font-size: 1.25rem;
        opacity: 0.8;
        max-width: 600px;
        margin: 0 auto;
        color: white;
    }
    
    .support-grid {
        max-width: 1200px;
        margin: -40px auto 0;
        padding: 0 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        position: relative;
        z-index: 2;
    }
    
    .support-card {
        background: white !important;
        border-radius: 20px !important;
        padding: 40px 30px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
        border: 1px solid rgba(0,0,0,0.05) !important;
        position: relative;
        overflow: hidden;
        min-height: 320px;
        display: flex !important;
        flex-direction: column !important;
    }
    
    .support-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }
    
    .card-icon {
        width: 60px !important;
        height: 60px !important;
        background: linear-gradient(135deg, rgb(31, 193, 153) 0%, rgb(0, 178, 128) 100%) !important;
        border-radius: 15px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-bottom: 25px !important;
        font-size: 24px !important;
        color: white !important;
        flex-shrink: 0;
    }
    
    .card-title {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        margin-bottom: 15px !important;
        color: #1d1d1f !important;
        line-height: 1.3;
    }
    
    .card-description {
        color: #6e6e73 !important;
        margin-bottom: 25px !important;
        line-height: 1.5 !important;
        flex-grow: 1;
        font-size: 1rem;
    }
    
    .card-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: auto;
    }
    
    .card-action {
        background: rgb(37, 165, 125) !important;
        color: white !important;
        padding: 12px 24px !important;
        border-radius: 10px !important;
        text-decoration: none !important;
        font-weight: 500 !important;
        display: block !important;
        transition: all 0.2s ease !important;
        border: none !important;
        cursor: pointer !important;
        font-size: 1rem !important;
        text-align: center !important;
        width: 100% !important;
    }
    
    .card-action:hover {
        background: rgb(30, 140, 105) !important;
        transform: translateY(-1px) !important;
        color: white !important;
        text-decoration: none !important;
    }
    
    .secondary-action {
        background: #f5f5f7 !important;
        color: rgb(37, 165, 125) !important;
        border: 2px solid rgb(37, 165, 125) !important;
    }
    
    .secondary-action:hover {
        background: rgb(37, 165, 125) !important;
        color: white !important;
    }
    
    .quick-help {
        max-width: 800px;
        margin: 80px auto;
        padding: 0 20px;
    }
    
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #1d1d1f;
    }
    
    .section-subtitle {
        text-align: center;
        color: #6e6e73;
        font-size: 1.25rem;
        margin-bottom: 50px;
    }
    
    .faq-item {
        background: white;
        border-radius: 15px;
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .faq-question {
        padding: 25px 30px;
        font-weight: 500;
        color: #1d1d1f;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background 0.2s ease;
    }
    
    .faq-question:hover {
        background: #f5f5f7;
    }
    
    .faq-answer {
        padding: 0 30px 25px;
        color: #6e6e73;
        display: none;
        line-height: 1.6;
    }
    
    .faq-answer.active {
        display: block;
    }
    
    .chevron {
        transition: transform 0.3s ease;
        font-size: 14px;
        opacity: 0.7;
    }
    
    .chevron.active {
        transform: rotate(180deg);
    }
    
    .contact-form {
        max-width: 600px;
        margin: 80px auto 40px;
        padding: 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .form-group {
        margin-bottom: 25px;
        transition: transform 0.2s ease;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #1d1d1f;
    }
    
    .form-input, .form-textarea {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e5e5e7;
        border-radius: 10px;
        font-size: 1rem;
        transition: border-color 0.2s ease;
        background: #fafafa;
        font-family: inherit;
    }
    
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: rgb(31, 193, 153);
        background: white;
        box-shadow: 0 0 0 3px rgba(31, 193, 153, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .submit-button {
        background: rgb(37, 165, 125);
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
        font-family: inherit;
    }
    
    .submit-button:hover {
        background: rgb(30, 140, 105);
        transform: translateY(-1px);
    }
    
    .status-links {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 30px;
        flex-wrap: wrap;
    }
    
    .status-link {
        color: rgb(37, 165, 125);
        text-decoration: none;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.2s ease;
        font-size: 0.95rem;
    }
    
    .status-link:hover {
        background: rgba(31, 193, 153, 0.1);
        text-decoration: none;
        color: rgb(30, 140, 105);
    }
    
    .success-message {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        padding: 20px 25px;
        border-radius: 15px;
        margin-bottom: 25px;
        border: 2px solid rgb(31, 193, 153);
        text-align: center;
        font-weight: 500;
        animation: slideInSuccess 0.5s ease-out;
    }

    .error-message {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        padding: 20px 25px;
        border-radius: 15px;
        margin-bottom: 25px;
        border: 2px solid #f5c6cb;
        text-align: center;
        font-weight: 500;
        animation: slideInSuccess 0.5s ease-out;
    }
    
    @keyframes slideInSuccess {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .form-sending {
        opacity: 0.7;
        pointer-events: none;
    }
    
    .form-sending .submit-button {
        background: #ccc;
        cursor: not-allowed;
    }
    
    @media (max-width: 768px) {
        .support-grid {
            grid-template-columns: 1fr !important;
            margin-top: -20px !important;
            gap: 20px !important;
        }
        
        .hero {
            padding: 60px 20px 40px !important;
        }
        
        .support-card {
            padding: 30px 25px !important;
            min-height: auto !important;
        }
        
        .contact-form {
            margin: 40px 20px !important;
            padding: 30px 25px !important;
        }
        
        .quick-help {
            margin: 60px auto 40px !important;
        }
        
        .section-title {
            font-size: 2rem !important;
        }
        
        .faq-question {
            padding: 20px 25px !important;
        }
        
        .faq-answer {
            padding: 0 25px 20px !important;
        }
    }
</style>

<!-- Hero Section -->
<div class="support-page">
    <section class="hero">
        <h1>How can we help you?</h1>
        <p>Get the support you need, when you need it. We're here to make things simple.</p>
    </section>

    <div class="support-grid">
        <div class="support-card">
            <div class="card-icon">📞</div>
            <h3 class="card-title">Talk to someone</h3>
            <p class="card-description">Sometimes you just need to speak with a real person. Our support team is standing by to help with any questions.</p>
            <div class="card-actions">
                <a href="tel:+256706272481" class="card-action">Call 0706 27-2481</a>
                <a href="https://wa.me/256706272481" class="card-action secondary-action">WhatsApp us</a>
            </div>
        </div>
        
        <div class="support-card">
            <div class="card-icon">⚡</div>
            <h3 class="card-title">Quick solutions</h3>
            <p class="card-description">Many questions have simple answers. Check our instant solutions for the fastest path to getting things working.</p>
            <div class="card-actions">
                <button onclick="scrollToFAQ()" class="card-action">View quick help</button>
                <a href="https://soko.sanaa.co/help" class="card-action secondary-action">Visit help center</a>
            </div>
        </div>
        
        <div class="support-card">
            <div class="card-icon">📧</div>
            <h3 class="card-title">Send us a message</h3>
            <p class="card-description">Describe your situation and we'll get back to you with a thoughtful response, usually within a few hours.</p>
            <div class="card-actions">
                <button onclick="scrollToForm()" class="card-action">Write to us</button>
                <a href="mailto:support@sanaa.co" class="card-action secondary-action">Email directly</a>
            </div>
        </div>
    </div>

    <section class="quick-help" id="quick-help">
        <h2 class="section-title">Quick help</h2>
        <p class="section-subtitle">Most questions can be resolved in seconds</p>
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>How do I track my Soko 24 order?</span>
                <span class="chevron">▼</span>
            </div>
            <div class="faq-answer">
                Visit your Soko 24 account or check the confirmation email for your tracking link. Orders typically ship within 24 hours and arrive within 2-3 business days in Kampala.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>I'm having trouble with a payment on Sanaa Fi</span>
                <span class="chevron">▼</span>
            </div>
            <div class="faq-answer">
                Payment issues are usually resolved quickly. First, check your internet connection and try again. If the problem persists, contact us at 0706 27-2481 and we'll sort it out immediately.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>How do I return or exchange a product?</span>
                <span class="chevron">▼</span>
            </div>
            <div class="faq-answer">
                Returns are simple. Contact us within 14 days of delivery with your order number. We'll arrange pickup and process your refund or exchange within 3 business days.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>I need help with device financing</span>
                <span class="chevron">▼</span>
            </div>
            <div class="faq-answer">
                Our device financing program makes technology accessible. Visit any of our 180 retail locations or chat with us on WhatsApp to learn about flexible payment options for smartphones and laptops.
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span>Where can I find system status updates?</span>
                <span class="chevron">▼</span>
            </div>
            <div class="faq-answer">
                Check our real-time system status for all Sanaa services. We proactively communicate any issues and their resolutions.
            </div>
        </div>
    </section>

    <form class="contact-form" id="contact-form" action="{{ route('support.send') }}" method="POST">
        @csrf
        <h2 class="section-title" style="margin-bottom: 10px;">Get in touch</h2>
        <p class="section-subtitle" style="margin-bottom: 30px;">We typically respond within a few hours</p>
        
        @if(session('status'))
            <div class="success-message">
                ✅ {{ session('status') }}
                <br><small style="opacity: 0.8; margin-top: 8px; display: block;">You can send another message anytime.</small>
            </div>
        @endif
        <div id="form-messages"></div>
        
        <div class="form-group">
            <label class="form-label" for="name">Your name</label>
            <input type="text" id="name" name="name" class="form-input" required value="{{ old('name') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label" for="email">Email address</label>
            <input type="email" id="email" name="email" class="form-input" required value="{{ old('email') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label" for="phone">Phone (optional)</label>
            <input type="tel" id="phone" name="phone" class="form-input" value="{{ old('phone') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label" for="product">Which product or service?</label>
            <input type="text" id="product" name="product" class="form-input" placeholder="e.g., Soko 24, Sanaa Fi, Device financing" value="{{ old('product') }}">
        </div>
        
        <div class="form-group">
            <label class="form-label" for="message">How can we help?</label>
            <textarea id="message" name="message" class="form-textarea" placeholder="Describe your question or issue..." required>{{ old('message') }}</textarea>
        </div>
        
        <button type="submit" class="submit-button">Send message</button>
        
        <div class="status-links">
            <a href="https://status.sanaa.co" class="status-link">System Status</a>
            <a href="https://soko.sanaa.co/orders" class="status-link">Track Order</a>
            <a href="https://fin.sanaa.co/help" class="status-link">Finance Help</a>
        </div>
    </form>
</div>

<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const chevron = element.querySelector('.chevron');
        
        // Close all other FAQ items
        document.querySelectorAll('.faq-answer').forEach(item => {
            if (item !== answer) {
                item.classList.remove('active');
            }
        });
        document.querySelectorAll('.chevron').forEach(item => {
            if (item !== chevron) {
                item.classList.remove('active');
            }
        });
        
        // Toggle current item
        answer.classList.toggle('active');
        chevron.classList.toggle('active');
    }
    
    function scrollToFAQ() {
        document.getElementById('quick-help').scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
    
    function scrollToForm() {
        document.getElementById('contact-form').scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
    
    // Enhanced form submission handling
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contact-form');
        const submitButton = form.querySelector('.submit-button');
        const messages = document.getElementById('form-messages');

        const showMessage = (text, type = 'success') => {
            messages.className = type === 'success' ? 'success-message' : 'error-message';
            messages.textContent = text;
            messages.scrollIntoView({ behavior: 'smooth', block: 'center' });
        };

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            form.classList.add('form-sending');
            submitButton.textContent = 'Sending message...';
            submitButton.disabled = true;

            messages.textContent = '';
            messages.className = '';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value,
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                });

                const data = await response.json();

                if (response.ok) {
                    showMessage(`✅ ${data.status}`);
                    form.reset();
                } else {
                    const errorText = data.message || (data.errors ? Object.values(data.errors)[0][0] : 'Failed to send support message');
                    showMessage(errorText, 'error');
                }
            } catch (err) {
                showMessage('Failed to send support message', 'error');
            } finally {
                form.classList.remove('form-sending');
                submitButton.textContent = 'Send message';
                submitButton.disabled = false;
            }
        });

        // Enhanced input interactions
        const inputs = form.querySelectorAll('.form-input, .form-textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    });
</script>

@endsection
@extends('landing.layouts.app')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        padding: 10rem 0 5rem;
        min-height: 90vh;
        display: flex;
        align-items: center;
        background: radial-gradient(circle at 80% 20%, rgba(197, 160, 89, 0.05) 0%, transparent 40%);
        overflow: hidden;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        align-items: center;
        gap: 4rem;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-tag {
        color: var(--accent-gold);
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        display: block;
    }

    .hero h1 {
        font-size: 4.5rem;
        line-height: 1.1;
        margin-bottom: 2rem;
        color: var(--text-main);
    }

    .hero p {
        font-size: 1.2rem;
        color: var(--text-light);
        margin-bottom: 3rem;
    }

    .hero-image-container {
        position: relative;
        height: 600px;
        z-index: 1;
    }

    .hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 40px;
        box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.05);
        filter: brightness(0.98);
    }

    /* Features Section */
    .section-padding {
        padding: 8rem 0;
    }

    .section-header {
        text-align: center;
        margin-bottom: 5rem;
    }

    .section-header h2 {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .section-header p {
        color: var(--accent-gold);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.9rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .feature-card {
        padding: 2.5rem 2rem;
        background: var(--white);
        border: 1px solid rgba(197, 160, 89, 0.1);
        border-radius: 20px;
        transition: var(--transition);
        text-align: left;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.03);
        border-color: var(--accent-gold);
    }

    .feature-icon {
        font-size: 2rem;
        color: var(--accent-gold);
        margin-bottom: 1.5rem;
    }

    .feature-card h3 {
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    .feature-card p {
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Template Showcase */
    .templates-section {
        background: #FDFBF7;
    }

    .template-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 3rem;
    }

    .template-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        background: white;
        transition: var(--transition);
    }

    .template-card:hover {
        transform: translateY(-10px);
    }

    .template-preview {
        height: 400px;
        background: #eee;
        position: relative;
    }

    .template-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .template-card:hover .template-preview img {
        transform: scale(1.05);
    }

    .template-info {
        padding: 2rem;
        text-align: center;
    }

    .template-tag {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--accent-gold);
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Pricing Section */
    .pricing {
        background: #F8F5F1;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        align-items: stretch;
    }

    .pricing-card {
        background: var(--white);
        padding: 3rem 2rem;
        border-radius: 30px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(197, 160, 89, 0.1);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
    }

    .pricing-card.featured {
        transform: scale(1.05);
        border-color: var(--accent-gold);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08);
        z-index: 1;
    }

    .pricing-card:hover {
        transform: translateY(-5px);
    }

    .pricing-card.featured:hover {
        transform: scale(1.05) translateY(-5px);
    }

    .pricing-card .badge {
        position: absolute;
        top: 25px;
        right: -35px;
        background: var(--accent-gold);
        color: white;
        padding: 5px 40px;
        transform: rotate(45deg);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .price {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 1rem 0;
        font-family: 'Inter', sans-serif;
    }

    .price span {
        font-size: 1.2rem;
        color: var(--text-light);
        font-weight: 400;
    }

    .pricing-features {
        list-style: none;
        margin: 2rem 0 3rem;
        text-align: left;
        display: inline-block;
    }

    .pricing-features li {
        margin-bottom: 1rem;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .pricing-features li i {
        color: var(--accent-gold);
    }

    /* Inquiry Section */
    .inquiry {
        text-align: center;
        background: var(--bg-color);
    }

    .inquiry-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .inquiry h2 {
        font-size: 3.5rem;
        margin-bottom: 2rem;
    }

    /* Testimonials */
    .testimonials {
        background: #FDFBF7;
        padding: 10rem 0;
    }

    .testimonial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 3rem;
    }

    .testimonial-card {
        background: var(--white);
        padding: 3.5rem 2.5rem;
        border-radius: 30px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(197, 160, 89, 0.05);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.06);
        border-color: var(--accent-gold);
    }

    .rating {
        color: var(--accent-gold);
        font-size: 0.8rem;
        margin-bottom: 1.5rem;
    }

    .testimonial-text {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-style: italic;
        margin-bottom: 2rem;
        color: var(--text-main);
        line-height: 1.6;
        flex-grow: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 1rem;
        border-top: 1px solid rgba(197, 160, 89, 0.1);
        padding-top: 1.5rem;
    }

    .author-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .author-info h4 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.1rem;
    }

    .author-info p {
        font-size: 0.75rem;
        color: var(--accent-gold);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero {
            padding-top: 8rem;
            text-align: center;
        }
        .hero-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }
        .hero-image-container {
            height: 400px;
            order: -1;
        }
        .hero h1 {
            font-size: 3.5rem;
        }
        .pricing-grid {
            grid-template-columns: 1fr;
        }
        .pricing-card.featured {
            transform: scale(1);
        }
        .pricing-card.featured:hover {
            transform: translateY(-5px);
        }
        .testimonial-grid {
            grid-template-columns: 1fr;
        }
        .features-grid, .template-grid {
            grid-template-columns: 1fr !important;
            gap: 2rem;
        }
        .section-header h2 {
            font-size: 2.5rem;
        }
        .hero h1 {
            font-size: 3rem;
        }
        .inquiry h2 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 576px) {
        .hero h1 {
            font-size: 2.5rem;
        }
        .hero-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .hero-actions .btn-outline {
            margin-left: 0 !important;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content" data-reveal>
                <span class="hero-tag">Perfume SaaS Solution</span>
                <h1>The Art of Scent,<br>Automated<span>.</span></h1>
                <p>Elevate your perfume brand with Task19 Perfume SaaS—the ultimate e-commerce platform designed for the luxury fragrance market.</p>
                <div class="hero-actions">
                    <a href="#contact" class="btn-premium">Launch Your Brand</a>
                    <a href="{{ route('landing.templates') }}" class="btn-outline" style="margin-left: 1rem;">View Templates</a>
                </div>
            </div>
            <div class="hero-image-container" data-reveal>
                <img src="{{ asset('images/landing/hero.png') }}" alt="Luxury Perfume" class="hero-img">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="section-padding">
    <div class="container">
        <div class="section-header" data-reveal>
            <p>Crafted for Excellence</p>
            <h2>Bespoke Features</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-palette"></i></div>
                <h3>Multi-Theme Engine</h3>
                <p>Switch between world-class designs like Afnan and Velvet with a single click.</p>
            </div>
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-layer-group"></i></div>
                <h3>Smart Bundling</h3>
                <p>Intelligent combo pools and pack-of-X deals to maximize your revenue per order.</p>
            </div>
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-users-gear"></i></div>
                <h3>Multi-Tenancy</h3>
                <p>Manage multiple storefronts from a single, centralized administrative core.</p>
            </div>
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-gauge-high"></i></div>
                <h3>High Performance</h3>
                <p>Ultra-fast loading times optimized for core web vitals and mobile conversion.</p>
            </div>
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                <h3>SEO Mastery</h3>
                <p>Built-in SEO tools to ensure your fragrance house dominates search results.</p>
            </div>
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h3>Secure Checkout</h3>
                <p>Robust, encrypted payment flows designed to build customer trust and security.</p>
            </div>
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                <h3>Mobile First</h3>
                <p>Every pixel crafted for a seamless shopping experience on any mobile device.</p>
            </div>
            <div class="feature-card" data-reveal>
                <div class="feature-icon"><i class="fa-solid fa-headset"></i></div>
                <h3>Expert Support</h3>
                <p>Dedicated assistance to help you scale your digital perfume empire.</p>
            </div>
        </div>
    </div>
</section>

<!-- Template Showcase Section -->
<section id="templates" class="section-padding templates-section">
    <div class="container">
        <div class="section-header" data-reveal>
            <p>Ready-to-Use Designs</p>
            <h2>Luxury Templates</h2>
        </div>
        <div class="template-grid">
            <!-- Afnan Template -->
            <div class="template-card" data-reveal>
                <div class="template-preview">
                    <img src="{{ asset('images/landing/v5-template.png') }}" alt="Afnan Template">
                </div>
                <div class="template-info">
                    <span class="template-tag">V5 Theme</span>
                    <h3>Afnan Luxury</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1.5rem;">Editorial style with clean typography and high-conversion layouts.</p>
                    <a href="{{ route('v5.home') }}" target="_blank" class="btn-outline" style="padding: 0.6rem 1.5rem; font-size: 0.8rem;">Live Demo</a>
                </div>
            </div>

            <!-- Velvet Template -->
            <div class="template-card" data-reveal>
                <div class="template-preview">
                    <img src="{{ asset('images/landing/v2-template.png') }}" alt="Velvet Template">
                </div>
                <div class="template-info">
                    <span class="template-tag">V2 Theme</span>
                    <h3>Velvet Noir</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1.5rem;">A high-end, minimalist aesthetic for boutique fragrance houses.</p>
                    <a href="{{ route('velvet.home') }}" target="_blank" class="btn-outline" style="padding: 0.6rem 1.5rem; font-size: 0.8rem;">Live Demo</a>
                </div>
            </div>

            <!-- Nurah Template -->
            <div class="template-card" data-reveal>
                <div class="template-preview">
                    <img src="{{ asset('images/landing/v1-template.png') }}" alt="Nurah Template">
                </div>
                <div class="template-info">
                    <span class="template-tag">V1 Theme</span>
                    <h3>Nurah Classic</h3>
                    <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 1.5rem;">The original heritage design, focused on product storytelling.</p>
                    <a href="{{ route('home') }}" target="_blank" class="btn-outline" style="padding: 0.6rem 1.5rem; font-size: 0.8rem;">Live Demo</a>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 4rem;" data-reveal>
            <a href="{{ route('landing.templates') }}" class="btn-premium">View All Templates</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="container">
        <div class="section-header" data-reveal>
            <p>Voices of Excellence</p>
            <h2>Trusted by Curators</h2>
        </div>
        <div class="testimonial-grid">
            <!-- Review 1 -->
            <div class="testimonial-card" data-reveal>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-text">"The Afnan theme captures our brand's heritage perfectly. The backend efficiency is unmatched for scaling globally."</p>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=150&auto=format&fit=crop" alt="Client" class="author-img">
                    <div class="author-info">
                        <h4>Marcello Davila</h4>
                        <p>Maison l'Amour</p>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="testimonial-card" data-reveal>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-text">"Switching to Task19 was the best decision for our boutique. The multi-theme engine is a total game changer."</p>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=150&auto=format&fit=crop" alt="Client" class="author-img">
                    <div class="author-info">
                        <h4>Elena Rosso</h4>
                        <p>Scent & Soul</p>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="testimonial-card" data-reveal>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-text">"Ultra-fast performance and incredible support. Our conversion rates have never been higher than with the Velvet theme."</p>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=150&auto=format&fit=crop" alt="Client" class="author-img">
                    <div class="author-info">
                        <h4>Julian Thorne</h4>
                        <p>Thorne Fragrances</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="section-padding pricing">
    <div class="container">
        <div class="section-header" data-reveal>
            <p>Simple, Transparent</p>
            <h2>Investment</h2>
        </div>
        <div class="pricing-grid">
            <!-- Starter Plan -->
            <div class="pricing-card" data-reveal>
                <span class="hero-tag" style="color: var(--text-light)">Starter</span>
                <div class="price">$10<span>/month</span></div>
                <p style="margin-bottom: 1.5rem; font-size: 0.9rem;">Perfect for emerging boutique fragrance houses.</p>
                <ul class="pricing-features" style="flex-grow: 1;">
                    <li><i class="fa-solid fa-check"></i> Up to 50 Products</li>
                    <li><i class="fa-solid fa-check"></i> Standard Nurah Theme</li>
                    <li><i class="fa-solid fa-check"></i> Basic Inventory Tools</li>
                    <li><i class="fa-solid fa-check"></i> Email Support</li>
                </ul>
                <a href="#contact" class="btn-outline">Choose Starter</a>
            </div>

            <!-- Premium Plan -->
            <div class="pricing-card featured" data-reveal>
                <div class="badge">MOST POPULAR</div>
                <span class="hero-tag" style="color: var(--accent-gold)">Premium</span>
                <div class="price">$20<span>/month</span></div>
                <p style="margin-bottom: 1.5rem; font-size: 0.9rem;">Full access for scaling luxury brands.</p>
                <ul class="pricing-features" style="flex-grow: 1;">
                    <li><i class="fa-solid fa-check"></i> Unlimited Products</li>
                    <li><i class="fa-solid fa-check"></i> All 5 Premium Themes</li>
                    <li><i class="fa-solid fa-check"></i> Advanced Bundle Engine</li>
                    <li><i class="fa-solid fa-check"></i> Priority WhatsApp Support</li>
                </ul>
                <a href="#contact" class="btn-premium">Choose Premium</a>
            </div>

            <!-- Elite Plan -->
            <div class="pricing-card" data-reveal>
                <span class="hero-tag" style="color: var(--text-main)">Elite</span>
                <div class="price">$49<span>/month</span></div>
                <p style="margin-bottom: 1.5rem; font-size: 0.9rem;">Custom solutions for elite fragrance labels.</p>
                <ul class="pricing-features" style="flex-grow: 1;">
                    <li><i class="fa-solid fa-check"></i> White-label Dashboard</li>
                    <li><i class="fa-solid fa-check"></i> Custom Domain Integration</li>
                    <li><i class="fa-solid fa-check"></i> Dedicated Account Manager</li>
                    <li><i class="fa-solid fa-check"></i> API Access & Webhooks</li>
                </ul>
                <a href="#contact" class="btn-outline">Choose Elite</a>
            </div>
        </div>
    </div>
</section>

<!-- Inquiry Section -->
<section id="contact" class="section-padding inquiry">
    <div class="container">
        <div class="inquiry-content" data-reveal>
            <p class="hero-tag">Connect With Us</p>
            <h2>Ready to transform your brand?</h2>
            <p style="margin-bottom: 3rem; font-size: 1.1rem;">Join the elite fragrance houses using Task19 Perfume SaaS to power their digital presence.</p>
            <a href="https://wa.me/your-number" class="btn-premium" style="padding: 1.2rem 4rem; font-size: 1.1rem;">
                <i class="fa-brands fa-whatsapp" style="margin-right: 10px;"></i> Chat on WhatsApp
            </a>
            <div style="margin-top: 2rem;">
                <p style="color: var(--text-light); font-size: 0.9rem;">Or email us at: <a href="mailto:hello@nurah.saas" style="color: var(--accent-gold); text-decoration: none;">hello@nurah.saas</a></p>
            </div>
        </div>
    </div>
</section>
@endsection

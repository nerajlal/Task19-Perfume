@extends('landing.layouts.app')

@section('styles')
    <style>
        .templates-hero {
            padding: 10rem 0 6rem;
            background: var(--bg-color);
            text-align: center;
        }

        .templates-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .templates-hero p {
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .template-grid-detailed {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 4rem;
            padding: 8rem 0;
        }

        .template-card-large {
            background: var(--white);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            border: 1px solid rgba(197, 160, 89, 0.05);
        }

        .template-card-large:hover {
            transform: translateY(-15px);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.1);
        }

        .template-preview-large {
            height: 500px;
            background: #eee;
            overflow: hidden;
        }

        .template-preview-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .template-content-large {
            padding: 3rem;
        }

        .template-features {
            list-style: none;
            margin: 1.5rem 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .template-features li {
            font-size: 0.9rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .template-features li i {
            color: var(--accent-gold);
            font-size: 0.8rem;
        }

        @media (max-width: 992px) {
            .template-grid-detailed {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <section class="templates-hero">
        <div class="container">
            <div data-reveal>
                <span class="hero-tag">Digital Excellence</span>
                <h1>Explore Our Templates</h1>
                <p>From high-conversion editorial layouts to minimalist boutique designs, discover the perfect digital home
                    for your fragrance brand.</p>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="template-grid-detailed">
            <!-- V5 Afnan -->
            <div class="template-card-large" data-reveal>
                <div class="template-preview-large">
                    <img src="{{ asset('Images/landing/v5-template.png') }}" alt="Afnan Template">
                </div>
                <div class="template-content-large">
                    <span class="template-tag">Modern Luxury</span>
                    <h3>Afnan V5 Edition</h3>
                    <p>Our most advanced template, featuring a center-focused header hierarchy, premium typography, and
                        editorial product showcases.</p>
                    <ul class="template-features">
                        <li><i class="fa-solid fa-check"></i> Center-Focused Header</li>
                        <li><i class="fa-solid fa-check"></i> Jost Typography</li>
                        <li><i class="fa-solid fa-check"></i> Quick-Add Enabled</li>
                        <li><i class="fa-solid fa-check"></i> SEO Optimized</li>
                    </ul>
                    <a href="{{ route('v5.home') }}" target="_blank" class="btn-premium">View Live Demo</a>
                </div>
            </div>

            <!-- V2 Velvet -->
            <div class="template-card-large" data-reveal>
                <div class="template-preview-large">
                    <img src="{{ asset('Images/landing/v2-template.png') }}" alt="Velvet Template">
                </div>
                <div class="template-content-large">
                    <span class="template-tag">Minimalist</span>
                    <h3>Velvet Noir V2</h3>
                    <p>A dark, sophisticated aesthetic designed for high-end boutique collections and exclusive releases.
                    </p>
                    <ul class="template-features">
                        <li><i class="fa-solid fa-check"></i> Sidebar Navigation</li>
                        <li><i class="fa-solid fa-check"></i> Dark Mode Option</li>
                        <li><i class="fa-solid fa-check"></i> Parallax Scrolling</li>
                        <li><i class="fa-solid fa-check"></i> Interactive Gallery</li>
                    </ul>
                    <a href="{{ route('velvet.home') }}" target="_blank" class="btn-premium">View Live Demo</a>
                </div>
            </div>

            <!-- V4 Ajmal -->
            <div class="template-card-large" data-reveal>
                <div class="template-preview-large">
                    <img src="{{ asset('Images/landing/v4-template.png') }}" alt="Ajmal Template">
                </div>
                <div class="template-content-large">
                    <span class="template-tag">Classic Elegance</span>
                    <h3>Ajmal Heritage V4</h3>
                    <p>Traditional layouts meeting modern performance. Perfect for established brands with large catalogs.
                    </p>
                    <ul class="template-features">
                        <li><i class="fa-solid fa-check"></i> Wide Grid Layout</li>
                        <li><i class="fa-solid fa-check"></i> Mega Menu Support</li>
                        <li><i class="fa-solid fa-check"></i> Advanced Filters</li>
                        <li><i class="fa-solid fa-check"></i> Blog Integration</li>
                    </ul>
                    <a href="{{ route('v4.home') }}" target="_blank" class="btn-premium">View Live Demo</a>
                </div>
            </div>

            <!-- Nurah Classic -->
            <div class="template-card-large" data-reveal>
                <div class="template-preview-large">
                    <img src="{{ asset('Images/landing/v1-template.png') }}" alt="Nurah Template">
                </div>
                <div class="template-content-large">
                    <span class="template-tag">Legacy</span>
                    <h3>Nurah Original V1</h3>
                    <p>The theme that started it all. A balanced, clean approach to perfume storytelling and commerce.</p>
                    <ul class="template-features">
                        <li><i class="fa-solid fa-check"></i> Clean Whitespace</li>
                        <li><i class="fa-solid fa-check"></i> Story-Focused Home</li>
                        <li><i class="fa-solid fa-check"></i> Simple Checkout</li>
                        <li><i class="fa-solid fa-check"></i> Fully Responsive</li>
                    </ul>
                    <a href="{{ route('home') }}" target="_blank" class="btn-premium">View Live Demo</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-padding" style="background: #F8F5F1; text-align: center;">
        <div class="container" data-reveal>
            <h2>Need a custom solution?</h2>
            <p style="margin-bottom: 2.5rem; color: var(--text-light);">We can craft a unique digital identity for your
                fragrance house.</p>
            <a href="{{ route('landing') }}#contact" class="btn-premium">Let's Talk</a>
        </div>
    </section>
@endsection
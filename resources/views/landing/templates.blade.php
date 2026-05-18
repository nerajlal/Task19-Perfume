@extends('landing.layouts.vespr')

@section('title', 'Explore Templates — VESPR')

@section('styles')
<style>
  .templates-hero {
    padding: 160px 48px 80px;
    background: var(--cream);
    text-align: center;
    position: relative;
  }
  .templates-hero::after {
    content: '';
    position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);
    width: 1px; height: 60px; background: var(--sand);
  }

  .templates-grid {
    padding: 100px 48px;
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 64px;
  }

  .template-card {
    background: var(--white);
    border: 1px solid var(--sand);
    border-radius: 2px;
    overflow: hidden;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
  }
  .template-card:hover {
    transform: translateY(-8px);
    border-color: var(--violet);
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
  }

  @keyframes autoScrollTemplates {
    0%, 8% {
      transform: translateY(0);
    }
    45%, 55% {
      transform: translateY(calc(-100% + 400px));
    }
    92%, 100% {
      transform: translateY(0);
    }
  }

  .template-preview {
    height: 400px;
    background: var(--warm);
    overflow: hidden;
    position: relative;
  }
  .template-preview img {
    width: 100%;
    height: auto;
    position: absolute;
    top: 0;
    left: 0;
    animation: autoScrollTemplates 18s ease-in-out infinite;
  }
  .template-card:hover .template-preview img {
    animation-play-state: paused;
  }

  .template-info {
    padding: 40px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }
  .template-tag {
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--violet);
    font-weight: 500;
    margin-bottom: 12px;
  }
  .template-title {
    font-family: var(--serif);
    font-size: 32px;
    font-weight: 300;
    color: var(--ink);
    margin-bottom: 16px;
  }
  .template-desc {
    font-size: 15px;
    font-weight: 300;
    color: var(--stone);
    line-height: 1.7;
    margin-bottom: 24px;
  }
  .template-features {
    list-style: none;
    margin-bottom: 32px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }
  .template-features li {
    font-size: 13px;
    font-weight: 300;
    color: var(--bark);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .template-features li::before {
    content: '◈';
    color: var(--violet);
    font-size: 10px;
  }

  .template-actions {
    margin-top: auto;
  }

  @media (max-width: 900px) {
    .templates-grid {
      grid-template-columns: 1fr;
      gap: 40px;
      padding: 60px 24px;
    }
    .template-info { padding: 32px 24px; }
  }

  @media (max-width: 600px) {
    .templates-hero { padding: 120px 24px 60px; }
    .template-title { font-size: 28px; }
  }
</style>
@endsection

@section('content')
<section class="templates-hero">
  <p class="section-label">Digital Excellence</p>
  <h1 class="section-title">Explore our<br/><em>curated templates</em></h1>
  <p class="section-desc" style="margin: 0 auto;">From high-conversion editorial layouts to minimalist boutique designs, discover the perfect digital home for your fragrance brand.</p>
</section>

<section class="templates-grid">
  <!-- V5 Afnan -->
  <div class="template-card">
    <div class="template-preview">
      <img src="{{ asset('Images/landing/v5-template.png') }}" alt="Afnan Template">
    </div>
    <div class="template-info">
      <span class="template-tag">Modern Luxury</span>
      <h3 class="template-title">Afnan V5 Edition</h3>
      <p class="template-desc">Our most advanced template, featuring a center-focused header hierarchy, premium typography, and editorial product showcases.</p>
      <ul class="template-features">
        <li>Center Header</li>
        <li>Jost Typography</li>
        <li>Quick-Add</li>
        <li>SEO Optimized</li>
      </ul>
      <div class="template-actions">
        <a href="javascript:void(0)" onclick="openDemoAccess(event, '{{ route('v5.home') }}')" class="btn-primary" style="width: 100%; text-align: center;">View Live Demo</a>
      </div>
    </div>
  </div>

  <!-- V2 Velvet -->
  <div class="template-card">
    <div class="template-preview">
      <img src="{{ asset('Images/landing/v2-template.png') }}" alt="Velvet Template">
    </div>
    <div class="template-info">
      <span class="template-tag">Minimalist Noir</span>
      <h3 class="template-title">Velvet Noir V2</h3>
      <p class="template-desc">A dark, sophisticated aesthetic designed for high-end boutique collections and exclusive releases.</p>
      <ul class="template-features">
        <li>Sidebar Nav</li>
        <li>Dark Mode</li>
        <li>Parallax</li>
        <li>Rich Gallery</li>
      </ul>
      <div class="template-actions">
        <a href="javascript:void(0)" onclick="openDemoAccess(event, '{{ route('velvet.home') }}')" class="btn-primary" style="width: 100%; text-align: center;">View Live Demo</a>
      </div>
    </div>
  </div>

  <!-- V4 Ajmal -->
  <div class="template-card">
    <div class="template-preview">
      <img src="{{ asset('Images/landing/v4-template.png') }}" alt="Ajmal Template">
    </div>
    <div class="template-info">
      <span class="template-tag">Classic Elegance</span>
      <h3 class="template-title">Ajmal Heritage V4</h3>
      <p class="template-desc">Traditional layouts meeting modern performance. Perfect for established brands with large catalogs.</p>
      <ul class="template-features">
        <li>Wide Grid</li>
        <li>Mega Menu</li>
        <li>Advanced Filters</li>
        <li>Blog Integrated</li>
      </ul>
      <div class="template-actions">
        <a href="javascript:void(0)" onclick="openDemoAccess(event, '{{ route('v4.home') }}')" class="btn-primary" style="width: 100%; text-align: center;">View Live Demo</a>
      </div>
    </div>
  </div>

  <!-- Nurah Classic -->
  <div class="template-card">
    <div class="template-preview">
      <img src="{{ asset('Images/landing/v1-template.png') }}" alt="Nurah Template">
    </div>
    <div class="template-info">
      <span class="template-tag">Legacy Theme</span>
      <h3 class="template-title">Nurah Original V1</h3>
      <p class="template-desc">The theme that started it all. A balanced, clean approach to perfume storytelling and commerce.</p>
      <ul class="template-features">
        <li>Clean White</li>
        <li>Story-Focused</li>
        <li>Simple Flows</li>
        <li>Mobile First</li>
      </ul>
      <div class="template-actions">
        <a href="javascript:void(0)" onclick="openDemoAccess(event, '{{ route('v1.home') }}')" class="btn-primary" style="width: 100%; text-align: center;">View Live Demo</a>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section style="background: var(--warm); text-align: center; padding: 100px 48px;">
  <p class="section-label">Custom Design</p>
  <h2 class="section-title">Need a unique<br/><em>digital identity?</em></h2>
  <p class="section-desc" style="margin: 0 auto 40px;">We can craft a bespoke fragrance experience tailored specifically to your brand heritage.</p>
  <a href="{{ route('landing') }}#contact" class="btn-primary">Request Custom Theme</a>
</section>
@endsection
@extends('landing.layouts.vespr')

@section('styles')
  <style>
    /* ── HERO ── */
    .hero {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 120px 48px 80px;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse 60% 50% at 50% 60%, rgba(124, 92, 138, 0.08) 0%, transparent 70%);
      pointer-events: none;
    }

    .hero-eyebrow {
      font-family: var(--sans);
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 4px;
      text-transform: uppercase;
      color: var(--violet);
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .hero-eyebrow::before,
    .hero-eyebrow::after {
      content: '';
      width: 32px;
      height: 1px;
      background: var(--violet-l);
    }

    .hero h1 {
      font-family: var(--serif);
      font-size: clamp(56px, 8vw, 110px);
      font-weight: 300;
      line-height: 1.05;
      letter-spacing: -1px;
      color: var(--ink);
      margin-bottom: 12px;
    }

    .hero h1 em {
      font-style: italic;
      color: var(--violet);
    }

    .hero-sub {
      font-family: var(--sans);
      font-size: 17px;
      font-weight: 300;
      color: var(--stone);
      max-width: 480px;
      margin: 20px auto 48px;
      line-height: 1.8;
    }

    .hero-actions {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .hero-trust {
      margin-top: 64px;
      font-size: 11px;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--stone);
    }

    .hero-brands {
      display: flex;
      gap: 40px;
      justify-content: center;
      margin-top: 16px;
      flex-wrap: wrap;
    }

    .hero-brands span {
      font-family: var(--serif);
      font-size: 16px;
      font-weight: 600;
      letter-spacing: 2px;
      color: var(--sand);
    }

    /* ── SECTION COMMONS ── */
    section {
      padding: 100px 48px;
    }

    .section-desc {
      font-size: 16px;
      font-weight: 300;
      color: var(--stone);
      max-width: 520px;
      line-height: 1.8;
    }

    /* ── ONBOARDING ── */
    .onboarding {
      background: var(--white);
    }

    .onboarding-inner {
      max-width: 1100px;
      margin: 0 auto;
    }

    .onboarding-head {
      text-align: center;
      margin-bottom: 72px;
    }

    .onboarding-head .section-desc {
      margin: 0 auto;
    }

    .steps {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2px;
    }

    .step {
      background: var(--cream);
      padding: 40px 32px;
      position: relative;
      transition: background var(--transition);
    }

    .step:hover {
      background: var(--warm);
    }

    .step-num {
      font-family: var(--serif);
      font-size: 72px;
      font-weight: 300;
      color: var(--sand);
      line-height: 1;
      margin-bottom: 20px;
    }

    .step-title {
      font-family: var(--serif);
      font-size: 22px;
      font-weight: 400;
      color: var(--ink);
      margin-bottom: 12px;
    }

    .step-desc {
      font-size: 14px;
      font-weight: 300;
      color: var(--stone);
      line-height: 1.8;
    }

    .step-tag {
      display: inline-block;
      margin-top: 20px;
      font-size: 11px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--violet);
      font-weight: 500;
    }

    .step-connector {
      position: absolute;
      top: 52px;
      right: -18px;
      width: 36px;
      height: 1px;
      background: var(--sand);
      z-index: 2;
    }

    .step:last-child .step-connector {
      display: none;
    }

    /* ── FEATURES SHOWCASE ── */
    .features {
      background: var(--cream);
      padding: 120px 48px;
    }

    .features-inner {
      max-width: 1200px;
      margin: 0 auto;
    }

    .features-head {
      text-align: center;
      margin-bottom: 72px;
    }
    
    .features-head .section-desc {
      margin: 0 auto;
    }

    .features-showcase {
      display: grid;
      grid-template-columns: 350px 1fr;
      gap: 64px;
      align-items: center;
    }

    .features-tabs {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .feature-tab {
      background: transparent;
      border: 1px solid transparent;
      padding: 20px 24px;
      text-align: left;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 16px;
      border-radius: 4px;
      transition: var(--transition);
      width: 100%;
    }

    .feature-tab:hover {
      background: rgba(237, 230, 214, 0.5);
    }

    .feature-tab.active {
      background: var(--white);
      border-color: var(--sand);
      box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .tab-icon {
      font-size: 18px;
      color: var(--stone);
      transition: color 0.3s ease;
      width: 24px;
      text-align: center;
    }

    .feature-tab.active .tab-icon {
      color: var(--violet);
    }

    .tab-label {
      font-family: var(--serif);
      font-size: 20px;
      font-weight: 400;
      color: var(--ink);
    }

    /* Browser Mockup Frame */
    .features-preview {
      background: var(--white);
      border: 1px solid var(--sand);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 30px 60px rgba(30, 26, 22, 0.08);
      position: relative;
    }

    .browser-header {
      background: var(--ink);
      padding: 16px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .browser-dots {
      display: flex;
      gap: 8px;
    }

    .browser-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
    }

    .browser-title {
      font-family: var(--sans);
      font-size: 11px;
      color: rgba(255, 255, 255, 0.4);
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    .browser-actions {
      display: flex;
      gap: 12px;
    }

    .browser-btn-dummy {
      width: 12px;
      height: 12px;
      border-radius: 2px;
      background: rgba(255, 255, 255, 0.2);
    }

    .browser-content {
      position: relative;
      height: 480px;
      background: var(--warm);
      overflow: hidden;
    }

    .tab-content {
      position: absolute;
      inset: 0;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.5s ease, visibility 0.5s ease;
      display: flex;
      flex-direction: column;
    }

    .tab-content.active {
      opacity: 1;
      visibility: visible;
      z-index: 2;
    }

    .tab-content-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .tab-content-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(to top, rgba(30,26,22,0.85) 0%, rgba(30,26,22,0.4) 60%, transparent 100%);
      padding: 40px;
      color: var(--white);
      display: flex;
      flex-direction: column;
      gap: 8px;
      text-align: left;
    }

    .tab-content-title {
      font-family: var(--serif);
      font-size: 28px;
      font-weight: 300;
      color: var(--cream);
    }

    .tab-content-desc {
      font-family: var(--sans);
      font-size: 14px;
      font-weight: 300;
      color: rgba(255, 255, 255, 0.8);
      line-height: 1.6;
      max-width: 600px;
    }

    @media (max-width: 900px) {
      .features-showcase {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      .features-tabs {
        flex-direction: row;
        overflow-x: auto;
        padding-bottom: 12px;
        -webkit-overflow-scrolling: touch;
      }
      .feature-tab {
        flex-shrink: 0;
        width: auto;
        padding: 14px 20px;
      }
      .browser-content {
        height: 350px;
      }
    }

    /* ── TESTIMONIALS ── */
    .testimonials {
      background: var(--white);
    }

    .testimonials-inner {
      max-width: 1100px;
      margin: 0 auto;
    }

    .testimonials-head {
      text-align: center;
      margin-bottom: 72px;
    }

    .testimonials-head .section-desc {
      margin: 0 auto;
    }

    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 32px;
    }

    .testimonial {
      background: var(--cream);
      padding: 48px 40px;
      border-radius: 2px;
      transition: var(--transition);
      display: flex;
      flex-direction: column;
    }

    .testimonial:hover {
      transform: translateY(-4px);
      background: var(--warm);
    }

    .t-rating {
      color: var(--violet);
      font-size: 12px;
      letter-spacing: 2px;
      margin-bottom: 24px;
    }

    .t-text {
      font-family: var(--serif);
      font-size: 20px;
      font-style: italic;
      font-weight: 300;
      color: var(--ink);
      line-height: 1.6;
      margin-bottom: 32px;
      flex-grow: 1;
    }

    .t-author {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .t-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background-size: cover;
      background-position: center;
      border: 1px solid var(--sand);
    }

    .t-meta {
      display: flex;
      flex-direction: column;
    }

    .t-name {
      font-family: var(--sans);
      font-size: 14px;
      font-weight: 500;
      color: var(--ink);
    }

    .t-role {
      font-size: 12px;
      color: var(--stone);
      font-weight: 300;
    }

    /* ── PRICING ── */
    .pricing {
      background: var(--ink);
    }

    .pricing .section-label {
      color: var(--violet-l);
    }

    .pricing .section-title {
      color: var(--white);
    }

    .pricing .section-title em {
      color: var(--violet-l);
    }

    .pricing-inner {
      max-width: 1000px;
      margin: 0 auto;
    }

    .pricing-head {
      text-align: center;
      margin-bottom: 64px;
    }

    .pricing-head .section-desc {
      color: var(--stone);
      margin: 0 auto;
    }

    .plans {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2px;
    }

    .plan {
      background: #2A2420;
      padding: 48px 36px;
      position: relative;
      transition: background var(--transition);
    }

    .plan:hover {
      background: #332C28;
    }

    .plan.featured {
      background: var(--violet);
      transform: translateY(-8px);
    }

    .plan.featured:hover {
      background: var(--violet-d);
    }

    .plan-badge {
      display: inline-block;
      background: var(--violet-l);
      color: var(--violet-d);
      font-size: 10px;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 4px 12px;
      border-radius: 2px;
      margin-bottom: 24px;
    }

    .plan.featured .plan-badge {
      background: rgba(255, 255, 255, 0.2);
      color: var(--white);
    }

    .plan-name {
      font-family: var(--serif);
      font-size: 28px;
      font-weight: 300;
      color: var(--white);
      margin-bottom: 8px;
    }

    .plan-price {
      font-family: var(--serif);
      font-size: 52px;
      font-weight: 300;
      color: var(--white);
      line-height: 1;
      margin-bottom: 4px;
    }

    .plan-price sup {
      font-size: 22px;
      vertical-align: super;
      font-weight: 300;
    }

    .plan-period {
      font-size: 13px;
      color: var(--stone);
      margin-bottom: 32px;
    }

    .plan.featured .plan-period {
      color: rgba(255, 255, 255, 0.6);
    }

    .plan-divider {
      height: 1px;
      background: rgba(255, 255, 255, 0.1);
      margin-bottom: 28px;
    }

    .plan-features {
      list-style: none;
      margin-bottom: 36px;
    }

    .plan-features li {
      font-size: 14px;
      font-weight: 300;
      color: rgba(255, 255, 255, 0.7);
      padding: 8px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .plan-features li::before {
      content: '—';
      color: var(--violet-l);
      font-weight: 300;
      flex-shrink: 0;
    }

    .plan.featured .plan-features li::before {
      color: rgba(255, 255, 255, 0.5);
    }

    .plan-cta {
      display: block;
      text-align: center;
      padding: 14px 24px;
      font-size: 12px;
      font-weight: 500;
      letter-spacing: 2px;
      text-transform: uppercase;
      text-decoration: none;
      border-radius: 2px;
      transition: all var(--transition);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: var(--white);
    }

    .plan-cta:hover {
      border-color: var(--white);
    }

    .plan.featured .plan-cta {
      background: var(--white);
      color: var(--violet-d);
      border-color: var(--white);
    }

    .plan.featured .plan-cta:hover {
      background: var(--cream);
    }

    /* ── BRAND SYSTEM ── */
    .brand {
      background: var(--warm);
    }

    .brand-inner {
      max-width: 1100px;
      margin: 0 auto;
    }

    .brand-head {
      margin-bottom: 56px;
    }

    .brand-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 48px;
    }

    .brand-block h4 {
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--stone);
      margin-bottom: 24px;
    }

    .palette {
      display: flex;
      gap: 8px;
    }

    .swatch {
      flex: 1;
      height: 64px;
      border-radius: 2px;
      position: relative;
    }

    .swatch span {
      position: absolute;
      bottom: -22px;
      left: 0;
      font-size: 11px;
      color: var(--stone);
      white-space: nowrap;
    }

    .font-sample {
      margin-bottom: 20px;
    }

    .font-sample .fs-name {
      font-size: 11px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--stone);
      margin-bottom: 8px;
    }

    .font-sample .fs-display {
      font-family: var(--serif);
      font-size: 40px;
      font-weight: 300;
      color: var(--ink);
      line-height: 1.1;
    }

    .font-sample .fs-body {
      font-family: var(--sans);
      font-size: 16px;
      font-weight: 300;
      color: var(--bark);
      margin-top: 8px;
    }

    /* ── CTA ── */
    .cta-section {
      background: var(--cream);
      text-align: center;
      padding: 120px 48px;
    }

    .cta-section .section-title {
      max-width: 600px;
      margin: 0 auto 16px;
    }

    .cta-section .section-desc {
      margin: 0 auto 48px;
      text-align: center;
    }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(24px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-up {
      animation: fadeUp 0.8s ease forwards;
    }

    .delay-1 {
      animation-delay: 0.1s;
      opacity: 0;
    }

    .delay-2 {
      animation-delay: 0.25s;
      opacity: 0;
    }

    .delay-3 {
      animation-delay: 0.4s;
      opacity: 0;
    }

    .delay-4 {
      animation-delay: 0.55s;
      opacity: 0;
    }

    @media (max-width: 900px) {
      section {
        padding: 60px 24px;
      }

      .hero {
        padding: 100px 24px 60px;
      }

      .hero-sub {
        margin-bottom: 32px;
      }

      .steps {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .step-connector {
        display: none;
      }

      .features-grid {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .testimonial-grid {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .plans {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .plan.featured {
        transform: none;
      }

      .brand-grid {
        grid-template-columns: 1fr;
      }

      .t-preview-grid {
        grid-template-columns: 1fr;
      }
    }

    /* ── TEMPLATES PREVIEW ── */
    .templates-preview {
      background: var(--white);
    }

    .templates-inner {
      max-width: 1100px;
      margin: 0 auto;
    }

    .templates-head {
      text-align: center;
      margin-bottom: 72px;
    }

    .templates-head .section-desc {
      margin: 0 auto;
    }

    .t-preview-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 32px;
    }

    .t-preview-card {
      background: var(--cream);
      border-radius: 2px;
      overflow: hidden;
      transition: var(--transition);
      border: 1px solid transparent;
    }

    .t-preview-card:hover {
      transform: translateY(-8px);
      border-color: var(--sand);
      background: var(--warm);
    }

    @keyframes autoScrollLanding {
      0%, 8% {
        transform: translateY(0);
      }
      45%, 55% {
        transform: translateY(calc(-100% + 320px));
      }
      92%, 100% {
        transform: translateY(0);
      }
    }

    .t-preview-img {
      height: 320px;
      overflow: hidden;
      position: relative;
      background-color: var(--sand);
    }

    .t-preview-img img {
      width: 100%;
      height: auto;
      position: absolute;
      top: 0;
      left: 0;
      animation: autoScrollLanding 16s ease-in-out infinite;
    }

    .t-preview-card:hover .t-preview-img img {
      animation-play-state: paused;
    }

    .t-preview-info {
      padding: 32px;
    }

    .t-preview-tag {
      font-size: 10px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--violet);
      font-weight: 500;
      margin-bottom: 12px;
      display: block;
    }

    .t-preview-info h3 {
      font-family: var(--serif);
      font-size: 28px;
      font-weight: 300;
      color: var(--ink);
      margin-bottom: 8px;
    }

    .t-preview-info p {
      font-size: 14px;
      color: var(--stone);
      margin-bottom: 24px;
      line-height: 1.6;
    }

    .t-preview-link {
      font-size: 11px;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--ink);
      text-decoration: none;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: gap 0.3s ease;
    }

    .t-preview-link:hover {
      gap: 12px;
      color: var(--violet);
    }

    .t-preview-link span {
      font-size: 16px;
    }

    /* ── FAQ SECTION ── */
    .faq {
      background: var(--warm);
    }

    .faq-inner {
      max-width: 800px;
      margin: 0 auto;
    }

    .faq-head {
      text-align: center;
      margin-bottom: 56px;
    }

    .faq-head .section-desc {
      margin: 0 auto;
    }

    .faq-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .faq-item {
      background: var(--white);
      border: 1px solid var(--sand);
      border-radius: 2px;
      overflow: hidden;
      transition: var(--transition);
    }

    .faq-item.active {
      border-color: var(--violet);
      box-shadow: 0 10px 30px rgba(124, 92, 138, 0.04);
    }

    .faq-question {
      width: 100%;
      padding: 24px 32px;
      background: none;
      border: none;
      text-align: left;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      font-family: var(--serif);
      font-size: 20px;
      color: var(--ink);
      font-weight: 300;
    }

    .faq-toggle-icon {
      font-size: 18px;
      color: var(--stone);
      transition: transform 0.3s ease;
      font-family: var(--sans);
      line-height: 1;
    }

    .faq-item.active .faq-toggle-icon {
      transform: rotate(45deg);
      color: var(--violet);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
    }

    .faq-answer-content {
      padding: 0 32px 24px;
      font-size: 14px;
      color: var(--stone);
      line-height: 1.7;
      font-weight: 300;
    }

    @media (max-width: 600px) {
      .hero h1 {
        font-size: 52px;
      }

      .hero-brands {
        gap: 20px;
      }

      .hero-brands span {
        font-size: 14px;
      }

      .palette {
        flex-wrap: wrap;
      }

      .swatch {
        flex: 1 1 30%;
        height: 50px;
      }

      .faq-question {
        padding: 20px 24px;
        font-size: 17px;
      }

      .faq-answer-content {
        padding: 0 24px 20px;
      }
    }
  </style>
@endsection

@section('content')
  <!-- HERO -->
  <section class="hero">
    <p class="hero-eyebrow fade-up">Perfume Platform</p>
    <h1 class="fade-up delay-1">Your scent brand,<br /><em>live today.</em></h1>
    <p class="hero-sub fade-up delay-2">Vespr gives independent perfumers and fragrance houses everything they need to
      sell online — beautiful store, smart tools, zero complexity.</p>
    <div class="hero-actions fade-up delay-3">
      <a href="#onboarding" class="btn-primary">Start for free</a>
      <a href="#features" class="btn-ghost">See features</a>
    </div>
    <p class="hero-trust fade-up delay-4">Trusted by</p>
    <div class="hero-brands fade-up delay-4">
      <span>Maison L'Amour</span>
      <span>Scent & Soul</span>
      <span>Thorne</span>
      <span>Nurah</span>
    </div>
  </section>

  <!-- ONBOARDING -->
  <section class="onboarding" id="onboarding">
    <div class="onboarding-inner">
      <div class="onboarding-head">
        <p class="section-label">How it works</p>
        <h2 class="section-title">Up and selling in<br /><em>four simple steps</em></h2>
        <p class="section-desc">No developers. No design agency. No complexity. Go from idea to live fragrance store in
          under an hour.</p>
      </div>
      <div class="steps">
        <div class="step">
          <div class="step-num">01</div>
          <div class="step-title">Create your account</div>
          <div class="step-desc">Sign up with your email. No credit card required to start. Your store is provisioned
            instantly.</div>
          <span class="step-tag">2 minutes</span>
          <div class="step-connector"></div>
        </div>
        <div class="step">
          <div class="step-num">02</div>
          <div class="step-title">Pick your theme</div>
          <div class="step-desc">Choose from our curated fragrance-first templates. Each one is designed to convert
            visitors into buyers.</div>
          <span class="step-tag">5 minutes</span>
          <div class="step-connector"></div>
        </div>
        <div class="step">
          <div class="step-num">03</div>
          <div class="step-title">Add your fragrances</div>
          <div class="step-desc">Upload your products, set prices, write your scent notes. Our editor makes it feel
            effortless.</div>
          <span class="step-tag">15 minutes</span>
          <div class="step-connector"></div>
        </div>
        <div class="step">
          <div class="step-num">04</div>
          <div class="step-title">Launch & sell</div>
          <div class="step-desc">Connect your domain, set up payments, and go live. Your fragrance store is open for
            business.</div>
          <span class="step-tag">Today</span>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="features" id="features">
    <div class="features-inner">
      <div class="features-head">
        <p class="section-label">Platform features</p>
        <h2 class="section-title">Everything a fragrance<br /><em>brand needs</em></h2>
        <p class="section-desc">Meticulously engineered tools to convey the sensory details, brand legacy, and visual beauty of your scent collections.</p>
      </div>

      <div class="features-showcase">
        <!-- Left Side: Interactive Tabs -->
        <div class="features-tabs">
          <button class="feature-tab active" data-tab="themes">
            <span class="tab-icon">◈</span>
            <span class="tab-label">Couture Themes</span>
          </button>
          <button class="feature-tab" data-tab="bundling">
            <span class="tab-icon">◎</span>
            <span class="tab-label">Scent Bundling</span>
          </button>
          <button class="feature-tab" data-tab="multibrand">
            <span class="tab-icon">⊞</span>
            <span class="tab-label">Multi-Brand Hub</span>
          </button>
          <button class="feature-tab" data-tab="performance">
            <span class="tab-icon">◐</span>
            <span class="tab-label">Velvet Speed</span>
          </button>
          <button class="feature-tab" data-tab="seo">
            <span class="tab-icon">◉</span>
            <span class="tab-label">Discovery SEO</span>
          </button>
          <button class="feature-tab" data-tab="payments">
            <span class="tab-icon">◇</span>
            <span class="tab-label">Secure Checkout</span>
          </button>
        </div>

        <!-- Right Side: Browser Mockup Showcase -->
        <div class="features-preview">
          <div class="browser-header">
            <div class="browser-dots">
              <div class="browser-dot" style="background: #FF5F56;"></div>
              <div class="browser-dot" style="background: #FFBD2E;"></div>
              <div class="browser-dot" style="background: #27C93F;"></div>
            </div>
            <div class="browser-title">vespr.platform // brand_manager</div>
            <div class="browser-actions">
              <div class="browser-btn-dummy"></div>
              <div class="browser-btn-dummy"></div>
            </div>
          </div>
          
          <div class="browser-content">
            <!-- Couture Themes Tab Content -->
            <div class="tab-content active" id="tab-themes">
              <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?w=1000&auto=format&fit=crop&q=80" alt="Couture Themes" class="tab-content-img">
              <div class="tab-content-overlay">
                <h3 class="tab-content-title">Couture Storefront Themes</h3>
                <p class="tab-content-desc">Switch between world-class fragrance-specific designs with a single click. Every template is meticulously engineered to tell your brand’s olfactory story with premium elegance.</p>
              </div>
            </div>

            <!-- Scent Bundling Tab Content -->
            <div class="tab-content" id="tab-bundling">
              <img src="https://images.unsplash.com/photo-1547887537-6158d64c35b3?w=1000&auto=format&fit=crop&q=80" alt="Scent Bundling" class="tab-content-img">
              <div class="tab-content-overlay">
                <h3 class="tab-content-title">Intelligent Scent Bundles</h3>
                <p class="tab-content-desc">Maximize your average order value automatically. Combine complementary perfume sprays, solid balms, and travel vials into custom gift sets directly inside checkout.</p>
              </div>
            </div>

            <!-- Multi-Brand Hub Tab Content -->
            <div class="tab-content" id="tab-multibrand">
              <img src="https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?w=1000&auto=format&fit=crop&q=80" alt="Multi-Brand Dashboard" class="tab-content-img">
              <div class="tab-content-overlay">
                <h3 class="tab-content-title">Multi-Brand House Dashboard</h3>
                <p class="tab-content-desc">Manage all of your custom fragrance labels, inventory logs, and product collections from one central, unified administration dashboard. Perfect for multi-line ateliers.</p>
              </div>
            </div>

            <!-- Velvet Speed Tab Content -->
            <div class="tab-content" id="tab-performance">
              <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1000&auto=format&fit=crop&q=80" alt="Velvet Performance" class="tab-content-img">
              <div class="tab-content-overlay">
                <h3 class="tab-content-title">Velvet Speed &amp; Analytics</h3>
                <p class="tab-content-desc">Lightning-fast store loading speeds built to maximize perfume conversions. Every single millisecond is finely tuned to keep premium clientele engaged and buying.</p>
              </div>
            </div>

            <!-- Discovery SEO Tab Content -->
            <div class="tab-content" id="tab-seo">
              <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=1000&auto=format&fit=crop&q=80" alt="Discovery SEO" class="tab-content-img">
              <div class="tab-content-overlay">
                <h3 class="tab-content-title">Olfactory Search &amp; Discovery SEO</h3>
                <p class="tab-content-desc">Help potential clients find your specific scent profiles in organic search. Auto-generates structural metadata matching scent notes, bottles, and ingredients.</p>
              </div>
            </div>

            <!-- Secure Checkout Tab Content -->
            <div class="tab-content" id="tab-payments">
              <img src="https://images.unsplash.com/photo-1563013544-824ae1d704d3?w=1000&auto=format&fit=crop&q=80" alt="Secure Checkout" class="tab-content-img">
              <div class="tab-content-overlay">
                <h3 class="tab-content-title">Secure &amp; Elegant Checkout</h3>
                <p class="tab-content-desc">Fully secure, high-trust encrypted payment experiences built for high-value transactions. Seamlessly accepts credit cards, UPI, and international methods out of the box.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TEMPLATES PREVIEW -->
  <section class="templates-preview" id="templates">
    <div class="templates-inner">
      <div class="templates-head">
        <p class="section-label">Exquisite Themes</p>
        <h2 class="section-title">Designed for high-conversion<br /><em>fragrance storytelling</em></h2>
        <p class="section-desc">Choose from our curated collection of luxury themes. Each one is meticulously crafted to
          reflect the heritage and nuance of your scent brand.</p>
      </div>
      <div class="t-preview-grid">
        <div class="t-preview-card">
          <div class="t-preview-img">
            <img src="{{ asset('Images/landing/v5-template.png') }}" alt="Afnan V5 Template">
          </div>
          <div class="t-preview-info">
            <span class="t-preview-tag">Editorial</span>
            <h3>Afnan V5</h3>
            <p>The gold standard for modern fragrance houses. Centered elegance with high-impact product grids.</p>
            <a href="{{ route('landing.templates') }}" class="t-preview-link">View Details <span>→</span></a>
          </div>
        </div>
        <div class="t-preview-card">
          <div class="t-preview-img">
            <img src="{{ asset('Images/landing/v2-template.png') }}" alt="Velvet Noir Template">
          </div>
          <div class="t-preview-info">
            <span class="t-preview-tag">Minimalist</span>
            <h3>Velvet Noir</h3>
            <p>A sophisticated dark aesthetic for exclusive collections and boutique perfume ateliers.</p>
            <a href="{{ route('landing.templates') }}" class="t-preview-link">View Details <span>→</span></a>
          </div>
        </div>
      </div>
      <div style="text-align: center; margin-top: 64px;">
        <a href="{{ route('landing.templates') }}" class="btn-ghost">Explore all templates</a>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="testimonials" id="testimonials">
    <div class="testimonials-inner">
      <div class="testimonials-head">
        <p class="section-label">Success stories</p>
        <h2 class="section-title">Loved by the world's<br /><em>finest noses</em></h2>
        <p class="section-desc">Join the community of independent perfumers and established heritage brands scaling their
          digital presence with Vespr.</p>
      </div>
      <div class="testimonial-grid">
        <div class="testimonial">
          <div class="t-rating">★★★★★</div>
          <p class="t-text">"Vespr understood the nuance of fragrance storytelling. Our online boutique now feels as
            premium as our physical atelier in Grasse."</p>
          <div class="t-author">
            <div class="t-avatar"
              style="background-image: url('https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop')">
            </div>
            <div class="t-meta">
              <span class="t-name">Marc-Antoine</span>
              <span class="t-role">Creative Director, Maison L'Amour</span>
            </div>
          </div>
        </div>
        <div class="testimonial">
          <div class="t-rating">★★★★★</div>
          <p class="t-text">"The scent bundling engine alone increased our average order value by 45%. It's the only
            platform that truly 'gets' the perfume business."</p>
          <div class="t-author">
            <div class="t-avatar"
              style="background-image: url('https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop')">
            </div>
            <div class="t-meta">
              <span class="t-name">Elena Rossi</span>
              <span class="t-role">Founder, Scent & Soul</span>
            </div>
          </div>
        </div>
        <div class="testimonial">
          <div class="t-rating">★★★★★</div>
          <p class="t-text">"We migrated from Shopify in a weekend. The themes are exquisite and the multi-brand dashboard
            is a game-changer for our group."</p>
          <div class="t-author">
            <div class="t-avatar"
              style="background-image: url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop')">
            </div>
            <div class="t-meta">
              <span class="t-name">James Thorne</span>
              <span class="t-role">CEO, Thorne Fragrance Group</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section class="pricing" id="pricing">
    <div class="pricing-inner">
      <div class="pricing-head">
        <p class="section-label">Pricing</p>
        <h2 class="section-title">Simple,<br /><em>transparent pricing</em></h2>
        <p class="section-desc">Start free. Upgrade when you grow. No hidden fees, no setup costs.</p>
      </div>
      <div class="plans">
        <div class="plan">
          <div class="plan-badge">Starter</div>
          <div class="plan-name">Boutique</div>
          <div class="plan-price"><sup>$</sup>10</div>
          <div class="plan-period">per month · billed monthly</div>
          <div class="plan-divider"></div>
          <ul class="plan-features">
            <li>Up to 50 fragrances</li>
            <li>Nurah Classic theme</li>
            <li>Inventory management</li>
            <li>Basic SEO tools</li>
            <li>Email support</li>
          </ul>
          <a href="#" class="plan-cta">Get started</a>
        </div>
        <div class="plan featured">
          <div class="plan-badge">Most popular</div>
          <div class="plan-name">Maison</div>
          <div class="plan-price"><sup>$</sup>20</div>
          <div class="plan-period">per month · billed monthly</div>
          <div class="plan-divider"></div>
          <ul class="plan-features">
            <li>Unlimited fragrances</li>
            <li>Full template library</li>
            <li>Scent combo engine</li>
            <li>Multi-brand dashboard</li>
            <li>Priority WhatsApp support</li>
          </ul>
          <a href="#" class="plan-cta">Get started</a>
        </div>
        <div class="plan">
          <div class="plan-badge">Enterprise</div>
          <div class="plan-name">Heritage</div>
          <div class="plan-price"><sup>$</sup>49</div>
          <div class="plan-period">per month · billed monthly</div>
          <div class="plan-divider"></div>
          <ul class="plan-features">
            <li>White-label experience</li>
            <li>Custom domain setup</li>
            <li>Dedicated brand partner</li>
            <li>Full API & webhook access</li>
            <li>Bespoke onboarding</li>
          </ul>
          <a href="#" class="plan-cta">Get started</a>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq" id="faq">
    <div class="faq-inner">
      <div class="faq-head">
        <p class="section-label">Common questions</p>
        <h2 class="section-title">Frequently asked<br /><em>inquiries</em></h2>
        <p class="section-desc">Everything you need to know about the VESPR platform, custom storefront templates, and how
          we help your brand scale.</p>
      </div>

      <div class="faq-list">
        <div class="faq-item">
          <button class="faq-question">
            <span>What is VESPR and how does it help my fragrance brand?</span>
            <span class="faq-toggle-icon">+</span>
          </button>
          <div class="faq-answer">
            <div class="faq-answer-content">
              VESPR is a high-performance eCommerce platform custom-tailored for independent perfumers and luxury
              fragrance houses. Unlike generic store builders, VESPR includes perfume-centric visual layouts, built-in
              notes classification (top, heart, and base notes), intelligent combo bundling, and optimized product grids
              to showcase your craft beautifully.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            <span>Can I use my own custom domain?</span>
            <span class="faq-toggle-icon">+</span>
          </button>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Yes, absolutely! Connecting a custom domain (such as <code>yourbrand.com</code>) is supported on all premium
              plans. We also provide secure, automated SSL certificates for all connected domains at no extra cost.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            <span>How do intelligent scent bundles work?</span>
            <span class="faq-toggle-icon">+</span>
          </button>
          <div class="faq-answer">
            <div class="faq-answer-content">
              Our proprietary bundling engine allows you to pair complimentary perfumes (e.g., suggesting a woody eau de
              parfum alongside a fresh travel spray) to create curated collections or combos. This feature can be managed
              easily from your multi-brand dashboard and helps maximize average order value (AOV) by up to 45%.
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            <span>Is there a transaction commission on my sales?</span>
            <span class="faq-toggle-icon">+</span>
          </button>
          <div class="faq-answer">
            <div class="faq-answer-content">
              No, VESPR does not take any commission fee on your sales. You keep 100% of your earnings minus standard
              transaction processing fees from your payment gateway (e.g., Stripe, PayPal).
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            <span>How long does it take to go live with my store?</span>
            <span class="faq-toggle-icon">+</span>
          </button>
          <div class="faq-answer">
            <div class="faq-answer-content">
              You can have a fully working, beautiful storefront live on the same day! Our bulk catalog importers,
              pre-configured layouts, and automated onboarding mean you only need to select a theme, upload your product
              details, connect your payment gateway, and launch.
            </div>
          </div>
        </div>

        <!-- <div class="faq-item">
            <button class="faq-question">
              <span>Can I migrate my existing store from Shopify or WooCommerce?</span>
              <span class="faq-toggle-icon">+</span>
            </button>
            <div class="faq-answer">
              <div class="faq-answer-content">
                Yes! We provide built-in migration tools that allow you to import your products, collections, pricing lists, and media assets using standard CSV formatting. If you require assistance, our support team is available on WhatsApp and email to help make the transition completely seamless.
              </div>
            </div>
          </div> -->
      </div>
    </div>
  </section>

  <!-- BRAND SYSTEM -->
  <!-- <section class="brand" id="brand">
      <div class="brand-inner">
        <div class="brand-head">
          <p class="section-label">Brand system</p>
          <h2 class="section-title">Colour palette &<br /><em>typography</em></h2>
        </div>
        <div class="brand-grid">
          <div class="brand-block">
            <h4>Neutral colour palette</h4>
            <div class="palette" style="margin-bottom: 36px;">
              <div class="swatch" style="background:#F5F0E8; border: 1px solid #D4C9B0;"><span>Cream</span></div>
              <div class="swatch" style="background:#EDE6D6;"><span>Warm</span></div>
              <div class="swatch" style="background:#D4C9B0;"><span>Sand</span></div>
              <div class="swatch" style="background:#9C9080;"><span>Stone</span></div>
              <div class="swatch" style="background:#5C5147;"><span>Bark</span></div>
              <div class="swatch" style="background:#1E1A16;"><span>Ink</span></div>
              <div class="swatch" style="background:#7C5C8A;"><span>Violet</span></div>
            </div>
            <h4 style="margin-top: 48px;">Usage</h4>
            <div style="display:grid; gap:8px; margin-top:12px;">
              <div style="display:flex; align-items:center; gap:12px; font-size:13px; color: var(--bark);">
                <div
                  style="width:16px; height:16px; background:#F5F0E8; border:1px solid #D4C9B0; border-radius:2px; flex-shrink:0;">
                </div>
                Cream — page backgrounds
              </div>
              <div style="display:flex; align-items:center; gap:12px; font-size:13px; color: var(--bark);">
                <div style="width:16px; height:16px; background:#D4C9B0; border-radius:2px; flex-shrink:0;"></div>
                Sand — borders, dividers
              </div>
              <div style="display:flex; align-items:center; gap:12px; font-size:13px; color: var(--bark);">
                <div style="width:16px; height:16px; background:#9C9080; border-radius:2px; flex-shrink:0;"></div>
                Stone — body text, secondary
              </div>
              <div style="display:flex; align-items:center; gap:12px; font-size:13px; color: var(--bark);">
                <div style="width:16px; height:16px; background:#1E1A16; border-radius:2px; flex-shrink:0;"></div>
                Ink — headings, CTAs
              </div>
              <div style="display:flex; align-items:center; gap:12px; font-size:13px; color: var(--bark);">
                <div style="width:16px; height:16px; background:#7C5C8A; border-radius:2px; flex-shrink:0;"></div>
                Violet — accents, highlights
              </div>
            </div>
          </div>
          <div class="brand-block">
            <h4>Font pairing</h4>
            <div class="font-sample">
              <div class="fs-name">Display — Cormorant Garamond</div>
              <div class="fs-display">The Art of Scent</div>
              <div style="font-size:12px; color:var(--stone); margin-top:6px; font-weight:300;">Light 300 · Italic for
                emphasis · Headlines &amp; hero text</div>
            </div>
            <div style="height:1px; background: var(--sand); margin: 24px 0;"></div>
            <div class="font-sample">
              <div class="fs-name">Body — DM Sans</div>
              <div class="fs-body">Sell fragrance, effortlessly. Built for independent perfumers and luxury fragrance
                houses.</div>
              <div style="font-size:12px; color:var(--stone); margin-top:6px; font-weight:300;">Light 300 · Regular 400 ·
                UI, navigation, body copy</div>
            </div>
            <div style="height:1px; background: var(--sand); margin: 24px 0;"></div>
            <div style="font-size:12px; color:var(--stone); font-weight:300; line-height:1.8;">
              <strong style="font-weight:500; color:var(--bark);">Why this pairing:</strong> Cormorant brings old-world
              fragrance house elegance. DM Sans keeps the SaaS UI clean and readable. The contrast between serif display and
              geometric sans signals both luxury and modern simplicity.
            </div>
          </div>
        </div>
      </div>
    </section> -->

  <!-- CTA -->
  <section class="cta-section">
    <p class="section-label">Get started</p>
    <h2 class="section-title">Ready to launch your<br /><em>fragrance brand?</em></h2>
    <p class="section-desc">Join the fragrance houses using Vespr to power their digital presence. No setup fee. No
      developer needed.</p>
    <div class="hero-actions">
      <a href="#pricing" class="btn-primary">Start for free</a>
      <a href="https://wa.me/your-number" class="btn-ghost">Chat on WhatsApp</a>
    </div>
  </section>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // FAQ Accordion Logic
      const faqQuestions = document.querySelectorAll('.faq-question');
      faqQuestions.forEach(q => {
        q.addEventListener('click', () => {
          const item = q.parentElement;
          const answer = item.querySelector('.faq-answer');
          const isActive = item.classList.contains('active');

          // Close other active items
          document.querySelectorAll('.faq-item').forEach(i => {
            if (i !== item) {
              i.classList.remove('active');
              i.querySelector('.faq-answer').style.maxHeight = null;
            }
          });

          if (!isActive) {
            item.classList.add('active');
            answer.style.maxHeight = answer.scrollHeight + 'px';
          } else {
            item.classList.remove('active');
            answer.style.maxHeight = null;
          }
        });
      });

      // Interactive Features Tabs Logic
      const featureTabs = document.querySelectorAll('.feature-tab');
      const tabContents = document.querySelectorAll('.tab-content');

      featureTabs.forEach(tab => {
        tab.addEventListener('click', () => {
          const targetTab = tab.getAttribute('data-tab');

          // Deactivate all tabs and contents
          featureTabs.forEach(t => t.classList.remove('active'));
          tabContents.forEach(c => c.classList.remove('active'));

          // Activate selected tab and target content
          tab.classList.add('active');
          const activeContent = document.getElementById(`tab-${targetTab}`);
          if (activeContent) {
            activeContent.classList.add('active');
          }
        });
      });
    });
  </script>
@endsection
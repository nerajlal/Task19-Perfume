<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>VESPR — The Ultimate Perfume Platform</title>
    <meta name="description" content="Vespr gives independent perfumers and fragrance houses everything they need to sell online — beautiful stores, smart tools, and zero complexity.">
    <meta name="keywords" content="perfume saas, fragrance e-commerce, luxury perfume website, vespr, perfume business solution">
    <link rel="canonical" href="{{ url()->current() }}">
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
<style>
  :root {
    --cream:    #F5F0E8;
    --warm:     #EDE6D6;
    --sand:     #D4C9B0;
    --stone:    #9C9080;
    --bark:     #5C5147;
    --ink:      #1E1A16;
    --violet:   #7C5C8A;
    --violet-l: #C4A8D4;
    --violet-d: #4A3556;
    --white:    #FDFAF5;
    --serif:    'Cormorant Garamond', Georgia, serif;
    --sans:     'DM Sans', system-ui, sans-serif;
    --radius:   6px;
    --transition: 0.3s cubic-bezier(0.4,0,0.2,1);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: var(--sans);
    background: var(--cream);
    color: var(--ink);
    font-size: 16px;
    line-height: 1.7;
    -webkit-font-smoothing: antialiased;
  }

  /* ── NAV ── */
  nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    display: flex; align-items: center; justify-content: space-between;
    padding: 20px 48px;
    background: rgba(245,240,232,0.9);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--sand);
  }
  .nav-logo {
    font-family: var(--serif);
    font-size: 28px;
    font-weight: 300;
    letter-spacing: 8px;
    color: var(--ink);
    text-decoration: none;
  }
  .nav-logo span { color: var(--violet); }
  .nav-links { display: flex; gap: 36px; list-style: none; }
  .nav-links a {
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 400;
    letter-spacing: 1.5px;
    color: var(--bark);
    text-decoration: none;
    text-transform: uppercase;
    transition: color var(--transition);
  }
  .nav-links a:hover { color: var(--violet); }
  .nav-cta {
    background: var(--ink);
    color: var(--white) !important;
    padding: 10px 24px;
    border-radius: 2px;
    letter-spacing: 1.5px;
  }
  .nav-cta:hover { background: var(--violet); color: var(--white) !important; }

  /* ── HERO ── */
  .hero {
    min-height: 100vh;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    text-align: center;
    padding: 120px 48px 80px;
    position: relative;
    overflow: hidden;
  }
  .hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(ellipse 60% 50% at 50% 60%, rgba(124,92,138,0.08) 0%, transparent 70%);
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
    display: flex; align-items: center; gap: 12px;
  }
  .hero-eyebrow::before, .hero-eyebrow::after {
    content: '';
    width: 32px; height: 1px;
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
  .hero-actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
  .btn-primary {
    background: var(--ink);
    color: var(--white);
    padding: 16px 40px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 2px;
    transition: background var(--transition);
    border: none; cursor: pointer;
  }
  .btn-primary:hover { background: var(--violet); }
  .btn-ghost {
    background: transparent;
    color: var(--bark);
    padding: 16px 40px;
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 400;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 2px;
    border: 1px solid var(--sand);
    transition: border-color var(--transition), color var(--transition);
    cursor: pointer;
  }
  .btn-ghost:hover { border-color: var(--violet); color: var(--violet); }
  .hero-trust {
    margin-top: 64px;
    font-size: 11px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--stone);
  }
  .hero-brands {
    display: flex; gap: 40px; justify-content: center;
    margin-top: 16px; flex-wrap: wrap;
  }
  .hero-brands span {
    font-family: var(--serif);
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 2px;
    color: var(--sand);
  }

  /* ── SECTION COMMONS ── */
  section { padding: 100px 48px; }
  .section-label {
    font-size: 11px; font-weight: 500;
    letter-spacing: 4px; text-transform: uppercase;
    color: var(--violet); margin-bottom: 16px;
  }
  .section-title {
    font-family: var(--serif);
    font-size: clamp(36px, 4vw, 56px);
    font-weight: 300;
    line-height: 1.15;
    color: var(--ink);
    margin-bottom: 20px;
  }
  .section-title em { font-style: italic; color: var(--violet); }
  .section-desc {
    font-size: 16px; font-weight: 300;
    color: var(--stone); max-width: 520px;
    line-height: 1.8;
  }

  /* ── ONBOARDING ── */
  .onboarding { background: var(--white); }
  .onboarding-inner { max-width: 1100px; margin: 0 auto; }
  .onboarding-head { text-align: center; margin-bottom: 72px; }
  .onboarding-head .section-desc { margin: 0 auto; }
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
  .step:hover { background: var(--warm); }
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
    top: 52px; right: -18px;
    width: 36px; height: 1px;
    background: var(--sand);
    z-index: 2;
  }
  .step:last-child .step-connector { display: none; }

  /* ── FEATURES ── */
  .features { background: var(--cream); }
  .features-inner { max-width: 1100px; margin: 0 auto; }
  .features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2px;
    margin-top: 64px;
  }
  .feature {
    background: var(--white);
    padding: 40px 36px;
    transition: transform var(--transition);
  }
  .feature:hover { transform: translateY(-4px); }
  .feature-icon {
    width: 40px; height: 40px;
    border: 1px solid var(--sand);
    border-radius: 2px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 24px;
    color: var(--violet);
    font-size: 18px;
  }
  .feature-title {
    font-family: var(--serif);
    font-size: 20px;
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 10px;
  }
  .feature-desc {
    font-size: 14px;
    font-weight: 300;
    color: var(--stone);
    line-height: 1.8;
  }

  /* ── PRICING ── */
  .pricing { background: var(--ink); }
  .pricing .section-label { color: var(--violet-l); }
  .pricing .section-title { color: var(--white); }
  .pricing .section-title em { color: var(--violet-l); }
  .pricing-inner { max-width: 1000px; margin: 0 auto; }
  .pricing-head { text-align: center; margin-bottom: 64px; }
  .pricing-head .section-desc { color: var(--stone); margin: 0 auto; }
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
  .plan:hover { background: #332C28; }
  .plan.featured {
    background: var(--violet);
    transform: translateY(-8px);
  }
  .plan.featured:hover { background: var(--violet-d); }
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
    background: rgba(255,255,255,0.2);
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
  .plan.featured .plan-period { color: rgba(255,255,255,0.6); }
  .plan-divider {
    height: 1px;
    background: rgba(255,255,255,0.1);
    margin-bottom: 28px;
  }
  .plan-features { list-style: none; margin-bottom: 36px; }
  .plan-features li {
    font-size: 14px;
    font-weight: 300;
    color: rgba(255,255,255,0.7);
    padding: 8px 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    display: flex; align-items: center; gap: 10px;
  }
  .plan-features li::before {
    content: '—';
    color: var(--violet-l);
    font-weight: 300;
    flex-shrink: 0;
  }
  .plan.featured .plan-features li::before { color: rgba(255,255,255,0.5); }
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
    border: 1px solid rgba(255,255,255,0.2);
    color: var(--white);
  }
  .plan-cta:hover { border-color: var(--white); }
  .plan.featured .plan-cta {
    background: var(--white);
    color: var(--violet-d);
    border-color: var(--white);
  }
  .plan.featured .plan-cta:hover { background: var(--cream); }

  /* ── BRAND SYSTEM ── */
  .brand { background: var(--warm); }
  .brand-inner { max-width: 1100px; margin: 0 auto; }
  .brand-head { margin-bottom: 56px; }
  .brand-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; }
  .brand-block h4 {
    font-size: 11px; font-weight: 500;
    letter-spacing: 3px; text-transform: uppercase;
    color: var(--stone); margin-bottom: 24px;
  }
  .palette { display: flex; gap: 8px; }
  .swatch {
    flex: 1; height: 64px; border-radius: 2px;
    position: relative;
  }
  .swatch span {
    position: absolute; bottom: -22px; left: 0;
    font-size: 11px; color: var(--stone);
    white-space: nowrap;
  }
  .font-sample { margin-bottom: 20px; }
  .font-sample .fs-name {
    font-size: 11px; letter-spacing: 2px;
    text-transform: uppercase; color: var(--stone);
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
  .cta-section .section-title { max-width: 600px; margin: 0 auto 16px; }
  .cta-section .section-desc { margin: 0 auto 48px; text-align: center; }

  /* ── FOOTER ── */
  footer {
    background: var(--ink);
    padding: 60px 48px 40px;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 48px;
  }
  .footer-brand .nav-logo { display: block; margin-bottom: 16px; }
  .footer-brand p {
    font-size: 13px; font-weight: 300;
    color: var(--stone); max-width: 260px; line-height: 1.8;
  }
  footer h5 {
    font-size: 11px; letter-spacing: 3px;
    text-transform: uppercase; color: var(--stone);
    margin-bottom: 20px; font-weight: 500;
  }
  footer ul { list-style: none; }
  footer ul li { margin-bottom: 10px; }
  footer ul a {
    font-size: 14px; font-weight: 300;
    color: rgba(255,255,255,0.5);
    text-decoration: none;
    transition: color var(--transition);
  }
  footer ul a:hover { color: var(--white); }
  .footer-bottom {
    background: var(--ink);
    padding: 20px 48px;
    border-top: 1px solid rgba(255,255,255,0.06);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .footer-bottom p {
    font-size: 12px; color: var(--stone); font-weight: 300;
  }

  /* ── ANIMATIONS ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .fade-up { animation: fadeUp 0.8s ease forwards; }
  .delay-1 { animation-delay: 0.1s; opacity: 0; }
  .delay-2 { animation-delay: 0.25s; opacity: 0; }
  .delay-3 { animation-delay: 0.4s; opacity: 0; }
  .delay-4 { animation-delay: 0.55s; opacity: 0; }

  @media (max-width: 900px) {
    nav { padding: 16px 24px; }
    .nav-links { display: none; }
    section { padding: 72px 24px; }
    .steps { grid-template-columns: 1fr 1fr; }
    .features-grid { grid-template-columns: 1fr 1fr; }
    .plans { grid-template-columns: 1fr; }
    .plan.featured { transform: none; }
    .brand-grid { grid-template-columns: 1fr; }
    footer { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="{{ route('landing.vespr') }}" class="nav-logo">vesp<span>r</span></a>
  <ul class="nav-links">
    <li><a href="#onboarding">How it works</a></li>
    <li><a href="#features">Features</a></li>
    <li><a href="#pricing">Pricing</a></li>
    <li><a href="#pricing" class="nav-cta">Start free</a></li>
  </ul>
</nav>

<!-- HERO -->
<section class="hero">
  <p class="hero-eyebrow fade-up">Perfume Platform</p>
  <h1 class="fade-up delay-1">Your scent brand,<br/><em>live today.</em></h1>
  <p class="hero-sub fade-up delay-2">Vespr gives independent perfumers and fragrance houses everything they need to sell online — beautiful store, smart tools, zero complexity.</p>
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
      <h2 class="section-title">Up and selling in<br/><em>four simple steps</em></h2>
      <p class="section-desc">No developers. No design agency. No complexity. Go from idea to live fragrance store in under an hour.</p>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step-num">01</div>
        <div class="step-title">Create your account</div>
        <div class="step-desc">Sign up with your email. No credit card required to start. Your store is provisioned instantly.</div>
        <span class="step-tag">2 minutes</span>
        <div class="step-connector"></div>
      </div>
      <div class="step">
        <div class="step-num">02</div>
        <div class="step-title">Pick your theme</div>
        <div class="step-desc">Choose from our curated fragrance-first templates. Each one is designed to convert visitors into buyers.</div>
        <span class="step-tag">5 minutes</span>
        <div class="step-connector"></div>
      </div>
      <div class="step">
        <div class="step-num">03</div>
        <div class="step-title">Add your fragrances</div>
        <div class="step-desc">Upload your products, set prices, write your scent notes. Our editor makes it feel effortless.</div>
        <span class="step-tag">15 minutes</span>
        <div class="step-connector"></div>
      </div>
      <div class="step">
        <div class="step-num">04</div>
        <div class="step-title">Launch & sell</div>
        <div class="step-desc">Connect your domain, set up payments, and go live. Your fragrance store is open for business.</div>
        <span class="step-tag">Today</span>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="features" id="features">
  <div class="features-inner">
    <p class="section-label">Platform features</p>
    <h2 class="section-title">Everything a fragrance<br/><em>brand needs</em></h2>
    <div class="features-grid">
      <div class="feature">
        <div class="feature-icon">◈</div>
        <div class="feature-title">Couture themes</div>
        <div class="feature-desc">Switch between world-class fragrance-specific designs with a single click. Every template built for high-conversion scent storytelling.</div>
      </div>
      <div class="feature">
        <div class="feature-icon">◎</div>
        <div class="feature-title">Scent bundling</div>
        <div class="feature-desc">Maximise revenue with intelligent fragrance combo pools. Suggest complementary scents automatically at checkout.</div>
      </div>
      <div class="feature">
        <div class="feature-icon">⊞</div>
        <div class="feature-title">Multi-brand dashboard</div>
        <div class="feature-desc">Manage multiple fragrance labels from one elite dashboard. Perfect for houses that carry more than one line.</div>
      </div>
      <div class="feature">
        <div class="feature-icon">◐</div>
        <div class="feature-title">Velvet performance</div>
        <div class="feature-desc">Ultra-fast loading built for high-conversion fragrance sales. Every millisecond optimised so customers stay and buy.</div>
      </div>
      <div class="feature">
        <div class="feature-icon">◉</div>
        <div class="feature-title">Discovery SEO</div>
        <div class="feature-desc">Built-in tools to dominate organic search for your scents. Structured data, meta tools, and sitemap generation included.</div>
      </div>
      <div class="feature">
        <div class="feature-icon">◇</div>
        <div class="feature-title">Secure payments</div>
        <div class="feature-desc">Robust, encrypted payment flows for high-value trust. Accept cards, UPI, and international payments out of the box.</div>
      </div>
    </div>
  </div>
</section>

<!-- PRICING -->
<section class="pricing" id="pricing">
  <div class="pricing-inner">
    <div class="pricing-head">
      <p class="section-label">Pricing</p>
      <h2 class="section-title">Simple,<br/><em>transparent pricing</em></h2>
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

<!-- BRAND SYSTEM -->
<section class="brand" id="brand">
  <div class="brand-inner">
    <div class="brand-head">
      <p class="section-label">Brand system</p>
      <h2 class="section-title">Colour palette &<br/><em>typography</em></h2>
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
            <div style="width:16px; height:16px; background:#F5F0E8; border:1px solid #D4C9B0; border-radius:2px; flex-shrink:0;"></div>
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
          <div style="font-size:12px; color:var(--stone); margin-top:6px; font-weight:300;">Light 300 · Italic for emphasis · Headlines &amp; hero text</div>
        </div>
        <div style="height:1px; background: var(--sand); margin: 24px 0;"></div>
        <div class="font-sample">
          <div class="fs-name">Body — DM Sans</div>
          <div class="fs-body">Sell fragrance, effortlessly. Built for independent perfumers and luxury fragrance houses.</div>
          <div style="font-size:12px; color:var(--stone); margin-top:6px; font-weight:300;">Light 300 · Regular 400 · UI, navigation, body copy</div>
        </div>
        <div style="height:1px; background: var(--sand); margin: 24px 0;"></div>
        <div style="font-size:12px; color:var(--stone); font-weight:300; line-height:1.8;">
          <strong style="font-weight:500; color:var(--bark);">Why this pairing:</strong> Cormorant brings old-world fragrance house elegance. DM Sans keeps the SaaS UI clean and readable. The contrast between serif display and geometric sans signals both luxury and modern simplicity.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <p class="section-label">Get started</p>
  <h2 class="section-title">Ready to launch your<br/><em>fragrance brand?</em></h2>
  <p class="section-desc">Join the fragrance houses using Vespr to power their digital presence. No setup fee. No developer needed.</p>
  <div class="hero-actions">
    <a href="#pricing" class="btn-primary">Start for free</a>
    <a href="https://wa.me/your-number" class="btn-ghost">Chat on WhatsApp</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-brand">
    <a href="{{ route('landing.vespr') }}" class="nav-logo">vesp<span>r</span></a>
    <p>The e-commerce platform built for perfumers. From artisanal boutiques to global fragrance houses.</p>
  </div>
  <div>
    <h5>Platform</h5>
    <ul>
      <li><a href="#">Features</a></li>
      <li><a href="{{ route('landing.templates') }}">Templates</a></li>
      <li><a href="#pricing">Pricing</a></li>
      <li><a href="{{ route('landing.templates') }}">Live demos</a></li>
    </ul>
  </div>
  <div>
    <h5>Company</h5>
    <ul>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="#">Privacy policy</a></li>
      <li><a href="#">Terms of service</a></li>
    </ul>
  </div>
</footer>
<div class="footer-bottom">
  <p>© 2026 Vespr. All rights reserved.</p>
  <p>perfume@vespr.com</p>
</div>

</body>
</html>

@extends('layouts.storefront')

@section('title', 'About Us | Task19 Perfumes')

@section('content')
<div class="static-page-container">
    <h1 class="page-title">The Story of Task19 Perfumes</h1>
    <div class="page-content">
        <p>Task19 Perfumes was born from a passion for the world's most exquisite scents. We believe that a fragrance is more than just a smell—it's a memory, an emotion, and a signature of who you are.</p>
        <p>Our collection is meticulously curated from artisanal perfumers and essential oil distillers around the globe, ensuring that every drop tells a story of craftsmanship and luxury.</p>
        
        <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&q=80&w=1200" alt="Perfume Craft" class="content-img">

        <h2>Our Commitment</h2>
        <p>We are committed to purity and quality. Every fragrance in our store is selected for its longevity, sillage, and unique olfactory profile.</p>
    </div>
</div>

<style>
    .static-page-container { max-width: 800px; margin: 0 auto; padding: 3rem 0; }
    .page-title { font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; text-align: center; }
    .page-content { line-height: 1.8; color: var(--text-main); font-size: 1.1rem; }
    .page-content p { margin-bottom: 1.5rem; }
    .content-img { width: 100%; border-radius: 1.5rem; margin: 2rem 0; }
</style>
@endsection

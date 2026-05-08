<footer class="store-footer">
    <div class="footer-content-wrapper">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo">Task19 Perfumes</a>
                <p>Elevating the art of fine perfumery. Task19 brings you the world's most exquisite artisanal
                    fragrances
                    and essential oils.</p>
                <div class="footer-trust">
                    <div class="payment-methods">
                        <i class="fa-brands fa-cc-visa"></i>
                        <i class="fa-brands fa-cc-mastercard"></i>
                        <i class="fa-brands fa-cc-apple-pay"></i>
                        <i class="fa-brands fa-google-pay"></i>
                    </div>
                    <div class="secure-badge">
                        <i class="fa-solid fa-shield-check"></i> 256-bit SSL Secure
                    </div>
                </div>
            </div>

            <div class="footer-group">
                <h3 class="footer-heading">Collections</h3>
                <ul class="footer-links">
                    @php $footerCols = \App\Models\Collection::where('status', 1)->take(5)->get(); @endphp
                    @foreach($footerCols as $col)
                        <li><a href="{{ route('collection', ['slug' => $col->slug]) }}">{{ $col->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-group">
                <h3 class="footer-heading">Customer Care</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('about') }}">Our Story</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('shipping-policy') }}">Shipping Policy</a></li>
                    <li><a href="{{ route('return-policy') }}">Return Policy</a></li>
                </ul>
            </div>

            <div class="footer-newsletter">
                <h3 class="footer-heading">Newsletter</h3>
                <p>Join our exclusive circle for artisanal launches and limited edition scents.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email">
                    <button type="button">Join</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="copyright">
                &copy; {{ date('Y') }} Task19 Perfumes. All rights reserved. <span style="opacity: 0.7; margin-left: 10px;">| Developed by <a href="#" style="color: inherit; text-decoration: none; font-weight: 600;">Task19 Technologies</a></span>
            </div>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-pinterest"></i></a>
            </div>
        </div>
</footer>
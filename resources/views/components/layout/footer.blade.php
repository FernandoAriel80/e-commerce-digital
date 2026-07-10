<footer>
    <div class="footer-top-side">
        <div class="footer-logo-container">
            <a
                class="logo-link-index"
                href="{{ route('home') }}">
                <img src="{{ asset('images/logos/basic-logo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="footer-social-container">
            <a
                href="{{ route('home') }}">
                <img src="https://img.icons8.com/?size=100&id=16712&format=png&color=000000" alt="Logo">
            </a>
            <a
                href="{{ route('home') }}">
                <img src="https://img.icons8.com/?size=100&id=32292&format=png&color=000000" alt="Logo">
            </a>
            <a
                href="{{ route('home') }}">
                <img src="https://img.icons8.com/?size=100&id=435&format=png&color=000000" alt="Logo">
            </a>
        </div>
        <div class="footer-about-container">
            <div class="footer-about-text">
                <p>Acerca de:</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Tenetur provident quo tempora, hic ratione, aspernatur enim
                    minima atque similique corrupti nulla quia voluptate ducimus ad,
                    deserunt explicabo consequatur optio fugit?</p>
            </div>
            <div class="footer-list-links-container">
                <div>
                    <span>titulo</span>
                    <ul>
                        <li><a href="#">algo</a></li>
                        <li><a href="#">algo</a></li>
                        <li><a href="#">algo</a></li>
                        <li><a href="#">algo</a></li>
                        <li><a href="#">algo</a></li>
                    </ul>
                </div>
                <div>
                    <span>Información</span>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                        <li><a href="#">Politica de privacidad</a></li>
                 
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bot-side">
        <p> Copyright {{ env('PROJECT_NAME') }} - {{ date('Y') }}. Todos los derechos reservados.</p>
    </div>
</footer>
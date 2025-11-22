<footer class="footer">
    <div class="container">
        <div class="footer-content">
            
            <!-- Sección 1: Jeff Academy Info -->
            <div class="footer-section">
                <h4>Jeff Academy</h4>
                <p>Formando campeones integrales con excelencia deportiva y valores sólidos.</p>
                <p>Somos una institución dedicada al desarrollo integral de jóvenes deportistas, combinando entrenamiento de alto nivel con formación en valores. Nuestro compromiso es crear atletas completos, preparados tanto para el éxito deportivo como para la vida.</p>
            </div>

            <!-- Sección 2: Enlaces Rápidos -->
            <div class="footer-section">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="{{ route('nosotros') }}"><i class="fas fa-users"></i> Nosotros</a></li>
                    <li><a href="{{ route('home') }}#disciplinas"><i class="fas fa-futbol"></i> Disciplinas</a></li>
                    <li><a href="{{ route('home') }}#instalaciones"><i class="fas fa-building"></i> Instalaciones</a></li>
                    <li><a href="{{ route('noticias.index') }}"><i class="fas fa-newspaper"></i> Noticias</a></li>
                    <li><a href="{{ route('planes') }}"><i class="fas fa-tags"></i> Planes</a></li>
                    <li><a href="{{ route('contacto') }}"><i class="fas fa-envelope"></i> Contacto</a></li>
                </ul>
            </div>

            <!-- Sección 3: Contacto -->
            <div class="footer-section">
                <h4>Contacto</h4>
                <ul class="contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Trujillo, La Libertad - Perú</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>+51 999 888 777</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>info@jeffacademy.com</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Lun - Vie: 8:00 AM - 8:00 PM<br>Sáb: 9:00 AM - 1:00 PM</span>
                    </li>
                </ul>

                <h4 style="margin-top: 25px;">Síguenos</h4>
                <div class="social-links">
                    <a href="https://facebook.com/jeffacademy" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       aria-label="Facebook"
                       title="Síguenos en Facebook">
                        <i class="fab fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="https://twitter.com/jeffacademy" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       aria-label="Twitter"
                       title="Síguenos en Twitter">
                        <i class="fab fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="https://instagram.com/jeffacademy" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       aria-label="Instagram"
                       title="Síguenos en Instagram">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                    </a>
                    <a href="https://youtube.com/@jeffacademy" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       aria-label="YouTube"
                       title="Suscríbete a nuestro Canal">
                        <i class="fab fa-youtube" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <!-- Sección 4: Medios de Pago -->
            <div class="footer-section payment-section">
                <h4>Medios de Pago</h4>
                <p class="payment-subtitle">Aceptamos los siguientes métodos de pago</p>
                
                <div class="payment-methods">
                    <div class="payment-item">
                        <img src="{{ asset('/img/tipos-de-pago/BCP.jpg') }}" 
                             alt="BCP - Banco de Crédito del Perú" 
                             title="BCP" 
                             loading="lazy">
                    </div>
                    <div class="payment-item">
                        <img src="{{ asset('/img/tipos-de-pago/yape.png') }}" 
                             alt="Yape - App de Pagos" 
                             title="Yape" 
                             loading="lazy">
                    </div>
                    <div class="payment-item">
                        <img src="{{ asset('/img/tipos-de-pago/plin.jpg') }}" 
                             alt="Plin - Sistema de Pagos" 
                             title="Plin" 
                             loading="lazy">
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom - Copyright -->
        <div class="footer-bottom">
            <p>&copy; 2025 <strong>Jeff Academy</strong> | Formando Campeones en Trujillo - Perú</p>
            <p class="footer-credits">
            
            </p>
        </div>
    </div>
</footer>
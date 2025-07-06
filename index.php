<?php
require_once 'config.php';

// Fetch latest 5 testimonials
$stmt = $db->getConnection()->prepare("SELECT * FROM images ORDER BY upload_date DESC LIMIT 5");
$stmt->execute();
$latestTestimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate alt text
foreach ($latestTestimonials as &$t) {
    $t['alt_text'] = explode(' ', trim($t['image_name']))[0] ?: 'testimonial';
}
?>

<body>
<?php include 'header.php'; ?>
    <!-- Full-screen Carousel -->
    <section class="hero-carousel" id="home">
        <div class="hero-carousel__slides">
            <!-- Slide 1 -->
            <div class="hero-carousel__slide hero-carousel__slide--active">
                <div class="hero-carousel__image" style="background-image: url('assets/img1.png');"></div>
                <div class="hero-carousel__content">
                    <h1 class="hero-carousel__title">Corporate Event Specialists</h1>
                    <p class="hero-carousel__subtitle">Creating memorable experiences for your business</p>
                    <a href="contact.php" class="hero-carousel__button">Plan Your Event</a>
                </div>
                <div class="hero-carousel__event-label">
                    <span>Annual Conferences</span>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="hero-carousel__slide">
                <div class="hero-carousel__image" style="background-image: url('assets/img2.png');"></div>
                <div class="hero-carousel__content">
                    <h1 class="hero-carousel__title">Wedding Planning Experts</h1>
                    <p class="hero-carousel__subtitle">Making your special day unforgettable</p>
                    <a href="contact.php" class="hero-carousel__button">Plan Your Wedding</a>
                </div>
                <div class="hero-carousel__event-label">
                    <span>Weddings & Receptions</span>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="hero-carousel__slide">
                <div class="hero-carousel__image" style="background-image: url('assets/img3.png');"></div>
                <div class="hero-carousel__content">
                    <h1 class="hero-carousel__title">Product Launch Professionals</h1>
                    <p class="hero-carousel__subtitle">Making your product shine in the market</p>
                    <a href="contact.php" class="hero-carousel__button">Launch With Us</a>
                </div>
                <div class="hero-carousel__event-label">
                    <span>Product Launches</span>
                </div>
            </div>
        </div>
        
        <div class="hero-carousel__controls">
            <button class="hero-carousel__prev" aria-label="Previous slide">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="hero-carousel__next" aria-label="Next slide">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        
        <div class="hero-carousel__indicators">
            <button class="hero-carousel__indicator hero-carousel__indicator--active" aria-label="Slide 1"></button>
            <button class="hero-carousel__indicator" aria-label="Slide 2"></button>
            <button class="hero-carousel__indicator" aria-label="Slide 3"></button>
        </div>
    </section>
<!-- Events Section -->
<section class="golden-events-section">
    <div class="golden-container">
        <h2 class="golden-section-title">Our Event Specialties</h2>
        <p class="golden-section-subtitle">We make your special occasions truly memorable</p>
        
        <div class="golden-events-grid">
            <!-- Card 1 -->
            <div class="golden-event-card golden-card-marriage">
                <div class="golden-card-icon">
                    <i class="fas fa-ring"></i>
                </div>
                <h3 class="golden-card-title">Marriage</h3>
                <p class="golden-card-text">Complete wedding planning with traditional and modern themes</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Food</span>
                    <span class="golden-service-tag">Photography</span>
                    <span class="golden-service-tag">Decoration</span>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="golden-event-card golden-card-birthday">
                <div class="golden-card-icon">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <h3 class="golden-card-title">Birthday Party</h3>
                <p class="golden-card-text">Themed birthday parties for all ages with customized cakes</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Catering</span>
                    <span class="golden-service-tag">Entertainment</span>
                    <span class="golden-service-tag">Sound System</span>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="golden-event-card golden-card-together">
                <div class="golden-card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="golden-card-title">Get Togethers</h3>
                <p class="golden-card-text">Perfect arrangements for family and friend reunions</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Food</span>
                    <span class="golden-service-tag">Venue</span>
                    <span class="golden-service-tag">Music</span>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="golden-event-card golden-card-school">
                <div class="golden-card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="golden-card-title">School/College Functions</h3>
                <p class="golden-card-text">Annual days, cultural events and graduation ceremonies</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Stage Setup</span>
                    <span class="golden-service-tag">Sound System</span>
                    <span class="golden-service-tag">Photography</span>
                </div>
            </div>
            
            <!-- Card 5 -->
            <div class="golden-event-card golden-card-house">
                <div class="golden-card-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="golden-card-title">House Warming</h3>
                <p class="golden-card-text">Traditional house warming ceremonies with modern touch</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Pooja Arrangements</span>
                    <span class="golden-service-tag">Catering</span>
                    <span class="golden-service-tag">Decoration</span>
                </div>
            </div>
            
            <!-- Card 6 -->
            <div class="golden-event-card golden-card-sangeeth">
                <div class="golden-card-icon">
                    <i class="fas fa-music"></i>
                </div>
                <h3 class="golden-card-title">Sangeeth</h3>
                <p class="golden-card-text">Vibrant musical nights with dance performances</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">DJ</span>
                    <span class="golden-service-tag">Lighting</span>
                    <span class="golden-service-tag">Stage</span>
                </div>
            </div>
            
            <!-- Card 7 -->
            <div class="golden-event-card golden-card-haldi">
                <div class="golden-card-icon">
                    <i class="fas fa-spa"></i>
                </div>
                <h3 class="golden-card-title">Haldi</h3>
                <p class="golden-card-text">Traditional haldi ceremony with floral decorations</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Rituals</span>
                    <span class="golden-service-tag">Photography</span>
                    <span class="golden-service-tag">Makeup</span>
                </div>
            </div>
            
            <!-- Card 8 -->
            <div class="golden-event-card golden-card-mehandi">
                <div class="golden-card-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="golden-card-title">Mehandi</h3>
                <p class="golden-card-text">Beautiful mehandi designs with cultural performances</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Artists</span>
                    <span class="golden-service-tag">Music</span>
                    <span class="golden-service-tag">Food</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials Section -->
<!-- Testimonials Section -->
<section class="golden-testimonials-3d" id="testimonials">
    <div class="golden-3d-container">
        <h2 class="golden-3d-title">Voices of <span class="golden-text-gradient">Delight</span></h2>
        <p class="golden-3d-subtitle">Where Memories Become Testimonials</p>
        
        <div class="golden-3d-carousel" id="testimonialCarousel">
            <!-- Testimonial items will be injected via JS -->
        </div>
        
        <div class="golden-3d-nav">
            <button class="golden-3d-prev"><i class="fas fa-chevron-left"></i></button>
            <div class="golden-3d-pagination"></div>
            <button class="golden-3d-next"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    
    <!-- Floating decorative elements -->
    <div class="golden-3d-particle" id="particle-1"></div>
    <div class="golden-3d-particle" id="particle-2"></div>
    <div class="golden-3d-particle" id="particle-3"></div>
</section>
    <!-- Rest of your content sections will go here -->
    <!-- Gallery Section -->
<section class="golden-gallery" id="gallery">
    <div class="golden-gallery-container">
        <h2 class="golden-gallery-title">Our <span class="golden-sparkle">Memories</span></h2>
        <p class="golden-gallery-subtitle">Capturing moments that last lifetimes</p>
        
        <div class="golden-grid-masonry">
            <!-- Grid Item 1 (Large) -->
            <div class="golden-grid-item golden-grid-item--wide">
                <img src="assets/t1.jpg" alt="Grand Wedding" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Royal Wedding</h3>
                        <p class="golden-grid-description">500+ guests · Taj Palace</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 2 (Tall) -->
            <div class="golden-grid-item golden-grid-item--tall">
                <img src="assets/t2.jpg" alt="Corporate Event" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Tech Conference</h3>
                        <p class="golden-grid-description">Bangalore · 2023</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 3 (Small) -->
            <div class="golden-grid-item">
                <img src="assets/gallery/birthday-1.jpg" alt="Birthday Party" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Sweet 16</h3>
                        <p class="golden-grid-description">Themed Party</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 4 (Medium) -->
            <div class="golden-grid-item">
                <img src="assets/gallery/sangeet-1.jpg" alt="Sangeet Night" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Sangeet Night</h3>
                        <p class="golden-grid-description">Live Performances</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 5 (Medium) -->
            <div class="golden-grid-item">
                <img src="assets/gallery/product-1.jpg" alt="Product Launch" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Product Launch</h3>
                        <p class="golden-grid-description">VR Experience</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 6 (Tall) -->
            <div class="golden-grid-item golden-grid-item--tall">
                <img src="assets/gallery/haldi-1.jpg" alt="Haldi Ceremony" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Haldi Ceremony</h3>
                        <p class="golden-grid-description">Traditional Rituals</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 7 (Wide) -->
            <div class="golden-grid-item golden-grid-item--wide">
                <img src="assets/gallery/reception-1.jpg" alt="Reception" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Grand Reception</h3>
                        <p class="golden-grid-description">500+ guests</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="golden-gallery-cta">
            <a href="#" class="golden-view-more">View Full Portfolio <i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
</section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <!-- Add these before your existing scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <?php include 'footer.php'; ?>    
</body>

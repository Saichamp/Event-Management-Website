<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    /* Service Page Styles */
.service-hero {
    position: relative;
    height: 70vh;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), 
                url('assets/services/hero-bg.jpg') center/cover no-repeat;
    color: white;
    text-align: center;
    padding: 0 2rem;
    margin-bottom: 4rem;
}

.service-hero__content {
    position: relative;
    z-index: 2;
    max-width: 800px;
}

.service-hero__title {
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    background: linear-gradient(45deg, #D4AF37, #FFD700);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.service-hero__subtitle {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.service-categories {
    padding: 5rem 0;
    background-color: #f9f9f9;
}

.service-categories__header {
    text-align: center;
    margin-bottom: 3rem;
}

.service-categories__title {
    font-size: 2.5rem;
    color: var(--dark-color);
    margin-bottom: 1rem;
    position: relative;
}

.service-categories__title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
}

.service-categories__subtitle {
    color: var(--text-light);
    font-size: 1.1rem;
}

.service-categories__grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.service-category {
    background: white;
    border-radius: 12px;
    padding: 2.5rem 2rem;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.service-category::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    transition: all 0.3s ease;
}

.service-category:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.service-category:hover::before {
    height: 10px;
}

.service-category__icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    font-size: 2rem;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.service-category:hover .service-category__icon {
    transform: rotate(360deg);
    background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
}

.service-category__title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--dark-color);
}

.service-category__description {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.service-category__link {
    color: var(--primary-color);
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.service-category__link i {
    margin-left: 0.5rem;
    transition: all 0.3s ease;
}

.service-category__link:hover {
    color: var(--secondary-color);
}

.service-category__link:hover i {
    transform: translateX(5px);
}

/* Service Sections */
.service-section {
    padding: 5rem 0;
}

.service-section--alt {
    background-color: #f9f9f9;
}

.service-section__header {
    text-align: center;
    margin-bottom: 3rem;
}

.service-section__title {
    font-size: 2.5rem;
    color: var(--dark-color);
    margin-bottom: 1rem;
    position: relative;
}

.service-section__title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
}

.service-section__subtitle {
    color: var(--text-light);
    font-size: 1.1rem;
}

.service-section__grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.service-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.service-card--alt {
    background: linear-gradient(135deg, #f9f9f9 0%, #e6e6e6 100%);
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.service-card__image {
    height: 250px;
    background-size: cover;
    background-position: center;
    transition: all 0.5s ease;
}

.service-card:hover .service-card__image {
    transform: scale(1.05);
}

.service-card__content {
    padding: 2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.service-card__title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--dark-color);
}

.service-card__description {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    line-height: 1.6;
    flex: 1;
}

.service-card__features {
    list-style: none;
    margin-bottom: 2rem;
}

.service-card__features li {
    margin-bottom: 0.5rem;
    color: var(--text-light);
    display: flex;
    align-items: center;
}

.service-card__features i {
    color: #D4AF37;
    margin-right: 0.5rem;
    font-size: 0.9rem;
}

.service-card__cta {
    display: inline-block;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-top: auto;
}

.service-card__cta:hover {
    background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* CTA Section */
.service-cta {
    padding: 6rem 0;
    background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.service-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #D4AF37, transparent);
}

.service-cta__content {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.service-cta__title {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #D4AF37, #FFD700);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.service-cta__text {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #cccccc;
}

.service-cta__buttons {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.service-cta__button {
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.service-cta__button--primary {
    background: linear-gradient(45deg, #D4AF37, #FFD700);
    color: #000000;
}

.service-cta__button--primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
}

.service-cta__button--secondary {
    background: transparent;
    color: white;
    border: 2px solid #D4AF37;
}

.service-cta__button--secondary:hover {
    background: rgba(212, 175, 55, 0.1);
    transform: translateY(-3px);
}

.service-cta__button i {
    margin-right: 0.5rem;
}

/* Responsive Design */
@media (max-width: 992px) {
    .service-hero__title {
        font-size: 2.8rem;
    }
    
    .service-categories__title,
    .service-section__title,
    .service-cta__title {
        font-size: 2.2rem;
    }
}

@media (max-width: 768px) {
    .service-hero {
        height: 60vh;
        min-height: 400px;
    }
    
    .service-hero__title {
        font-size: 2.2rem;
    }
    
    .service-hero__subtitle {
        font-size: 1.2rem;
    }
    
    .service-section__grid {
        grid-template-columns: 1fr;
    }
    
    .service-cta__buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .service-cta__button {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .service-hero__title {
        font-size: 1.8rem;
    }
    
    .service-categories__title,
    .service-section__title,
    .service-cta__title {
        font-size: 1.8rem;
    }
    
    .service-category {
        padding: 2rem 1.5rem;
    }
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    


<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="service-hero">
    <div class="service-hero__content">
        <h1 class="service-hero__title">Our Premium Event Services</h1>
        <p class="service-hero__subtitle">Transforming visions into unforgettable experiences with our comprehensive event solutions</p>
    </div>
    <div class="service-hero__overlay"></div>
</section>

<!-- Service Categories -->
<section class="service-categories">
    <div class="golden-container">
        <div class="service-categories__header">
            <h2 class="service-categories__title">Event Categories</h2>
            <p class="service-categories__subtitle">Explore our specialized event management services</p>
        </div>
        
        <div class="service-categories__grid">
            <!-- Category 1 -->
            <div class="service-category">
                <div class="service-category__icon">
                    <i class="fas fa-glass-cheers"></i>
                </div>
                <h3 class="service-category__title">Weddings</h3>
                <p class="service-category__description">Complete wedding planning from engagement to reception with personalized themes</p>
                <a href="#weddings" class="service-category__link">Explore Services <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Category 2 -->
            <div class="service-category">
                <div class="service-category__icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="service-category__title">Corporate</h3>
                <p class="service-category__description">Professional event management for businesses and organizations</p>
                <a href="#corporate" class="service-category__link">Explore Services <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Category 3 -->
            <div class="service-category">
                <div class="service-category__icon">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <h3 class="service-category__title">Social</h3>
                <p class="service-category__description">Celebrations for life's special moments with friends and family</p>
                <a href="#social" class="service-category__link">Explore Services <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <!-- Category 4 -->
            <div class="service-category">
                <div class="service-category__icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="service-category__title">Academic</h3>
                <p class="service-category__description">Memorable events for educational institutions and students</p>
                <a href="#academic" class="service-category__link">Explore Services <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Wedding Services -->
<section class="service-section" id="weddings">
    <div class="golden-container">
        <div class="service-section__header">
            <h2 class="service-section__title">Wedding Services</h2>
            <p class="service-section__subtitle">Creating your dream wedding with meticulous planning and execution</p>
        </div>
        
        <div class="service-section__grid">
            <!-- Service 1 -->
            <div class="service-card">
                <div class="service-card__image" style="background-image: url('assets/services/wedding-1.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Complete Wedding Planning</h3>
                    <p class="service-card__description">End-to-end wedding planning including venue selection, vendor coordination, and day-of coordination.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Custom theme development</li>
                        <li><i class="fas fa-check"></i> Budget management</li>
                        <li><i class="fas fa-check"></i> Timeline creation</li>
                        <li><i class="fas fa-check"></i> Full vendor management</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
            
            <!-- Service 2 -->
            <div class="service-card">
                <div class="service-card__image" style="background-image: url('assets/services/wedding-2.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Sangeet & Mehendi</h3>
                    <p class="service-card__description">Vibrant pre-wedding celebrations with traditional performances and henna artistry.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Cultural performances</li>
                        <li><i class="fas fa-check"></i> Professional mehendi artists</li>
                        <li><i class="fas fa-check"></i> Themed decorations</li>
                        <li><i class="fas fa-check"></i> Catering coordination</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
            
            <!-- Service 3 -->
            <div class="service-card">
                <div class="service-card__image" style="background-image: url('assets/services/wedding-3.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Reception Planning</h3>
                    <p class="service-card__description">Elegant reception planning to celebrate your union in style.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Venue selection & decoration</li>
                        <li><i class="fas fa-check"></i> Entertainment coordination</li>
                        <li><i class="fas fa-check"></i> Seating arrangements</li>
                        <li><i class="fas fa-check"></i> Photography & videography</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Corporate Services -->
<section class="service-section service-section--alt" id="corporate">
    <div class="golden-container">
        <div class="service-section__header">
            <h2 class="service-section__title">Corporate Services</h2>
            <p class="service-section__subtitle">Professional event solutions for businesses and organizations</p>
        </div>
        
        <div class="service-section__grid">
            <!-- Service 1 -->
            <div class="service-card service-card--alt">
                <div class="service-card__image" style="background-image: url('assets/services/corporate-1.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Conferences & Seminars</h3>
                    <p class="service-card__description">Comprehensive management of professional gatherings and knowledge-sharing events.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Venue sourcing</li>
                        <li><i class="fas fa-check"></i> Speaker coordination</li>
                        <li><i class="fas fa-check"></i> Registration management</li>
                        <li><i class="fas fa-check"></i> AV & technical support</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
            
            <!-- Service 2 -->
            <div class="service-card service-card--alt">
                <div class="service-card__image" style="background-image: url('assets/services/corporate-2.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Product Launches</h3>
                    <p class="service-card__description">Creating buzz and excitement for your new product introduction.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Creative concept development</li>
                        <li><i class="fas fa-check"></i> Media coordination</li>
                        <li><i class="fas fa-check"></i> Experiential marketing</li>
                        <li><i class="fas fa-check"></i> Guest management</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
            
            <!-- Service 3 -->
            <div class="service-card service-card--alt">
                <div class="service-card__image" style="background-image: url('assets/services/corporate-3.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Team Building Events</h3>
                    <p class="service-card__description">Engaging activities to strengthen teamwork and company culture.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Customized activities</li>
                        <li><i class="fas fa-check"></i> Venue selection</li>
                        <li><i class="fas fa-check"></i> Facilitator coordination</li>
                        <li><i class="fas fa-check"></i> Catering services</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Services -->
<section class="service-section" id="social">
    <div class="golden-container">
        <div class="service-section__header">
            <h2 class="service-section__title">Social Events</h2>
            <p class="service-card__subtitle">Celebrating life's special moments with creativity and joy</p>
        </div>
        
        <div class="service-section__grid">
            <!-- Service 1 -->
            <div class="service-card">
                <div class="service-card__image" style="background-image: url('assets/services/social-1.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Birthday Celebrations</h3>
                    <p class="service-card__description">Themed parties for all ages, from first birthdays to milestone celebrations.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Theme development</li>
                        <li><i class="fas fa-check"></i> Entertainment planning</li>
                        <li><i class="fas fa-check"></i> Custom decorations</li>
                        <li><i class="fas fa-check"></i> Catering coordination</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
            
            <!-- Service 2 -->
            <div class="service-card">
                <div class="service-card__image" style="background-image: url('assets/services/social-2.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Anniversary Parties</h3>
                    <p class="service-card__description">Elegant celebrations to honor lasting love and commitment.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Venue selection</li>
                        <li><i class="fas fa-check"></i> Memory displays</li>
                        <li><i class="fas fa-check"></i> Entertainment booking</li>
                        <li><i class="fas fa-check"></i> Catering services</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
            
            <!-- Service 3 -->
            <div class="service-card">
                <div class="service-card__image" style="background-image: url('assets/services/social-3.jpg');"></div>
                <div class="service-card__content">
                    <h3 class="service-card__title">Family Reunions</h3>
                    <p class="service-card__description">Creating memorable gatherings for extended families and friends.</p>
                    <ul class="service-card__features">
                        <li><i class="fas fa-check"></i> Location scouting</li>
                        <li><i class="fas fa-check"></i> Activity planning</li>
                        <li><i class="fas fa-check"></i> Accommodation coordination</li>
                        <li><i class="fas fa-check"></i> Catering services</li>
                    </ul>
                    <a href="#contact" class="service-card__cta">Get a Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="service-cta">
    <div class="golden-container">
        <div class="service-cta__content">
            <h2 class="service-cta__title">Ready to Plan Your Perfect Event?</h2>
            <p class="service-cta__text">Contact us today to discuss your vision and let us handle the details</p>
            <div class="service-cta__buttons">
                <a href="#contact" class="service-cta__button service-cta__button--primary">Get a Free Consultation</a>
                <a href="tel:+919876543210" class="service-cta__button service-cta__button--secondary">
                    <i class="fas fa-phone-alt"></i> Call Us Now
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
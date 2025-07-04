<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Golden Events</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --gold: #D4AF37;
            --gold-light: #FFD700;
            --dark: #222222;
            --light: #f9f9f9;
            --text-dark: #444444;
            --text-light: #777777;
        }

        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            overflow-x: hidden;
            background-color: var(--light);
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        .golden-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Hero Section */
        .service-hero {
            position: relative;
            height: 100vh;
            min-height: 700px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), 
                        url('assets/services/hero-bg.jpg') center/cover no-repeat fixed;
            color: white;
            text-align: center;
            padding: 0 2rem;
            overflow: hidden;
        }

        .service-hero__content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            transform: translateY(50px);
            opacity: 0;
            transition: all 1s ease;
        }

        .service-hero__content.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .service-hero__title {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .service-hero__subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 300;
        }

        .hero-scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 1.5rem;
            animation: bounce 2s infinite;
            cursor: pointer;
            z-index: 10;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0) translateX(-50%);}
            40% {transform: translateY(-20px) translateX(-50%);}
            60% {transform: translateY(-10px) translateX(-50%);}
        }

        /* Service Categories */
        .service-categories {
            padding: 8rem 0;
            position: relative;
            overflow: hidden;
        }

        .service-categories::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('assets/gold-pattern.png') center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .service-categories__header {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
            z-index: 1;
        }

        .service-categories__title {
            font-size: 3rem;
            color: var(--dark);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .service-categories__title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--gold), var(--gold-light));
            border-radius: 2px;
        }

        .service-categories__subtitle {
            color: var(--text-light);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .service-categories__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 3rem;
            position: relative;
            z-index: 1;
        }

        .service-category {
            background: white;
            border-radius: 15px;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.5s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            transform: translateY(50px);
            opacity: 0;
        }

        .service-category.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .service-category:hover {
            transform: translateY(-15px) !important;
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.15);
        }

        .service-category__icon-container {
            width: 100px;
            height: 100px;
            margin: 0 auto 2rem;
            position: relative;
            border-radius: 50%;
            padding: 5px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
        }

        .service-category__icon {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            font-size: 2.5rem;
            transition: all 0.5s ease;
        }

        .service-category:hover .service-category__icon {
            transform: rotate(360deg);
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: white;
        }

        .service-category__title {
            font-size: 1.6rem;
            margin-bottom: 1rem;
            color: var(--dark);
            position: relative;
        }

        .service-category__title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: var(--gold);
        }

        .service-category__description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .service-category__link {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            position: relative;
        }

        .service-category__link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: all 0.3s ease;
        }

        .service-category__link:hover::after {
            width: 100%;
        }

        .service-category__link i {
            margin-left: 0.5rem;
            transition: all 0.3s ease;
        }

        .service-category__link:hover i {
            transform: translateX(5px);
        }

        /* Service Sections */
        .service-section {
            padding: 8rem 0;
            position: relative;
        }

        .service-section--alt {
            background: url('assets/services/service-bg.jpg') center/cover fixed;
        }

        .service-section--alt::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.85);
        }

        .service-section__header {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
            z-index: 1;
        }

        .service-section__title {
            font-size: 3rem;
            color: var(--dark);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .service-section--alt .service-section__title {
            color: white;
        }

        .service-section__title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--gold), var(--gold-light));
            border-radius: 2px;
        }

        .service-section__subtitle {
            color: var(--text-light);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .service-section--alt .service-section__subtitle {
            color: rgba(255,255,255,0.8);
        }

        .service-section__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
            position: relative;
            z-index: 1;
        }

        .service-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.5s ease;
            display: flex;
            flex-direction: column;
            transform: translateY(50px);
            opacity: 0;
        }

        .service-card.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .service-card--alt {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .service-card:hover {
            transform: translateY(-15px) !important;
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.15);
        }

        .service-card--alt:hover {
            background: rgba(255,255,255,0.1);
            border-color: var(--gold);
        }

        .service-card__image {
            height: 250px;
            background-size: cover;
            background-position: center;
            transition: all 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card__image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.7));
            z-index: 1;
        }

        .service-card:hover .service-card__image {
            transform: scale(1.1);
        }

        .service-card__content {
            padding: 2.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .service-card__title {
            font-size: 1.6rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .service-card--alt .service-card__title {
            color: white;
        }

        .service-card__description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.8;
            flex: 1;
        }

        .service-card--alt .service-card__description {
            color: rgba(255,255,255,0.7);
        }

        .service-card__features {
            list-style: none;
            margin-bottom: 2rem;
        }

        .service-card__features li {
            margin-bottom: 0.8rem;
            color: var(--text-light);
            display: flex;
            align-items: flex-start;
            line-height: 1.6;
        }

        .service-card--alt .service-card__features li {
            color: rgba(255,255,255,0.7);
        }

        .service-card__features i {
            color: var(--gold);
            margin-right: 0.8rem;
            font-size: 1rem;
            margin-top: 0.2rem;
        }

        .service-card__cta {
            display: inline-block;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: var(--dark);
            padding: 1rem 2rem;
            border-radius: 50px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: auto;
            align-self: flex-start;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .service-card__cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--gold-light), var(--gold));
            opacity: 0;
            transition: all 0.3s ease;
            z-index: -1;
        }

        .service-card__cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        .service-card__cta:hover::before {
            opacity: 1;
        }

        /* CTA Section */
        .service-cta {
            padding: 8rem 0;
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
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .service-cta__content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .service-cta__title {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .service-cta__text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #cccccc;
            line-height: 1.8;
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
            position: relative;
            overflow: hidden;
        }

        .service-cta__button--primary {
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: #000000;
        }

        .service-cta__button--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        .service-cta__button--secondary {
            background: transparent;
            color: white;
            border: 2px solid var(--gold);
        }

        .service-cta__button--secondary:hover {
            background: rgba(212, 175, 55, 0.1);
            transform: translateY(-3px);
        }

        .service-cta__button i {
            margin-right: 0.5rem;
        }

        /* Floating Particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.6);
            pointer-events: none;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .service-hero__title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 992px) {
            .service-hero__title {
                font-size: 3rem;
            }
            
            .service-categories__title,
            .service-section__title,
            .service-cta__title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .service-hero {
                height: 80vh;
                min-height: 600px;
                background-attachment: scroll;
            }
            
            .service-hero__title {
                font-size: 2.5rem;
            }
            
            .service-hero__subtitle {
                font-size: 1.2rem;
            }
            
            .service-section--alt {
                background-attachment: scroll;
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
                font-size: 2rem;
            }
            
            .service-categories__title,
            .service-section__title,
            .service-cta__title {
                font-size: 2rem;
            }
            
            .service-category {
                padding: 2.5rem 1.5rem;
            }
            
            .service-card__content {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Hero Section -->
    <section class="service-hero" id="service-hero">
        <div class="service-hero__content" id="hero-content">
            <h1 class="service-hero__title">Exquisite Event Services</h1>
            <p class="service-hero__subtitle">Where imagination meets execution - our comprehensive services transform your vision into unforgettable experiences</p>
        </div>
        
        <div class="hero-scroll-down" id="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </div>
        
        <!-- Floating particles will be added by JS -->
    </section>

    <!-- Service Categories -->
    <section class="service-categories">
        <div class="golden-container">
            <div class="service-categories__header">
                <h2 class="service-categories__title">Our Event Expertise</h2>
                <p class="service-categories__subtitle">Specialized services tailored to create perfect moments for every occasion</p>
            </div>
            
            <div class="service-categories__grid" id="categories-grid">
                <!-- Category 1 -->
                <div class="service-category">
                    <div class="service-category__icon-container">
                        <div class="service-category__icon">
                            <i class="fas fa-glass-cheers"></i>
                        </div>
                    </div>
                    <h3 class="service-category__title">Weddings</h3>
                    <p class="service-category__description">Complete wedding planning from engagement to reception with personalized themes and flawless execution</p>
                    <a href="#weddings" class="service-category__link">Explore Services <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <!-- Category 2 -->
                <div class="service-category">
                    <div class="service-category__icon-container">
                        <div class="service-category__icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                    </div>
                    <h3 class="service-category__title">Corporate</h3>
                    <p class="service-category__description">Professional event management solutions that elevate your business gatherings and brand experiences</p>
                    <a href="#corporate" class="service-category__link">Explore Services <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <!-- Category 3 -->
                <div class="service-category">
                    <div class="service-category__icon-container">
                        <div class="service-category__icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                    </div>
                    <h3 class="service-category__title">Social</h3>
                    <p class="service-category__description">Celebrations for life's special moments crafted with creativity, joy, and personal touches</p>
                    <a href="#social" class="service-category__link">Explore Services <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <!-- Category 4 -->
                <div class="service-category">
                    <div class="service-category__icon-container">
                        <div class="service-category__icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </div>
                    <h3 class="service-category__title">Academic</h3>
                    <p class="service-category__description">Memorable events for educational institutions that inspire, celebrate, and bring communities together</p>
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
                <p class="service-section__subtitle">Creating your dream wedding with meticulous planning and magical moments</p>
            </div>
            
            <div class="service-section__grid">
                <!-- Service 1 -->
                <div class="service-card">
                    <div class="service-card__image" style="background-image: url('assets/services/wedding-1.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Complete Wedding Planning</h3>
                        <p class="service-card__description">End-to-end wedding planning including venue selection, vendor coordination, and day-of coordination to ensure your special day is perfect.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Custom theme development tailored to your love story</li>
                            <li><i class="fas fa-check"></i> Comprehensive budget management</li>
                            <li><i class="fas fa-check"></i> Detailed timeline creation and management</li>
                            <li><i class="fas fa-check"></i> Full vendor coordination and management</li>
                        </ul>
                        <a href="#contact" class="service-card__cta">Get a Quote</a>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="service-card">
                    <div class="service-card__image" style="background-image: url('assets/services/wedding-2.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Sangeet & Mehendi</h3>
                        <p class="service-card__description">Vibrant pre-wedding celebrations filled with traditional performances, henna artistry, and joyful festivities.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Cultural performances and entertainment</li>
                            <li><i class="fas fa-check"></i> Professional mehendi artists with diverse styles</li>
                            <li><i class="fas fa-check"></i> Themed decorations and ambiance creation</li>
                            <li><i class="fas fa-check"></i> Catering coordination with diverse menu options</li>
                        </ul>
                        <a href="#contact" class="service-card__cta">Get a Quote</a>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="service-card">
                    <div class="service-card__image" style="background-image: url('assets/services/wedding-3.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Reception Planning</h3>
                        <p class="service-card__description">Elegant reception planning to celebrate your union in style with unforgettable experiences.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Venue selection & exquisite decoration</li>
                            <li><i class="fas fa-check"></i> Entertainment coordination and programming</li>
                            <li><i class="fas fa-check"></i> Seating arrangements and guest flow management</li>
                            <li><i class="fas fa-check"></i> Professional photography & videography coordination</li>
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
                <p class="service-section__subtitle">Professional event solutions that elevate your business objectives and brand experience</p>
            </div>
            
            <div class="service-section__grid">
                <!-- Service 1 -->
                <div class="service-card service-card--alt">
                    <div class="service-card__image" style="background-image: url('assets/services/corporate-1.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Conferences & Seminars</h3>
                        <p class="service-card__description">Comprehensive management of professional gatherings that inspire knowledge-sharing and networking.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Strategic venue sourcing and setup</li>
                            <li><i class="fas fa-check"></i> Speaker coordination and management</li>
                            <li><i class="fas fa-check"></i> Seamless registration management</li>
                            <li><i class="fas fa-check"></i> State-of-the-art AV & technical support</li>
                        </ul>
                        <a href="#contact" class="service-card__cta">Get a Quote</a>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="service-card service-card--alt">
                    <div class="service-card__image" style="background-image: url('assets/services/corporate-2.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Product Launches</h3>
                        <p class="service-card__description">Creating buzz and excitement for your new product with innovative launch experiences.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Creative concept development</li>
                            <li><i class="fas fa-check"></i> Comprehensive media coordination</li>
                            <li><i class="fas fa-check"></i> Experiential marketing activations</li>
                            <li><i class="fas fa-check"></i> VIP guest management</li>
                        </ul>
                        <a href="#contact" class="service-card__cta">Get a Quote</a>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="service-card service-card--alt">
                    <div class="service-card__image" style="background-image: url('assets/services/corporate-3.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Team Building Events</h3>
                        <p class="service-card__description">Engaging activities designed to strengthen teamwork, communication, and company culture.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Customized activities for your team</li>
                            <li><i class="fas fa-check"></i> Unique venue selection</li>
                            <li><i class="fas fa-check"></i> Professional facilitator coordination</li>
                            <li><i class="fas fa-check"></i> Premium catering services</li>
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
                <p class="service-section__subtitle">Celebrating life's special moments with creativity, joy, and personalized touches</p>
            </div>
            
            <div class="service-section__grid">
                <!-- Service 1 -->
                <div class="service-card">
                    <div class="service-card__image" style="background-image: url('assets/services/social-1.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Birthday Celebrations</h3>
                        <p class="service-card__description">Themed parties for all ages, from first birthdays to milestone celebrations that create lasting memories.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Creative theme development</li>
                            <li><i class="fas fa-check"></i> Entertainment planning and coordination</li>
                            <li><i class="fas fa-check"></i> Custom decorations and ambiance</li>
                            <li><i class="fas fa-check"></i> Catering coordination with special menus</li>
                        </ul>
                        <a href="#contact" class="service-card__cta">Get a Quote</a>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="service-card">
                    <div class="service-card__image" style="background-image: url('assets/services/social-2.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Anniversary Parties</h3>
                        <p class="service-card__description">Elegant celebrations to honor lasting love and commitment with personalized touches.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Venue selection and transformation</li>
                            <li><i class="fas fa-check"></i> Memory displays and timeline presentations</li>
                            <li><i class="fas fa-check"></i> Entertainment booking and coordination</li>
                            <li><i class="fas fa-check"></i> Catering services with customized menus</li>
                        </ul>
                        <a href="#contact" class="service-card__cta">Get a Quote</a>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="service-card">
                    <div class="service-card__image" style="background-image: url('assets/services/social-3.jpg');"></div>
                    <div class="service-card__content">
                        <h3 class="service-card__title">Family Reunions</h3>
                        <p class="service-card__description">Creating memorable gatherings that bring extended families and friends together.</p>
                        <ul class="service-card__features">
                            <li><i class="fas fa-check"></i> Location scouting and logistics</li>
                            <li><i class="fas fa-check"></i> Activity planning for all ages</li>
                            <li><i class="fas fa-check"></i> Accommodation coordination</li>
                            <li><i class="fas fa-check"></i> Catering services with family favorites</li>
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
                <h2 class="service-cta__title">Let's Create Something Extraordinary</h2>
                <p class="service-cta__text">Our team is ready to bring your vision to life with creativity, precision, and passion. Contact us today to start planning your perfect event.</p>
                <div class="service-cta__buttons">
                    <a href="#contact" class="service-cta__button service-cta__button--primary">Get a Free Consultation</a>
                    <a href="tel:+919876543210" class="service-cta__button service-cta__button--secondary">
                        <i class="fas fa-phone-alt"></i> Call Our Team
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate hero content
            const heroContent = document.getElementById('hero-content');
            setTimeout(() => {
                heroContent.classList.add('animate');
            }, 500);

            // Create floating particles
            function createParticles() {
                const heroSection = document.getElementById('service-hero');
                const particleCount = 15;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    // Random properties
                    const size = Math.random() * 20 + 5;
                    const posX = Math.random() * 100;
                    const posY = Math.random() * 100;
                    const opacity = Math.random() * 0.4 + 0.1;
                    const duration = Math.random() * 20 + 10;
                    const delay = Math.random() * 5;
                    
                    // Apply styles
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${posX}%`;
                    particle.style.top = `${posY}%`;
                    particle.style.opacity = opacity;
                    
                    heroSection.appendChild(particle);
                    
                    // Animate with GSAP
                    gsap.to(particle, {
                        duration: duration,
                        x: `${Math.random() * 100 - 50}px`,
                        y: `${Math.random() * 100 - 50}px`,
                        rotation: Math.random() * 360,
                        repeat: -1,
                        yoyo: true,
                        delay: delay,
                        ease: "sine.inOut"
                    });
                }
            }

            createParticles();

            // Scroll down button
            document.getElementById('scroll-down').addEventListener('click', function() {
                gsap.to(window, {
                    duration: 1.5,
                    scrollTo: "#categories-grid",
                    ease: "power2.inOut"
                });
            });

            // Animate service categories
            gsap.utils.toArray('.service-category').forEach((category, i) => {
                ScrollTrigger.create({
                    trigger: category,
                    start: "top 80%",
                    onEnter: () => {
                        category.classList.add('animate');
                    },
                    once: true
                });
            });

            // Animate service cards
            gsap.utils.toArray('.service-card').forEach((card, i) => {
                ScrollTrigger.create({
                    trigger: card,
                    start: "top 80%",
                    onEnter: () => {
                        card.classList.add('animate');
                    },
                    once: true
                });
            });

            // Initialize GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);
            ScrollTrigger.refresh();
        });
    </script>
</body>
</html>
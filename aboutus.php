<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Golden Events</title>
      <!-- Favicon -->
    <link rel="icon" href="assets/logo.png" type="image/png">
    
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="assets/logo.png">
    
    <!-- Optional: iOS icon sizes for better compatibility -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/logo.png">
    <link rel="apple-touch-icon" sizes="167x167" href="assets/logo.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/logo.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/logo.png">

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

        /* Hero Section */
        .about-hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), 
                        url('assets/about-bg.jpg') center/cover no-repeat fixed;
            color: white;
            text-align: center;
            padding: 0 2rem;
            overflow: hidden;
        }

        .about-hero__content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            transform: translateY(50px);
            opacity: 0;
            transition: all 1s ease;
        }

        .about-hero__content.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .about-hero__title {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .about-hero__subtitle {
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

        /* Floating Particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.6);
            pointer-events: none;
        }

        /* About Intro */
        .about-intro {
            padding: 8rem 0;
            position: relative;
            overflow: hidden;
        }

        .about-intro::before {
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

        .about-intro__container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .about-intro__content {
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        .about-intro__title {
            font-size: 3rem;
            color: var(--dark);
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .about-intro__title::after {
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

        .about-intro__text {
            color: var(--text-dark);
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 3rem;
            text-align:justify;
        }

        .stats-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 4rem;
        }

        .stat-box {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            width: 200px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            transform: translateY(20px);
            opacity: 0;
        }

        .stat-box.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .stat-box:hover {
            transform: translateY(-10px) !important;
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.15);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 0.5rem;
            font-family: 'Playfair Display', serif;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Team Section */
        .team-section {
            padding: 8rem 0;
            background: url('assets/team-bg.jpg') center/cover fixed;
            position: relative;
        }

        .team-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.85);
        }

        .team-section__header {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
            z-index: 1;
        }

        .team-section__title {
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .team-section__title::after {
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

        .team-section__subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .team-grid {
            display: grid;
        grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }
        @media (max-width: 1200px) {
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
        }

        @media (max-width: 900px) {
            .team-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }



        .team-member {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.5s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.2);
            transform: translateY(50px);
            opacity: 0;
        }

        .team-member.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .team-member:hover {
            transform: translateY(-15px) !important;
            background: rgba(255,255,255,0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-color: var(--gold);
        }

        .team-member__photo-container {
            width: 200px;
            height: 200px;
            margin: 0 auto 2rem;
            position: relative;
            border-radius: 50%;
            padding: 5px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
        }

        .team-member__photo {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: contain;
            border: 5px solid var(--dark);
            transition: all 0.5s ease;
        }

        .team-member:hover .team-member__photo {
            transform: scale(0.95);
        }

        .team-member__name {
            font-size: 1.6rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .team-member__role {
            color: var(--gold);
            font-weight: 500;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            position: relative;
            display: inline-block;
        }

        .team-member__role::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: var(--gold);
        }

        .team-member__bio {
            color: rgba(255,255,255,0.7);
            margin-bottom: 2rem;
            line-height: 1.8;
            font-size: 0.95rem;
            min-height: 100px;
            text-align:justify;
        }

        .team-member__social {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .team-member__social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .team-member__social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            z-index: -1;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .team-member__social-link:hover {
            color: var(--dark);
            transform: translateY(-5px);
        }

        .team-member__social-link:hover::before {
            opacity: 1;
        }

        /* Values Section */
        .values-section {
            padding: 8rem 0;
            background: var(--light);
        }

        .values-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .values-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .values-title {
            font-size: 3rem;
            color: var(--dark);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .values-title::after {
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

        .values-subtitle {
            color: var(--text-light);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            text-align:justify;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
        }

        .value-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.5s ease;
            transform: scale(0.95);
            opacity: 0;
        }

        .value-card.animate {
            transform: scale(1);
            opacity: 1;
        }

        .value-card:hover {
            transform: scale(1.05) !important;
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.15);
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }

        .value-title {
            font-size: 1.5rem;
            color: var(--dark);
            margin-bottom: 1rem;
            text-align: center;
        }

        .value-description {
            color: var(--text-light);
            line-height: 1.8;
            text-align:justify;
        }

        /* CTA Section */
        .about-cta {
            padding: 8rem 0;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .about-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .about-cta__content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .about-cta__title {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .about-cta__text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #cccccc;
            line-height: 1.8;
        }

        .about-cta__buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .about-cta__button {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .about-cta__button--primary {
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: #000000;
        }

        .about-cta__button--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        .about-cta__button--secondary {
            background: transparent;
            color: white;
            border: 2px solid var(--gold);
        }

        .about-cta__button--secondary:hover {
            background: rgba(212, 175, 55, 0.1);
            transform: translateY(-3px);
        }

        .about-cta__button i {
            margin-right: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .about-hero__title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 992px) {
            .about-hero__title {
                font-size: 3rem;
            }
            
            .about-intro__title,
            .team-section__title,
            .values-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .about-hero {
                height: 80vh;
                min-height: 500px;
                background-attachment: scroll;
            }
            
            .about-hero__title {
                font-size: 2.5rem;
            }
            
            .about-hero__subtitle {
                font-size: 1.2rem;
            }
            
            .team-section {
                background-attachment: scroll;
            }
            
            .team-member__photo-container {
                width: 180px;
                height: 180px;
            }
        }

        @media (max-width: 576px) {
            .about-hero__title {
                font-size: 2rem;
            }
            
            .about-intro__title,
            .team-section__title,
            .values-title {
                font-size: 2rem;
            }
            
            .about-intro__text,
            .about-cta__text {
                font-size: 1rem;
            }
            
            .team-member {
                padding: 2rem 1.5rem;
            }
            
            .team-member__photo-container {
                width: 160px;
                height: 160px;
            }
            
            .about-cta__buttons {
                flex-direction: column;
                gap: 1rem;
            }
            
            .about-cta__button {
                width: 100%;
                justify-content: center;
            }
        }
        
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Hero Section -->
    <section class="about-hero" id="about-hero">
        <div class="about-hero__content" id="hero-content">
            <h1 class="about-hero__title">The Faces Behind Golden Events</h1>
            <p class="about-hero__subtitle">Meet the passionate team that transforms your visions into unforgettable experiences with creativity, precision, and dedication</p>
        </div>
        
        <div class="hero-scroll-down" id="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </div>
        
        <!-- Floating particles will be added by JS -->
    </section>

    <!-- Introduction Section -->
    <section class="about-intro">
        <div class="about-intro__container">
            <div class="about-intro__content">
                <h2 class="about-intro__title">Our Story</h2>
                <p class="about-intro__text">
                    Founded with a vision to redefine event management, Golden Events brings together a team of creative professionals dedicated to excellence. 
                    We blend innovation with tradition to craft experiences that resonate with your unique style. From intimate gatherings to grand celebrations, 
                    our team works tirelessly to ensure every detail reflects your personality and exceeds your expectations.
                </p>
                
                <div class="stats-container" id="stats-container">
                    <div class="stat-box">
                        <div class="stat-number" data-count="1500">0</div>
                        <div class="stat-label">Events Managed</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number" data-count="98">0</div>
                        <div class="stat-label">Client Satisfaction</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number" data-count="12">0</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-number" data-count="50">0</div>
                        <div class="stat-label">Awards Won</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section" id="team">
        <div class="team-section__header">
            <h2 class="team-section__title">Meet Our Dream Team</h2>
            <p class="team-section__subtitle">The creative minds and meticulous planners who make your events extraordinary</p>
        </div>
        
        <div class="team-grid" id="team-grid">
            <!-- Team Member 1 -->
            <div class="team-member ">
                <div class="team-member__photo-container">
                    <img src="assets/team/gayathri.jpg" alt="Gayathri Reddy" class="team-member__photo">
                </div>
                <h3 class="team-member__name">Gayathri Reddy</h3>
                <p class="team-member__role">Event Manager</p>
                <p class="team-member__bio">
                   Gayathri’s dedication to excellence and her vast experience make her the go-to expert for the flawless event planning. She also excels in turning complex ideas into spectacular events that leave lasting impressions.                </p>
                <!-- <div class="team-member__social">
                    <a href="#" class="team-member__social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Email"><i class="fas fa-envelope"></i></a>
                </div> -->
            </div>
            
            <!-- Team Member 2 -->
            <div class="team-member ">
                <div class="team-member__photo-container">
                    <img src="assets/team/gowthami.jpg" alt="Gowthami" class="team-member__photo">
                </div>
                <h3 class="team-member__name">Gowthami Reddy</h3>
                <p class="team-member__role">Executive Manager</p>
                <p class="team-member__bio">
                    As the organizational backbone of Golden Events, Gowthami orchestrates the perfect synergy between teams. Her ability to manage the resources and maintaining focus ensures flawless execution at every stage.
                </p>
                <!-- <div class="team-member__social">
                    <a href="#" class="team-member__social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Email"><i class="fas fa-envelope"></i></a>
                </div> -->
            </div>
            
            <!-- Team Member 3 -->
            <div class="team-member ">
                <div class="team-member__photo-container">
                    <img src="assets/team/gv.jpg" alt="Gvreddy" class="team-member__photo">
                </div>
                <h3 class="team-member__name">Gvreddy</h3>
                <p class="team-member__role">Finance Manager</p>
                <p class="team-member__bio">
                    Gvreddy's meticulous attention to budgeting means the Golden Events consistently achieves top-tier results without overspending. His insight into the cost-effective strategies supports premium event delivery every time.
                </p>
                <!-- <div class="team-member__social">
                    <a href="#" class="team-member__social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Email"><i class="fas fa-envelope"></i></a>
                </div> -->
            </div>
            
            <!-- Team Member 4 -->
            <div class="team-member ">
                <div class="team-member__photo-container">
                    <img src="assets/team/gowtham.jpg" alt="Gowtham Reddy" class="team-member__photo">
                </div>
                <h3 class="team-member__name">Gowtham Reddy</h3>
                <p class="team-member__role">Marketing Manager</p>
                <p class="team-member__bio">
                    The storyteller of the Golden Events, Gowtham crafts compelling narratives that elevate our brand and our clients' events. 
                    His innovative campaigns set trends in the industry.
                </p>
                <!-- <div class="team-member__social">
                    <a href="#" class="team-member__social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="team-member__social-link" aria-label="Email"><i class="fas fa-envelope"></i></a>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="values-container">
            <div class="values-header">
                <h2 class="values-title">Our Core Values</h2>
                <p class="values-subtitle">The principles that guide every decision we make and every event we create</p>
            </div>
            
            <div class="values-grid" id="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="value-title">Innovation</h3>
                    <p class="value-description">
                        We constantly push boundaries with creative concepts and cutting-edge solutions to make your event stand out.
                    </p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="value-title">Passion</h3>
                    <p class="value-description">
                        Fueled by enthusiasm, our team crafts memorable experiences, perfecting every detail.                    
                    </p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="value-title">Integrity</h3>
                    <p class="value-description">
                        We build strong, lasting client ties through honesty and ethical practices.
                    </p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="value-title">Excellence</h3>
                    <p class="value-description">
                        We settle for nothing less than perfection in execution, from grand designs to minute details.
                    </p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="value-title">Collaboration</h3>
                    <p class="value-description">
                        We work as partners with our clients, vendors, and team to bring visions to life.
                    </p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-laugh-beam"></i>
                    </div>
                    <h3 class="value-title">Joy</h3>
                    <p class="value-description">
                        We believe celebrations should be fun - for our clients and for our team creating them.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="about-cta">
        <div class="about-cta__content">
            <h2 class="about-cta__title">Ready to Create Magic Together?</h2>
            <p class="about-cta__text">
                Our team is excited to learn about your vision and collaborate on an event that exceeds your expectations. 
                Let's start planning your unforgettable experience today.
            </p>
            <div class="about-cta__buttons">
                <a href="contact.php" class="about-cta__button about-cta__button--primary">Get a Free Consultation</a>
                <a href="tel:+919876543210" class="about-cta__button about-cta__button--secondary">
                    <i class="fas fa-phone-alt"></i> Call Our Team
                </a>
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
                const heroSection = document.getElementById('about-hero');
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
                    scrollTo: "#stats-container",
                    ease: "power2.inOut"
                });
            });

            // Animate stats counter
            function animateStats() {
                const statNumbers = document.querySelectorAll('.stat-number');
                
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-count'));
                    const duration = 2;
                    let start = 0;
                    const increment = target / (duration * 60); // 60fps
                    
                    const timer = setInterval(() => {
                        start += increment;
                        stat.textContent = Math.floor(start);
                        
                        if (start >= target) {
                            stat.textContent = target;
                            clearInterval(timer);
                        }
                    }, 1000/60);
                });
            }

            // Animate team members
            gsap.utils.toArray('.team-member').forEach((member, i) => {
                ScrollTrigger.create({
                    trigger: member,
                    start: "top 80%",
                    onEnter: () => {
                        member.classList.add('animate');
                    },
                    once: true
                });
            });

            // Animate value cards
            gsap.utils.toArray('.value-card').forEach((card, i) => {
                ScrollTrigger.create({
                    trigger: card,
                    start: "top 80%",
                    onEnter: () => {
                        card.classList.add('animate');
                    },
                    once: true
                });
            });

            // Animate stat boxes
            gsap.utils.toArray('.stat-box').forEach((box, i) => {
                ScrollTrigger.create({
                    trigger: box,
                    start: "top 80%",
                    onEnter: () => {
                        box.classList.add('animate');
                        if(i === 0) animateStats(); // Start counter when first box animates
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
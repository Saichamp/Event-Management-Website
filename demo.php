<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immersive Event Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #0a0a0a;
            --secondary-bg: #1a1a2e;
            --accent-electric: #00f5ff;
            --accent-purple: #8b5cf6;
            --accent-pink: #f472b6;
            --accent-gold: #fbbf24;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Exo 2', sans-serif;
            background: var(--primary-bg);
            color: white;
            overflow-x: hidden;
            cursor: none;
        }

        /* Custom Cursor */
        .cursor {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--accent-electric);
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transition: transform 0.1s ease;
        }

        .cursor-follower {
            position: fixed;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--accent-electric);
            pointer-events: none;
            z-index: 9998;
            transition: all 0.3s ease;
        }

        /* Particle Background */
        .particle-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 20% 50%, var(--accent-purple) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, var(--accent-pink) 0%, transparent 50%),
                        radial-gradient(circle at 40% 80%, var(--accent-electric) 0%, transparent 50%);
            opacity: 0.1;
        }

        /* Hero Section */
        .hero-3d {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            text-align: center;
            transform-style: preserve-3d;
            animation: float3d 6s ease-in-out infinite;
        }

        .hero-title {
            font-family: 'Orbitron', monospace;
            font-size: 5rem;
            font-weight: 900;
            background: linear-gradient(45deg, var(--accent-electric), var(--accent-purple), var(--accent-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(0, 245, 255, 0.5);
            margin-bottom: 2rem;
            animation: glow 2s ease-in-out infinite alternate;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 3rem;
            animation: fadeInUp 2s ease-out;
        }

        .glass-button {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 15px 40px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .glass-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 245, 255, 0.3);
            color: white;
        }

        .glass-button::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(0, 245, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
        }

        .glass-button:hover::before {
            animation: shine 0.5s ease-in-out;
        }

        /* 3D Service Cards */
        .services-3d {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-bg) 0%, var(--secondary-bg) 100%);
        }

        .section-title-3d {
            font-family: 'Orbitron', monospace;
            font-size: 4rem;
            font-weight: 700;
            text-align: center;
            background: linear-gradient(45deg, var(--accent-electric), var(--accent-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4rem;
            animation: slideInFromTop 1s ease-out;
        }

        .services-grid-3d {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            perspective: 1000px;
        }

        .service-card-3d {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.4s ease;
            transform-style: preserve-3d;
            position: relative;
            overflow: hidden;
        }

        .service-card-3d::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                rgba(0, 245, 255, 0.1) 0%, 
                rgba(139, 92, 246, 0.1) 50%, 
                rgba(244, 114, 182, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .service-card-3d:hover::before {
            opacity: 1;
        }

        .service-card-3d:hover {
            transform: translateY(-20px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 30px 60px rgba(0, 245, 255, 0.2);
        }

        .service-icon-3d {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--accent-electric), var(--accent-purple), var(--accent-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: iconPulse 3s ease-in-out infinite;
        }

        .service-title-3d {
            font-family: 'Orbitron', monospace;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--accent-electric);
        }

        .service-description-3d {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        /* Interactive Stats */
        .stats-3d {
            padding: 100px 0;
            background: var(--secondary-bg);
            position: relative;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .stat-card-3d {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }

        .stat-card-3d:hover {
            transform: translateZ(20px) rotateX(10deg);
            box-shadow: 0 20px 40px rgba(0, 245, 255, 0.3);
        }

        .stat-number-3d {
            font-family: 'Orbitron', monospace;
            font-size: 3rem;
            font-weight: 900;
            color: var(--accent-electric);
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label-3d {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Testimonials */
        .testimonials-3d {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-bg) 0%, var(--secondary-bg) 100%);
        }

        .testimonial-card-3d {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 2rem;
            margin: 1rem;
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }

        .testimonial-card-3d:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 0 25px 50px rgba(139, 92, 246, 0.2);
        }

        .testimonial-text-3d {
            font-style: italic;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 1.5rem;
        }

        .author-avatar-3d {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--accent-electric), var(--accent-purple));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            margin-right: 1rem;
        }

        .author-name-3d {
            color: var(--accent-electric);
            font-weight: 600;
        }

        .author-role-3d {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta-3d {
            padding: 100px 0;
            background: linear-gradient(45deg, var(--accent-electric), var(--accent-purple), var(--accent-pink));
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-3d::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
            animation: move 20s linear infinite;
        }

        .cta-title-3d {
            font-family: 'Orbitron', monospace;
            font-size: 3rem;
            font-weight: 900;
            color: white;
            margin-bottom: 2rem;
            text-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .cta-buttons {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta-3d {
            background: rgba(0, 0, 0, 0.3);
            border: 2px solid white;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .btn-cta-3d:hover {
            background: white;
            color: var(--primary-bg);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        /* Animations */
        @keyframes float3d {
            0%, 100% { transform: translateY(0px) rotateX(0deg); }
            50% { transform: translateY(-20px) rotateX(5deg); }
        }

        @keyframes glow {
            from { text-shadow: 0 0 30px rgba(0, 245, 255, 0.5); }
            to { text-shadow: 0 0 50px rgba(0, 245, 255, 0.8), 0 0 80px rgba(139, 92, 246, 0.3); }
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInFromTop {
            from { opacity: 0; transform: translateY(-100px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        @keyframes move {
            0% { transform: translateX(-100px) translateY(-100px); }
            100% { transform: translateX(100px) translateY(100px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title { font-size: 3rem; }
            .section-title-3d { font-size: 2.5rem; }
            .cta-title-3d { font-size: 2rem; }
            .services-grid-3d { grid-template-columns: 1fr; }
            .cta-buttons { flex-direction: column; align-items: center; }
        }
    </style>
</head>
<body>
    
    
    <div class="cursor"></div>
    <div class="cursor-follower"></div>
    <div class="particle-bg"></div>

    <!-- Hero Section -->
    <section class="hero-3d">
        <div class="hero-content">
            <h1 class="hero-title">IMMERSIVE EVENTS</h1>
            <p class="hero-subtitle">Where Technology Meets Celebration</p>
            <button class="glass-button" onclick="scrollToSection('services')">
                EXPLORE THE FUTURE
            </button>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-3d" id="services">
        <div class="container">
            <h2 class="section-title-3d">OUR SERVICES</h2>
            <div class="services-grid-3d">
                <div class="service-card-3d">
                    <div class="service-icon-3d">
                        <i class="fas fa-ring"></i>
                    </div>
                    <h3 class="service-title-3d">LUXURY WEDDINGS</h3>
                    <p class="service-description-3d">
                        Immersive wedding experiences with Sangeeth, Haldi, and Mehandi ceremonies featuring cutting-edge technology and traditional elegance.
                    </p>
                </div>
                
                <div class="service-card-3d">
                    <div class="service-icon-3d">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3 class="service-title-3d">BIRTHDAY CELEBRATIONS</h3>
                    <p class="service-description-3d">
                        Interactive birthday experiences with personalized themes, immersive entertainment, and unforgettable moments.
                    </p>
                </div>
                
                <div class="service-card-3d">
                    <div class="service-icon-3d">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="service-title-3d">CORPORATE EVENTS</h3>
                    <p class="service-description-3d">
                        Professional corporate functions and educational events with state-of-the-art presentation technology.
                    </p>
                </div>
                
                <div class="service-card-3d">
                    <div class="service-icon-3d">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="service-title-3d">HOUSE WARMING</h3>
                    <p class="service-description-3d">
                        Traditional ceremonies enhanced with modern interactive elements and personalized experiences.
                    </p>
                </div>
                
                <div class="service-card-3d">
                    <div class="service-icon-3d">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="service-title-3d">GOURMET CATERING</h3>
                    <p class="service-description-3d">
                        Culinary experiences featuring molecular gastronomy, interactive food stations, and fusion cuisines.
                    </p>
                </div>
                
                <div class="service-card-3d">
                    <div class="service-icon-3d">
                        <i class="fas fa-video"></i>
                    </div>
                    <h3 class="service-title-3d">MEDIA PRODUCTION</h3>
                    <p class="service-description-3d">
                        Professional photography, videography, and immersive audio systems with live streaming capabilities.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-3d">
        <div class="container">
            <h2 class="section-title-3d">ACHIEVEMENTS</h2>
            <div class="stats-grid">
                <div class="stat-card-3d">
                    <span class="stat-number-3d" data-count="1000">0</span>
                    <div class="stat-label-3d">Events Crafted</div>
                </div>
                <div class="stat-card-3d">
                    <span class="stat-number-3d" data-count="500">0</span>
                    <div class="stat-label-3d">Happy Couples</div>
                </div>
                <div class="stat-card-3d">
                    <span class="stat-number-3d" data-count="8">0</span>
                    <div class="stat-label-3d">Years Innovation</div>
                </div>
                <div class="stat-card-3d">
                    <span class="stat-number-3d" data-count="50">0</span>
                    <div class="stat-label-3d">Expert Team</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-3d">
        <div class="container">
            <h2 class="section-title-3d">CLIENT EXPERIENCES</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card-3d">
                        <p class="testimonial-text-3d">
                            "They transformed our wedding into a futuristic fairy tale! The interactive elements and technology integration was mind-blowing."
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="author-avatar-3d">AK</div>
                            <div>
                                <div class="author-name-3d">Arjun & Kavya</div>
                                <div class="author-role-3d">Luxury Wedding</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card-3d">
                        <p class="testimonial-text-3d">
                            "The corporate event was beyond our expectations. The immersive presentations and interactive technology impressed all our clients."
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="author-avatar-3d">RS</div>
                            <div>
                                <div class="author-name-3d">Rohan Sharma</div>
                                <div class="author-role-3d">Corporate Executive</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card-3d">
                        <p class="testimonial-text-3d">
                            "Our daughter's birthday party was like stepping into a sci-fi movie. The kids were absolutely amazed by the interactive elements!"
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="author-avatar-3d">PM</div>
                            <div>
                                <div class="author-name-3d">Priya Mehta</div>
                                <div class="author-role-3d">Birthday Celebration</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-3d">
        <div class="container">
            <h2 class="cta-title-3d">READY FOR THE FUTURE?</h2>
            <p class="mb-4" style="font-size: 1.3rem; color: white;">
                Step into tomorrow's celebrations today
            </p>
            <div class="cta-buttons">
                <button class="btn-cta-3d" onclick="window.location.href='contact.php'">
                    START YOUR JOURNEY
                </button>
                <button class="btn-cta-3d" onclick="window.location.href='tel:+919876543210'">
                    CONNECT NOW
                </button>
            </div>
        </div>
    </section>

  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Custom Cursor
        const cursor = document.querySelector('.cursor');
        const cursorFollower = document.querySelector('.cursor-follower');
        
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            
            setTimeout(() => {
                cursorFollower.style.left = e.clientX - 20 + 'px';
                cursorFollower.style.top = e.clientY - 20 + 'px';
            }, 50);
        });

        // Hover effects for interactive elements
        const interactiveElements = document.querySelectorAll('.glass-button, .service-card-3d, .stat-card-3d, .testimonial-card-3d, .btn-cta-3d');
        
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.5)';
                cursorFollower.style.transform = 'scale(1.5)';
            });
            
            element.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursorFollower.style.transform = 'scale(1)';
            });
        });

        // Smooth scrolling
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number-3d');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 16);
            });
        }

        // Parallax effect
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero-3d');
            const particleBg = document.querySelector('.particle-bg');
            
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
            
            if (particleBg) {
                particleBg.style.transform = `translateY(${scrolled * 0.1}px)`;
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('stats-3d')) {
                        animateCounters();
                    }
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.service-card-3d, .testimonial-card-3d, .stat-card-3d, .stats-3d');
            animatedElements.forEach(el => {
                observer.observe(el);
            });

            // Stagger animations for service cards
            const serviceCards = document.querySelectorAll('.service-card-3d');
            serviceCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.style.animation = 'fadeInUp 0.8s ease-out forwards';
                card.style.opacity = '0';
            });

            // Add entrance animations for testimonials
            const testimonialCards = document.querySelectorAll('.testimonial-card-3d');
            testimonialCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
                card.style.animation = 'fadeInUp 0.8s ease-out forwards';
                card.style.opacity = '0';
            });
        });

        // Mouse movement parallax for 3D cards
        document.addEventListener('mousemove', (e) => {
            const cards = document.querySelectorAll('.service-card-3d, .testimonial-card-3d, .stat-card-3d');
            const { clientX, clientY } = e;
            const { innerWidth, innerHeight } = window;
            
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const cardX = rect.left + rect.width / 2;
                const cardY = rect.top + rect.height / 2;
                
                const deltaX = (clientX - cardX) / innerWidth;
                const deltaY = (clientY - cardY) / innerHeight;
                
                card.style.transform = `translateY(-10px) rotateX(${deltaY * 10}deg) rotateY(${deltaX * 10}deg)`;
            });
        });
    </script>
</body>
</html>
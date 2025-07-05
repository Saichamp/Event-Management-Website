
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials - Golden Events</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
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
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        /* Testimonials Hero */
        .testimonials-hero {
            position: relative;
            height: 60vh;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), 
                        url('assets/testimonials/hero-bg.jpg') center/cover no-repeat fixed;
            color: white;
            text-align: center;
            padding: 0 2rem;
            margin-bottom: 4rem;
            overflow: hidden;
        }

        .testimonials-hero__content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            transform: translateY(50px);
            opacity: 0;
            transition: all 1s ease;
        }

        .testimonials-hero__content.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .testimonials-hero__title {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .testimonials-hero__subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 300;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 4rem 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--dark);
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Testimonial Cards */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
            transform: translateY(50px);
            opacity: 0;
            transition: all 0.8s ease;
        }

        .testimonial-card.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .testimonial-card::before {
            content: '\201C';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 6rem;
            font-family: 'Playfair Display', serif;
            color: rgba(212, 175, 55, 0.1);
            line-height: 1;
            z-index: 0;
        }

        .testimonial-card__content {
            position: relative;
            z-index: 1;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            font-style: italic;
            color: var(--text-dark);
        }

        .testimonial-card__author {
            display: flex;
            align-items: center;
        }

        .testimonial-card__author-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1.5rem;
            border: 3px solid var(--gold);
        }

        .testimonial-card__author-info h4 {
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
            color: var(--dark);
        }

        .testimonial-card__author-info p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .testimonial-card__rating {
            color: var(--gold);
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }

        /* Video Testimonials */
        .video-testimonials {
            padding: 4rem 0;
            background-color: #f5f5f5;
        }

        .video-testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
        }

        .video-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: scale(0.95);
            opacity: 0;
            transition: all 0.8s ease;
        }

        .video-card.animate {
            transform: scale(1);
            opacity: 1;
        }

        .video-card:hover {
            transform: scale(1.02) !important;
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
        }

        .video-thumbnail {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70px;
            height: 70px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .video-play-btn:hover {
            transform: translate(-50%, -50%) scale(1.1);
        }

        .video-info {
            padding: 1.5rem;
            background-color: white;
        }

        .video-info h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .video-info p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* CTA Section */
        .testimonials-cta {
            padding: 6rem 0;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .testimonials-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .testimonials-cta__content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .testimonials-cta__title {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .testimonials-cta__text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #cccccc;
        }

        .testimonials-cta__button {
            padding: 1rem 2rem;
            border-radius: 50px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: #000000;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .testimonials-cta__button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        .testimonials-cta__button i {
            margin-right: 0.5rem;
        }

        /* Floating decorative elements */
        .golden-particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.6);
            pointer-events: none;
        }

        /* Modal for Video */
        .video-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .video-modal__content {
            width: 80%;
            max-width: 900px;
            position: relative;
        }

        .video-modal__close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 2rem;
            cursor: pointer;
        }

        .video-modal__iframe {
            width: 100%;
            height: 500px;
            border: none;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .testimonials-hero__title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 992px) {
            .testimonials-hero__title {
                font-size: 3rem;
            }
            
            .testimonials-cta__title {
                font-size: 2.2rem;
            }
            
            .video-grid {
                grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .testimonials-hero {
                height: 50vh;
                min-height: 400px;
                background-attachment: scroll;
            }
            
            .testimonials-hero__title {
                font-size: 2.5rem;
            }
            
            .testimonials-hero__subtitle {
                font-size: 1.2rem;
            }
            
            .testimonials-grid {
                grid-template-columns: 1fr;
            }
            
            .video-modal__iframe {
                height: 400px;
            }
        }

        @media (max-width: 576px) {
            .testimonials-hero__title {
                font-size: 2rem;
            }
            
            .testimonials-cta__title {
                font-size: 1.8rem;
            }
            
            .testimonial-card {
                padding: 2rem 1.5rem;
            }
            
            .video-grid {
                grid-template-columns: 1fr;
            }
            
            .video-modal__content {
                width: 95%;
            }
            
            .video-modal__iframe {
                height: 250px;
            }
        }
    </style>

<body>
    <?php include 'header.php'; ?>

    <!-- Testimonials Hero -->
    <section class="testimonials-hero" id="testimonials-hero">
        <div class="testimonials-hero__content" id="hero-content">
            <h1 class="testimonials-hero__title">Our Clients Speak</h1>
            <p class="testimonials-hero__subtitle">Hear what our clients have to say about their Golden Experiences</p>
        </div>
        
        <!-- Floating particles will be added by JS -->
    </section>

    <!-- Written Testimonials -->
    <section class="testimonials-section">
        <div class="testimonials-container">
            <h2 class="section-title">Client Testimonials</h2>
            
            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card" data-delay="0">
                    <div class="testimonial-card__content">
                        <p>Golden Events transformed our wedding into a fairy tale! Every detail was perfect, from the floral arrangements to the lighting. Their team worked tirelessly to make sure everything ran smoothly, and we couldn't have asked for a more magical day.</p>
                    </div>
                    <div class="testimonial-card__author">
                        <img src="assets/testimonials/client-1.jpg" alt="Sarah Johnson" class="testimonial-card__author-img">
                        <div class="testimonial-card__author-info">
                            <h4>Sarah & Michael Johnson</h4>
                            <p>Wedding Clients</p>
                            <div class="testimonial-card__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="testimonial-card" data-delay="0.1">
                    <div class="testimonial-card__content">
                        <p>Our corporate gala was a tremendous success thanks to Golden Events. They handled everything from venue selection to catering with impeccable professionalism. The event flowed seamlessly, and our guests were thoroughly impressed.</p>
                    </div>
                    <div class="testimonial-card__author">
                        <img src="assets/testimonials/client-2.jpg" alt="David Chen" class="testimonial-card__author-img">
                        <div class="testimonial-card__author-info">
                            <h4>David Chen</h4>
                            <p>CEO, TechForward Inc.</p>
                            <div class="testimonial-card__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="testimonial-card" data-delay="0.2">
                    <div class="testimonial-card__content">
                        <p>I've worked with many event planners over the years, but Golden Events stands out for their creativity and attention to detail. My daughter's Sweet 16 was everything she dreamed of and more. The team went above and beyond to make it special.</p>
                    </div>
                    <div class="testimonial-card__author">
                        <img src="assets/testimonials/client-3.jpg" alt="Maria Gonzalez" class="testimonial-card__author-img">
                        <div class="testimonial-card__author-info">
                            <h4>Maria Gonzalez</h4>
                            <p>Birthday Celebration</p>
                            <div class="testimonial-card__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 4 -->
                <div class="testimonial-card" data-delay="0.3">
                    <div class="testimonial-card__content">
                        <p>Our 25th anniversary celebration was absolutely perfect. Golden Events understood our vision and executed it flawlessly. They handled all the stressful details so we could simply enjoy our special evening with family and friends.</p>
                    </div>
                    <div class="testimonial-card__author">
                        <img src="assets/testimonials/client-4.jpg" alt="Robert & Lisa Wilson" class="testimonial-card__author-img">
                        <div class="testimonial-card__author-info">
                            <h4>Robert & Lisa Wilson</h4>
                            <p>Anniversary Celebration</p>
                            <div class="testimonial-card__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 5 -->
                <div class="testimonial-card" data-delay="0.4">
                    <div class="testimonial-card__content">
                        <p>The graduation party Golden Events planned for our son was incredible. They transformed our backyard into an elegant celebration space that wowed all our guests. Their team was professional, creative, and a pleasure to work with.</p>
                    </div>
                    <div class="testimonial-card__author">
                        <img src="assets/testimonials/client-5.jpg" alt="Thomas Baker" class="testimonial-card__author-img">
                        <div class="testimonial-card__author-info">
                            <h4>Thomas Baker</h4>
                            <p>Graduation Party</p>
                            <div class="testimonial-card__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 6 -->
                <div class="testimonial-card" data-delay="0.5">
                    <div class="testimonial-card__content">
                        <p>As a wedding photographer, I've seen many event planners in action. Golden Events is truly exceptional. Their coordination makes my job easier and ensures the couple has the perfect day. I always recommend them to my clients.</p>
                    </div>
                    <div class="testimonial-card__author">
                        <img src="assets/testimonials/client-6.jpg" alt="Emily Rodriguez" class="testimonial-card__author-img">
                        <div class="testimonial-card__author-info">
                            <h4>Emily Rodriguez</h4>
                            <p>Professional Photographer</p>
                            <div class="testimonial-card__rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Testimonials -->
    <section class="video-testimonials">
        <div class="video-testimonials-container">
            <h2 class="section-title">Video Testimonials</h2>
            
            <div class="video-grid">
                <!-- Video 1 -->
                <div class="video-card">
                    <img src="assets/testimonials/video-thumb-1.jpg" alt="Wedding Testimonial" class="video-thumbnail">
                    <button class="video-play-btn" data-video-id="dQw4w9WgXcQ">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="video-info">
                        <h3>Jennifer & Mark's Wedding</h3>
                        <p>"Golden Events made our dream wedding come true!"</p>
                    </div>
                </div>
                
                <!-- Video 2 -->
                <div class="video-card">
                    <img src="assets/testimonials/video-thumb-2.jpg" alt="Corporate Testimonial" class="video-thumbnail">
                    <button class="video-play-btn" data-video-id="9bZkp7q19f0">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="video-info">
                        <h3>Annual Corporate Gala</h3>
                        <p>"Our most successful event yet, thanks to Golden Events"</p>
                    </div>
                </div>
                
                <!-- Video 3 -->
                <div class="video-card">
                    <img src="assets/testimonials/video-thumb-3.jpg" alt="Birthday Testimonial" class="video-thumbnail">
                    <button class="video-play-btn" data-video-id="JGwWNGJdvx8">
                        <i class="fas fa-play"></i>
                    </button>
                    <div class="video-info">
                        <h3>Surprise 50th Birthday</h3>
                        <p>"They planned the perfect surprise celebration"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials CTA -->
    <section class="testimonials-cta">
        <div class="testimonials-cta__content">
            <h2 class="testimonials-cta__title">Ready to Create Your Golden Experience?</h2>
            <p class="testimonials-cta__text">Let us make your next event as memorable as those you've seen here</p>
            <a href="contact.php" class="testimonials-cta__button">
                <i class="fas fa-calendar-check"></i> Get in Touch
            </a>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="video-modal" id="video-modal">
        <div class="video-modal__content">
            <span class="video-modal__close" id="video-modal-close">&times;</span>
            <iframe class="video-modal__iframe" id="video-modal-iframe" allowfullscreen></iframe>
        </div>
    </div>

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
                const heroSection = document.getElementById('testimonials-hero');
                const particleCount = 15;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('golden-particle');
                    
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

            // Animate testimonial cards on scroll with staggered delay
            const testimonialCards = document.querySelectorAll('.testimonial-card');
            testimonialCards.forEach((card, index) => {
                const delay = card.dataset.delay || 0;
                
                ScrollTrigger.create({
                    trigger: card,
                    start: "top 80%",
                    onEnter: () => {
                        gsap.to(card, {
                            duration: 0.8,
                            y: 0,
                            opacity: 1,
                            delay: delay,
                            ease: "power3.out"
                        });
                    },
                    once: true
                });
            });

            // Animate video cards on scroll
            const videoCards = document.querySelectorAll('.video-card');
            videoCards.forEach((card, index) => {
                ScrollTrigger.create({
                    trigger: card,
                    start: "top 80%",
                    onEnter: () => {
                        gsap.to(card, {
                            duration: 0.8,
                            scale: 1,
                            opacity: 1,
                            delay: index * 0.1,
                            ease: "back.out(1.7)"
                        });
                    },
                    once: true
                });
            });

            // Video modal functionality
            const videoModal = document.getElementById('video-modal');
            const videoModalClose = document.getElementById('video-modal-close');
            const videoModalIframe = document.getElementById('video-modal-iframe');
            const videoPlayBtns = document.querySelectorAll('.video-play-btn');

            videoPlayBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const videoId = this.dataset.videoId;
                    videoModalIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
                    videoModal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });

            videoModalClose.addEventListener('click', function() {
                videoModalIframe.src = '';
                videoModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            videoModal.addEventListener('click', function(e) {
                if (e.target === videoModal) {
                    videoModalIframe.src = '';
                    videoModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Initialize GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);
            ScrollTrigger.refresh();
        });
    </script>
</body>

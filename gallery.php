<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Golden Events</title>
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
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        /* Gallery Hero */
        .gallery-hero {
            position: relative;
            height: 70vh;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), 
                        url('assets/gallery/hero-bg.jpg') center/cover no-repeat fixed;
            color: white;
            text-align: center;
            padding: 0 2rem;
            margin-bottom: 4rem;
            overflow: hidden;
        }

        .gallery-hero__content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            transform: translateY(50px);
            opacity: 0;
            transition: all 1s ease;
        }

        .gallery-hero__content.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .gallery-hero__title {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .gallery-hero__subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 300;
        }

        /* Gallery Filters */
        .gallery-filters {
            padding: 2rem 0;
            background-color: var(--light);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .filter-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .filter-btn {
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            background: transparent;
            border: 2px solid var(--gold);
            color: var(--dark);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: white;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        /* Unique Grid Layout */
        .gallery-grid {
            padding: 4rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            grid-auto-rows: minmax(200px, auto);
            grid-gap: 2rem;
            grid-auto-flow: dense;
        }

        .grid-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            transform: scale(0.95);
            opacity: 0;
        }

        .grid-item.animate {
            transform: scale(1);
            opacity: 1;
        }

        .grid-item:hover {
            transform: scale(1.02) !important;
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
            z-index: 10;
        }

        /* Different grid item sizes */
        .grid-item--wide {
            grid-column: span 2;
        }

        .grid-item--tall {
            grid-row: span 2;
        }

        .grid-item--big {
            grid-column: span 2;
            grid-row: span 2;
        }

        .grid-item__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: all 0.8s ease;
        }

        .grid-item:hover .grid-item__image {
            transform: scale(1.1);
        }

        .grid-item__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 50%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
            opacity: 0;
            transition: all 0.5s ease;
        }

        .grid-item:hover .grid-item__overlay {
            opacity: 1;
        }

        .grid-item__title {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .grid-item__category {
            color: var(--gold);
            font-weight: 500;
            transform: translateY(20px);
            transition: all 0.5s ease 0.1s;
        }

        .grid-item:hover .grid-item__title,
        .grid-item:hover .grid-item__category {
            transform: translateY(0);
        }

        /* Gallery CTA */
        .gallery-cta {
            padding: 6rem 0;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .gallery-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .gallery-cta__content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .gallery-cta__title {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gallery-cta__text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #cccccc;
        }

        .gallery-cta__button {
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

        .gallery-cta__button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        .gallery-cta__button i {
            margin-right: 0.5rem;
        }

        /* Floating decorative elements */
        .golden-particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.6);
            pointer-events: none;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .gallery-hero__title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 992px) {
            .gallery-hero__title {
                font-size: 3rem;
            }
            
            .gallery-cta__title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .gallery-hero {
                height: 60vh;
                min-height: 400px;
                background-attachment: scroll;
            }
            
            .gallery-hero__title {
                font-size: 2.5rem;
            }
            
            .gallery-hero__subtitle {
                font-size: 1.2rem;
            }
            
            .grid-item--wide,
            .grid-item--big {
                grid-column: span 1;
            }
            
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                grid-gap: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .gallery-hero__title {
                font-size: 2rem;
            }
            
            .gallery-cta__title {
                font-size: 1.8rem;
            }
            
            .filter-btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
            
            .gallery-grid {
                grid-template-columns: 1fr;
                padding: 2rem 1rem;
            }
            
            .grid-item--tall {
                grid-row: span 1;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Gallery Hero -->
    <section class="gallery-hero" id="gallery-hero">
        <div class="gallery-hero__content" id="hero-content">
            <h1 class="gallery-hero__title">Our Golden Moments</h1>
            <p class="gallery-hero__subtitle">A visual journey through our most memorable events and celebrations</p>
        </div>
        
        <!-- Floating particles will be added by JS -->
    </section>

    <!-- Gallery Filters -->
    <section class="gallery-filters">
        <div class="filter-container">
            <button class="filter-btn active" data-filter="all">All Events</button>
            <button class="filter-btn" data-filter="wedding">Weddings</button>
            <button class="filter-btn" data-filter="corporate">Corporate</button>
            <button class="filter-btn" data-filter="social">Social</button>
            <button class="filter-btn" data-filter="academic">Academic</button>
        </div>
    </section>

    <!-- Unique Grid Gallery -->
    <section class="gallery-grid" id="gallery-grid">
        <!-- Wedding 1 (Wide) -->
        <div class="grid-item grid-item--wide" data-category="wedding">
            <img src="assets/gallery/wedding-1.jpg" alt="Grand Wedding" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Royal Wedding</h3>
                <span class="grid-item__category">Wedding</span>
            </div>
        </div>
        
        <!-- Corporate 1 (Tall) -->
        <div class="grid-item grid-item--tall" data-category="corporate">
            <img src="assets/gallery/corporate-1.jpg" alt="Corporate Event" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Tech Conference</h3>
                <span class="grid-item__category">Corporate</span>
            </div>
        </div>
        
        <!-- Social 1 (Small) -->
        <div class="grid-item" data-category="social">
            <img src="assets/gallery/social-1.jpg" alt="Birthday Party" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Sweet 16</h3>
                <span class="grid-item__category">Birthday</span>
            </div>
        </div>
        
        <!-- Wedding 2 (Medium) -->
        <div class="grid-item" data-category="wedding">
            <img src="assets/gallery/wedding-2.jpg" alt="Sangeet Night" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Sangeet Night</h3>
                <span class="grid-item__category">Wedding</span>
            </div>
        </div>
        
        <!-- Corporate 2 (Medium) -->
        <div class="grid-item" data-category="corporate">
            <img src="assets/gallery/corporate-2.jpg" alt="Product Launch" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Product Launch</h3>
                <span class="grid-item__category">Corporate</span>
            </div>
        </div>
        
        <!-- Academic 1 (Tall) -->
        <div class="grid-item grid-item--tall" data-category="academic">
            <img src="assets/gallery/academic-1.jpg" alt="Graduation Ceremony" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Graduation Day</h3>
                <span class="grid-item__category">Academic</span>
            </div>
        </div>
        
        <!-- Wedding 3 (Big) -->
        <div class="grid-item grid-item--big" data-category="wedding">
            <img src="assets/gallery/wedding-3.jpg" alt="Wedding Reception" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Grand Reception</h3>
                <span class="grid-item__category">Wedding</span>
            </div>
        </div>
        
        <!-- Social 2 (Medium) -->
        <div class="grid-item" data-category="social">
            <img src="assets/gallery/social-2.jpg" alt="Anniversary Party" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Golden Anniversary</h3>
                <span class="grid-item__category">Anniversary</span>
            </div>
        </div>
        
        <!-- Corporate 3 (Wide) -->
        <div class="grid-item grid-item--wide" data-category="corporate">
            <img src="assets/gallery/corporate-3.jpg" alt="Award Ceremony" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Award Night</h3>
                <span class="grid-item__category">Corporate</span>
            </div>
        </div>
        
        <!-- Academic 2 (Small) -->
        <div class="grid-item" data-category="academic">
            <img src="assets/gallery/academic-2.jpg" alt="College Fest" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">College Fest</h3>
                <span class="grid-item__category">Academic</span>
            </div>
        </div>
        
        <!-- Social 3 (Medium) -->
        <div class="grid-item" data-category="social">
            <img src="assets/gallery/social-3.jpg" alt="Family Reunion" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Family Reunion</h3>
                <span class="grid-item__category">Social</span>
            </div>
        </div>
        
        <!-- Wedding 4 (Tall) -->
        <div class="grid-item grid-item--tall" data-category="wedding">
            <img src="assets/gallery/wedding-4.jpg" alt="Haldi Ceremony" class="grid-item__image">
            <div class="grid-item__overlay">
                <h3 class="grid-item__title">Haldi Ceremony</h3>
                <span class="grid-item__category">Wedding</span>
            </div>
        </div>
    </section>

    <!-- Gallery CTA -->
    <section class="gallery-cta">
        <div class="gallery-cta__content">
            <h2 class="gallery-cta__title">Ready to Create Your Own Golden Moments?</h2>
            <p class="gallery-cta__text">Let's discuss how we can make your event as memorable as these</p>
            <a href="#contact" class="gallery-cta__button">
                <i class="fas fa-calendar-check"></i> Book Your Event
            </a>
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
                const heroSection = document.getElementById('gallery-hero');
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

            // Filter functionality
            const filterBtns = document.querySelectorAll('.filter-btn');
            const gridItems = document.querySelectorAll('.grid-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active button
                    filterBtns.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filter = this.dataset.filter;
                    
                    // Filter items
                    gridItems.forEach(item => {
                        if (filter === 'all' || item.dataset.category === filter) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // Animate grid items on scroll
            gsap.utils.toArray('.grid-item').forEach((item, i) => {
                ScrollTrigger.create({
                    trigger: item,
                    start: "top 80%",
                    onEnter: () => {
                        item.classList.add('animate');
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
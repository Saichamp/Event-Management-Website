<?php include "config.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials - Golden Events</title>
    <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                                url('assets/img1.png') center/cover no-repeat fixed;
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

                /* Responsive Testimonial Author Images */
                .testimonial-card__author-img {
                    width: 70px;
                    height: 70px;
                    border-radius: 50%;
                    object-fit: cover;
                    object-position: center;
                    margin-right: 1.5rem;
                    border: 3px solid var(--gold);
                    display: block;
                    flex-shrink: 0;
                    transition: all 0.3s ease;
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

                /* Desktop Large (1200px and up) */
                @media (min-width: 1200px) {
                    .testimonials-hero__title {
                        font-size: 4.5rem;
                    }
                    
                    .testimonials-hero__subtitle {
                        font-size: 1.6rem;
                    }
                    
                    .testimonial-card__author-img {
                        width: 80px;
                        height: 80px;
                        margin-right: 2rem;
                        border-width: 4px;
                    }
                    
                    .testimonial-card {
                        padding: 3rem;
                    }
                    
                    .testimonials-cta__title {
                        font-size: 2.8rem;
                    }
                }

                /* Desktop (992px to 1199px) */
                @media (max-width: 1199px) and (min-width: 992px) {
                    .testimonials-hero__title {
                        font-size: 3.5rem;
                    }
                    
                    .testimonials-hero__subtitle {
                        font-size: 1.4rem;
                    }
                    
                    .testimonial-card__author-img {
                        width: 70px;
                        height: 70px;
                        margin-right: 1.5rem;
                        border-width: 3px;
                    }
                    
                    .testimonials-cta__title {
                        font-size: 2.2rem;
                    }
                }

                /* Tablet (768px to 991px) */
                @media (max-width: 991px) and (min-width: 768px) {
                    .testimonials-hero {
                        height: 50vh;
                        min-height: 400px;
                        background-attachment: scroll;
                    }
                    
                    .testimonials-hero__title {
                        font-size: 3rem;
                    }
                    
                    .testimonials-hero__subtitle {
                        font-size: 1.3rem;
                    }
                    
                    .testimonials-grid {
                        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                        gap: 1.5rem;
                    }
                    
                    .testimonial-card {
                        padding: 2rem;
                    }
                    
                    .testimonial-card__author-img {
                        width: 65px;
                        height: 65px;
                        margin-right: 1.2rem;
                        border-width: 3px;
                    }
                    
                    .testimonial-card__author {
                        flex-direction: column;
                        text-align: center;
                        align-items: center;
                    }
                    
                    .testimonial-card__author-img {
                        margin-right: 0;
                        margin-bottom: 1rem;
                    }
                    
                    .testimonials-cta {
                        padding: 4rem 0;
                    }
                    
                    .testimonials-cta__title {
                        font-size: 2rem;
                    }
                    
                    .testimonials-cta__text {
                        font-size: 1.1rem;
                    }
                }

                /* Mobile Large (576px to 767px) */
                @media (max-width: 767px) and (min-width: 576px) {
                    .testimonials-hero {
                        height: 45vh;
                        min-height: 350px;
                        background-attachment: scroll;
                        padding: 0 1.5rem;
                    }
                    
                    .testimonials-hero__title {
                        font-size: 2.5rem;
                    }
                    
                    .testimonials-hero__subtitle {
                        font-size: 1.2rem;
                    }
                    
                    .testimonials-section {
                        padding: 3rem 0;
                    }
                    
                    .testimonials-container {
                        padding: 0 1.5rem;
                    }
                    
                    .testimonials-grid {
                        grid-template-columns: 1fr;
                        gap: 1.5rem;
                    }
                    
                    .testimonial-card {
                        padding: 2rem 1.5rem;
                    }
                    
                    .testimonial-card__author-img {
                        width: 60px;
                        height: 60px;
                        margin-right: 1rem;
                        border-width: 2px;
                    }
                    
                    .testimonial-card__author {
                        flex-direction: row;
                        text-align: left;
                        align-items: center;
                    }
                    
                    .testimonial-card__author-img {
                        margin-bottom: 0;
                    }
                    
                    .testimonials-cta {
                        padding: 3rem 0;
                    }
                    
                    .testimonials-cta__title {
                        font-size: 1.8rem;
                    }
                    
                    .testimonials-cta__text {
                        font-size: 1rem;
                    }
                    
                    .testimonials-cta__button {
                        padding: 0.8rem 1.5rem;
                    }
                }

                /* Mobile Small (575px and below) */
                @media (max-width: 575px) {
                    .testimonials-hero {
                        height: 40vh;
                        min-height: 300px;
                        padding: 0 1rem;
                    }
                    
                    .testimonials-hero__title {
                        font-size: 2rem;
                    }
                    
                    .testimonials-hero__subtitle {
                        font-size: 1rem;
                    }
                    
                    .testimonials-section {
                        padding: 2rem 0;
                    }
                    
                    .testimonials-container {
                        padding: 0 1rem;
                    }
                    
                    .section-title {
                        font-size: 2rem;
                    }
                    
                    .testimonials-grid {
                        gap: 1rem;
                    }
                    
                    .testimonial-card {
                        padding: 1.5rem 1rem;
                    }
                    
                    .testimonial-card::before {
                        font-size: 4rem;
                        top: 15px;
                        left: 15px;
                    }
                    
                    .testimonial-card__content {
                        font-size: 1rem;
                        margin-bottom: 1.5rem;
                    }
                    
                    .testimonial-card__author-img {
                        width: 50px;
                        height: 50px;
                        margin-right: 0.8rem;
                        border-width: 2px;
                    }
                    
                    .testimonial-card__author {
                        flex-direction: row;
                        text-align: left;
                        align-items: flex-start;
                    }
                    
                    .testimonial-card__author-info h4 {
                        font-size: 1rem;
                        margin-bottom: 0.2rem;
                    }
                    
                    .testimonial-card__author-info p {
                        font-size: 0.8rem;
                    }
                    
                    .testimonial-card__rating {
                        font-size: 0.8rem;
                        margin-top: 0.3rem;
                    }
                    
                    .testimonials-cta {
                        padding: 2.5rem 0;
                    }
                    
                    .testimonials-cta__title {
                        font-size: 1.5rem;
                    }
                    
                    .testimonials-cta__text {
                        font-size: 0.9rem;
                    }
                    
                    .testimonials-cta__button {
                        padding: 0.7rem 1.2rem;
                        font-size: 0.9rem;
                    }
                }

                /* Ultra Small Mobile (480px and below) */
                @media (max-width: 480px) {
                    .testimonials-hero {
                        height: 35vh;
                        min-height: 250px;
                        padding: 0 0.5rem;
                    }
                    
                    .testimonials-hero__title {
                        font-size: 1.8rem;
                    }
                    
                    .testimonials-hero__subtitle {
                        font-size: 0.9rem;
                    }
                    
                    .testimonials-container {
                        padding: 0 0.5rem;
                    }
                    
                    .section-title {
                        font-size: 1.8rem;
                    }
                    
                    .testimonial-card {
                        padding: 1.2rem 0.8rem;
                    }
                    
                    .testimonial-card__author-img {
                        width: 45px;
                        height: 45px;
                        margin-right: 0.6rem;
                        border-width: 2px;
                    }
                    
                    .testimonial-card__author-info h4 {
                        font-size: 0.9rem;
                    }
                    
                    .testimonial-card__author-info p {
                        font-size: 0.75rem;
                    }
                    
                    .testimonial-card__rating {
                        font-size: 0.75rem;
                    }
                    
                    .testimonials-cta__title {
                        font-size: 1.3rem;
                    }
                    
                    .testimonials-cta__text {
                        font-size: 0.8rem;
                    }
                    
                    .testimonials-cta__button {
                        padding: 0.6rem 1rem;
                        font-size: 0.8rem;
                    }
                }

                /* Landscape Mobile */
                @media (max-height: 500px) and (orientation: landscape) {
                    .testimonials-hero {
                        height: 80vh;
                        min-height: 300px;
                    }
                    
                    .testimonials-hero__title {
                        font-size: 2.5rem;
                    }
                    
                    .testimonials-hero__subtitle {
                        font-size: 1.1rem;
                    }
                }
                <style>
                /* Grid container */
                .testimonials-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                    gap: 2rem;
                    margin-top: 2rem;
                }

                /* Card styling */
                .testimonial-card {
                    background: #fff;
                    padding: 1.5rem;
                    border-radius: 12px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                    transition: transform 0.3s ease;
                }

                .testimonial-card:hover {
                    transform: translateY(-5px);
                }

                /* Content paragraph */
                .testimonial-card__content p {
                    font-size: 1rem;
                    line-height: 1.6;
                    color: #444;
                    margin-bottom: 1rem;
                }

                /* Author section */
                .testimonial-card__author {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                }

                /* Author image */
                .testimonial-card__author-img {
                    width: 70px;
                    height: 70px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: 2px solid #ccc;
                    flex-shrink: 0;
                }

                /* Author text */
                .testimonial-card__author-info h4 {
                    margin: 0;
                    font-size: 1rem;
                    font-weight: 600;
                    color: #222;
                }

                .testimonial-card__author-info p {
                    margin: 0;
                    font-size: 0.9rem;
                    color: #777;
                }

                /* Star rating */
                .testimonial-card__rating i {
                    color: #f5c518;
                    font-size: 0.9rem;
                    margin-right: 2px;
                }

                /* Responsive image/text on smaller screens */
                @media (max-width: 600px) {
                    .testimonial-card__author {
                        flex-direction: column;
                        text-align: center;
                    }

                    .testimonial-card__author-img {
                        margin-bottom: 0.5rem;
                    }
            }
            .testimonial-card__content {
            font-style: italic;
            color: #555;
            line-height: 1.5;
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
            overflow: visible;         /* Ensures no scrollbar */
            max-height: none;          /* Removes any hidden height */
        }

        .testimonial-text {
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #333;
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
            overflow: visible;
        }
        .testimonial-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;         /* Stretch to full height */
        }
        .testimonial-card__author-img {
            width: 80px;
            height: 80px;
            object-fit: cover;         /* Ensures the image fills the space without distortion */
            border-radius: 50%;        /* Makes the image circular */
            border: 2px solid #eee;    /* Optional subtle border */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
            margin-right: 15px;
        }
        .testimonial-card__author {
            display: flex;
            align-items: center;
            margin-top: 15px;
            gap: 10px;
        }
        .testimonial-card__author {
            display: flex;
            align-items: center;
            margin-top: 15px;
            gap: 10px;
        }

            .testimonial-nav {
                text-align: center;
                margin-bottom: 20px;
            }

            .testimonial-nav-link {
                font-size: 16px;
                color: #007BFF;
                text-decoration: none;
                padding: 10px;
                background-color: #f8f9fa;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .testimonial-nav-link:hover {
                background-color: #007BFF;
                color: white;
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
        
        <!-- Navigation to admin_testimonial folder -->
        <div class="testimonial-nav">
            <a href="admin_testimonial/" class="testimonial-nav-link">Add Testimonials</a>
        </div>

        <div class="testimonials-grid">
            <?php
            $delay = 0.0;
            if (empty($testimonials)) {
                echo '<p class="text-muted">No testimonials available yet.</p>';
            } else {
                foreach ($testimonials as $testimonial):
                    $fullStars = floor($testimonial['star_rating']);
                    $hasHalf = ($testimonial['star_rating'] - $fullStars) >= 0.5;
                    $emptyStars = 5 - $fullStars - ($hasHalf ? 1 : 0);
            ?>
                <div class="testimonial-card" data-delay="<?= htmlspecialchars(number_format($delay, 1)) ?>">
                    <div class="testimonial-card__content">
                        <p><?= htmlspecialchars($testimonial['description'] ?: 'No description provided.') ?></p>
                    </div>
                    <div class="testimonial-card__author">
                        <img src="admin_testimonial/<?= htmlspecialchars($testimonial['file_path']) ?>"
                            alt="<?= htmlspecialchars($testimonial['alt_text']) ?>"
                            class="testimonial-card__author-img">
                        <div class="testimonial-card__author-info">
                            <h4><?= htmlspecialchars($testimonial['image_name']) ?></h4>
                            <p>Client Testimonial</p>
                            <div class="testimonial-card__rating">
                                <?php
                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                if ($hasHalf) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                }
                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<i class="far fa-star"></i>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $delay += 0.1;
                endforeach;
            }
            ?>
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

         

       

            // Initialize GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);
            ScrollTrigger.refresh();
        });
    </script>
</body>

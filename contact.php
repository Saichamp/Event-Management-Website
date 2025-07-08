<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Golden Events</title>
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

        /* Contact Hero */
        .contact-hero {
            position: relative;
            height: 60vh;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), 
                        url('assets/sangeeth.webp') center/cover no-repeat fixed;
            color: white;
            text-align: center;
            padding: 0 2rem;
            margin-bottom: 4rem;
            overflow: hidden;
        }

        .contact-hero__content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            transform: translateY(50px);
            opacity: 0;
            transition: all 1s ease;
        }

        .contact-hero__content.animate {
            transform: translateY(0);
            opacity: 1;
        }

        .contact-hero__title {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        .contact-hero__subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 300;
        }

        /* Contact Sections */
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .contact-info {
            background-color: white;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transform: translateX(-50px);
            opacity: 0;
            transition: all 0.8s ease;
        }

        .contact-info.animate {
            transform: translateX(0);
            opacity: 1;
        }

        .contact-info__title {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--dark);
            position: relative;
            padding-bottom: 1rem;
        }

        .contact-info__title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
        }

        .contact-method {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .contact-method__icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .contact-method__content h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .contact-method__content p, 
        .contact-method__content a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-method__content a:hover {
            color: var(--gold);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--light);
            color: var(--dark);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: white;
            transform: translateY(-3px);
        }

        /* Contact Form */
        .contact-form {
            background-color: white;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transform: translateX(50px);
            opacity: 0;
            transition: all 0.8s ease 0.2s;
        }

        .contact-form.animate {
            transform: translateX(0);
            opacity: 1;
        }

        .contact-form__title {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--dark);
            position: relative;
            padding-bottom: 1rem;
        }

        .contact-form__title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
            color: #000000;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        .submit-btn i {
            margin-right: 0.5rem;
        }

        /* Map Section */
        .map-section {
            padding: 4rem 0;
            background-color: #f5f5f5;
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .map-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--dark);
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        .map-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(45deg, var(--gold), var(--gold-light));
        }

        .map-wrapper {
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: scale(0.95);
            opacity: 0;
            transition: all 0.8s ease;
        }

        .map-wrapper.animate {
            transform: scale(1);
            opacity: 1;
        }

        .map-wrapper iframe {
            width: 100%;
            height: 100%;
            border: none;
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
            .contact-hero__title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 992px) {
            .contact-hero__title {
                font-size: 3rem;
            }
            
            .contact-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .contact-info,
            .contact-form {
                transform: none !important;
            }
        }

        @media (max-width: 768px) {
            .contact-hero {
                height: 50vh;
                min-height: 400px;
                background-attachment: scroll;
            }
            
            .contact-hero__title {
                font-size: 2.5rem;
            }
            
            .contact-hero__subtitle {
                font-size: 1.2rem;
            }
            
            .contact-info,
            .contact-form {
                padding: 2rem;
            }
            
            .map-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .contact-hero__title {
                font-size: 2rem;
            }
            
            .contact-method {
                flex-direction: column;
            }
            
            .contact-method__icon {
                margin-bottom: 1rem;
                margin-right: 0;
            }
            
            .map-wrapper {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Contact Hero -->
    <section class="contact-hero" id="contact-hero">
        <div class="contact-hero__content" id="hero-content">
            <h1 class="contact-hero__title">Let's Create Magic Together</h1>
            <p class="contact-hero__subtitle">Get in touch with our team to start planning your unforgettable event</p>
        </div>
        
        <!-- Floating particles will be added by JS -->
    </section>

    <!-- Contact Sections -->
    <div class="contact-container">
        <!-- Contact Info -->
        <div class="contact-info" id="contact-info">
            <h2 class="contact-info__title">Contact Information</h2>
            
            <div class="contact-method">
                <div class="contact-method__icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="contact-method__content">
                    <h3>Our Office</h3>
                    <p>Sri Hari nevasam 3rd block 2floor flat no 307 near Tagore rice mill, Amaravati road, Nagaralu, Guntur</p>
                </div>
            </div>
            
            <div class="contact-method">
                <div class="contact-method__icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="contact-method__content">
                    <h3>Phone Numbers</h3>
                    <p>
                        <a href="tel:+919494055362">+91 9494055362</a><br>
                        <a href="tel:+919505380238">+91 9505380238</a>
                    </p>
                </div>
            </div>
            
            <div class="contact-method">
                <div class="contact-method__icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-method__content">
                    <h3>Email Address</h3>
                    <p>
                        <a href="mailto:g4goldenevents@gmail.com">g4goldenevents@gmail.com</a><br>
                     
                    </p>
                </div>
            </div>
            
            <div class="contact-method">
                <div class="contact-method__icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="contact-method__content">
                    <h3>Working Hours</h3>
                    <p>
                        Monday - Friday: 9:00 AM - 7:00 PM<br>
                        Saturday: 10:00 AM - 5:00 PM<br>
                        Sunday: Closed
                    </p>
                </div>
            </div>
            
            <div class="social-links">
                <!-- <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a> -->
                <a href="https://www.instagram.com/g4_golden_events" class="social-link"><i class="fab fa-instagram"></i></a>
                <!-- <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-pinterest-p"></i></a> -->
                <a href="https://www.linkedin.com/in/g4golden-events-aa463a373" class="social-link"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="contact-form" id="contact-form">
            <h2 class="contact-form__title">Send Us a Message</h2>
            <form id="event-contact-form">
                <div class="form-group">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="event-type" class="form-label">Event Type</label>
                    <select id="event-type" name="event-type" class="form-control" required>
                        <option value="">Select an event type</option>
                        <option value="wedding">Wedding</option>
                        <option value="corporate">Corporate Event</option>
                        <option value="birthday">Birthday Party</option>
                        <option value="anniversary">Anniversary</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="event-date" class="form-label">Event Date (if known)</label>
                    <input type="date" id="event-date" name="event-date" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea id="message" name="message" class="form-control" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>
    
    <!-- Map Section -->
    <section class="map-section">
        <div class="map-container">
            <h2 class="map-title">Find Us Here</h2>
            <div class="map-wrapper" id="map-wrapper">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7657.866181672171!2d80.42895938445966!3d16.326362683819223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sSri%20Hari%20Nevasam%2C%203rd%20Block%2C%202nd%20Floor%2C%20Flat%20No.%20307%2C%20near%20Tagore%20Rice%20Mill%2C%20Amaravati%20Road%2C%20Nagaralu%2C%20Guntur!5e0!3m2!1sen!2sin!4v1751958684772!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                const heroSection = document.getElementById('contact-hero');
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

            // Animate sections on scroll
            const contactInfo = document.getElementById('contact-info');
            const contactForm = document.getElementById('contact-form');
            const mapWrapper = document.getElementById('map-wrapper');

            ScrollTrigger.create({
                trigger: contactInfo,
                start: "top 80%",
                onEnter: () => {
                    contactInfo.classList.add('animate');
                    contactForm.classList.add('animate');
                },
                once: true
            });

            ScrollTrigger.create({
                trigger: mapWrapper,
                start: "top 80%",
                onEnter: () => {
                    mapWrapper.classList.add('animate');
                },
                once: true
            });

            // Form submission handling
            const contactFormElement = document.getElementById('event-contact-form');
            contactFormElement.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Here you would typically send the form data to your server
                // For demo purposes, we'll just show an alert
                alert('Thank you for your message! We will contact you soon.');
                contactFormElement.reset();
            });

            // Initialize GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);
            ScrollTrigger.refresh();
        });
    </script>
</body>
</html>
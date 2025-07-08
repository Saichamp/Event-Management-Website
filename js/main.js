document.addEventListener('DOMContentLoaded', function() {
    // Navbar Scroll Effect
    const header = document.querySelector('.header-main');
    const navbar = document.querySelector('.navbar-primary');
    const logo = document.querySelector('.navbar-primary__logo');
    const navLinks = document.querySelectorAll('.navbar-primary__link');
    const toggleButton = document.getElementById('navbarToggle');
    const navMenu = document.getElementById('navbarMenu');
    
    // Toggle mobile menu
    toggleButton.addEventListener('click', function() {
        this.classList.toggle('navbar-primary__toggle--active');
        navMenu.classList.toggle('navbar-primary__menu--active');
        
        // Toggle body scroll when menu is open
        if (navMenu.classList.contains('navbar-primary__menu--active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });
    
    // Close mobile menu when clicking a link
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navMenu.classList.contains('navbar-primary__menu--active')) {
                toggleButton.classList.remove('navbar-primary__toggle--active');
                navMenu.classList.remove('navbar-primary__menu--active');
                document.body.style.overflow = '';
            }
        });
    });
    
    // Change navbar style on scroll
    function updateNavbarStyle() {
        if (window.scrollY > 100) {
            header.style.background = 'var(--white)';
            navbar.classList.remove('navbar-primary--transparent');
            navbar.classList.add('navbar-primary--solid');
            logo.style.color = 'var(--primary-color)';
            navLinks.forEach(link => {
                link.style.color = 'var(--dark-color)';
            });
            toggleButton.querySelectorAll('.navbar-primary__icon').forEach(icon => {
                icon.style.backgroundColor = 'var(--dark-color)';
            });
        } else {
            header.style.background = 'transparent';
            navbar.classList.add('navbar-primary--transparent');
            navbar.classList.remove('navbar-primary--solid');
            logo.style.color = 'var(--white)';
            navLinks.forEach(link => {
                link.style.color = 'var(--white)';
            });
            toggleButton.querySelectorAll('.navbar-primary__icon').forEach(icon => {
                icon.style.backgroundColor = 'var(--white)';
            });
        }
    }
    
    // Initialize navbar style
    updateNavbarStyle();
    
    window.addEventListener('scroll', updateNavbarStyle);
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideNav = navbar.contains(event.target);
        const isClickOnToggle = toggleButton.contains(event.target);
        
        if (!isClickInsideNav && !isClickOnToggle && 
            navMenu.classList.contains('navbar-primary__menu--active')) {
            toggleButton.classList.remove('navbar-primary__toggle--active');
            navMenu.classList.remove('navbar-primary__menu--active');
            document.body.style.overflow = '';
        }
    });
    // Carousel Functionality
    const slides = document.querySelectorAll('.hero-carousel__slide');
    const indicators = document.querySelectorAll('.hero-carousel__indicator');
    const prevButton = document.querySelector('.hero-carousel__prev');
    const nextButton = document.querySelector('.hero-carousel__next');
    let currentSlide = 0;
    let slideInterval;
    
    // Function to show a specific slide
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('hero-carousel__slide--active', i === index);
        });
        
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('hero-carousel__indicator--active', i === index);
        });
        
        currentSlide = index;
    }
    
    // Function to go to next slide
    function nextSlide() {
        let newIndex = (currentSlide + 1) % slides.length;
        showSlide(newIndex);
    }
    
    // Function to go to previous slide
    function prevSlide() {
        let newIndex = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(newIndex);
    }
    
    // Start auto-sliding
    function startCarousel() {
        slideInterval = setInterval(nextSlide, 5000);
    }
    
    // Stop auto-sliding when user interacts
    function pauseCarousel() {
        clearInterval(slideInterval);
    }
    
    // Event listeners for carousel controls
    nextButton.addEventListener('click', () => {
        pauseCarousel();
        nextSlide();
        startCarousel();
    });
    
    prevButton.addEventListener('click', () => {
        pauseCarousel();
        prevSlide();
        startCarousel();
    });
    
    // Event listeners for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            pauseCarousel();
            showSlide(index);
            startCarousel();
        });
    });
    
    // Initialize carousel
    showSlide(0);
    startCarousel();
    
    // Pause carousel when mouse enters
    document.querySelector('.hero-carousel').addEventListener('mouseenter', pauseCarousel);
    document.querySelector('.hero-carousel').addEventListener('mouseleave', startCarousel);
});
  
// Testimonial Carousel Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Testimonial data
    const testimonials = [
        {
            quote: "Golden Events transformed our wedding into a magical experience. Their team handled everything perfectly, allowing us to enjoy every moment stress-free.",
            name: "Priya & Rahul",
            role: "Wedding Clients",
            rating: 5,
            avatar: "assets/t1.jpg"
        },
        {
            quote: "Our product launch exceeded all expectations. The creative concepts and flawless execution helped us make a huge impact in our industry.",
            name: "Dev3 Solutions",
            role: "Corporate Client",
            rating: 4.5,
            avatar: "assets/t2.jpg"
        },
        {
            quote: "From decorations to catering, everything was perfect for our daughter's birthday. The team's attention to detail was remarkable.",
            name: "The Reddy's Family",
            role: "Birthday Celebration",
            rating: 5,
            avatar: "assets/t3.jpg"
        },
        {
            quote: "The cultural event they organized for our college was spectacular. Professionalism and creativity at its best!",
            name: "Kits College",
            role: "College Event",
            rating: 5,
            avatar: "assets/t4.jpg"
        }
    ];

    // DOM elements
    const carousel = document.getElementById('testimonialCarousel');
    const pagination = document.querySelector('.golden-3d-pagination');
    const prevBtn = document.querySelector('.golden-3d-prev');
    const nextBtn = document.querySelector('.golden-3d-next');

    // Initialize carousel
    let currentIndex = 0;
    
    // Create testimonial items
    function createTestimonials() {
        testimonials.forEach((testimonial, index) => {
            // Create testimonial item
            const item = document.createElement('div');
            item.className = `golden-3d-item ${index === 0 ? 'active' : ''}`;
            
            // Create rating stars
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= testimonial.rating) {
                    stars += '<i class="fas fa-star"></i>';
                } else if (i - 0.5 <= testimonial.rating) {
                    stars += '<i class="fas fa-star-half-alt"></i>';
                } else {
                    stars += '<i class="far fa-star"></i>';
                }
            }
            
            // Item content
            item.innerHTML = `
                <div class="golden-3d-quote">${testimonial.quote}</div>
                <div class="golden-3d-author">
                    <img src="${testimonial.avatar}" alt="${testimonial.name}" class="golden-3d-avatar">
                    <div class="golden-3d-author-info">
                        <div class="golden-3d-name">${testimonial.name}</div>
                        <div class="golden-3d-role">${testimonial.role}</div>
                        <div class="golden-3d-rating">${stars}</div>
                    </div>
                </div>
            `;
            
            carousel.appendChild(item);
            
            // Create pagination dots
            const dot = document.createElement('div');
            dot.className = `golden-3d-dot ${index === 0 ? 'active' : ''}`;
            dot.dataset.index = index;
            pagination.appendChild(dot);
            
            // Dot click event
            dot.addEventListener('click', () => {
                goToTestimonial(index);
            });
        });
    }

    // Navigation functions
    function goToTestimonial(index) {
        const items = document.querySelectorAll('.golden-3d-item');
        const dots = document.querySelectorAll('.golden-3d-dot');
        
        // Update current index
        currentIndex = index;
        
        // Update classes
        items.forEach((item, i) => {
            item.classList.remove('active', 'prev', 'next');
            
            if (i === index) {
                item.classList.add('active');
            } else if (i === (index - 1 + items.length) % items.length) {
                item.classList.add('prev');
            } else if (i === (index + 1) % items.length) {
                item.classList.add('next');
            }
        });
        
        // Update dots
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    function nextTestimonial() {
        goToTestimonial((currentIndex + 1) % testimonials.length);
    }

    function prevTestimonial() {
        goToTestimonial((currentIndex - 1 + testimonials.length) % testimonials.length);
    }

    // Event listeners
    prevBtn.addEventListener('click', prevTestimonial);
    nextBtn.addEventListener('click', nextTestimonial);

    // Auto-rotate
    let autoRotate = setInterval(nextTestimonial, 5000);
    
    // Pause on hover
    carousel.addEventListener('mouseenter', () => {
        clearInterval(autoRotate);
    });
    
    carousel.addEventListener('mouseleave', () => {
        autoRotate = setInterval(nextTestimonial, 5000);
    });

    // Initialize
    createTestimonials();

    // GSAP animations
    gsap.from(".golden-3d-title", {
        duration: 1,
        y: -50,
        opacity: 0,
        ease: "power3.out"
    });

    gsap.from(".golden-3d-subtitle", {
        duration: 1,
        y: 30,
        opacity: 0,
        delay: 0.3,
        ease: "power3.out"
    });

    // Animate particles
    gsap.to("#particle-1", {
        duration: 20,
        x: "+=50",
        y: "+=30",
        rotation: 360,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });

    gsap.to("#particle-2", {
        duration: 25,
        x: "-=70",
        y: "-=20",
        rotation: -360,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });

    gsap.to("#particle-3", {
        duration: 30,
        x: "+=30",
        y: "-=50",
        rotation: 180,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });
});


// Gallery Animation
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Masonry Grid Animation
    const gridItems = document.querySelectorAll('.golden-grid-item');
    
    // Animate each grid item with staggered delay
    gsap.from(gridItems, {
        duration: 1.2,
        y: 50,
        opacity: 0,
        stagger: 0.1,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".golden-gallery",
            start: "top 80%",
            toggleActions: "play none none none"
        }
    });
    
    // Hover effect enhancement
    gridItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            gsap.to(item, {
                duration: 0.6,
                scale: 1.02,
                boxShadow: "0 25px 60px rgba(212, 175, 55, 0.4)",
                ease: "power2.out"
            });
            
            const img = item.querySelector('.golden-grid-img');
            gsap.to(img, {
                duration: 0.8,
                scale: 1.1,
                ease: "power2.out"
            });
        });
        
        item.addEventListener('mouseleave', () => {
            gsap.to(item, {
                duration: 0.6,
                scale: 1,
                boxShadow: "0 10px 30px rgba(0,0,0,0.3)",
                ease: "power2.out"
            });
            
            const img = item.querySelector('.golden-grid-img');
            gsap.to(img, {
                duration: 0.8,
                scale: 1,
                ease: "power2.out"
            });
        });
    });
    
    // Create floating particles
    createParticles();
    
    function createParticles() {
        const gallery = document.querySelector('.golden-gallery');
        const particleCount = 8;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'golden-gallery-particle';
            
            // Random properties
            const size = Math.random() * 100 + 50;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const opacity = Math.random() * 0.3 + 0.1;
            const duration = Math.random() * 20 + 10;
            const delay = Math.random() * 5;
            
            // Apply styles
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
particle.style.top = `${Math.random() * 80}%`; // Keep within 80%
            particle.style.opacity = opacity;
            
            gallery.appendChild(particle);
            
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
});
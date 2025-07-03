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
        navMenu.classList.toggle('navbar-primary__menu--active');
        
        // Animate hamburger icon
        this.classList.toggle('navbar-primary__toggle--active');
    });
    
    // Close mobile menu when clicking a link
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navMenu.classList.contains('navbar-primary__menu--active')) {
                navMenu.classList.remove('navbar-primary__menu--active');
                toggleButton.classList.remove('navbar-primary__toggle--active');
            }
        });
    });
    
    // Change navbar style on scroll
    window.addEventListener('scroll', function() {
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
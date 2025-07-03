 // Set current year
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Scroll to top functionality
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover effects with enhanced animations
        const footerColumns = document.querySelectorAll('.footer-main__column');
        
        footerColumns.forEach(column => {
            column.addEventListener('mouseenter', () => {
                column.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            column.addEventListener('mouseleave', () => {
                column.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Dynamic social link hover effects
        const socialLinks = document.querySelectorAll('.footer-main__social-link');
        
        socialLinks.forEach(link => {
            link.addEventListener('mouseenter', () => {
                const icon = link.querySelector('i');
                icon.style.transform = 'rotate(360deg)';
                icon.style.transition = 'transform 0.5s ease';
            });
            
            link.addEventListener('mouseleave', () => {
                const icon = link.querySelector('i');
                icon.style.transform = 'rotate(0deg)';
            });
        });

        // Add loading animation
        window.addEventListener('load', () => {
            const footer = document.querySelector('.footer-main');
            footer.style.opacity = '0';
            footer.style.transform = 'translateY(50px)';
            footer.style.transition = 'all 0.8s ease';
            
            setTimeout(() => {
                footer.style.opacity = '1';
                footer.style.transform = 'translateY(0)';
            }, 200);
        });

        // Add click analytics (placeholder)
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('footer-main__link') || 
                e.target.classList.contains('footer-main__social-link')) {
                console.log('Footer link clicked:', e.target.href || e.target.closest('a').href);
                // Here you would typically send analytics data
            }
        });

        // Intersection Observer for animation triggers
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        footerColumns.forEach(column => {
            observer.observe(column);
        });

     
document.addEventListener('DOMContentLoaded', function() {
    // Only run on desktop devices
    if (window.innerWidth > 768) {
        const cardSection = document.querySelector('.golden-events-section');
        const cards = document.querySelectorAll('.golden-event-card');
        
        // Three.js Setup
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(60, cardSection.offsetWidth / cardSection.offsetHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(cardSection.offsetWidth, cardSection.offsetHeight);
        renderer.setClearColor(0x000000, 0);
        renderer.domElement.style.position = 'absolute';
        renderer.domElement.style.top = '0';
        renderer.domElement.style.left = '0';
        renderer.domElement.style.zIndex = '0';
        renderer.domElement.style.pointerEvents = 'none';
        cardSection.style.position = 'relative';
        cardSection.insertBefore(renderer.domElement, cardSection.firstChild);
        
        // Celebration Elements
        const elements = [];
        const colors = [
            0xFF5252, 0xFF4081, 0xE040FB, 0x7C4DFF,
            0x536DFE, 0x448AFF, 0x40C4FF, 0x18FFFF,
            0x64FFDA, 0x69F0AE, 0xB2FF59, 0xEEFF41,
            0xFFFF00, 0xFFD740, 0xFFAB40, 0xFF6E40
        ];
        
        // Create Balloons (more visible)
        const balloonGeometry = new THREE.SphereGeometry(0.3, 16, 16);
        const balloonTailGeometry = new THREE.ConeGeometry(0.05, 0.5, 8);
        
        for (let i = 0; i < 30; i++) {
            const color = colors[Math.floor(Math.random() * colors.length)];
            const balloonMaterial = new THREE.MeshPhongMaterial({ 
                color: color,
                shininess: 100,
                transparent: true,
                opacity: 0.9
            });
            
            // Balloon
            const balloon = new THREE.Mesh(balloonGeometry, balloonMaterial);
            
            // Balloon tail
            const tail = new THREE.Mesh(balloonTailGeometry, new THREE.MeshBasicMaterial({ color: 0xffffff }));
            tail.position.y = -0.4;
            tail.rotation.x = Math.PI;
            
            // Group them together
            const balloonGroup = new THREE.Group();
            balloonGroup.add(balloon);
            balloonGroup.add(tail);
            
            // Position
            balloonGroup.position.set(
                Math.random() * 12 - 6,
                Math.random() * 8 - 4,
                Math.random() * -20
            );
            
            // Animation properties
            balloonGroup.userData = {
                speedY: 0.02 + Math.random() * 0.03,
                rotationSpeed: (Math.random() - 0.5) * 0.02,
                floatHeight: 0.5 + Math.random()
            };
            
            scene.add(balloonGroup);
            elements.push(balloonGroup);
        }
        
        // Add Confetti Particles
        const confettiGeometry = new THREE.BufferGeometry();
        const confettiCount = 200;
        const positions = new Float32Array(confettiCount * 3);
        const sizes = new Float32Array(confettiCount);
        
        for (let i = 0; i < confettiCount; i++) {
            positions[i * 3] = Math.random() * 10 - 5;
            positions[i * 3 + 1] = Math.random() * 10 - 5;
            positions[i * 3 + 2] = Math.random() * -20;
            sizes[i] = 0.1 + Math.random() * 0.2;
        }
        
        confettiGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        confettiGeometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
        
        const confettiMaterial = new THREE.PointsMaterial({
            color: 0xffffff,
            size: 0.2,
            transparent: true,
            opacity: 0.8,
            blending: THREE.AdditiveBlending
        });
        
        const confetti = new THREE.Points(confettiGeometry, confettiMaterial);
        scene.add(confetti);
        elements.push(confetti);
        
        // Add lighting
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(1, 1, 1);
        scene.add(directionalLight);
        
        camera.position.z = 5;
        
        // Burst animation variables
        let burstActive = false;
        let burstTime = 0;
        const burstDuration = 3; // seconds
        const burstParticles = [];
        
        // Create burst particles
        function createBurst() {
            burstActive = true;
            burstTime = 0;
            
            // Remove old burst particles
            burstParticles.forEach(p => scene.remove(p));
            burstParticles.length = 0;
            
            // Create new burst
            const burstGeometry = new THREE.BufferGeometry();
            const burstCount = 100;
            const burstPositions = new Float32Array(burstCount * 3);
            const burstSizes = new Float32Array(burstCount);
            const burstColors = new Float32Array(burstCount * 3);
            
            for (let i = 0; i < burstCount; i++) {
                burstPositions[i * 3] = 0;
                burstPositions[i * 3 + 1] = 0;
                burstPositions[i * 3 + 2] = 0;
                
                burstSizes[i] = 0.2 + Math.random() * 0.3;
                
                const color = colors[Math.floor(Math.random() * colors.length)];
                burstColors[i * 3] = (color >> 16 & 255) / 255;
                burstColors[i * 3 + 1] = (color >> 8 & 255) / 255;
                burstColors[i * 3 + 2] = (color & 255) / 255;
            }
            
            burstGeometry.setAttribute('position', new THREE.BufferAttribute(burstPositions, 3));
            burstGeometry.setAttribute('size', new THREE.BufferAttribute(burstSizes, 1));
            burstGeometry.setAttribute('color', new THREE.BufferAttribute(burstColors, 3));
            
            const burstMaterial = new THREE.PointsMaterial({
                size: 0.3,
                vertexColors: true,
                transparent: true,
                opacity: 1,
                blending: THREE.AdditiveBlending
            });
            
            const burst = new THREE.Points(burstGeometry, burstMaterial);
            burst.userData = {
                velocities: Array.from({ length: burstCount }, () => ({
                    x: (Math.random() - 0.5) * 0.2,
                    y: (Math.random() - 0.5) * 0.2,
                    z: (Math.random() - 0.5) * 0.2
                })),
                startTime: Date.now()
            };
            
            scene.add(burst);
            burstParticles.push(burst);
        }
        
        // Random bursts
        setInterval(createBurst, 5000);
        
        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            
            // Animate balloons
            elements.forEach(element => {
                if (element instanceof THREE.Group) {
                    // Balloon floating
                    element.position.y += element.userData.speedY;
                    element.rotation.y += element.userData.rotationSpeed;
                    
                    // Reset if too high
                    if (element.position.y > element.userData.floatHeight) {
                        element.position.y = -element.userData.floatHeight;
                        element.position.x = Math.random() * 12 - 6;
                    }
                }
            });
            
            // Animate burst
            if (burstActive) {
                burstTime += 0.016; // assuming ~60fps
                
                burstParticles.forEach(burst => {
                    const positions = burst.geometry.attributes.position.array;
                    const elapsed = (Date.now() - burst.userData.startTime) / 1000;
                    const progress = elapsed / burstDuration;
                    
                    for (let i = 0; i < burst.geometry.attributes.position.count; i++) {
                        const vel = burst.userData.velocities[i];
                        positions[i * 3] += vel.x;
                        positions[i * 3 + 1] += vel.y;
                        positions[i * 3 + 2] += vel.z;
                        
                        // Apply gravity
                        positions[i * 3 + 1] -= 0.01;
                        
                        // Fade out
                        if (progress > 0.5) {
                            burst.material.opacity = 1 - (progress - 0.5) * 2;
                        }
                    }
                    
                    burst.geometry.attributes.position.needsUpdate = true;
                });
                
                if (burstTime > burstDuration) {
                    burstActive = false;
                }
            }
            
            renderer.render(scene, camera);
        }
        
        animate();
        
        // Handle window resize
        window.addEventListener('resize', function() {
            camera.aspect = cardSection.offsetWidth / cardSection.offsetHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(cardSection.offsetWidth, cardSection.offsetHeight);
        });
        
        // Ensure cards stay above the Three.js canvas
        cards.forEach(card => {
            card.style.position = 'relative';
            card.style.zIndex = '1';
            card.style.backgroundColor = 'rgba(255, 255, 255, 0.85)';
        });
    }
});

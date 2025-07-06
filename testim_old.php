<?php
// Database configuration
class DatabaseConfig {
    private $host = 'localhost';
    private $dbname = 'ems';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}",
                $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createTable();
        } catch(PDOException $e) {
            die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]));
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            image_name VARCHAR(255) NOT NULL,
            file_path VARCHAR(500) NOT NULL,
            description TEXT,
            star_rating DECIMAL(2,1) DEFAULT 5.0,
            upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        try {
            $this->pdo->exec($sql);
            $this->pdo->exec("ALTER TABLE images ADD COLUMN IF NOT EXISTS star_rating DECIMAL(2,1) DEFAULT 5.0");
        } catch(PDOException $e) {
            throw new Exception('Failed to create table: ' . $e->getMessage());
        }
    }
}

// ImageManager class
class ImageManager {
    private $pdo;
    private $uploadDir = 'uploads/';

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->createUploadDirectory();
    }

    private function createUploadDirectory() {
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    private function generateAltText($imageName) {
        $words = explode(' ', trim($imageName));
        return !empty($words[0]) ? $words[0] : 'testimonial';
    }

    public function getAllImages() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM images ORDER BY upload_date DESC");
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($images as &$image) {
                $image['alt_text'] = $this->generateAltText($image['image_name']);
            }
            return $images;
        } catch(PDOException $e) {
            throw new Exception('Failed to fetch images: ' . $e->getMessage());
        }
    }
}

// ResponseHandler class
class ResponseHandler {
    public static function jsonResponse($success, $message, $data = null) {
        header('Content-Type: application/json');
        $response = ['success' => $success, 'message' => $message];
        if ($data !== null) {
            $response['data'] = $data;
        }
        echo json_encode($response);
        exit;
    }
}

// Initialize here
$db = new DatabaseConfig();
$imageManager = new ImageManager($db->getConnection());

// Fetch testimonials now
$testimonials = $imageManager->getAllImages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                       <img src="admin_testimonial/<?= htmlspecialchars($testimonial['file_path']) ?>">
 
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


    <!-- Video Testimonials -->
    <!-- <section class="video-testimonials">
        <div class="video-testimonials-container">
            <h2 class="section-title">Video Testimonials</h2>
            
            <div class="video-grid">
                <!-- Video 1 --
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
                
                <!-- Video 2 --
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
                
                <!-- Video 3 --
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
    </section> -->

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



<!-- <At index testimonials -->
 <?php
require_once 'config.php';

// Fetch latest 5 testimonials
$stmt = $db->getConnection()->prepare("SELECT * FROM images ORDER BY upload_date DESC LIMIT 5");
$stmt->execute();
$latestTestimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate alt text
foreach ($latestTestimonials as &$t) {
    $t['alt_text'] = explode(' ', trim($t['image_name']))[0] ?: 'testimonial';
}
?>

<body>
<?php include 'header.php'; ?>
    <!-- Full-screen Carousel -->
    <section class="hero-carousel" id="home">
        <div class="hero-carousel__slides">
            <!-- Slide 1 -->
            <div class="hero-carousel__slide hero-carousel__slide--active">
                <div class="hero-carousel__image" style="background-image: url('assets/img1.png');"></div>
                <div class="hero-carousel__content">
                    <h1 class="hero-carousel__title">Corporate Event Specialists</h1>
                    <p class="hero-carousel__subtitle">Creating memorable experiences for your business</p>
                    <a href="contact.php" class="hero-carousel__button">Plan Your Event</a>
                </div>
                <div class="hero-carousel__event-label">
                    <span>Annual Conferences</span>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="hero-carousel__slide">
                <div class="hero-carousel__image" style="background-image: url('assets/img2.png');"></div>
                <div class="hero-carousel__content">
                    <h1 class="hero-carousel__title">Wedding Planning Experts</h1>
                    <p class="hero-carousel__subtitle">Making your special day unforgettable</p>
                    <a href="contact.php" class="hero-carousel__button">Plan Your Wedding</a>
                </div>
                <div class="hero-carousel__event-label">
                    <span>Weddings & Receptions</span>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="hero-carousel__slide">
                <div class="hero-carousel__image" style="background-image: url('assets/img3.png');"></div>
                <div class="hero-carousel__content">
                    <h1 class="hero-carousel__title">Product Launch Professionals</h1>
                    <p class="hero-carousel__subtitle">Making your product shine in the market</p>
                    <a href="contact.php" class="hero-carousel__button">Launch With Us</a>
                </div>
                <div class="hero-carousel__event-label">
                    <span>Product Launches</span>
                </div>
            </div>
        </div>
        
        <div class="hero-carousel__controls">
            <button class="hero-carousel__prev" aria-label="Previous slide">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="hero-carousel__next" aria-label="Next slide">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        
        <div class="hero-carousel__indicators">
            <button class="hero-carousel__indicator hero-carousel__indicator--active" aria-label="Slide 1"></button>
            <button class="hero-carousel__indicator" aria-label="Slide 2"></button>
            <button class="hero-carousel__indicator" aria-label="Slide 3"></button>
        </div>
    </section>
<!-- Events Section -->
<section class="golden-events-section">
    <div class="golden-container">
        <h2 class="golden-section-title">Our Event Specialties</h2>
        <p class="golden-section-subtitle">We make your special occasions truly memorable</p>
        
        <div class="golden-events-grid">
            <!-- Card 1 -->
            <div class="golden-event-card golden-card-marriage">
                <div class="golden-card-icon">
                    <i class="fas fa-ring"></i>
                </div>
                <h3 class="golden-card-title">Marriage</h3>
                <p class="golden-card-text">Complete wedding planning with traditional and modern themes</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Food</span>
                    <span class="golden-service-tag">Photography</span>
                    <span class="golden-service-tag">Decoration</span>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="golden-event-card golden-card-birthday">
                <div class="golden-card-icon">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <h3 class="golden-card-title">Birthday Party</h3>
                <p class="golden-card-text">Themed birthday parties for all ages with customized cakes</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Catering</span>
                    <span class="golden-service-tag">Entertainment</span>
                    <span class="golden-service-tag">Sound System</span>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="golden-event-card golden-card-together">
                <div class="golden-card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="golden-card-title">Get Togethers</h3>
                <p class="golden-card-text">Perfect arrangements for family and friend reunions</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Food</span>
                    <span class="golden-service-tag">Venue</span>
                    <span class="golden-service-tag">Music</span>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="golden-event-card golden-card-school">
                <div class="golden-card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="golden-card-title">School/College Functions</h3>
                <p class="golden-card-text">Annual days, cultural events and graduation ceremonies</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Stage Setup</span>
                    <span class="golden-service-tag">Sound System</span>
                    <span class="golden-service-tag">Photography</span>
                </div>
            </div>
            
            <!-- Card 5 -->
            <div class="golden-event-card golden-card-house">
                <div class="golden-card-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="golden-card-title">House Warming</h3>
                <p class="golden-card-text">Traditional house warming ceremonies with modern touch</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Pooja Arrangements</span>
                    <span class="golden-service-tag">Catering</span>
                    <span class="golden-service-tag">Decoration</span>
                </div>
            </div>
            
            <!-- Card 6 -->
            <div class="golden-event-card golden-card-sangeeth">
                <div class="golden-card-icon">
                    <i class="fas fa-music"></i>
                </div>
                <h3 class="golden-card-title">Sangeeth</h3>
                <p class="golden-card-text">Vibrant musical nights with dance performances</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">DJ</span>
                    <span class="golden-service-tag">Lighting</span>
                    <span class="golden-service-tag">Stage</span>
                </div>
            </div>
            
            <!-- Card 7 -->
            <div class="golden-event-card golden-card-haldi">
                <div class="golden-card-icon">
                    <i class="fas fa-spa"></i>
                </div>
                <h3 class="golden-card-title">Haldi</h3>
                <p class="golden-card-text">Traditional haldi ceremony with floral decorations</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Rituals</span>
                    <span class="golden-service-tag">Photography</span>
                    <span class="golden-service-tag">Makeup</span>
                </div>
            </div>
            
            <!-- Card 8 -->
            <div class="golden-event-card golden-card-mehandi">
                <div class="golden-card-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="golden-card-title">Mehandi</h3>
                <p class="golden-card-text">Beautiful mehandi designs with cultural performances</p>
                <div class="golden-card-services">
                    <span class="golden-service-tag">Artists</span>
                    <span class="golden-service-tag">Music</span>
                    <span class="golden-service-tag">Food</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials Section -->
<!-- Testimonials Section -->
<section class="golden-testimonials-3d" id="testimonials">
    <div class="golden-3d-container">
        <h2 class="golden-3d-title">Voices of <span class="golden-text-gradient">Delight</span></h2>
        <p class="golden-3d-subtitle">Where Memories Become Testimonials</p>
        
       <div class="golden-3d-carousel" id="testimonialCarousel">
<?php
if (empty($latestTestimonials)) {
    echo '<p class="text-muted">No testimonials available yet.</p>';
} else {
    foreach ($latestTestimonials as $index => $testimonial):
        $fullStars = floor($testimonial['star_rating']);
        $hasHalf = ($testimonial['star_rating'] - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($hasHalf ? 1 : 0);
?>
    <div class="golden-3d-item <?= $index === 0 ? 'active' : '' ?>">
        <div class="golden-3d-quote">
            <?= htmlspecialchars($testimonial['description'] ?: 'No description provided.') ?>
        </div>
        <div class="golden-3d-author">
            <img src="admin_testimonial/<?= htmlspecialchars($testimonial['file_path']) ?>"
                 alt="<?= htmlspecialchars($testimonial['alt_text']) ?>"
                 class="golden-3d-avatar">
            <div class="golden-3d-author-info">
                <div class="golden-3d-name"><?= htmlspecialchars($testimonial['image_name']) ?></div>
                <div class="golden-3d-role">Client Testimonial</div>
                <div class="golden-3d-rating">
                    <?php
                    for ($i = 0; $i < $fullStars; $i++) echo '<i class="fas fa-star"></i>';
                    if ($hasHalf) echo '<i class="fas fa-star-half-alt"></i>';
                    for ($i = 0; $i < $emptyStars; $i++) echo '<i class="far fa-star"></i>';
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
    endforeach;
}
?>
</div>

        
        <div class="golden-3d-nav">
            <button class="golden-3d-prev"><i class="fas fa-chevron-left"></i></button>
            <div class="golden-3d-pagination"></div>
            <button class="golden-3d-next"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
    
    <!-- Floating decorative elements -->
    <div class="golden-3d-particle" id="particle-1"></div>
    <div class="golden-3d-particle" id="particle-2"></div>
    <div class="golden-3d-particle" id="particle-3"></div>
</section>
    <!-- Rest of your content sections will go here -->
    <!-- Gallery Section -->
<section class="golden-gallery" id="gallery">
    <div class="golden-gallery-container">
        <h2 class="golden-gallery-title">Our <span class="golden-sparkle">Memories</span></h2>
        <p class="golden-gallery-subtitle">Capturing moments that last lifetimes</p>
        
        <div class="golden-grid-masonry">
            <!-- Grid Item 1 (Large) -->
            <div class="golden-grid-item golden-grid-item--wide">
                <img src="assets/t1.jpg" alt="Grand Wedding" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Royal Wedding</h3>
                        <p class="golden-grid-description">500+ guests · Taj Palace</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 2 (Tall) -->
            <div class="golden-grid-item golden-grid-item--tall">
                <img src="assets/t2.jpg" alt="Corporate Event" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Tech Conference</h3>
                        <p class="golden-grid-description">Bangalore · 2023</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 3 (Small) -->
            <div class="golden-grid-item">
                <img src="assets/gallery/birthday-1.jpg" alt="Birthday Party" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Sweet 16</h3>
                        <p class="golden-grid-description">Themed Party</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 4 (Medium) -->
            <div class="golden-grid-item">
                <img src="assets/gallery/sangeet-1.jpg" alt="Sangeet Night" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Sangeet Night</h3>
                        <p class="golden-grid-description">Live Performances</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 5 (Medium) -->
            <div class="golden-grid-item">
                <img src="assets/gallery/product-1.jpg" alt="Product Launch" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Product Launch</h3>
                        <p class="golden-grid-description">VR Experience</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 6 (Tall) -->
            <div class="golden-grid-item golden-grid-item--tall">
                <img src="assets/gallery/haldi-1.jpg" alt="Haldi Ceremony" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Haldi Ceremony</h3>
                        <p class="golden-grid-description">Traditional Rituals</p>
                    </div>
                </div>
            </div>
            
            <!-- Grid Item 7 (Wide) -->
            <div class="golden-grid-item golden-grid-item--wide">
                <img src="assets/gallery/reception-1.jpg" alt="Reception" class="golden-grid-img">
                <div class="golden-grid-overlay">
                    <div class="golden-grid-content">
                        <h3 class="golden-grid-caption">Grand Reception</h3>
                        <p class="golden-grid-description">500+ guests</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="golden-gallery-cta">
            <a href="#" class="golden-view-more">View Full Portfolio <i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
</section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <!-- Add these before your existing scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <?php include 'footer.php'; ?>    
</body>

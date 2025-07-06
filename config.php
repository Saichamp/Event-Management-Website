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
<?php
// config.php - Database configuration
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
        
        // Add star_rating column if it doesn't exist (for existing databases)
        $this->pdo->exec("ALTER TABLE images ADD COLUMN IF NOT EXISTS star_rating DECIMAL(2,1) DEFAULT 5.0");
    } catch(PDOException $e) {
        throw new Exception('Failed to create table: ' . $e->getMessage());
    }
    }
}

// ImageManager.php - Main image management class
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
            
            // Generate alt text for each image
            foreach ($images as &$image) {
                $image['alt_text'] = $this->generateAltText($image['image_name']);
            }
            
            return $images;
        } catch(PDOException $e) {
            throw new Exception('Failed to fetch images: ' . $e->getMessage());
        }
    }
    
    public function addImage($imageName, $file, $description = '', $starRating = 5.0) {
        // Validate input
        if (empty($imageName) || empty($file['name'])) {
            throw new Exception('Image name and file are required.');
        }
        
        // Validate star rating
        $starRating = floatval($starRating);
        if ($starRating < 1 || $starRating > 5) {
            throw new Exception('Star rating must be between 1 and 5.');
        }
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.');
        }
        
        // Validate file size (10MB max)
        if ($file['size'] > 10 * 1024 * 1024) {
            throw new Exception('File size too large. Maximum 10MB allowed.');
        }
        
        // Generate unique filename
        $fileName = time() . '_' . basename($file['name']);
        $filePath = $this->uploadDir . $fileName;
        
        // Upload file
        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new Exception('Failed to upload file.');
        }
        
        try {
            $stmt = $this->pdo->prepare("INSERT INTO images (image_name, file_path, description, star_rating) VALUES (?, ?, ?, ?)");
            $stmt->execute([$imageName, $filePath, $description, $starRating]);
            return true;
        } catch(PDOException $e) {
            // Clean up uploaded file if database insert fails
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }
    
    public function updateImage($id, $imageName, $description = '', $starRating = 5.0) {
        if (empty($imageName) || empty($id)) {
            throw new Exception('Image name and ID are required.');
        }
        
        // Validate star rating
        $starRating = floatval($starRating);
        if ($starRating < 1 || $starRating > 5) {
            throw new Exception('Star rating must be between 1 and 5.');
        }
        
        try {
            $stmt = $this->pdo->prepare("UPDATE images SET image_name = ?, description = ?, star_rating = ? WHERE id = ?");
            $stmt->execute([$imageName, $description, $starRating, $id]);
            return true;
        } catch(PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }
    
    public function deleteImage($id) {
        if (empty($id)) {
            throw new Exception('Image ID is required.');
        }
        
        try {
            // Get file path before deleting record
            $stmt = $this->pdo->prepare("SELECT file_path FROM images WHERE id = ?");
            $stmt->execute([$id]);
            $image = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$image) {
                throw new Exception('Image not found.');
            }
            
            // Delete file
            if (file_exists($image['file_path'])) {
                unlink($image['file_path']);
            }
            
            // Delete database record
            $stmt = $this->pdo->prepare("DELETE FROM images WHERE id = ?");
            $stmt->execute([$id]);
            
            return true;
        } catch(PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }
}

// Response handler
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

// Initialize application
$db = new DatabaseConfig();
$imageManager = new ImageManager($db->getConnection());

// Handle AJAX requests for getting images
if (isset($_GET['ajax'])) {
    try {
        $images = $imageManager->getAllImages();
        header('Content-Type: application/json');
        echo json_encode($images);
    } catch(Exception $e) {
        ResponseHandler::jsonResponse(false, $e->getMessage());
    }
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    try {
        switch ($action) {
            case 'add':
                $imageManager->addImage(
                    $_POST['image_name'],
                    $_FILES['image_file'],
                    $_POST['description'] ?? '',
                    $_POST['star_rating'] ?? 5.0
                );
                ResponseHandler::jsonResponse(true, 'Image uploaded successfully!');
                break;
                
            case 'edit':
                $imageManager->updateImage(
                    $_POST['image_id'],
                    $_POST['image_name'],
                    $_POST['description'] ?? '',
                    $_POST['star_rating'] ?? 5.0
                );
                ResponseHandler::jsonResponse(true, 'Image updated successfully!');
                break;
                
            case 'delete':
                $imageManager->deleteImage($_POST['image_id']);
                ResponseHandler::jsonResponse(true, 'Image deleted successfully!');
                break;
                
            default:
                ResponseHandler::jsonResponse(false, 'Invalid action.');
        }
    } catch(Exception $e) {
        ResponseHandler::jsonResponse(false, $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Events - Testimonial Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #fdcb6e;
            --primary-black: #2d3436;
            --primary-white: #ffffff;
            --secondary-gray: #636e72;
            --light-gray: #f8f9fa;
            --dark-gray: #495057;
        }

        body {
            background: linear-gradient(135deg, var(--light-gray) 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-black) 0%, var(--dark-gray) 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: var(--primary-white);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-gold) 0%, #f39c12 100%);
            border-radius: 15px 15px 0 0 !important;
            border: none;
            color: var(--primary-black);
            font-weight: 600;
        }

        .card-header.bg-success {
            background: linear-gradient(135deg, var(--primary-black) 0%, var(--dark-gray) 100%) !important;
            color: var(--primary-white);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-gold) 0%, #f39c12 100%);
            border: none;
            color: var(--primary-black);
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #f39c12 0%, var(--primary-gold) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(253, 203, 110, 0.3);
            color: var(--primary-black);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-gray) 0%, var(--dark-gray) 100%);
            border: none;
            color: var(--primary-white);
            font-weight: 600;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, var(--dark-gray) 0%, var(--primary-black) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            color: var(--primary-white);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-gold);
            color: var(--primary-gold);
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-gold);
            color: var(--primary-black);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(253, 203, 110, 0.3);
        }

        .btn-outline-danger {
            border: 2px solid #e74c3c;
            color: #e74c3c;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background: #e74c3c;
            color: var(--primary-white);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.3);
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(253, 203, 110, 0.25);
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 15px;
            border: 3px solid var(--primary-gold);
            transition: all 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .image-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .image-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .image-card .card-img-top {
            border-radius: 15px 15px 0 0;
            transition: all 0.3s ease;
        }

        .image-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .upload-area {
            border: 3px dashed var(--primary-gold);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        }

        .upload-area:hover {
            border-color: #f39c12;
            background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(253, 203, 110, 0.2);
        }

        .upload-area.dragover {
            border-color: #f39c12;
            background: linear-gradient(135deg, rgba(253, 203, 110, 0.1) 0%, rgba(243, 156, 18, 0.1) 100%);
            transform: scale(1.02);
        }

        .alert-fixed {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            border-radius: 10px;
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .alert-success {
            background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
            color: var(--primary-white);
        }

        .alert-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: var(--primary-white);
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
        }

        .modal-header.bg-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%) !important;
            border-radius: 15px 15px 0 0;
            border: none;
        }

        .page-title {
            background: linear-gradient(135deg, var(--primary-gold) 0%, #f39c12 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            text-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .spinner-border {
            color: var(--primary-gold);
        }

        .text-muted {
            color: var(--secondary-gray) !important;
        }

        .card-footer {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 0 0 15px 15px;
            border: none;
        }

        @media (max-width: 768px) {
            .card-header h5 {
                font-size: 1rem;
            }
            
            .btn {
                padding: 8px 16px;
                font-size: 0.9rem;
            }
            
            .image-preview {
                max-width: 150px;
                max-height: 150px;
            }
            
            .upload-area {
                padding: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding: 1rem;
            }
            
            .card {
                margin-bottom: 1rem;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .btn-group .btn {
                border-radius: 8px !important;
                margin-bottom: 0.25rem;
            }
        }
        /* Star Rating System CSS */
            .star-rating {
                display: flex;
                align-items: center;
                gap: 5px;
                margin: 10px 0;
            }

            .star-rating .star {
                font-size: 1.2em;
                color: #ddd;
                transition: color 0.2s ease;
            }

            .star-rating .star.filled {
                color: var(--primary-gold);
            }

            .star-rating .star.half {
                background: linear-gradient(90deg, var(--primary-gold) 50%, #ddd 50%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .star-rating-display {
                display: flex;
                align-items: center;
                gap: 8px;
                margin: 8px 0;
            }

            .star-rating-display .stars {
                display: flex;
                gap: 2px;
            }

            .star-rating-display .star {
                font-size: 1.1em;
                color: #ddd;
            }

            .star-rating-display .star.filled {
                color: var(--primary-gold);
                text-shadow: 0 0 3px rgba(253, 203, 110, 0.5);
            }

            .star-rating-display .star.half {
                position: relative;
                color: #ddd;
            }

            .star-rating-display .star.half::before {
                content: "★";
                position: absolute;
                left: 0;
                color: var(--primary-gold);
                width: 50%;
                overflow: hidden;
                text-shadow: 0 0 3px rgba(253, 203, 110, 0.5);
            }

            .star-rating-display .rating-text {
                font-size: 0.9em;
                color: var(--secondary-gray);
                font-weight: 500;
            }

            .form-select {
                border-radius: 10px;
                border: 2px solid #e9ecef;
                padding: 12px 15px;
                transition: all 0.3s ease;
                background-color: white;
            }

            .form-select:focus {
                border-color: var(--primary-gold);
                box-shadow: 0 0 0 0.2rem rgba(253, 203, 110, 0.25);
            }

            .star-preview {
                background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
                border: 2px solid var(--primary-gold);
                border-radius: 10px;
                padding: 15px;
                margin-top: 10px;
                text-align: center;
            }

            .star-preview .preview-stars {
                font-size: 1.5em;
                margin-bottom: 5px;
            }

            .star-preview .preview-text {
                font-size: 0.9em;
                color: var(--secondary-gray);
                font-weight: 500;
            }

            /* Card rating badge */
            .rating-badge {
                position: absolute;
                top: 10px;
                right: 10px;
                background: linear-gradient(135deg, var(--primary-gold) 0%, #f39c12 100%);
                color: var(--primary-black);
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 0.8em;
                font-weight: 600;
                box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                z-index: 10;
            }

            .image-card {
                position: relative;
            }

            .image-card .card-img-top {
                position: relative;
            }

            /* Star rating in card footer */
            .card-footer .star-rating-display {
                justify-content: center;
                margin: 10px 0;
                padding: 10px;
                background: linear-gradient(135deg, rgba(253, 203, 110, 0.1) 0%, rgba(243, 156, 18, 0.1) 100%);
                border-radius: 8px;
            }

            .card-footer .star-rating-display .stars {
                gap: 3px;
            }

            .card-footer .star-rating-display .star {
                font-size: 1.2em;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .star-rating {
                    justify-content: center;
                }
                
                .star-rating-display {
                    flex-direction: column;
                    gap: 5px;
                    text-align: center;
                }
                
                .star-preview .preview-stars {
                    font-size: 1.3em;
                }
                
                .rating-badge {
                    top: 8px;
                    right: 8px;
                    padding: 4px 8px;
                    font-size: 0.75em;
                }
            }

            @media (max-width: 576px) {
                .star-rating-display .stars {
                    justify-content: center;
                }
                
                .star-preview {
                    padding: 10px;
                }
                
                .card-footer .star-rating-display {
                    margin: 5px 0;
                    padding: 8px;
                }
            }
    </style>
</head>
<body>
   
     <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="text-center mb-4 page-title">
                <i class="fas fa-images"></i> Golden Events Testimonial Management System
            </h2>
            <!-- Logout Button in the Navbar -->
            <button class="btn btn-outline-danger" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </div>

        <!-- Add/Edit Form -->
        <div class="row mb-4">
            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-plus"></i> 
                            <span id="form-title">Add New Image</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="imageForm" enctype="multipart/form-data">
                            <input type="hidden" id="image_id" name="image_id">
                            <input type="hidden" id="action" name="action" value="add">
                            
                            <div class="mb-3">
                                <label for="image_name" class="form-label">Image Name *</label>
                                <input type="text" class="form-control" id="image_name" name="image_name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" 
                                          placeholder="Testimonial description..."></textarea>
                            </div>
                            <div class="mb-3">
                            <label for="star_rating" class="form-label">Star Rating *</label>
                            <select class="form-select" id="star_rating" name="star_rating" required>
                                <option value="1">1 Star ⭐</option>
                                <option value="1.5">1.5 Stars ⭐</option>
                                <option value="2">2 Stars ⭐⭐</option>
                                <option value="2.5">2.5 Stars ⭐⭐</option>
                                <option value="3">3 Stars ⭐⭐⭐</option>
                                <option value="3.5">3.5 Stars ⭐⭐⭐</option>
                                <option value="4">4 Stars ⭐⭐⭐⭐</option>
                                <option value="4.5">4.5 Stars ⭐⭐⭐⭐</option>
                                <option value="5" selected>5 Stars ⭐⭐⭐⭐⭐</option>
                            </select>
                            <div class="star-preview" id="starPreview">
                                <div class="preview-stars" id="previewStars">⭐⭐⭐⭐⭐</div>
                                <div class="preview-text" id="previewText">5.0 out of 5 stars</div>
                            </div>
                        </div>
                            <div class="mb-3" id="file-upload-section">
                                <label for="image_file" class="form-label">Image File *</label>
                                <div class="upload-area" id="uploadArea">
                                    <input type="file" class="form-control" id="image_file" name="image_file" 
                                           accept="image/*" style="display: none;" required>
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="mb-0">Click to select or drag & drop an image</p>
                                    <small class="text-muted">JPG, PNG, GIF, WebP up to 10MB</small>
                                </div>
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="previewImg" class="image-preview" alt="Preview">
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> 
                                    <span id="submit-text">Add Image</span>
                                </button>
                                <button type="button" class="btn btn-secondary" id="cancelBtn" style="display: none;">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Testimonial List -->
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-success">
                        <h5 class="mb-0">
                            <i class="fas fa-list"></i> Testimonial testimonial
                        </h5>
                        <button class="btn btn-light btn-sm float-end" id="refreshBtn">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="imagesContainer" class="row">
                            <div class="col-12 text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-trash"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this image? This action cannot be undone.</p>
                    <div class="text-center">
                        <img id="deletePreviewImg" class="image-preview" alt="Delete Preview">
                        <p class="mt-2"><strong id="deleteImageName"></strong></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
<script>
    class ImageManagementApp {
    constructor() {
        this.deleteImageId = null;
        this.deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        this.initializeEventListeners();
        this.loadImages();
    }

    initializeEventListeners() {
        // File upload handling
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('image_file');
        
        uploadArea.addEventListener('click', () => fileInput.click());
        uploadArea.addEventListener('dragover', this.handleDragOver.bind(this));
        uploadArea.addEventListener('dragleave', this.handleDragLeave.bind(this));
        uploadArea.addEventListener('drop', this.handleDrop.bind(this));
        fileInput.addEventListener('change', this.handleFileSelect.bind(this));

        // Form submission
        document.getElementById('imageForm').addEventListener('submit', this.handleFormSubmit.bind(this));
        
        // Cancel edit
        document.getElementById('cancelBtn').addEventListener('click', this.resetForm.bind(this));
        
        // Refresh button
        document.getElementById('refreshBtn').addEventListener('click', this.loadImages.bind(this));
        
        // Delete confirmation
        document.getElementById('confirmDeleteBtn').addEventListener('click', this.confirmDelete.bind(this));
        
        // Star rating preview
        document.getElementById('star_rating').addEventListener('change', this.updateStarPreview.bind(this));
        
        // Logout button
        document.getElementById('logoutBtn').addEventListener('click', this.handleLogout.bind(this));
        
        // Initialize star preview
        this.updateStarPreview();
    }

    handleDragOver(e) {
        e.preventDefault();
        document.getElementById('uploadArea').classList.add('dragover');
    }

    handleDragLeave(e) {
        e.preventDefault();
        document.getElementById('uploadArea').classList.remove('dragover');
    }

    handleDrop(e) {
        e.preventDefault();
        const uploadArea = document.getElementById('uploadArea');
        uploadArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const fileInput = document.getElementById('image_file');
            fileInput.files = files;
            this.handleFileSelect();
        }
    }

    handleFileSelect() {
        const fileInput = document.getElementById('image_file');
        const file = fileInput.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewImg = document.getElementById('previewImg');
                const imagePreview = document.getElementById('imagePreview');
                
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    updateStarPreview() {
        const starRating = document.getElementById('star_rating');
        const previewStars = document.getElementById('previewStars');
        const previewText = document.getElementById('previewText');
        
        if (starRating && previewStars && previewText) {
            const rating = parseFloat(starRating.value);
            const stars = this.generateStarDisplay(rating);
            
            previewStars.innerHTML = stars;
            previewText.textContent = `${rating} out of 5 stars`;
        }
    }

    generateStarDisplay(rating) {
        const fullStars = Math.floor(rating);
        const hasHalfStar = rating % 1 !== 0;
        const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
        
        let stars = '';
        
        // Full stars
        for (let i = 0; i < fullStars; i++) {
            stars += '<span class="star filled">⭐</span>';
        }
        
        // Half star
        if (hasHalfStar) {
            stars += '<span class="star half">⭐</span>';
        }
        
        // Empty stars
        for (let i = 0; i < emptyStars; i++) {
            stars += '<span class="star empty">☆</span>';
        }
        
        return stars;
    }

    async handleFormSubmit(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showAlert('success', data.message);
                this.resetForm();
                this.loadImages();
            } else {
                this.showAlert('danger', data.message);
            }
        } catch (error) {
            this.showAlert('danger', 'An error occurred: ' + error.message);
        } finally {
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    resetForm() {
        const form = document.getElementById('imageForm');
        if (form) form.reset();
        
        const imageIdEl = document.getElementById('image_id');
        const actionEl = document.getElementById('action');
        const formTitleEl = document.getElementById('form-title');
        const submitTextEl = document.getElementById('submit-text');
        const cancelBtnEl = document.getElementById('cancelBtn');
        const fileUploadSectionEl = document.getElementById('file-upload-section');
        const imagePreviewEl = document.getElementById('imagePreview');
        const imageFileEl = document.getElementById('image_file');
        const starRatingEl = document.getElementById('star_rating');

        if (imageIdEl) imageIdEl.value = '';
        if (actionEl) actionEl.value = 'add';
        if (formTitleEl) formTitleEl.textContent = 'Add New Image';
        if (submitTextEl) submitTextEl.textContent = 'Add Image';
        if (cancelBtnEl) cancelBtnEl.style.display = 'none';
        if (fileUploadSectionEl) fileUploadSectionEl.style.display = 'block';
        if (imagePreviewEl) imagePreviewEl.style.display = 'none';
        if (imageFileEl) imageFileEl.required = true;
        if (starRatingEl) {
            starRatingEl.value = '5';
            this.updateStarPreview();
        }
    }

    editImage(id, name, description, filePath, starRating) {
        // Safely set form values
        const imageIdEl = document.getElementById('image_id');
        const actionEl = document.getElementById('action');
        const imageNameEl = document.getElementById('image_name');
        const descriptionEl = document.getElementById('description');
        const formTitleEl = document.getElementById('form-title');
        const submitTextEl = document.getElementById('submit-text');
        const cancelBtnEl = document.getElementById('cancelBtn');
        const fileUploadSectionEl = document.getElementById('file-upload-section');
        const imageFileEl = document.getElementById('image_file');
        const starRatingEl = document.getElementById('star_rating');

        if (imageIdEl) imageIdEl.value = id;
        if (actionEl) actionEl.value = 'edit';
        if (imageNameEl) imageNameEl.value = name;
        if (descriptionEl) descriptionEl.value = description || '';
        if (formTitleEl) formTitleEl.textContent = 'Edit Image';
        if (submitTextEl) submitTextEl.textContent = 'Update Image';
        if (cancelBtnEl) cancelBtnEl.style.display = 'block';
        if (fileUploadSectionEl) fileUploadSectionEl.style.display = 'none';
        if (imageFileEl) imageFileEl.required = false;
        if (starRatingEl) {
            starRatingEl.value = starRating || '5';
            this.updateStarPreview();
        }
        
        // Scroll to form
        const firstCard = document.querySelector('.card');
        if (firstCard) {
            firstCard.scrollIntoView({ behavior: 'smooth' });
        }
    }

    deleteImage(id, name, filePath) {
        this.deleteImageId = id;
        const deleteImageNameEl = document.getElementById('deleteImageName');
        const deletePreviewImgEl = document.getElementById('deletePreviewImg');
        
        if (deleteImageNameEl) deleteImageNameEl.textContent = name;
        if (deletePreviewImgEl) deletePreviewImgEl.src = filePath;
        
        this.deleteModal.show();
    }

    async confirmDelete() {
        if (!this.deleteImageId) return;
        
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        const originalText = confirmBtn.innerHTML;
        
        // Show loading state
        confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
        confirmBtn.disabled = true;
        
        try {
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('image_id', this.deleteImageId);
            
            const response = await fetch('', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showAlert('success', data.message);
                this.loadImages();
            } else {
                this.showAlert('danger', data.message);
            }
            
            this.deleteModal.hide();
        } catch (error) {
            this.showAlert('danger', 'An error occurred: ' + error.message);
            this.deleteModal.hide();
        } finally {
            // Reset button state
            confirmBtn.innerHTML = originalText;
            confirmBtn.disabled = false;
            this.deleteImageId = null;
        }
    }

    async loadImages() {
        const container = document.getElementById('imagesContainer');
        
        try {
            const response = await fetch('?ajax=1');
            const data = await response.json();
            
            if (data.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center text-muted">
                        <i class="fas fa-images fa-3x mb-3"></i>
                        <p>No images found. Add your first image!</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = data.map(image => `
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card image-card h-100">
                        <div class="rating-badge">
                            ${this.generateStarDisplay(parseFloat(image.star_rating || 5))} ${image.star_rating || 5}
                        </div>
                        <img src="${this.escapeHtml(image.file_path)}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;" 
                             alt="${this.escapeHtml(image.alt_text || 'testimonial')}">
                        <div class="card-body">
                            <h6 class="card-title">${this.escapeHtml(image.image_name)}</h6>
                            <p class="card-text text-muted small">
                                ${this.escapeHtml(image.description || 'No description')}
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Uploaded: ${new Date(image.upload_date).toLocaleDateString()}
                                </small>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="star-rating-display mb-2">
                                <div class="stars">
                                    ${this.generateStarDisplay(parseFloat(image.star_rating || 5))}
                                </div>
                                <span class="rating-text">${image.star_rating || 5} / 5</span>
                            </div>
                            <div class="btn-group w-100">
                                <button class="btn btn-outline-primary btn-sm" 
                                        onclick="app.editImage(${image.id}, 
                                                '${this.escapeJs(image.image_name)}', 
                                                '${this.escapeJs(image.description || '')}', 
                                                '${this.escapeJs(image.file_path)}',
                                                '${image.star_rating || 5}')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-outline-danger btn-sm" 
                                        onclick="app.deleteImage(${image.id}, 
                                                '${this.escapeJs(image.image_name)}', 
                                                '${this.escapeJs(image.file_path)}')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        } catch (error) {
            this.showAlert('danger', 'Failed to load images: ' + error.message);
        }
    }

    handleLogout() {
        if (confirm('Are you sure you want to logout?')) {
            // Add your logout logic here
            // For example: window.location.href = 'logout.php';
            this.showAlert('info', 'Logout functionality to be implemented');
        }
    }

    showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show alert-fixed`;
        alertDiv.innerHTML = `
            ${this.escapeHtml(message)}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    escapeJs(text) {
        return text.replace(/'/g, "\\'").replace(/"/g, '\\"');
    }
}

// Initialize the application
let app;
document.addEventListener('DOMContentLoaded', () => {
    app = new ImageManagementApp();
});        
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   
<script>
    document.getElementById('logoutBtn').addEventListener('click', function() {
        // Redirect to logout.php page when clicked
        window.location.href = 'logout.php';
    });
</script>

</body>
</html>
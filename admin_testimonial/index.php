<?php
session_start();

// Database configuration
class DatabaseConfig {
    private $host = 'localhost';
    private $dbname = 'neo';
    private $username = 'root';
    private $password = '';
    private $pdo;
    
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", 
                                $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]));
        }
    }
    
    public function getConnection() {
        return $this->pdo;
    }
}

// Admin authentication class
class AdminAuth {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function login($mobile) {
        try {
            // Validate mobile number format
            if (!$this->isValidMobile($mobile)) {
                throw new Exception('Invalid mobile number format.');
            }
            
            $stmt = $this->pdo->prepare("SELECT * FROM admin_users WHERE mobile = ? AND is_active = 1");
            $stmt->execute([$mobile]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$admin) {
                throw new Exception('Invalid mobile number or account not found.');
            }
            
            // Update last login
            $updateStmt = $this->pdo->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
            $updateStmt->execute([$admin['id']]);
            
            // Set session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_mobile'] = $admin['mobile'];
            $_SESSION['admin_logged_in'] = true;
            
            return true;
        } catch(Exception $e) {
            throw $e;
        }
    }
    
    public function logout() {
        session_unset();
        session_destroy();
        return true;
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    
    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?page=login');
            exit;
        }
    }
    
    public function getAdminInfo() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['admin_id'],
                'name' => $_SESSION['admin_name'],
                'mobile' => $_SESSION['admin_mobile']
            ];
        }
        return null;
    }
    
    public function addAdmin($name, $mobile) {
        try {
            if (!$this->isValidMobile($mobile)) {
                throw new Exception('Invalid mobile number format.');
            }
            
            // Check if mobile already exists
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM admin_users WHERE mobile = ?");
            $stmt->execute([$mobile]);
            
            if ($stmt->fetchColumn() > 0) {
                throw new Exception('Mobile number already exists.');
            }
            
            $stmt = $this->pdo->prepare("INSERT INTO admin_users (name, mobile) VALUES (?, ?)");
            $stmt->execute([$name, $mobile]);
            
            return true;
        } catch(Exception $e) {
            throw $e;
        }
    }
    
    public function getAllAdmins() {
        try {
            $stmt = $this->pdo->query("SELECT id, name, mobile, is_active, last_login, created_at FROM admin_users ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            throw $e;
        }
    }
    
    public function toggleAdminStatus($id) {
        try {
            $stmt = $this->pdo->prepare("UPDATE admin_users SET is_active = 1 - is_active WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch(Exception $e) {
            throw $e;
        }
    }
    
    private function isValidMobile($mobile) {
        // Indian mobile number validation (10 digits starting with 6-9)
        return preg_match('/^[6-9]\d{9}$/', $mobile);
    }
}

// Initialize
$db = new DatabaseConfig();
$auth = new AdminAuth($db->getConnection());

// Handle AJAX requests
if (isset($_POST['ajax'])) {
    header('Content-Type: application/json');
    
    try {
        switch ($_POST['action']) {
            case 'login':
                $mobile = trim($_POST['mobile'] ?? '');
                
                if (empty($mobile)) {
                    throw new Exception('Mobile number is required.');
                }
                
                $auth->login($mobile);
                echo json_encode(['success' => true, 'message' => 'Login successful!']);
                break;
                
            case 'logout':
                $auth->logout();
                echo json_encode(['success' => true, 'message' => 'Logged out successfully!']);
                break;
                
            case 'add_admin':
                $auth->requireLogin();
                $name = trim($_POST['name'] ?? '');
                $mobile = trim($_POST['mobile'] ?? '');
                
                if (empty($name) || empty($mobile)) {
                    throw new Exception('Name and mobile number are required.');
                }
                
                $auth->addAdmin($name, $mobile);
                echo json_encode(['success' => true, 'message' => 'Admin added successfully!']);
                break;
                
            case 'get_admins':
                $auth->requireLogin();
                $admins = $auth->getAllAdmins();
                echo json_encode($admins);
                break;
                
            case 'toggle_status':
                $auth->requireLogin();
                $id = $_POST['admin_id'] ?? 0;
                
                if (empty($id)) {
                    throw new Exception('Admin ID is required.');
                }
                
                $auth->toggleAdminStatus($id);
                echo json_encode(['success' => true, 'message' => 'Admin status updated!']);
                break;
                
            default:
                throw new Exception('Invalid action.');
        }
    } catch(Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    $auth->logout();
    header('Location: ' . $_SERVER['PHP_SELF'] . '?page=login');
    exit;
}

// Determine current page
$page = $_GET['page'] ?? 'login';

// Redirect to login if not authenticated
if (!$auth->isLoggedIn()) {
    $page = 'login';
}

// Redirect to testimonial_add if already logged in and trying to access login
if ($page === 'login' && $auth->isLoggedIn()) {
    header('Location: testimonial_add.php');
    exit;
}

$adminInfo = $auth->getAdminInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<!-- Login Page -->
<div class="login-container d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card">
                    <div class="card-body p-5">
                        <!-- Back Button -->
                        <a href="../" class="btn btn-outline-secondary btn-sm mb-3">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>

                        <div class="text-center mb-4">
                            <i class="fas fa-user-shield fa-3x text-primary mb-3"></i>
                            <h3 class="card-title">Admin Login</h3>
                            <p class="text-muted">Enter your mobile number to login</p>
                        </div>
                        
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" id="mobile" name="mobile" 
                                           placeholder="Enter 10-digit mobile number" maxlength="10" required>
                                </div>
                                <small class="text-muted">Enter your registered mobile number</small>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
class AdminPanel {
    constructor() {
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // Login form
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', this.handleLogin.bind(this));
        }

        // Mobile number input validation
        const mobileInputs = document.querySelectorAll('input[type="tel"]');
        mobileInputs.forEach(input => {
            input.addEventListener('input', this.validateMobileInput.bind(this));
        });
    }

    validateMobileInput(e) {
        // Allow only digits and limit to 10 characters
        e.target.value = e.target.value.replace(/\D/g, '').slice(0, 10);
    }

    async handleLogin(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        formData.append('ajax', '1');
        formData.append('action', 'login');

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
        submitBtn.disabled = true;

        try {
            const response = await fetch('', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                this.showAlert('success', data.message);
                setTimeout(() => {
                    window.location.href = 'testimonial_add.php';
                }, 1000);
            } else {
                this.showAlert('danger', data.message);
            }
        } catch (error) {
            this.showAlert('danger', 'An error occurred: ' + error.message);
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            ${this.escapeHtml(message)}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
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
}

// Initialize the application
let adminPanel;
document.addEventListener('DOMContentLoaded', () => {
    adminPanel = new AdminPanel();
});
</script>

</body>
</html>
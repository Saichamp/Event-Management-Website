<?php
// logout.php - Handles user logout
session_start();

// Destroy session or clear any user-related session data
session_unset();
session_destroy();

// Redirect to login page or homepage after logout
header('Location: index.php');  // Or any page you want to redirect to
exit;
?>

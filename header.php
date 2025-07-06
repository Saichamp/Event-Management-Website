  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Events - Best Event Management Company in Bangalore</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/main.css">
   <link rel="stylesheet" href="css/header.css">
</head>
  <header class="header-main">
    <nav class="navbar-primary navbar-primary--transparent">
        <div class="navbar-primary__brand">
            <a href="index.php" class="navbar-primary__logo">Golden Events</a>
        </div>
        
        <button class="navbar-primary__toggle" id="navbarToggle" aria-label="Toggle navigation">
            <span class="navbar-primary__icon"></span>
            <span class="navbar-primary__icon"></span>
            <span class="navbar-primary__icon"></span>
        </button>
        
      <div class="navbar-primary__menu" id="navbarMenu">
    <ul class="navbar-primary__list">
        <li class="navbar-primary__item">
            <a href="index.php" class="navbar-primary__link <?php echo (basename($_SERVER['PHP_SELF']) === 'index.php') ? 'navbar-primary__link--active' : ''; ?>">Home</a>
        </li>
        <li class="navbar-primary__item">
            <a href="aboutus.php" class="navbar-primary__link <?php echo (basename($_SERVER['PHP_SELF']) === 'aboutus.php') ? 'navbar-primary__link--active' : ''; ?>">About</a>
        </li>
        <li class="navbar-primary__item">
            <a href="services.php" class="navbar-primary__link <?php echo (basename($_SERVER['PHP_SELF']) === 'services.php') ? 'navbar-primary__link--active' : ''; ?>">Services</a>
        </li>
        <li class="navbar-primary__item">
            <a href="gallery.php" class="navbar-primary__link <?php echo (basename($_SERVER['PHP_SELF']) === 'gallery.php') ? 'navbar-primary__link--active' : ''; ?>">Gallery</a>
        </li>
        <li class="navbar-primary__item">
            <a href="testimonials.php" class="navbar-primary__link <?php echo (basename($_SERVER['PHP_SELF']) === 'testimonials.php') ? 'navbar-primary__link--active' : ''; ?>">Testimonials</a>
        </li>
        <li class="navbar-primary__item">
            <a href="contact.php" class="navbar-primary__link navbar-primary__link--cta <?php echo (basename($_SERVER['PHP_SELF']) === 'contact.php') ? 'navbar-primary__link--active' : ''; ?>">Contact</a>
        </li>
    </ul>
</div>
    </nav>
</header>
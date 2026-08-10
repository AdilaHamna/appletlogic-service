<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="cursor"></div>
<div id="cursor-ring"></div>

<!-- Loader -->
<div id="loader">
  <div class="bar"><i id="loadBar"></i></div>
  <span class="pct" id="loadPct">0%</span>
</div>

<!-- Page Transition Curtain -->
<div id="curtain">
  <i></i><i></i><i></i><i></i><i></i>
  <div class="cl">
    <svg viewBox="0 0 100 78">
      <path d="M8 70 L38 6 L50 6 L74 56 L94 56 L94 64 L68 64 L48 20 L22 70 Z" fill="url(#lgm)"/>
      <defs>
        <linearGradient id="lgm" x1="0%" y1="100%" x2="100%" y2="0%">
          <stop offset="0%" stop-color="#356DFF" />
          <stop offset="100%" stop-color="#E8434E" />
        </linearGradient>
      </defs>
    </svg>
  </div>
</div>

<div id="progress"></div>
<div id="glow"></div>

<?php
// Retrieve custom links
$home_url       = home_url( '/' );
$services_url   = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-service.php', 'services') : home_url('/services/');
$industries_url = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-industries.php', 'industries') : home_url('/industries/');
$portfolio_url  = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-portfolio.php', 'portfolio') : home_url('/portfolio/');
$why_us_url     = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-why-us.php', 'why-us') : home_url('/why-us/');
$contact_url    = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');
?>

<nav id="nav">
  <div class="nav-in">
    <a class="logo" href="<?php echo esc_url($home_url); ?>">
      <img src="/wp-content/uploads/2026/08/WhatsApp-Image-2026-06-05-at-10.51.04-AM-2-1.svg" alt="AppletLogic Logo" style="height: 73px; width: auto; vertical-align: middle;">
    </a>
    <button class="burger" id="burger" aria-label="Menu"><span></span><span></span><span></span></button>
    <div class="nav-links" id="navLinks">
      <a href="<?php echo esc_url($services_url); ?>" class="<?php echo (is_page_template('templates/template-service.php') || is_singular('service')) ? 'active' : ''; ?>">Services</a>
      <a href="<?php echo esc_url($industries_url); ?>" class="<?php echo is_page_template('templates/template-industries.php') ? 'active' : ''; ?>">Industries</a>
      <a href="<?php echo esc_url($portfolio_url); ?>" class="<?php echo is_page_template('templates/template-portfolio.php') ? 'active' : ''; ?>">Portfolio</a>
      <a href="<?php echo esc_url($why_us_url); ?>" class="<?php echo is_page_template('templates/template-why-us.php') ? 'active' : ''; ?>">Why Us</a>
      <a href="<?php echo esc_url($contact_url); ?>" class="<?php echo is_page_template('templates/template-contact.php') ? 'active' : ''; ?>">Contact</a>
      <a href="<?php echo esc_url($contact_url); ?>" class="btn btn-grad btn-sm">Book Free Consultation</a>
    </div>
  </div>
</nav>

<main id="app">

<?php
/**
 * Template Name: Custom Contact Page
 * Description: Renders the Contact page with dynamic forms, contact detail cards, and an interactive layout.
 */

get_header('custom');

include_once get_stylesheet_directory() . '/inc/data.php';
global $SERVICES;
$SERVICES = function_exists('appletlogic_get_services') ? appletlogic_get_services() : $SERVICES;
?>

<div class="page">
  <section class="page-hero">
    <div class="bgnum">HI</div>
    <div class="wrap">
      <div class="crumb rv">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>›</span>
        <span>Contact</span>
      </div>
      <span class="eyebrow rv">Get in touch</span>
      <h1 class="rv-blur">Start your <span class="grad-txt">project</span></h1>
      <p class="lead rv">Tell us where you're headed. We'll reply within one business day — with a point of view, not a pitch.</p>
    </div>
  </section>

  <!-- Contact Grid -->
  <section style="padding-bottom:110px">
    <div class="wrap">
      <div class="ct-grid" style="margin-top:0">
        
        <!-- Proposal Form -->
        <div id="proposal-form" class="ct-form rv">
          <?php echo do_shortcode('[contact-form-7 id="967fc63" title="Contact form 1"]'); ?>
        </div>

        <!-- Detail Cards & Map -->
        <div class="ct-info">
          <a class="ct-card rv"><div class="ic ic-cyan">📅</div><div><b>Book a discovery call</b><small>Pick a slot on our calendar</small></div></a>
          <a class="ct-card rv" data-d="1" href="https://wa.me/919061914915" target="_blank" rel="noopener"><div class="ic" style="background:rgba(30,190,93,.12);color:#4FE58D">🟢</div><div><b>WhatsApp us</b><small>Fastest way to reach the team</small></div></a>
          <a class="ct-card rv" data-d="2" href="mailto:info@gmail.com"><div class="ic ic-red">✉</div><div><b>info@gmail.com</b><small>For proposals and partnerships</small></div></a>
          <a class="ct-card rv" data-d="3" href="tel:+919061914915"><div class="ic ic-blue">☏</div><div><b>+91 9061914915</b><small>Mon–Sat, 9:00 AM – 7:00 PM IST</small></div></a>
          
          <div class="map rv" data-d="4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4743.053466542192!2d75.78416378343427!3d11.253219680085202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba659cca41c1853%3A0x34a2f6d1fcf328dd!2sAPPLETLOGIC!5e0!3m2!1sen!2sin!4v1786349330668!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<?php
get_footer('custom');

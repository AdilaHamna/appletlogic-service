<?php
/**
 * Custom footer template for AppletLogic pages.
 */

// Retrieve custom links
$home_url       = home_url( '/' );
$services_url   = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-service.php', 'services') : home_url('/services/');
$industries_url = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-industries.php', 'industries') : home_url('/industries/');
$portfolio_url  = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-portfolio.php', 'portfolio') : home_url('/portfolio/');
$why_us_url     = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-why-us.php', 'why-us') : home_url('/why-us/');
$contact_url    = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');

include_once get_stylesheet_directory() . '/inc/data.php';
global $SERVICES;
?>

</main> <!-- #app -->

<footer>
  <div class="wrap">
    <div class="ft-grid">
      <div class="ft-about">
        <a class="logo" href="<?php echo esc_url($home_url); ?>">
          <span class="word"><b>APPLET</b><i>LOGIC</i></span>
        </a>
        <p>AppletLogic Technologies LLP — a premium digital transformation partner delivering AI, enterprise software, cloud, and automation at a global standard.</p>
        <div class="socials">
          <a href="#" aria-label="LinkedIn">in</a>
          <a href="#" aria-label="X">𝕏</a>
          <a href="#" aria-label="Instagram">◎</a>
          <a href="#" aria-label="YouTube">▶</a>
        </div>
      </div>
      <div>
        <h5>Services</h5>
        <ul id="ftServices">
          <?php
          if (isset($SERVICES) && is_array($SERVICES)) {
              for ($j = 0; $j < min(6, count($SERVICES)); $j++) {
                  $s = $SERVICES[$j];
                  $detail_url = esc_url(add_query_arg('slug', $s['slug'], $services_url));
                  echo '<li><a href="' . $detail_url . '">' . esc_html($s['name']) . '</a></li>';
              }
          }
          ?>
        </ul>
      </div>
      <div>
        <h5>Company</h5>
        <ul>
          <li><a href="<?php echo esc_url($why_us_url); ?>">Why AppletLogic</a></li>
          <li><a href="<?php echo esc_url($industries_url); ?>">Industries</a></li>
          <li><a href="<?php echo esc_url($portfolio_url); ?>">Portfolio</a></li>
          <li><a href="<?php echo esc_url($services_url); ?>">All Services</a></li>
          <li><a href="<?php echo esc_url($contact_url); ?>">Contact</a></li>
        </ul>
      </div>
      <div>
        <h5>Newsletter</h5>
        <p style="color:var(--muted);font-size:.85rem;margin-bottom:16px">Monthly insights on AI, engineering, and digital growth.</p>
        <div class="news">
          <input type="email" placeholder="Your email">
          <button class="btn btn-ghost btn-sm" style="width:100%;justify-content:center">Subscribe</button>
        </div>
      </div>
    </div>
    <div class="ft-bottom">
      <span>© <?php echo date('Y'); ?> AppletLogic Technologies LLP. All rights reserved.</span>
      <span>Kochi · Kerala · India · info@appletlogic.com</span>
    </div>
  </div>
</footer>

<div class="float-ct">
  <a class="f-cal" data-tip="Book a meeting" href="<?php echo esc_url($contact_url); ?>">📅</a>
  <a class="f-wa" data-tip="WhatsApp" href="#"><svg width="23" height="23" viewBox="0 0 24 24" fill="#fff"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5.1-1.3A10 10 0 1 0 12 2zm5.3 14.1c-.2.6-1.3 1.2-1.8 1.2-.5.1-1 .2-3.4-.7-2.9-1.1-4.7-4-4.9-4.2-.1-.2-1.1-1.5-1.1-2.9s.7-2 1-2.3c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5s.8 1.9.8 2c.1.1.1.3 0 .5l-.4.6c-.1.2-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1.1 2.2 1.4 2.5 1.5.3.1.5.1.7-.1l.9-1c.2-.3.4-.2.7-.1l2 1c.3.1.5.2.6.3 0 .1 0 .7-.2 1.3z"/></svg></a>
  <a class="f-call" data-tip="Call us" href="tel:+916238577323">☏</a>
  <a class="f-mail" data-tip="Email" href="mailto:info@appletlogic.com">✉</a>
</div>

<?php wp_footer(); ?>
</body>
</html>

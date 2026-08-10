<?php
/**
 * The template for displaying single Service custom posts.
 */

get_header('custom');

$services_url   = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-service.php', 'services') : home_url('/services/');
$contact_url    = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');

$SERVICES = function_exists('appletlogic_get_services') ? appletlogic_get_services() : array();
$current_service = null;
$current_index = -1;
$current_post_id = get_the_ID();

if ($current_post_id && is_array($SERVICES)) {
    foreach ($SERVICES as $idx => $s) {
        if ($s['id'] === $current_post_id) {
            $current_service = $s;
            $current_index = $idx;
            break;
        }
    }
}

if ($current_service):
    $s = $current_service;
    $prev_service = $SERVICES[($current_index - 1 + count($SERVICES)) % count($SERVICES)];
    $next_service = $SERVICES[($current_index + 1) % count($SERVICES)];
    $prev_url = esc_url(get_permalink($prev_service['id']));
    $next_url = esc_url(get_permalink($next_service['id']));
?>

<div class="page">
  <section class="page-hero">
    <div class="bgnum">0<?php echo ($current_index + 1); ?></div>
    <div class="wrap">
      <div class="crumb rv">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>›</span>
        <a href="<?php echo esc_url($services_url); ?>">Services</a><span>›</span>
        <span><?php echo esc_html($s['name']); ?></span>
      </div>
      <div class="sd-hero-ic <?php echo esc_attr($s['cls']); ?> rv"><?php echo esc_html($s['icon']); ?></div>
      <h1 class="rv-blur"><?php echo esc_html($s['name']); ?></h1>
      <p class="lead rv"><?php echo esc_html($s['short']); ?></p>
      <div class="hero-ctas rv" style="margin-top:34px">
        <a class="btn btn-grad magnet" href="#svc-contact">Connect With Us <span class="arr">→</span></a>
        <a class="btn btn-ghost magnet" href="#svc-process">See our process</a>
      </div>
    </div>
  </section>

  <!-- Problem / Solution -->
  <section class="pad" style="padding-top:30px">
    <div class="wrap">
      <div class="ps-grid">
        <div class="card ps problem rv-l">
          <span class="tag">The problem</span>
          <h3>What's holding teams back</h3>
          <p><?php echo esc_html($s['problem']); ?></p>
        </div>
        <div class="card ps solution rv-r">
          <span class="tag">Our solution</span>
          <h3>How we solve it</h3>
          <p><?php echo esc_html($s['solution']); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Benefits -->
  <section class="pad" style="padding-top:0">
    <div class="wrap">
      <span class="eyebrow rv">Benefits</span>
      <h2 class="sec-title rv-blur">What you get</h2>
      <div class="ben-grid">
        <?php
        foreach ($s['benefits'] as $k => $benefit) {
          $delay_d = $k % 3 ? 'data-d="' . ($k % 3) . '"' : '';
          echo '<div class="card ben rv" ' . $delay_d . '>';
          echo '<div class="ic">' . esc_html($benefit[0]) . '</div>';
          echo '<h4>' . esc_html($benefit[1]) . '</h4>';
          echo '<p>' . esc_html($benefit[2]) . '</p>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Process -->
  <section class="pad" id="svc-process" style="background:var(--coal)">
    <div class="wrap">
      <span class="eyebrow rv">Our process</span>
      <h2 class="sec-title rv-blur">How a <?php echo esc_html(strtolower($s['name'])); ?> engagement runs</h2>
      <div class="sd-tl">
        <?php
        foreach ($s['process'] as $k => $step) {
          echo '<div class="sd-step rv">';
          echo '<span class="n">0' . ($k + 1) . '</span>';
          echo '<div><h4>' . esc_html($step) . '</h4></div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Technologies & Case Study -->
  <section class="pad">
    <div class="wrap">
      <span class="eyebrow rv">Technologies</span>
      <h2 class="sec-title rv-blur">Tools we reach for</h2>
      <div class="tech-cloud rv">
        <?php
        foreach ($s['techs'] as $tech) {
          echo '<span>' . esc_html($tech) . '</span>';
        }
        ?>
      </div>

      <div class="cs-band rv-blur">
        <div>
          <span class="eyebrow" style="margin-bottom:12px">Case study</span>
          <h3><?php echo esc_html($s['cs']['title']); ?></h3>
          <p><?php echo esc_html($s['cs']['text']); ?></p>
        </div>
        <div style="text-align:center">
          <div class="stat"><em><?php echo esc_html($s['cs']['stat']); ?></em></div>
          <p style="color:var(--muted);font-size:.85rem;margin-top:6px"><?php echo esc_html($s['cs']['statLabel']); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQs -->
  <section class="pad" style="background:var(--coal)">
    <div class="wrap">
      <div style="text-align:center">
        <span class="eyebrow rv" style="justify-content:center">FAQ</span>
        <h2 class="sec-title rv-blur" style="margin:0 auto"><?php echo esc_html($s['name']); ?> — common questions</h2>
      </div>
      <div class="faq-list">
        <?php
        foreach ($s['faqs'] as $k => $faq) {
          $delay_d = $k ? 'data-d="' . $k . '"' : '';
          echo '<div class="faq rv" ' . $delay_d . '>';
          echo '<button>' . esc_html($faq[0]) . '<span class="plus">＋</span></button>';
          echo '<div class="a"><p>' . esc_html($faq[1]) . '</p></div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Contact/Proposal form for this specific Service -->
  <section class="pad" id="svc-contact">
    <div class="wrap">
      <span class="eyebrow rv">Start here</span>
      <h2 class="sec-title rv-blur">Discuss your <?php echo esc_html(strtolower($s['name'])); ?> project</h2>
      <p class="sec-sub rv">This form goes straight to the <?php echo esc_html($s['name']); ?> practice lead. Reply within one business day.</p>
      
      <div class="ct-grid">
        <?php echo do_shortcode('[contact-form-7 id="2fee701" title="Service-page form"]'); ?>

        <div class="ct-info">
          <a class="ct-card rv" href="<?php echo esc_url($contact_url); ?>"><div class="ic ic-cyan">📅</div><div><b>Book a discovery call</b><small>Pick a slot on our calendar</small></div></a>
          <a class="ct-card rv" data-d="1" href="mailto:info@gmail.com"><div class="ic ic-red">✉</div><div><b>info@gmail.com</b><small>For proposals and partnerships</small></div></a>
          <a class="ct-card rv" data-d="2" href="tel:+919061914915"><div class="ic ic-blue">☏</div><div><b>+91 9061914915</b><small>Mon–Sat, 9:00–19:00 IST</small></div></a>
        </div>
      </div>

      <!-- Navigation to other services -->
      <div class="sd-nav">
        <a href="<?php echo $prev_url; ?>"><small>← Previous service</small><b><?php echo esc_html($prev_service['name']); ?></b></a>
        <a class="next" href="<?php echo $next_url; ?>"><small>Next service →</small><b><?php echo esc_html($next_service['name']); ?></b></a>
      </div>
    </div>
  </section>
</div>

<?php
endif;

get_footer('custom');

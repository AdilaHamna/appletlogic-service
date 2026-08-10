<?php
/**
 * Template Name: Custom Services Page
 * Description: Renders the Services List index OR dynamically renders individual Service Detail views depending on the 'slug' URL query parameter.
 */

get_header('custom');

include_once get_stylesheet_directory() . '/inc/data.php';
global $SERVICES;

$services_url   = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-service.php', 'services') : home_url('/services/');
$contact_url    = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');

$slug = isset($_GET['slug']) ? sanitize_key($_GET['slug']) : '';
$current_service = null;
$current_index = -1;

if ($slug && isset($SERVICES) && is_array($SERVICES)) {
    foreach ($SERVICES as $idx => $s) {
        if ($s['slug'] === $slug) {
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
    $prev_url = esc_url(add_query_arg('slug', $prev_service['slug'], $services_url));
    $next_url = esc_url(add_query_arg('slug', $next_service['slug'], $services_url));
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
        <div class="ct-form rv">
          <form onsubmit="return submitForm(event)">
            <div class="f-row">
              <div class="field"><label>Full name</label><input required type="text" placeholder="Your name"></div>
              <div class="field"><label>Work email</label><input required type="email" placeholder="you@company.com"></div>
            </div>
            <div class="f-row">
              <div class="field"><label>Phone / WhatsApp</label><input type="tel" placeholder="+91"></div>
              <div class="field">
                <label>Service</label>
                <select>
                  <?php
                  foreach ($SERVICES as $item) {
                    $selected = ($item['name'] === $s['name']) ? 'selected' : '';
                    echo '<option ' . $selected . '>' . esc_html($item['name']) . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="field"><label>Project details</label><textarea placeholder="Tell us where you're headed…"></textarea></div>
            <button type="submit" class="btn btn-grad magnet" style="width:100%;justify-content:center">Request a Proposal <span class="arr">→</span></button>
          </form>
          <div class="form-ok">
            <div class="tick">✓</div>
            <h3 style="margin-bottom:10px">Request received</h3>
            <p style="color:var(--muted);font-size:.9rem">We'll reply within one business day.</p>
          </div>
        </div>

        <div class="ct-info">
          <a class="ct-card rv" href="<?php echo esc_url($contact_url); ?>"><div class="ic ic-cyan">📅</div><div><b>Book a discovery call</b><small>Pick a slot on our calendar</small></div></a>
          <a class="ct-card rv" data-d="1" href="mailto:info@appletlogic.com"><div class="ic ic-red">✉</div><div><b>info@appletlogic.com</b><small>For proposals and partnerships</small></div></a>
          <a class="ct-card rv" data-d="2" href="tel:+916238577323"><div class="ic ic-blue">☏</div><div><b>+91 6238577323</b><small>Mon–Sat, 9:00–19:00 IST</small></div></a>
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

<?php else: ?>

<!-- Render Services List Page -->
<div class="page">
  <section class="page-hero">
    <div class="bgnum">10</div>
    <div class="wrap">
      <div class="crumb rv">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>›</span>
        <span>Services</span>
      </div>
      <span class="eyebrow rv">Our services</span>
      <h1 class="rv-blur">Ten practices. <span class="grad-txt">One accountable partner.</span></h1>
      <p class="lead rv">Every service below opens its own page — problem, solution, benefits, process, technologies, case study, FAQ, and a dedicated enquiry form.</p>
    </div>
  </section>

  <section style="padding-bottom:110px">
    <div class="wrap">
      <div class="svc-grid" style="margin-top:0">
        <?php
        if (isset($SERVICES) && is_array($SERVICES)) {
          foreach ($SERVICES as $idx => $s) {
            $detail_url = esc_url(add_query_arg('slug', $s['slug'], $services_url));
            $delay_d = $idx % 2 ? 'data-d="1"' : '';
            echo '<article class="card spot svc rv tilt" ' . $delay_d . ' onclick="location.href=\'' . $detail_url . '\'">';
            echo '<div class="top"><div class="ic ' . esc_attr($s['cls']) . '" style="font-size:1.3rem">' . esc_html($s['icon']) . '</div><span class="idx">0' . ($idx + 1) . '</span></div>';
            echo '<h3>' . esc_html($s['name']) . '</h3><p>' . esc_html($s['short']) . '</p>';
            echo '<div class="tags">';
            foreach ($s['tags'] as $tag) {
              echo '<span>' . esc_html($tag) . '</span>';
            }
            echo '</div>';
            echo '<span class="cta">Explore Service <span class="arr">→</span></span>';
            echo '</article>';
          }
        }
        ?>
      </div>
    </div>
  </section>

  <!-- CTA Box -->
  <section class="pad">
    <div class="wrap">
      <div class="cta-box rv-blur">
        <h2>Not sure which service fits?</h2>
        <p>Tell us the problem — we'll map the right solution in a free 30-minute discovery call.</p>
        <a class="btn btn-grad magnet" href="<?php echo esc_url($contact_url); ?>" style="font-size:1rem;padding:18px 40px">Connect With Us <span class="arr">→</span></a>
      </div>
    </div>
  </section>
</div>

<?php endif; ?>

<?php
get_footer('custom');

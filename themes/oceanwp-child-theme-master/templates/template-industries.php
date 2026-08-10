<?php
/**
 * Template Name: Custom Industries Page
 * Description: Renders the 11 industries with icons, subtitles, sectors, client testimonials, and a custom consultation CTA.
 */

get_header('custom');

include_once get_stylesheet_directory() . '/inc/data.php';
global $INDUSTRIES, $TESTIMONIALS;
$TESTIMONIALS = function_exists('appletlogic_get_testimonials') ? appletlogic_get_testimonials() : $TESTIMONIALS;

$contact_url = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');
?>

<div class="page">
  <section class="page-hero">
    <div class="bgnum">11</div>
    <div class="wrap">
      <div class="crumb rv">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>›</span>
        <span>Industries</span>
      </div>
      <span class="eyebrow rv">Where we work</span>
      <h1 class="rv-blur">Domain depth across <span class="grad-txt">11 industries</span></h1>
      <p class="lead rv">Sector knowledge shortens discovery and de-risks delivery — we've shipped production systems in each of these.</p>
    </div>
  </section>

  <!-- Industries Grid -->
  <section style="padding-bottom:110px">
    <div class="wrap">
      <div class="ind-grid" style="margin-top:0;">
        <?php
        if (isset($INDUSTRIES) && is_array($INDUSTRIES)) {
          foreach ($INDUSTRIES as $k => $ind) {
            $delay_d = $k % 3 ? 'data-d="' . ($k % 3) . '"' : '';
            echo '<div class="card spot ind-big rv" ' . $delay_d . '>';
            echo '<div class="ic">' . esc_html($ind[0]) . '</div>';
            echo '<h3>' . esc_html($ind[1]) . '</h3>';
            echo '<p>' . esc_html($ind[2]) . '</p>';
            echo '<div class="sol"><span>AI-ready</span><span>Automation</span><span>Analytics</span></div>';
            echo '</div>';
          }
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="pad" style="background:var(--coal)">
    <div class="wrap">
      <span class="eyebrow rv">Client voices</span>
      <h2 class="sec-title rv-blur">Partners who'd hire us again</h2>
      <div style="overflow:hidden">
        <div class="tst-track" id="tstTrack">
          <?php
          if (isset($TESTIMONIALS) && is_array($TESTIMONIALS)) {
            foreach ($TESTIMONIALS as $idx => $tst) {
              $delay_d = $idx === 1 ? 'data-d="1"' : ($idx === 2 ? 'data-d="2"' : '');
              $fade_class = $idx < 3 ? 'rv' : '';
              echo '<div class="tst ' . $fade_class . '" ' . $delay_d . '>';
              echo '<div class="stars">★★★★★</div><p>"' . esc_html($tst[3]) . '"</p>';
              echo '<div class="who"><div class="av" style="background:' . esc_attr($tst[4]) . '">' . esc_html($tst[0]) . '</div>';
              echo '<div><b>' . esc_html($tst[1]) . '</b><small>' . esc_html($tst[2]) . '</small></div></div>';
              echo '</div>';
            }
          }
          ?>
        </div>
      </div>
      <div class="tst-nav" id="tstNav"></div>
    </div>
  </section>

  <!-- CTA Box -->
  <section class="pad">
    <div class="wrap">
      <div class="cta-box rv-blur">
        <h2>Don't see your industry?</h2>
        <p>We've probably built something adjacent. Tell us your workflow — we'll show you what's possible.</p>
        <a class="btn btn-grad magnet" href="<?php echo esc_url($contact_url); ?>" style="font-size:1rem;padding:18px 40px">Connect With Us <span class="arr">→</span></a>
      </div>
    </div>
  </section>
</div>

<?php
get_footer('custom');

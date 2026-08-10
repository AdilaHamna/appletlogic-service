<?php
/**
 * Template Name: Custom Portfolio Page
 * Description: Renders the case studies grid page, displaying projects with custom SVGs, tech tags, descriptions, and CTAs.
 */

get_header('custom');

include_once get_stylesheet_directory() . '/inc/data.php';
global $PROJECTS;

$contact_url = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');
?>

<div class="page">
  <section class="page-hero">
    <div class="bgnum">WORK</div>
    <div class="wrap">
      <div class="crumb rv">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>›</span>
        <span>Portfolio</span>
      </div>
      <span class="eyebrow rv">Featured work</span>
      <h1 class="rv-blur">Projects that <span class="grad-txt">moved the numbers</span></h1>
      <p class="lead rv">A selection of engagements across industries — every one measured on business outcomes, not deliverables.</p>
    </div>
  </section>

  <!-- Projects Grid -->
  <section style="padding-bottom:110px">
    <div class="wrap">
      <div class="pf-grid" style="margin-top:0">
        <?php
        // Helper function for custom SVG drawings matching indices
        if (!function_exists('portfolio_thumb_svg')) {
          function portfolio_thumb_svg($art_idx) {
            $svgs = [
              '<svg viewBox="0 0 400 190" preserveAspectRatio="none"><rect width="400" height="190" fill="#101014"/><rect x="30" y="26" width="150" height="12" rx="6" fill="#356DFF" opacity=".7"/><rect x="30" y="50" width="90" height="8" rx="4" fill="#27D7FF" opacity=".4"/><rect x="30" y="80" width="160" height="84" rx="10" fill="#1A1A21"/><path d="M45 145 L75 118 L105 130 L135 100 L165 112" stroke="#27D7FF" stroke-width="3" fill="none"/><rect x="210" y="80" width="75" height="84" rx="10" fill="#1A1A21"/><circle cx="247" cy="112" r="20" fill="none" stroke="#E8434E" stroke-width="6" stroke-dasharray="90 40"/><rect x="300" y="80" width="70" height="38" rx="8" fill="#356DFF" opacity=".5"/><rect x="300" y="126" width="70" height="38" rx="8" fill="#1A1A21"/></svg>',
              '<svg viewBox="0 0 400 190" preserveAspectRatio="none"><rect width="400" height="190" fill="#121217"/><rect x="140" y="20" width="120" height="150" rx="16" fill="#1A1A21"/><rect x="158" y="40" width="84" height="10" rx="5" fill="#27D7FF" opacity=".5"/><rect x="158" y="60" width="84" height="52" rx="8" fill="#356DFF" opacity=".4"/><rect x="158" y="120" width="38" height="26" rx="6" fill="#E8434E" opacity=".7"/><rect x="204" y="120" width="38" height="26" rx="6" fill="#22222B"/><circle cx="80" cy="95" r="26" fill="none" stroke="#356DFF" stroke-width="2" opacity=".4"/><circle cx="322" cy="95" r="26" fill="none" stroke="#E8434E" stroke-width="2" opacity=".4"/></svg>',
              '<svg viewBox="0 0 400 190" preserveAspectRatio="none"><rect width="400" height="190" fill="#101014"/><rect x="30" y="30" width="340" height="130" rx="12" fill="#1A1A21"/><rect x="50" y="50" width="140" height="10" rx="5" fill="#27D7FF" opacity=".5"/><path d="M60 140 C110 90 150 130 200 85 S 300 110 345 70" stroke="#356DFF" stroke-width="2" fill="none" opacity=".8"/><circle cx="200" cy="85" r="5" fill="#E8434E"/><circle cx="345" cy="70" r="5" fill="#27D7FF"/><rect x="240" y="46" width="110" height="20" rx="10" fill="#22222B"/></svg>'
            ];
            return $svgs[$art_idx];
          }
        }

        if (isset($PROJECTS) && is_array($PROJECTS)) {
          foreach ($PROJECTS as $i => $p) {
            $delay_d = $i % 3 ? 'data-d="' . ($i % 3) . '"' : '';
            echo '<article class="card pf rv" ' . $delay_d . ' onclick="location.href=\'' . esc_url($contact_url) . '\'">';
            echo '<div class="thumb">' . portfolio_thumb_svg($p['art']) . '</div>';
            echo '<div class="body">';
            echo '<div class="meta"><span>' . esc_html($p['ind']) . '</span><span class="red">' . esc_html($p['tech']) . '</span></div>';
            echo '<h3>' . esc_html($p['title']) . '</h3>';
            echo '<p>' . esc_html($p['text']) . '</p>';
            echo '<a class="lnk" href="' . esc_url($contact_url) . '">Discuss a similar project <span class="arr">→</span></a>';
            echo '</div>';
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
        <h2>Want results like these?</h2>
        <p>Book a free strategy session — we'll map what a similar outcome looks like for your business.</p>
        <a class="btn btn-grad magnet" href="<?php echo esc_url($contact_url); ?>" style="font-size:1rem;padding:18px 40px">Connect With Us <span class="arr">→</span></a>
      </div>
    </div>
  </section>
</div>

<?php
get_footer('custom');

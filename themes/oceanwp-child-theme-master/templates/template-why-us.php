<?php
/**
 * Template Name: Custom Why Us Page
 * Description: Renders the differentiators grid, the 8-stage delivery process timeline, testimonials, and contact CTA.
 */

get_header('custom');

include_once get_stylesheet_directory() . '/inc/data.php';
global $TESTIMONIALS;

$contact_url = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');
?>

<div class="page">
  <section class="page-hero">
    <div class="bgnum">WHY</div>
    <div class="wrap">
      <div class="crumb rv">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>›</span>
        <span>Why AppletLogic</span>
      </div>
      <span class="eyebrow rv">Why AppletLogic</span>
      <h1 class="rv-blur">Built like a product team, <span class="grad-txt">not an agency</span></h1>
      <p class="lead rv">AppletLogic Technologies LLP is a premium digital transformation partner — AI-native, engineering-led, and measured on your business outcomes.</p>
    </div>
  </section>

  <!-- Counters Block -->
  <section class="pad" style="padding-top:20px">
    <div class="wrap">
      <div class="counters rv">
        <?php
        $counter_data = [
          ["180", "+", "Projects Delivered"],
          ["120", "+", "Clients Served"],
          ["11", "+", "Industries"],
          ["8", "+", "Countries"],
          ["10", "+", "Years Experience"],
          ["98", "%", "Happy Customers"]
        ];
        foreach ($counter_data as $cnt) {
          echo '<div class="counter"><div class="num"><span data-count="' . esc_attr($cnt[0]) . '">0</span><s>' . esc_html($cnt[1]) . '</s></div><p>' . esc_html($cnt[2]) . '</p></div>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Old Agency model vs AppletLogic -->
  <section class="pad" style="background:var(--coal)">
    <div class="wrap">
      <span class="eyebrow rv">The difference</span>
      <h2 class="sec-title rv-blur">Traditional agencies vs. AppletLogic</h2>
      <div class="vs">
        <div class="vs-col vs-old rv-l">
          <h3>Traditional agencies</h3>
          <ul>
            <?php
            $vs_old = [
              ["Communication", "Weekly status emails, slow escalation loops"],
              ["Speed", "Months to a first working release"],
              ["AI", "Bolted on late — if at all"],
              ["Support", "Ticket queues after go-live"],
              ["Technology", "Whatever the last project used"],
              ["Cost", "Scope creep and surprise invoices"],
              ["Delivery", "Big-bang launches, high risk"],
              ["Innovation", "Waits for the next contract"]
            ];
            foreach ($vs_old as $row) {
              echo '<li><span class="m">✕</span><div><b>' . esc_html($row[0]) . '</b><span>' . esc_html($row[1]) . '</span></div></li>';
            }
            ?>
          </ul>
        </div>
        <div class="vs-col vs-new rv-r">
          <h3>
            <svg width="20" height="16" viewBox="0 0 100 78" style="vertical-align: middle; margin-right: 6px;">
              <path d="M8 70 L38 6 L50 6 L74 56 L94 56 L94 64 L68 64 L48 20 L22 70 Z" fill="#FF5A63"/>
            </svg> 
            AppletLogic
          </h3>
          <ul>
            <?php
            $vs_new = [
              ["Communication", "Dedicated channel, same-day answers, live boards"],
              ["Speed", "Working software in the first sprint"],
              ["AI", "AI-native from architecture to workflow"],
              ["Support", "SLA-backed engineering partnership"],
              ["Technology", "The right modern stack for your problem"],
              ["Cost", "Transparent milestones, fixed where you need it"],
              ["Delivery", "Continuous, incremental, de-risked releases"],
              ["Innovation", "Quarterly roadmaps, proactive R&D"]
            ];
            foreach ($vs_new as $row) {
              echo '<li><span class="m">✓</span><div><b>' . esc_html($row[0]) . '</b><span>' . esc_html($row[1]) . '</span></div></li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Timeline stages -->
  <section class="pad">
    <div class="wrap">
      <span class="eyebrow rv">How we deliver</span>
      <h2 class="sec-title rv-blur">A process built for momentum</h2>
      <p class="sec-sub rv">Eight stages, each with clear deliverables — you always know what's next.</p>
      <div class="tl">
        <?php
        $timeline = [
          ["Discover", "Stakeholder sessions to map goals, users, and constraints."],
          ["Research", "Market, competitor, and technical feasibility analysis."],
          ["Strategy", "Roadmap, architecture, and success metrics agreed up front."],
          ["Design", "Wireframes to high-fidelity prototypes, validated with users."],
          ["Development", "Sprint-based builds with demos every cycle."],
          ["Testing", "Automated + manual QA, security, and performance passes."],
          ["Deployment", "Zero-downtime releases, monitored from minute one."],
          ["Support", "SLA-backed maintenance and improvement roadmaps."]
        ];
        foreach ($timeline as $k => $step) {
          $delay_d = $k % 4 ? 'data-d="' . ($k % 4) . '"' : '';
          echo '<div class="step rv" ' . $delay_d . '><span class="n">0' . ($k + 1) . '</span><h4>' . esc_html($step[0]) . '</h4><p>' . esc_html($step[1]) . '</p></div>';
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
        <h2>Work with a team that ships</h2>
        <p>Start with a free strategy session — no pitch decks, just a working plan.</p>
        <a class="btn btn-grad magnet" href="<?php echo esc_url($contact_url); ?>" style="font-size:1rem;padding:18px 40px">Connect With Us <span class="arr">→</span></a>
      </div>
    </div>
  </section>
</div>

<?php
get_footer('custom');

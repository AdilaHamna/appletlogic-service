<?php
/**
 * Template Name: Custom Home Page
 * Description: Replicates the reference homepage with particles, counters, grids, comparisons, tech marquees, testimonials.
 */

get_header('custom');

include_once get_stylesheet_directory() . '/inc/data.php';
global $SERVICES, $INDUSTRIES, $PROJECTS, $TESTIMONIALS, $TECHS1, $TECHS2;

$services_url   = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-service.php', 'services') : home_url('/services/');
$industries_url = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-industries.php', 'industries') : home_url('/industries/');
$portfolio_url  = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-portfolio.php', 'portfolio') : home_url('/portfolio/');
$why_us_url     = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-why-us.php', 'why-us') : home_url('/why-us/');
$contact_url    = function_exists('get_custom_page_link_by_template') ? get_custom_page_link_by_template('templates/template-contact.php', 'contact') : home_url('/contact/');
?>

<div class="page">
  <section id="hero">
    <div class="hgrid-bg"></div>
    <canvas id="hero-canvas"></canvas>
    <div class="mesh b1"></div>
    <div class="mesh b2"></div>
    <div class="wrap hero-grid">
      <div>
        <div class="hero-badge"><span class="dot"></span> IT Services &amp; Digital Transformation Division</div>
        <h1 class="hero-h">
          <span class="line"><span>Build future-ready</span></span>
          <span class="line"><span class="grad-txt">digital products</span></span>
          <span class="line"><span>that drive growth.</span></span>
        </h1>
        <p class="hero-sub">We help startups, enterprises, and growing businesses build scalable digital solutions through AI, software engineering, cloud technologies, and business automation.</p>
        <div class="hero-ctas">
          <a class="btn btn-grad magnet" href="<?php echo esc_url($contact_url); ?>">Book Consultation <span class="arr">→</span></a>
          <a class="btn btn-ghost magnet" href="<?php echo esc_url($services_url); ?>">Explore Services</a>
        </div>
      </div>
      <div class="hero-visual">
        <div class="dash parallax" data-p="6">
          <div class="dash-top"><i></i><i></i><i></i></div>
          <div class="dash-rows">
            <div class="d-row">
              <div class="d-cell"><span class="lbl">Revenue Impact</span><div class="val up">+248%</div></div>
              <div class="d-cell"><span class="lbl">AI Tasks / day</span><div class="val">12,480</div></div>
              <div class="d-cell"><span class="lbl">Uptime</span><div class="val up">99.99%</div></div>
            </div>
            <div class="d-row">
              <div class="d-cell" style="flex:1.5"><span class="lbl">Pipeline performance</span>
                <div class="spark">
                  <i style="height:40%"></i><i style="height:65%"></i><i style="height:50%"></i><i style="height:85%"></i>
                  <i style="height:60%"></i><i style="height:95%"></i><i style="height:72%"></i><i style="height:100%"></i>
                </div>
              </div>
              <div class="d-cell"><span class="lbl">deploy.yaml</span>
                <div class="code-lines">
                  <span class="k">pipeline</span>: production<br>&nbsp;&nbsp;build: <span class="s">docker</span><br>&nbsp;&nbsp;ai_agent: <span class="s">enabled</span><br><span class="c"># zero-downtime ✓</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="fcard fc1 parallax" data-p="26"><div class="ic ic-cyan">◎</div><div><b>AI Engine</b><small>GPT · Agents · RAG</small></div></div>
        <div class="fcard fc2 parallax" data-p="34"><div class="ic ic-blue">☁</div><div><b>Cloud Native</b><small>AWS · Azure · GCP</small></div></div>
        <div class="fcard fc3 parallax" data-p="22"><div class="ic ic-red">⚡</div><div><b>Automation</b><small>4,200 hrs saved / yr</small></div></div>
        <div class="fcard fc4 parallax" data-p="30"><div class="ic ic-vio">▤</div><div><b>Analytics</b><small>Live dashboards</small></div></div>
      </div>
    </div>
    <div class="scroll-hint"><span>Scroll</span><i></i></div>
  </section>

  <!-- Circuit divider -->
  <svg class="circuit" viewBox="0 0 1200 80" preserveAspectRatio="none">
    <path id="cp1" d="M0 40 H320 L360 16 H560 L600 40 H1200"/>
    <path id="cp2" d="M0 62 H420 L460 40 H760 L800 62 H1100"/>
    <circle cx="360" cy="16" r="4"/><circle cx="600" cy="40" r="4"/><circle cx="460" cy="40" r="4"/><circle cx="1100" cy="62" r="5"/>
    <circle class="tracer" r="3.3"><animateMotion dur="7s" repeatCount="indefinite"><mpath href="#cp1"/></animateMotion></circle>
    <circle class="tracer r" r="3.3"><animateMotion dur="9s" repeatCount="indefinite"><mpath href="#cp2"/></animateMotion></circle>
  </svg>

  <!-- Counters -->
  <section class="pad" style="padding-top:70px">
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

  <!-- Services grid teaser (First 6) -->
  <section class="pad">
    <div class="wrap">
      <span class="eyebrow rv">What we build</span>
      <h2 class="sec-title rv-blur">End-to-end engineering for the <span class="grad-txt">AI-first enterprise</span></h2>
      <p class="sec-sub rv">Ten practice areas, each a dedicated page — open any card for the full breakdown, case study, and its own enquiry form.</p>
      <div class="svc-grid">
        <?php
        if (isset($SERVICES) && is_array($SERVICES)) {
          for ($j = 0; $j < min(6, count($SERVICES)); $j++) {
            $s = $SERVICES[$j];
            $detail_url = esc_url(add_query_arg('slug', $s['slug'], $services_url));
            $delay_d = $j % 2 ? 'data-d="1"' : '';
            echo '<article class="card spot svc rv tilt" ' . $delay_d . ' onclick="location.href=\'' . $detail_url . '\'">';
            echo '<div class="top"><div class="ic ' . esc_attr($s['cls']) . '" style="font-size:1.3rem">' . esc_html($s['icon']) . '</div><span class="idx">0' . ($j + 1) . '</span></div>';
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
      <div style="text-align:center;margin-top:44px" class="rv">
        <a class="btn btn-ghost magnet" href="<?php echo esc_url($services_url); ?>">View all 10 services <span class="arr">→</span></a>
      </div>
    </div>
  </section>

  <!-- Differentiators old vs new -->
  <section class="pad" style="background:var(--coal)">
    <div class="wrap">
      <span class="eyebrow rv">Why AppletLogic</span>
      <h2 class="sec-title rv-blur">The old agency model vs. <span class="grad-txt">the AppletLogic way</span></h2>
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
              ["Cost", "Scope creep and surprise invoices"],
              ["Delivery", "Big-bang launches, high risk"]
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
              ["Cost", "Transparent milestones, fixed where you need it"],
              ["Delivery", "Continuous, incremental, de-risked releases"]
            ];
            foreach ($vs_new as $row) {
              echo '<li><span class="m">✓</span><div><b>' . esc_html($row[0]) . '</b><span>' . esc_html($row[1]) . '</span></div></li>';
            }
            ?>
          </ul>
        </div>
      </div>
      <div style="text-align:center;margin-top:40px" class="rv">
        <a class="btn btn-ghost magnet" href="<?php echo esc_url($why_us_url); ?>">Our full story &amp; process <span class="arr">→</span></a>
      </div>
    </div>
  </section>

  <!-- Technology Marquees -->
  <section class="pad" style="overflow:hidden">
    <div class="wrap"><span class="eyebrow rv">Our stack</span><h2 class="sec-title rv-blur">Modern technologies, production-proven</h2></div>
    <div class="fade-edges" style="margin-top:44px">
      <div class="marquee">
        <?php
        $double_techs1 = array_merge($TECHS1, $TECHS1);
        foreach ($double_techs1 as $t) {
          echo '<span class="chip"><i></i>' . esc_html($t) . '</span>';
        }
        ?>
      </div>
      <div class="marquee rev">
        <?php
        $double_techs2 = array_merge($TECHS2, $TECHS2);
        foreach ($double_techs2 as $t) {
          echo '<span class="chip"><i></i>' . esc_html($t) . '</span>';
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Featured Work teaser (First 3) -->
  <section class="pad" style="background:var(--coal)">
    <div class="wrap">
      <span class="eyebrow rv">Featured work</span>
      <h2 class="sec-title rv-blur">Projects that moved the numbers</h2>
      <div class="pf-grid">
        <?php
        // Helper function for custom SVG drawings matching indices
        function draw_thumb_svg($art_idx) {
          $svgs = [
            '<svg viewBox="0 0 400 190" preserveAspectRatio="none"><rect width="400" height="190" fill="#101014"/><rect x="30" y="26" width="150" height="12" rx="6" fill="#356DFF" opacity=".7"/><rect x="30" y="50" width="90" height="8" rx="4" fill="#27D7FF" opacity=".4"/><rect x="30" y="80" width="160" height="84" rx="10" fill="#1A1A21"/><path d="M45 145 L75 118 L105 130 L135 100 L165 112" stroke="#27D7FF" stroke-width="3" fill="none"/><rect x="210" y="80" width="75" height="84" rx="10" fill="#1A1A21"/><circle cx="247" cy="112" r="20" fill="none" stroke="#E8434E" stroke-width="6" stroke-dasharray="90 40"/><rect x="300" y="80" width="70" height="38" rx="8" fill="#356DFF" opacity=".5"/><rect x="300" y="126" width="70" height="38" rx="8" fill="#1A1A21"/></svg>',
            '<svg viewBox="0 0 400 190" preserveAspectRatio="none"><rect width="400" height="190" fill="#121217"/><rect x="140" y="20" width="120" height="150" rx="16" fill="#1A1A21"/><rect x="158" y="40" width="84" height="10" rx="5" fill="#27D7FF" opacity=".5"/><rect x="158" y="60" width="84" height="52" rx="8" fill="#356DFF" opacity=".4"/><rect x="158" y="120" width="38" height="26" rx="6" fill="#E8434E" opacity=".7"/><rect x="204" y="120" width="38" height="26" rx="6" fill="#22222B"/><circle cx="80" cy="95" r="26" fill="none" stroke="#356DFF" stroke-width="2" opacity=".4"/><circle cx="322" cy="95" r="26" fill="none" stroke="#E8434E" stroke-width="2" opacity=".4"/></svg>',
            '<svg viewBox="0 0 400 190" preserveAspectRatio="none"><rect width="400" height="190" fill="#101014"/><rect x="30" y="30" width="340" height="130" rx="12" fill="#1A1A21"/><rect x="50" y="50" width="140" height="10" rx="5" fill="#27D7FF" opacity=".5"/><path d="M60 140 C110 90 150 130 200 85 S 300 110 345 70" stroke="#356DFF" stroke-width="2" fill="none" opacity=".8"/><circle cx="200" cy="85" r="5" fill="#E8434E"/><circle cx="345" cy="70" r="5" fill="#27D7FF"/><rect x="240" y="46" width="110" height="20" rx="10" fill="#22222B"/></svg>'
          ];
          return $svgs[$art_idx];
        }

        if (isset($PROJECTS) && is_array($PROJECTS)) {
          for ($j = 0; $j < min(3, count($PROJECTS)); $j++) {
            $p = $PROJECTS[$j];
            $delay_d = $j ? 'data-d="' . $j . '"' : '';
            echo '<article class="card pf rv" ' . $delay_d . ' onclick="location.href=\'' . esc_url($portfolio_url) . '\'">';
            echo '<div class="thumb">' . draw_thumb_svg($p['art']) . '</div>';
            echo '<div class="body"><div class="meta"><span>' . esc_html($p['ind']) . '</span><span class="red">' . esc_html($p['tech']) . '</span></div>';
            echo '<h3>' . esc_html($p['title']) . '</h3><p>' . esc_html($p['text']) . '</p>';
            echo '<a class="lnk" href="' . esc_url($portfolio_url) . '">Read Case Study <span class="arr">→</span></a></div>';
            echo '</article>';
          }
        }
        ?>
      </div>
      <div style="text-align:center;margin-top:44px" class="rv">
        <a class="btn btn-ghost magnet" href="<?php echo esc_url($portfolio_url); ?>">Full portfolio <span class="arr">→</span></a>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
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
        <h2>Ready to transform your business?</h2>
        <p>Book a free strategy session — walk away with a clear roadmap, whether or not we work together.</p>
        <a class="btn btn-grad magnet" href="<?php echo esc_url($contact_url); ?>" style="font-size:1rem;padding:18px 40px">Connect With Us <span class="arr">→</span></a>
      </div>
    </div>
  </section>
</div>

<?php
get_footer('custom');

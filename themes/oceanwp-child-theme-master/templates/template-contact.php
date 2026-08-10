<?php
/**
 * Template Name: Custom Contact Page
 * Description: Renders the Contact page with dynamic forms, contact detail cards, and an interactive layout.
 */

get_header('custom');

include_once get_stylesheet_directory() . '/inc/data.php';
global $SERVICES;
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
                  <option selected>General enquiry</option>
                  <?php
                  if (isset($SERVICES) && is_array($SERVICES)) {
                    foreach ($SERVICES as $s) {
                      echo '<option>' . esc_html($s['name']) . '</option>';
                    }
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

        <!-- Detail Cards & Map -->
        <div class="ct-info">
          <a class="ct-card rv"><div class="ic ic-cyan">📅</div><div><b>Book a discovery call</b><small>Pick a slot on our calendar</small></div></a>
          <a class="ct-card rv" data-d="1" href="#"><div class="ic" style="background:rgba(30,190,93,.12);color:#4FE58D">🟢</div><div><b>WhatsApp us</b><small>Fastest way to reach the team</small></div></a>
          <a class="ct-card rv" data-d="2" href="mailto:info@appletlogic.com"><div class="ic ic-red">✉</div><div><b>info@appletlogic.com</b><small>For proposals and partnerships</small></div></a>
          <a class="ct-card rv" data-d="3" href="tel:+916238577323"><div class="ic ic-blue">☏</div><div><b>+91 6238577323</b><small>Mon–Sat, 9:00–19:00 IST</small></div></a>
          
          <div class="map rv" data-d="4">
            <svg class="pin" width="30" height="38" viewBox="0 0 24 30">
              <path d="M12 0C5.4 0 0 5.4 0 12c0 8.5 12 18 12 18s12-9.5 12-18C24 5.4 18.6 0 12 0z" fill="#E8434E"/>
              <circle cx="12" cy="12" r="5" fill="#0A0A0B"/>
            </svg>
            <div class="ring"></div>
            <span>Calicut, Kerala · India — visits by appointment</span>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<?php
get_footer('custom');

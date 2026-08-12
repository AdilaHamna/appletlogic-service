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
$SERVICES = function_exists('appletlogic_get_services') ? appletlogic_get_services() : $SERVICES;
?>

</main> <!-- #app -->

<footer>
  <div class="wrap">
    <div class="ft-grid">
      <div class="ft-about">
        <a class="logo" href="<?php echo esc_url($home_url); ?>">
          <img src="/wp-content/uploads/2026/08/WhatsApp-Image-2026-06-05-at-10.51.04-AM-2-1.svg" alt="AppletLogic Logo" style="height: 38px; width: auto; vertical-align: middle;">
        </a>
        <p>AppletLogic Technologies LLP — a premium digital transformation partner delivering AI, enterprise software, cloud, and automation at a global standard.</p>
        <div class="socials">
          <a href="https://www.linkedin.com/company/109904548/admin/dashboard/" target="_blank" rel="noopener" aria-label="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>
          <a href="https://www.facebook.com/profile.php?id=61577082613079" target="_blank" rel="noopener" aria-label="Facebook"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="https://www.instagram.com/appletlogic?igsh=MmR2Ym96ODU2Z2Jr" target="_blank" rel="noopener" aria-label="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
          <a href="https://youtube.com/@shiljiraj?si=jHnSk1HCvEo0aIbU" target="_blank" rel="noopener" aria-label="YouTube"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.41 19c1.71.46 8.59.46 8.59.46s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg></a>
        </div>
      </div>
      <div>
        <h5>Services</h5>
        <ul id="ftServices">
          <?php
          if (isset($SERVICES) && is_array($SERVICES)) {
              for ($j = 0; $j < min(6, count($SERVICES)); $j++) {
                  $s = $SERVICES[$j];
                  $detail_url = esc_url(get_permalink($s['id']));
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
        <div class="news" id="mc_embed_shell">
          <div id="mc_embed_signup">
            <form action="https://gmail.us20.list-manage.com/subscribe/post?u=aa3b41c551732d6f2ed5e21d3&amp;id=0904c921dc&amp;f_id=002867e0f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
              <div id="mc_embed_signup_scroll">
                <input type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value="" placeholder="Your email">
                
                <div id="mce-responses" class="clear foot">
                  <div class="response" id="mce-error-response" style="display: none;"></div>
                  <div class="response" id="mce-success-response" style="display: none;"></div>
                </div>
                
                <div aria-hidden="true" style="position: absolute; left: -5000px;">
                  <input type="text" name="b_aa3b41c551732d6f2ed5e21d3_0904c921dc" tabindex="-1" value="">
                </div>
                
                <div class="optionalParent">
                  <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-ghost btn-sm" style="width:100%;justify-content:center">Subscribe</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="ft-bottom">
      <span>© <?php echo date('Y'); ?> AppletLogic Technologies LLP. All rights reserved.</span>
      <span>Calicut · Kerala · India · info@gmail.com</span>
    </div>
  </div>
</footer>

<?php echo do_shortcode('[contact-form-7 id="64" title="Pop up form"]'); ?>

<div class="float-ct">
  <a class="f-cal" data-tip="Book a meeting" href="<?php echo esc_url($contact_url); ?>">📅</a>
  <a class="f-wa" data-tip="WhatsApp" href="https://wa.me/919061914915" target="_blank" rel="noopener"><svg width="23" height="23" viewBox="0 0 24 24" fill="#fff"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5.1-1.3A10 10 0 1 0 12 2zm5.3 14.1c-.2.6-1.3 1.2-1.8 1.2-.5.1-1 .2-3.4-.7-2.9-1.1-4.7-4-4.9-4.2-.1-.2-1.1-1.5-1.1-2.9s.7-2 1-2.3c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5s.8 1.9.8 2c.1.1.1.3 0 .5l-.4.6c-.1.2-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1.1 2.2 1.4 2.5 1.5.3.1.5.1.7-.1l.9-1c.2-.3.4-.2.7-.1l2 1c.3.1.5.2.6.3 0 .1 0 .7-.2 1.3z"/></svg></a>
  <a class="f-call" data-tip="Call us" href="tel:+919061914915">☏</a>
  <a class="f-mail" data-tip="Email" href="mailto:info@gmail.com">✉</a>
</div>

<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
<script type="text/javascript">
(function($) {
  window.fnames = new Array();
  window.ftypes = new Array();
  fnames[0]='EMAIL';
  ftypes[0]='email';
  fnames[1]='FNAME';
  ftypes[1]='text';
  fnames[2]='LNAME';
  ftypes[2]='text';
  fnames[3]='ADDRESS';
  ftypes[3]='address';
  fnames[4]='PHONE';
  ftypes[4]='phone';
  fnames[5]='BIRTHDAY';
  ftypes[5]='birthday';
  fnames[6]='COMPANY';
  ftypes[6]='text';
}(jQuery));
var $mcj = jQuery.noConflict(true);

// SMS Phone Multi-Country Functionality
if(!window.MC) {
  window.MC = {};
}
window.MC.smsPhoneData = {
  defaultCountryCode: 'IN',
  programs: [],
  smsProgramDataCountryNames: []
};

function getCountryUnicodeFlag(countryCode) {
   return countryCode.toUpperCase().replace(/./g, (char) => String.fromCodePoint(char.charCodeAt(0) + 127397))
};

function sanitizeHtml(str) {
  if (typeof str !== 'string') return '';
  return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#x27;')
    .replace(/\//g, '&#x2F;');
}

function sanitizeUrl(url) {
  if (typeof url !== 'string') return '';
  const trimmedUrl = url.trim().toLowerCase();
  if (trimmedUrl.startsWith('javascript:') || trimmedUrl.startsWith('data:') || trimmedUrl.startsWith('vbscript:')) {
    return '#';
  }
  return url;
}

const getBrowserLanguage = () => {
  if (!window?.navigator?.language?.split('-')[1]) {
    return window?.navigator?.language?.toUpperCase();
  }
  return window?.navigator?.language?.split('-')[1];
};

function getDefaultCountryProgram(defaultCountryCode, smsProgramData) {
  if (!smsProgramData || smsProgramData.length === 0) {
    return null;
  }
  const browserLanguage = getBrowserLanguage();
  if (browserLanguage) {
    const foundProgram = smsProgramData.find(
      (program) => program?.countryCode === browserLanguage,
    );
    if (foundProgram) {
      return foundProgram;
    }
  }
  if (defaultCountryCode) {
    const foundProgram = smsProgramData.find(
      (program) => program?.countryCode === defaultCountryCode,
    );
    if (foundProgram) {
      return foundProgram;
    }
  }
  return smsProgramData[0];
}

function updateSmsLegalText(countryCode, fieldName) {
  if (!countryCode || !fieldName) {
    return;
  }
  const programs = window?.MC?.smsPhoneData?.programs;
  if (!programs || !Array.isArray(programs)) {
    return;
  }
  const program = programs.find(program => program?.countryCode === countryCode);
  if (!program || !program.requiredTemplate) {
    return;
  }
  var smsConsentHtmlRenderingFixEnabled = true;
  const legalTextElement = document.querySelector('#legal-text-' + fieldName);
  if (!legalTextElement) {
    return;
  }
  const divRegex = new RegExp('</?[div][^>]*>', 'gi');
  const blockWrapperRegex = new RegExp('</?(?:div|p)[^>]*>', 'gi');
  const fullAnchorRegex = new RegExp('<a.*?</a>', 'g');
  const anchorRegex = new RegExp('<a href="(.*?)" target="(.*?)">(.*?)</a>');
  const template = smsConsentHtmlRenderingFixEnabled
    ? program.requiredTemplate
        .replace(/<\/p>\s*<p[^>]*>/gi, ' ')
        .replace(blockWrapperRegex, '')
    : program.requiredTemplate.replace(divRegex, '');

  legalTextElement.textContent = '';
  const parts = template.split(/(<a href=".*?" target=".*?">.*?<\/a>)/g);
  parts.forEach(function(part) {
    if (!part) {
      return;
    }
    const anchorMatch = part.match(/<a href="(.*?)" target="(.*?)">(.*?)<\/a>/);
    if (anchorMatch) {
      const linkElement = document.createElement('a');
      linkElement.href = sanitizeUrl(anchorMatch[1]);
      linkElement.target = sanitizeHtml(anchorMatch[2]);
      linkElement.textContent = sanitizeHtml(anchorMatch[3]);
      legalTextElement.appendChild(linkElement);
    } else {
      legalTextElement.appendChild(document.createTextNode(part));
    }
  });
}

function generateDropdownOptions(smsProgramData) {
  if (!smsProgramData || smsProgramData.length === 0) {
    return '';
  }
  var programs = smsProgramData;
  return programs.map(program => {
    const flag = getCountryUnicodeFlag(program.countryCode);
    const countryName = getCountryName(program.countryCode);
    const callingCode = program.countryCallingCode || '';
    const sanitizedCountryCode = sanitizeHtml(program.countryCode || '');
    const sanitizedCountryName = sanitizeHtml(countryName || '');
    const sanitizedCallingCode = sanitizeHtml(callingCode || '');
    return '<option value="' + sanitizedCountryCode + '">' + sanitizedCountryName + ' ' + sanitizedCallingCode + '</option>';
  }).join('');
}

function getCountryName(countryCode) {
  if (window.MC?.smsPhoneData?.smsProgramDataCountryNames && Array.isArray(window.MC.smsPhoneData.smsProgramDataCountryNames)) {
    for (let i = 0; i < window.MC.smsPhoneData.smsProgramDataCountryNames.length; i++) {
      if (window.MC.smsPhoneData.smsProgramDataCountryNames[i].code === countryCode) {
        return window.MC.smsPhoneData.smsProgramDataCountryNames[i].name;
      }
    }
  }
  return countryCode;
}

function getDefaultPlaceholder(countryCode) {
  if (!countryCode || typeof countryCode !== 'string') {
    return '+1 000 000 0000';
  }
  var mockPlaceholders = [
    { countryCode: 'US', placeholder: '+1 000 000 0000' },
    { countryCode: 'GB', placeholder: '+44 0000 000000' },
    { countryCode: 'CA', placeholder: '+1 000 000 0000' },
    { countryCode: 'AU', placeholder: '+61 000 000 000' },
  ];
  const selectedPlaceholder = mockPlaceholders.find(function(item) {
    return item && item.countryCode === countryCode;
  });
  return selectedPlaceholder ? selectedPlaceholder.placeholder : mockPlaceholders[0].placeholder;
}

function updatePlaceholder(countryCode, fieldName) {
  if (!countryCode || !fieldName) {
    return;
  }
  const phoneInput = document.querySelector('#mce-' + fieldName);
  if (!phoneInput) {
    return;
  }
  const placeholder = getDefaultPlaceholder(countryCode);
  if (placeholder) {
    phoneInput.placeholder = placeholder;
  }
}

function updateCountryCodeInstruction(countryCode, fieldName) {
  updatePlaceholder(countryCode, fieldName);
}

function initializeSmsPhoneDropdown(fieldName) {
  if (!fieldName || typeof fieldName !== 'string') {
    return;
  }
  const dropdown = document.querySelector('#country-select-' + fieldName);
  const displayFlag = document.querySelector('#flag-display-' + fieldName);
  if (!dropdown || !displayFlag) {
    return;
  }
  const smsPhoneData = window.MC?.smsPhoneData;
  if (smsPhoneData && smsPhoneData.programs && Array.isArray(smsPhoneData.programs)) {
    dropdown.innerHTML = generateDropdownOptions(smsPhoneData.programs);
  }
  const defaultProgram = getDefaultCountryProgram(smsPhoneData?.defaultCountryCode, smsPhoneData?.programs);
  if (defaultProgram && defaultProgram.countryCode) {
    dropdown.value = defaultProgram.countryCode;
    const flagSpan = displayFlag?.querySelector('#flag-emoji-' + fieldName);
    if (flagSpan) {
      flagSpan.textContent = getCountryUnicodeFlag(defaultProgram.countryCode);
      flagSpan.setAttribute('aria-label', sanitizeHtml(defaultProgram.countryCode) + ' flag');
    }
    updateSmsLegalText(defaultProgram.countryCode, fieldName);
    updatePlaceholder(defaultProgram.countryCode, fieldName);
    updateCountryCodeInstruction(defaultProgram.countryCode, fieldName);
  }
  displayFlag?.addEventListener('click', function(e) {
    dropdown.focus();
  });
  dropdown?.addEventListener('change', function() {
    const selectedCountry = this.value;
    if (!selectedCountry || typeof selectedCountry !== 'string') {
      return;
    }
    const flagSpan = displayFlag?.querySelector('#flag-emoji-' + fieldName);
    if (flagSpan) {
      flagSpan.textContent = getCountryUnicodeFlag(selectedCountry);
      flagSpan.setAttribute('aria-label', sanitizeHtml(selectedCountry) + ' flag');
    }
    updateSmsLegalText(selectedCountry, fieldName);
    updatePlaceholder(selectedCountry, fieldName);
    updateCountryCodeInstruction(selectedCountry, fieldName);
  });
}

document.addEventListener('DOMContentLoaded', function() {
  const smsPhoneFields = document.querySelectorAll('[id^="country-select-"]');
  smsPhoneFields.forEach(function(dropdown) {
    const fieldName = dropdown?.id.replace('country-select-', '');
    initializeSmsPhoneDropdown(fieldName);
  });
});
</script>

<?php wp_footer(); ?>
</body>
</html>

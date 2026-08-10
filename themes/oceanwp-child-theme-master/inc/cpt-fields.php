<?php
/**
 * Custom Post Types, Custom Fields, and database querying functions for Services and Testimonials.
 */

// Register CPTs
function appletlogic_register_cpts() {
    // Services CPT
    register_post_type('service', array(
        'labels' => array(
            'name' => __('Services', 'oceanwp'),
            'singular_name' => __('Service', 'oceanwp'),
            'add_new' => __('Add New Service', 'oceanwp'),
            'add_new_item' => __('Add New Service', 'oceanwp'),
            'edit_item' => __('Edit Service', 'oceanwp'),
            'new_item' => __('New Service', 'oceanwp'),
            'view_item' => __('View Service', 'oceanwp'),
            'search_items' => __('Search Services', 'oceanwp'),
            'not_found' => __('No Services found', 'oceanwp'),
            'not_found_in_trash' => __('No Services found in Trash', 'oceanwp'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        'menu_icon' => 'dashicons-admin-tools',
        'rewrite' => array('slug' => 'service', 'with_front' => false),
    ));

    // Testimonials CPT
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'oceanwp'),
            'singular_name' => __('Testimonial', 'oceanwp'),
            'add_new' => __('Add New Testimonial', 'oceanwp'),
            'add_new_item' => __('Add New Testimonial', 'oceanwp'),
            'edit_item' => __('Edit Testimonial', 'oceanwp'),
            'new_item' => __('New Testimonial', 'oceanwp'),
            'view_item' => __('View Testimonial', 'oceanwp'),
            'search_items' => __('Search Testimonials', 'oceanwp'),
            'not_found' => __('No Testimonials found', 'oceanwp'),
            'not_found_in_trash' => __('No Testimonials found in Trash', 'oceanwp'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'revisions', 'page-attributes'),
        'menu_icon' => 'dashicons-testimonial',
        'rewrite' => array('slug' => 'testimonial', 'with_front' => false),
    ));
}
add_action('init', 'appletlogic_register_cpts');

// Seed data function
function appletlogic_seed_data() {
    // Self-healing migration for corrupted Unicode escape characters
    $check_query = new WP_Query(array(
        'post_type' => 'service',
        'posts_per_page' => 1,
        'post_status' => 'any',
    ));
    if ($check_query->have_posts()) {
        $check_query->the_post();
        $benefits_json = get_post_meta(get_the_ID(), '_service_benefits', true);
        if (strpos($benefits_json, '"u2') !== false || strpos($benefits_json, '\\u2') !== false) {
            // Delete all services and testimonials so they get re-seeded correctly
            $all_services = get_posts(array('post_type' => 'service', 'numberposts' => -1, 'post_status' => 'any'));
            foreach ($all_services as $post) {
                wp_delete_post($post->ID, true);
            }
            $all_testimonials = get_posts(array('post_type' => 'testimonial', 'numberposts' => -1, 'post_status' => 'any'));
            foreach ($all_testimonials as $post) {
                wp_delete_post($post->ID, true);
            }
            delete_transient('appletlogic_rewrites_flushed_v2');
        }
        wp_reset_postdata();
    }

    $services_query = new WP_Query(array(
        'post_type' => 'service',
        'posts_per_page' => 1,
        'post_status' => 'any',
    ));
    
    $seeded = false;

    if (!$services_query->have_posts()) {
        include_once get_stylesheet_directory() . '/inc/data.php';
        global $SERVICES;
        if (isset($SERVICES) && is_array($SERVICES)) {
            foreach ($SERVICES as $idx => $s) {
                // Insert service post
                $post_id = wp_insert_post(array(
                    'post_title'   => $s['name'],
                    'post_name'    => $s['slug'],
                    'post_status'  => 'publish',
                    'post_type'    => 'service',
                    'menu_order'   => $idx,
                    'post_content' => '',
                ));
                if (!is_wp_error($post_id)) {
                    update_post_meta($post_id, '_service_icon', $s['icon']);
                    update_post_meta($post_id, '_service_cls', $s['cls']);
                    update_post_meta($post_id, '_service_short', $s['short']);
                    update_post_meta($post_id, '_service_tags', implode(', ', $s['tags']));
                    update_post_meta($post_id, '_service_problem', $s['problem']);
                    update_post_meta($post_id, '_service_solution', $s['solution']);
                    update_post_meta($post_id, '_service_benefits', json_encode($s['benefits'], JSON_UNESCAPED_UNICODE));
                    update_post_meta($post_id, '_service_process', json_encode($s['process'], JSON_UNESCAPED_UNICODE));
                    update_post_meta($post_id, '_service_techs', implode(', ', $s['techs']));
                    update_post_meta($post_id, '_service_cs_stat', $s['cs']['stat']);
                    update_post_meta($post_id, '_service_cs_stat_label', $s['cs']['statLabel']);
                    update_post_meta($post_id, '_service_cs_title', $s['cs']['title']);
                    update_post_meta($post_id, '_service_cs_text', $s['cs']['text']);
                    update_post_meta($post_id, '_service_faqs', json_encode($s['faqs'], JSON_UNESCAPED_UNICODE));
                }
            }
            $seeded = true;
        }
    }

    $testimonials_query = new WP_Query(array(
        'post_type' => 'testimonial',
        'posts_per_page' => 1,
        'post_status' => 'any',
    ));
    if (!$testimonials_query->have_posts()) {
        include_once get_stylesheet_directory() . '/inc/data.php';
        global $TESTIMONIALS;
        if (isset($TESTIMONIALS) && is_array($TESTIMONIALS)) {
            foreach ($TESTIMONIALS as $idx => $tst) {
                // Insert testimonial post
                $post_id = wp_insert_post(array(
                    'post_title'   => $tst[1],
                    'post_content' => $tst[3],
                    'post_status'  => 'publish',
                    'post_type'    => 'testimonial',
                    'menu_order'   => $idx,
                ));
                if (!is_wp_error($post_id)) {
                    update_post_meta($post_id, '_testimonial_initials', $tst[0]);
                    update_post_meta($post_id, '_testimonial_role_company', $tst[2]);
                    update_post_meta($post_id, '_testimonial_avatar_bg', $tst[4]);
                }
            }
            $seeded = true;
        }
    }

    if ($seeded) {
        flush_rewrite_rules();
    }
}
add_action('init', 'appletlogic_seed_data', 20);

// Flush rewrites once to make new single-service CPT URLs active
function appletlogic_flush_rewrites_once() {
    if (!get_transient('appletlogic_rewrites_flushed_v2')) {
        flush_rewrite_rules(false);
        set_transient('appletlogic_rewrites_flushed_v2', 1, DAY_IN_SECONDS);
    }
}
add_action('init', 'appletlogic_flush_rewrites_once', 99);

// Add custom meta boxes for service details
function appletlogic_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __('Service Details', 'oceanwp'),
        'appletlogic_service_meta_box_html',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'appletlogic_add_service_meta_boxes');

// Meta box HTML for service details
function appletlogic_service_meta_box_html($post) {
    wp_nonce_field('appletlogic_save_service_meta', 'appletlogic_service_meta_nonce');

    $icon = get_post_meta($post->ID, '_service_icon', true);
    $cls = get_post_meta($post->ID, '_service_cls', true);
    $short = get_post_meta($post->ID, '_service_short', true);
    $tags = get_post_meta($post->ID, '_service_tags', true);
    $problem = get_post_meta($post->ID, '_service_problem', true);
    $solution = get_post_meta($post->ID, '_service_solution', true);
    $techs = get_post_meta($post->ID, '_service_techs', true);
    
    $cs_stat = get_post_meta($post->ID, '_service_cs_stat', true);
    $cs_stat_label = get_post_meta($post->ID, '_service_cs_stat_label', true);
    $cs_title = get_post_meta($post->ID, '_service_cs_title', true);
    $cs_text = get_post_meta($post->ID, '_service_cs_text', true);

    $benefits_json = get_post_meta($post->ID, '_service_benefits', true);
    $benefits = json_decode($benefits_json, true);
    if (!is_array($benefits)) {
        $benefits = array_fill(0, 6, array('', '', ''));
    } else {
        while (count($benefits) < 6) {
            $benefits[] = array('', '', '');
        }
    }

    $process_json = get_post_meta($post->ID, '_service_process', true);
    $process = json_decode($process_json, true);
    if (!is_array($process)) {
        $process = array_fill(0, 6, '');
    } else {
        while (count($process) < 6) {
            $process[] = '';
        }
    }

    $faqs_json = get_post_meta($post->ID, '_service_faqs', true);
    $faqs = json_decode($faqs_json, true);
    if (!is_array($faqs)) {
        $faqs = array_fill(0, 3, array('', ''));
    } else {
        while (count($faqs) < 3) {
            $faqs[] = array('', '');
        }
    }
    ?>
    <style>
        .al-meta-group { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .al-meta-group h3 { margin-top: 0; color: #1d2327; font-size: 1.1em; border-bottom: 2px solid #2271b1; padding-bottom: 5px; display: inline-block; }
        .al-field-row { display: flex; flex-wrap: wrap; margin-bottom: 12px; }
        .al-field-col { flex: 1; min-width: 250px; margin-right: 15px; margin-bottom: 10px; }
        .al-field-col:last-child { margin-right: 0; }
        .al-field-col label { display: block; font-weight: bold; margin-bottom: 5px; color: #3c434a; }
        .al-field-col input[type="text"], .al-field-col textarea, .al-field-col select { width: 100%; box-sizing: border-box; }
        .al-benefit-row, .al-faq-row { border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; background: #f9f9f9; border-radius: 4px; }
        .al-benefit-row h4, .al-faq-row h4 { margin: 0 0 8px 0; font-size: 0.95em; color: #1d2327; }
    </style>

    <div class="al-meta-group">
        <h3>General Settings</h3>
        <div class="al-field-row">
            <div class="al-field-col" style="flex: 0 0 150px;">
                <label for="service_icon">Icon (Unicode/Emoji)</label>
                <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>">
            </div>
            <div class="al-field-col" style="flex: 0 0 200px;">
                <label for="service_cls">Color Class</label>
                <select id="service_cls" name="service_cls">
                    <option value="ic-blue" <?php selected($cls, 'ic-blue'); ?>>Blue (ic-blue)</option>
                    <option value="ic-cyan" <?php selected($cls, 'ic-cyan'); ?>>Cyan (ic-cyan)</option>
                    <option value="ic-vio" <?php selected($cls, 'ic-vio'); ?>>Violet (ic-vio)</option>
                    <option value="ic-red" <?php selected($cls, 'ic-red'); ?>>Red (ic-red)</option>
                </select>
            </div>
            <div class="al-field-col">
                <label for="service_tags">Tags (Comma separated)</label>
                <input type="text" id="service_tags" name="service_tags" value="<?php echo esc_attr($tags); ?>" placeholder="e.g. Next.js, React, Angular">
            </div>
        </div>
        <div class="al-field-row">
            <div class="al-field-col">
                <label for="service_short">Short Description (for Listing and Teasers)</label>
                <textarea id="service_short" name="service_short" rows="2"><?php echo esc_textarea($short); ?></textarea>
            </div>
        </div>
    </div>

    <div class="al-meta-group">
        <h3>Problem &amp; Solution</h3>
        <div class="al-field-row">
            <div class="al-field-col">
                <label for="service_problem">The Problem</label>
                <textarea id="service_problem" name="service_problem" rows="3"><?php echo esc_textarea($problem); ?></textarea>
            </div>
            <div class="al-field-col">
                <label for="service_solution">Our Solution</label>
                <textarea id="service_solution" name="service_solution" rows="3"><?php echo esc_textarea($solution); ?></textarea>
            </div>
        </div>
    </div>

    <div class="al-meta-group">
        <h3>Case Study</h3>
        <div class="al-field-row">
            <div class="al-field-col" style="flex: 0 0 180px;">
                <label for="service_cs_stat">Stat Value</label>
                <input type="text" id="service_cs_stat" name="service_cs_stat" value="<?php echo esc_attr($cs_stat); ?>" placeholder="e.g. +312% or 3.1×">
            </div>
            <div class="al-field-col" style="flex: 0 0 250px;">
                <label for="service_cs_stat_label">Stat Label</label>
                <input type="text" id="service_cs_stat_label" name="service_cs_stat_label" value="<?php echo esc_attr($cs_stat_label); ?>" placeholder="e.g. organic traffic in 6 months">
            </div>
            <div class="al-field-col">
                <label for="service_cs_title">Case Study Title</label>
                <input type="text" id="service_cs_title" name="service_cs_title" value="<?php echo esc_attr($cs_title); ?>">
            </div>
        </div>
        <div class="al-field-row">
            <div class="al-field-col">
                <label for="service_cs_text">Case Study Text Description</label>
                <textarea id="service_cs_text" name="service_cs_text" rows="3"><?php echo esc_textarea($cs_text); ?></textarea>
            </div>
        </div>
    </div>

    <div class="al-meta-group">
        <h3>Technologies</h3>
        <div class="al-field-row">
            <div class="al-field-col">
                <label for="service_techs">Tools We Reach For (Comma separated)</label>
                <input type="text" id="service_techs" name="service_techs" value="<?php echo esc_attr($techs); ?>" placeholder="e.g. Next.js, React, Angular, TypeScript">
            </div>
        </div>
    </div>

    <div class="al-meta-group">
        <h3>Benefits (Exactly 6 benefits required for grid layout)</h3>
        <?php for ($i = 0; $i < 6; $i++): 
            $b_icon = isset($benefits[$i][0]) ? $benefits[$i][0] : '';
            $b_title = isset($benefits[$i][1]) ? $benefits[$i][1] : '';
            $b_desc = isset($benefits[$i][2]) ? $benefits[$i][2] : '';
        ?>
            <div class="al-benefit-row">
                <h4>Benefit #<?php echo ($i + 1); ?></h4>
                <div class="al-field-row" style="margin-bottom:0">
                    <div class="al-field-col" style="flex: 0 0 100px; min-width: 100px;">
                        <label>Icon</label>
                        <input type="text" name="service_benefits[<?php echo $i; ?>][icon]" value="<?php echo esc_attr($b_icon); ?>">
                    </div>
                    <div class="al-field-col" style="flex: 0 0 250px;">
                        <label>Title</label>
                        <input type="text" name="service_benefits[<?php echo $i; ?>][title]" value="<?php echo esc_attr($b_title); ?>">
                    </div>
                    <div class="al-field-col">
                        <label>Description</label>
                        <input type="text" name="service_benefits[<?php echo $i; ?>][desc]" value="<?php echo esc_attr($b_desc); ?>">
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <div class="al-meta-group">
        <h3>Process Steps (Exactly 6 steps required for roadmap timeline)</h3>
        <div class="al-field-row">
            <?php for ($i = 0; $i < 6; $i++): 
                $step_val = isset($process[$i]) ? $process[$i] : '';
            ?>
                <div class="al-field-col" style="flex: 0 0 45%; min-width: 250px;">
                    <label>Step 0<?php echo ($i + 1); ?></label>
                    <input type="text" name="service_process[<?php echo $i; ?>]" value="<?php echo esc_attr($step_val); ?>">
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="al-meta-group" style="border-bottom:none; margin-bottom:0; padding-bottom:0;">
        <h3>FAQs (Exactly 3 FAQs recommended)</h3>
        <?php for ($i = 0; $i < 3; $i++): 
            $faq_q = isset($faqs[$i][0]) ? $faqs[$i][0] : '';
            $faq_a = isset($faqs[$i][1]) ? $faqs[$i][1] : '';
        ?>
            <div class="al-faq-row">
                <h4>FAQ #<?php echo ($i + 1); ?></h4>
                <div class="al-field-row" style="margin-bottom:0">
                    <div class="al-field-col">
                        <label>Question</label>
                        <input type="text" name="service_faqs[<?php echo $i; ?>][q]" value="<?php echo esc_attr($faq_q); ?>">
                    </div>
                    <div class="al-field-col">
                        <label>Answer</label>
                        <textarea name="service_faqs[<?php echo $i; ?>][a]" rows="2"><?php echo esc_textarea($faq_a); ?></textarea>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <?php
}

// Save Service CPT metadata
function appletlogic_save_service_meta($post_id) {
    if (!isset($_POST['appletlogic_service_meta_nonce']) || !wp_verify_nonce($_POST['appletlogic_service_meta_nonce'], 'appletlogic_save_service_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $simple_fields = array(
        'service_icon'     => '_service_icon',
        'service_cls'      => '_service_cls',
        'service_tags'     => '_service_tags',
        'service_techs'    => '_service_techs',
        'service_cs_stat'  => '_service_cs_stat',
        'service_cs_stat_label' => '_service_cs_stat_label',
        'service_cs_title' => '_service_cs_title',
    );

    foreach ($simple_fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    $textarea_fields = array(
        'service_short'    => '_service_short',
        'service_problem'  => '_service_problem',
        'service_solution' => '_service_solution',
        'service_cs_text'  => '_service_cs_text',
    );

    foreach ($textarea_fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, wp_kses_post($_POST[$post_key]));
        }
    }

    if (isset($_POST['service_benefits']) && is_array($_POST['service_benefits'])) {
        $benefits = array();
        foreach ($_POST['service_benefits'] as $idx => $b) {
            $icon = sanitize_text_field($b['icon']);
            $title = sanitize_text_field($b['title']);
            $desc = sanitize_text_field($b['desc']);
            $benefits[] = array($icon, $title, $desc);
        }
        update_post_meta($post_id, '_service_benefits', json_encode($benefits, JSON_UNESCAPED_UNICODE));
    }

    if (isset($_POST['service_process']) && is_array($_POST['service_process'])) {
        $process = array_map('sanitize_text_field', $_POST['service_process']);
        update_post_meta($post_id, '_service_process', json_encode($process, JSON_UNESCAPED_UNICODE));
    }

    if (isset($_POST['service_faqs']) && is_array($_POST['service_faqs'])) {
        $faqs = array();
        foreach ($_POST['service_faqs'] as $idx => $faq) {
            $q = sanitize_text_field($faq['q']);
            $a = wp_kses_post($faq['a']);
            $faqs[] = array($q, $a);
        }
        update_post_meta($post_id, '_service_faqs', json_encode($faqs, JSON_UNESCAPED_UNICODE));
    }
}
add_action('save_post_service', 'appletlogic_save_service_meta');

// Add testimonial meta boxes
function appletlogic_add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'oceanwp'),
        'appletlogic_testimonial_meta_box_html',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'appletlogic_add_testimonial_meta_boxes');

function appletlogic_testimonial_meta_box_html($post) {
    wp_nonce_field('appletlogic_save_testimonial_meta', 'appletlogic_testimonial_meta_nonce');

    $initials = get_post_meta($post->ID, '_testimonial_initials', true);
    $role_company = get_post_meta($post->ID, '_testimonial_role_company', true);
    $avatar_bg = get_post_meta($post->ID, '_testimonial_avatar_bg', true);
    
    $default_bgs = array(
        'linear-gradient(140deg,#356DFF,#27D7FF)' => 'Blue-Cyan Gradient',
        'linear-gradient(140deg,#E8434E,#9E1B22)' => 'Red-DarkRed Gradient',
        'linear-gradient(140deg,#4A3DD8,#356DFF)' => 'Purple-Blue Gradient',
        'linear-gradient(140deg,#27D7FF,#356DFF)' => 'Cyan-Blue Gradient',
        'linear-gradient(140deg,#9E1B22,#E8434E)' => 'DarkRed-Red Gradient',
    );
    ?>
    <style>
        .al-field-col label { display: block; font-weight: bold; margin-bottom: 5px; color: #3c434a; }
        .al-field-col input[type="text"], .al-field-col select { width: 100%; box-sizing: border-box; }
    </style>
    <div style="padding: 10px 0;">
        <div style="display: flex; flex-wrap: wrap; margin-bottom: 12px;">
            <div class="al-field-col" style="flex: 0 0 150px; margin-right: 15px;">
                <label for="testimonial_initials">Initials (for Avatar)</label>
                <input type="text" id="testimonial_initials" name="testimonial_initials" value="<?php echo esc_attr($initials); ?>" placeholder="e.g. RS">
            </div>
            <div class="al-field-col" style="flex: 1; min-width: 250px; margin-right: 15px;">
                <label for="testimonial_role_company">Role &amp; Company</label>
                <input type="text" id="testimonial_role_company" name="testimonial_role_company" value="<?php echo esc_attr($role_company); ?>" placeholder="e.g. Director, Multispecialty Hospital Group">
            </div>
            <div class="al-field-col" style="flex: 1; min-width: 250px;">
                <label for="testimonial_avatar_bg">Avatar Background Color/Gradient</label>
                <input type="text" id="testimonial_avatar_bg" name="testimonial_avatar_bg" value="<?php echo esc_attr($avatar_bg); ?>" placeholder="e.g. linear-gradient(140deg,#356DFF,#27D7FF)">
                <small style="color: #666;">Suggested presets:
                    <select onchange="document.getElementById('testimonial_avatar_bg').value = this.value;" style="margin-top: 5px; width: 100%;">
                        <option value="">-- Choose Preset Gradient --</option>
                        <?php foreach ($default_bgs as $bg_val => $bg_lbl): ?>
                            <option value="<?php echo esc_attr($bg_val); ?>"><?php echo esc_html($bg_lbl); ?></option>
                        <?php endforeach; ?>
                    </select>
                </small>
            </div>
        </div>
    </div>
    <?php
}

function appletlogic_save_testimonial_meta($post_id) {
    if (!isset($_POST['appletlogic_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['appletlogic_testimonial_meta_nonce'], 'appletlogic_save_testimonial_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['testimonial_initials'])) {
        update_post_meta($post_id, '_testimonial_initials', sanitize_text_field($_POST['testimonial_initials']));
    }
    if (isset($_POST['testimonial_role_company'])) {
        update_post_meta($post_id, '_testimonial_role_company', sanitize_text_field($_POST['testimonial_role_company']));
    }
    if (isset($_POST['testimonial_avatar_bg'])) {
        update_post_meta($post_id, '_testimonial_avatar_bg', sanitize_text_field($_POST['testimonial_avatar_bg']));
    }
}
add_action('save_post_testimonial', 'appletlogic_save_testimonial_meta');

// Helper to query services
function appletlogic_get_services() {
    $query = new WP_Query(array(
        'post_type' => 'service',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ));
    $services = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            
            $tags_str = get_post_meta($post_id, '_service_tags', true);
            $tags = $tags_str ? array_map('trim', explode(',', $tags_str)) : array();
            
            $techs_str = get_post_meta($post_id, '_service_techs', true);
            $techs = $techs_str ? array_map('trim', explode(',', $techs_str)) : array();

            $benefits_json = get_post_meta($post_id, '_service_benefits', true);
            $benefits = json_decode($benefits_json, true);
            if (!is_array($benefits)) {
                $benefits = array();
            }

            $process_json = get_post_meta($post_id, '_service_process', true);
            $process = json_decode($process_json, true);
            if (!is_array($process)) {
                $process = array();
            }

            $faqs_json = get_post_meta($post_id, '_service_faqs', true);
            $faqs = json_decode($faqs_json, true);
            if (!is_array($faqs)) {
                $faqs = array();
            }

            $services[] = array(
                'id' => $post_id,
                'slug' => get_post_field('post_name', $post_id),
                'name' => get_the_title(),
                'icon' => get_post_meta($post_id, '_service_icon', true),
                'cls' => get_post_meta($post_id, '_service_cls', true),
                'short' => get_post_meta($post_id, '_service_short', true),
                'tags' => $tags,
                'problem' => get_post_meta($post_id, '_service_problem', true),
                'solution' => get_post_meta($post_id, '_service_solution', true),
                'benefits' => $benefits,
                'process' => $process,
                'techs' => $techs,
                'cs' => array(
                    'stat' => get_post_meta($post_id, '_service_cs_stat', true),
                    'statLabel' => get_post_meta($post_id, '_service_cs_stat_label', true),
                    'title' => get_post_meta($post_id, '_service_cs_title', true),
                    'text' => get_post_meta($post_id, '_service_cs_text', true),
                ),
                'faqs' => $faqs,
            );
        }
        wp_reset_postdata();
    }
    return $services;
}

// Helper to query testimonials
function appletlogic_get_testimonials() {
    $query = new WP_Query(array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ));
    $testimonials = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $testimonials[] = array(
                get_post_meta($post_id, '_testimonial_initials', true),
                get_the_title(),
                get_post_meta($post_id, '_testimonial_role_company', true),
                get_the_content(),
                get_post_meta($post_id, '_testimonial_avatar_bg', true),
            );
        }
        wp_reset_postdata();
    }
    return $testimonials;
}

// Disable Contact Form 7 auto-paragraph and line-break formatting
add_filter('wpcf7_autop_or_not', '__return_false');

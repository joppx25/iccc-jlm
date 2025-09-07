<?php
// Theme setup
function conference_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('woocommerce');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
    
    // Set image sizes
    add_image_size('conference-hero', 1920, 1080, true);
    add_image_size('conference-thumb', 400, 300, true);
}
add_action('after_setup_theme', 'conference_theme_setup');

// Enqueue styles and scripts
function conference_theme_scripts() {
    wp_enqueue_style('conference-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('conference-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
    wp_enqueue_script('conference-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Add Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@400;600;700&display=swap', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'conference_theme_scripts');

// Custom post type for registrations (alternative to WooCommerce if needed)
function create_registration_post_type() {
    register_post_type('registration', array(
        'public' => true,
        'label' => 'Registrations',
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-groups',
        'show_in_admin_bar' => true,
    ));
}
add_action('init', 'create_registration_post_type');

// Add custom admin menu
function conference_admin_menu() {
    add_menu_page(
        'Conference Dashboard',
        'Conference',
        'manage_options',
        'conference-dashboard',
        'conference_dashboard_page',
        'dashicons-calendar-alt',
        25
    );
    
    add_submenu_page(
        'conference-dashboard',
        'Export Registrations',
        'Export Data',
        'manage_options',
        'export-registrations',
        'export_registrations_page'
    );
}
add_action('admin_menu', 'conference_admin_menu');

// Dashboard page callback
function conference_dashboard_page() {
    include get_template_directory() . '/admin/admin-dashboard.php';
}

function export_registrations_page() {
    include get_template_directory() . '/admin/export-registrations.php';
}

// Widget areas
function conference_widgets_init() {
    register_sidebar(array(
        'name' => 'Footer Widget Area',
        'id' => 'footer-sidebar',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'conference_widgets_init');

// Custom URL rewrite rules for clean URLs
function conference_custom_rewrite_rules() {
    // Add custom query variables
    add_rewrite_tag('%custom_page%', '([^&]+)');
    
    // Add rewrite rules for custom pages
    add_rewrite_rule('^faq/?$', 'index.php?custom_page=faq', 'top');
    add_rewrite_rule('^registration/?$', 'index.php?custom_page=registration', 'top');
}
add_action('init', 'conference_custom_rewrite_rules');

// Add custom query variables
function conference_add_query_vars($vars) {
    $vars[] = 'custom_page';
    return $vars;
}
add_filter('query_vars', 'conference_add_query_vars');

// Template redirect for custom pages
function conference_template_redirect() {
    $custom_page = get_query_var('custom_page');
    
    if ($custom_page) {
        $template_file = '';
        
        switch ($custom_page) {
            case 'faq':
                $template_file = 'page-faq.php';
                break;
            case 'registration':
                $template_file = 'page-registration.php';
                break;
        }
        
        if ($template_file) {
            $template_path = get_template_directory() . '/' . $template_file;
            if (file_exists($template_path)) {
                include $template_path;
                exit;
            }
        }
    }
}
add_action('template_redirect', 'conference_template_redirect');

// Flush rewrite rules on theme activation
function conference_flush_rewrite_rules() {
    conference_custom_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'conference_flush_rewrite_rules');

// Add admin notice for flushing rewrite rules
function conference_admin_notice() {
    if (get_option('conference_rewrite_rules_flushed') !== '1') {
        echo '<div class="notice notice-warning is-dismissible">';
        echo '<p><strong>Conference Theme:</strong> Please go to <a href="' . admin_url('options-permalink.php') . '">Settings > Permalinks</a> and click "Save Changes" to activate custom URL routes (/faq and /registration).</p>';
        echo '</div>';
    }
}
add_action('admin_notices', 'conference_admin_notice');

// Mark rewrite rules as flushed when permalinks are saved
function conference_permalink_structure_changed() {
    update_option('conference_rewrite_rules_flushed', '1');
}
add_action('permalink_structure_changed', 'conference_permalink_structure_changed');
?>
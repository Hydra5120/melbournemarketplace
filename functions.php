<?php
/**
 * Melbourne Marketplace Theme Functions
 * 
 * @package MelbourneMarketplace
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function melbournemarketplace_setup() {
    // Add theme support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Add support for title tag
    add_theme_support('title-tag');
    
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'melbournemarketplace'),
    ));
    
    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'melbournemarketplace_setup');

/**
 * Enqueue scripts and styles
 */
function melbournemarketplace_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('melbournemarketplace-style', get_stylesheet_uri(), array(), '1.0');
    
    // Enqueue custom JavaScript if needed
    wp_enqueue_script('melbournemarketplace-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'melbournemarketplace_scripts');

/**
 * Custom WooCommerce Product Categories Display
 */
function melbournemarketplace_display_categories() {
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
    ));
    
    if (!empty($categories) && !is_wp_error($categories)) {
        echo '<div class="category-filter">';
        echo '<h3>Shop by Category</h3>';
        echo '<div class="category-list">';
        
        foreach ($categories as $category) {
            $category_link = get_term_link($category);
            echo '<a href="' . esc_url($category_link) . '" class="category-item">';
            echo esc_html($category->name);
            echo ' (' . $category->count . ')';
            echo '</a>';
        }
        
        echo '</div></div>';
    }
}

/**
 * Customize WooCommerce product display
 */
function melbournemarketplace_products_per_page() {
    return 12; // Display 12 products per page
}
add_filter('loop_shop_per_page', 'melbournemarketplace_products_per_page', 20);

/**
 * Add custom product badge for featured products
 */
function melbournemarketplace_featured_badge() {
    global $product;
    
    if ($product->is_featured()) {
        echo '<span class="featured-badge">Featured</span>';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'melbournemarketplace_featured_badge', 10);

/**
 * Custom breadcrumb display
 */
function melbournemarketplace_breadcrumbs() {
    if (function_exists('woocommerce_breadcrumb')) {
        woocommerce_breadcrumb(array(
            'delimiter' => ' / ',
            'wrap_before' => '<nav class="breadcrumb">',
            'wrap_after' => '</nav>',
            'before' => '',
            'after' => '',
            'home' => 'Home',
        ));
    }
}

/**
 * Modify WooCommerce Add to Cart button text
 */
function melbournemarketplace_custom_cart_button_text() {
    return __('Add to Basket', 'melbournemarketplace');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'melbournemarketplace_custom_cart_button_text');
add_filter('woocommerce_product_add_to_cart_text', 'melbournemarketplace_custom_cart_button_text');

/**
 * Custom product sorting options
 */
function melbournemarketplace_custom_sorting($sortby) {
    $sortby['popularity'] = 'Sort by popularity';
    $sortby['rating'] = 'Sort by average rating';
    $sortby['date'] = 'Sort by latest';
    $sortby['price'] = 'Sort by price: low to high';
    $sortby['price-desc'] = 'Sort by price: high to low';
    
    return $sortby;
}
add_filter('woocommerce_default_catalog_orderby_options', 'melbournemarketplace_custom_sorting');
add_filter('woocommerce_catalog_orderby', 'melbournemarketplace_custom_sorting');

/**
 * Add vendor support functionality
 * This allows for potential multi-vendor features
 */
function melbournemarketplace_add_vendor_field() {
    global $post;
    
    $vendor_name = get_post_meta($post->ID, '_vendor_name', true);
    
    echo '<div class="vendor-field">';
    echo '<label for="vendor_name">Vendor Name:</label>';
    echo '<input type="text" id="vendor_name" name="vendor_name" value="' . esc_attr($vendor_name) . '" />';
    echo '</div>';
}

/**
 * Save vendor field data
 */
function melbournemarketplace_save_vendor_field($post_id) {
    if (isset($_POST['vendor_name'])) {
        update_post_meta($post_id, '_vendor_name', sanitize_text_field($_POST['vendor_name']));
    }
}
add_action('woocommerce_process_product_meta', 'melbournemarketplace_save_vendor_field');

/**
 * Display vendor name on product page
 */
function melbournemarketplace_display_vendor_name() {
    global $post;
    
    $vendor_name = get_post_meta($post->ID, '_vendor_name', true);
    
    if ($vendor_name) {
        echo '<div class="product-vendor">';
        echo '<strong>Vendor:</strong> ' . esc_html($vendor_name);
        echo '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'melbournemarketplace_display_vendor_name', 15);

/**
 * Custom widget areas
 */
function melbournemarketplace_widgets_init() {
    register_sidebar(array(
        'name' => __('Shop Sidebar', 'melbournemarketplace'),
        'id' => 'shop-sidebar',
        'description' => __('Appears on shop pages', 'melbournemarketplace'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'melbournemarketplace_widgets_init');

/**
 * Customize the number of related products
 */
function melbournemarketplace_related_products_args($args) {
    $args['posts_per_page'] = 4; // Show 4 related products
    $args['columns'] = 4;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'melbournemarketplace_related_products_args');

/**
 * Add custom CSS classes to body
 */
function melbournemarketplace_body_classes($classes) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $classes[] = 'marketplace-shop';
    }
    return $classes;
}
add_filter('body_class', 'melbournemarketplace_body_classes');

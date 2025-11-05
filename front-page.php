<?php
/**
 * Front Page template
 *
 * Custom homepage with hero, category filter, and featured products.
 *
 * @package MelbourneMarketplace
 */

get_header(); ?>

<main id="main-content" class="site-main">
    <?php
    $hero_bg = '';
    $front_id = get_queried_object_id();
    if ($front_id) {
        $bg_url = get_the_post_thumbnail_url($front_id, 'full');
        if ($bg_url) {
            $hero_bg = ' style="background-image: url(' . esc_url($bg_url) . ');"';
        }
    }
    ?>
    <?php
    // Customizer overrides for hero image and text
    $custom_hero = get_theme_mod('mm_hero_image');
    if ($custom_hero) {
        $hero_bg = ' style="background-image: url(' . esc_url($custom_hero) . ');"';
    }
    $hero_title = get_theme_mod('mm_hero_title');
    if (!$hero_title) { $hero_title = get_bloginfo('name'); }
    $hero_subtitle = get_theme_mod('mm_hero_subtitle');
    if (!$hero_subtitle) { $hero_subtitle = get_bloginfo('description'); }
    ?>
    <section class="hero<?php echo $hero_bg ? ' has-bg' : ''; ?>"<?php echo $hero_bg; ?>>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <div class="hero-actions">
                    <?php if (function_exists('wc_get_page_permalink')) : ?>
                        <a class="button hero-cta" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Shop Now</a>
                    <?php endif; ?>
                    <a class="button secondary" href="#categories">Browse Categories</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <?php
        // Optional: Content from the page editor if not empty
        $front_content = '';
        if (!empty($front_id)) {
            $raw = get_post_field('post_content', $front_id);
            if (!empty(trim(wp_strip_all_tags($raw)))) {
                $front_content = apply_filters('the_content', $raw);
            }
        }
        if ($front_content) {
            echo '<section class="home-section intro-content">' . $front_content . '</section>';
        }
        ?>

        <section class="home-section features">
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon" aria-hidden="true">🥦</div>
                    <h3 class="feature-title">Fresh Local Produce</h3>
                    <p class="feature-text">Discover seasonal goods from Melbourne vendors.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" aria-hidden="true">🧵</div>
                    <h3 class="feature-title">Handmade & Unique</h3>
                    <p class="feature-text">Support artisans with one-of-a-kind items.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" aria-hidden="true">🚚</div>
                    <h3 class="feature-title">Easy Delivery</h3>
                    <p class="feature-text">Fast, reliable checkout and shipping.</p>
                </div>
            </div>
        </section>

        <?php
        // Category filter
        if (function_exists('melbournemarketplace_display_categories')) {
            echo '<section id="categories" class="home-section">';
            melbournemarketplace_display_categories();
            echo '</section>';
        }
        ?>

        <section class="home-section featured-products">
            <h2 class="section-title">Featured Products</h2>
            <?php
            // Display featured products grid (adjust limit/columns as desired)
            echo do_shortcode('[products limit="8" columns="4" visibility="featured"]');
            ?>
        </section>
    </div>
</main>

<?php get_footer(); ?>

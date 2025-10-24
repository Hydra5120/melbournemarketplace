<?php
/**
 * WooCommerce template
 *
 * @package MelbourneMarketplace
 */

get_header(); ?>

<div class="woocommerce-container">
    <div class="container">
        
        <?php
        // Display category filter on shop pages
        if (is_shop() || is_product_category()) {
            melbournemarketplace_display_categories();
        }
        ?>

        <?php
        // Display breadcrumbs
        melbournemarketplace_breadcrumbs();
        ?>

        <div class="shop-content">
            <?php woocommerce_content(); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>

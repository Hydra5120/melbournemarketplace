/**
 * Melbourne Marketplace Theme JavaScript
 * 
 * @package MelbourneMarketplace
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });

        // Mobile menu toggle
        $('.menu-toggle').on('click', function() {
            $('.main-navigation').toggleClass('active');
        });

        // Product quick view functionality
        $('.quick-view-button').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            // Add quick view logic here
            console.log('Quick view for product:', productId);
        });

        // Update cart count dynamically
        $(document.body).on('added_to_cart', function() {
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'get_cart_count'
                },
                success: function(response) {
                    $('.cart-count').text(response);
                }
            });
        });

        // Category filter animation
        $('.category-item').hover(
            function() {
                $(this).css('transform', 'scale(1.05)');
            },
            function() {
                $(this).css('transform', 'scale(1)');
            }
        );

        // Product image hover effect
        $('.product img').hover(
            function() {
                $(this).css('opacity', '0.8');
            },
            function() {
                $(this).css('opacity', '1');
            }
        );

    });

})(jQuery);

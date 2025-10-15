# Melbourne Marketplace

A custom WordPress theme with WooCommerce integration, bringing Melbourne's market experiences online.

## Overview

Melbourne Marketplace is a full-stack eCommerce platform that enables local vendors to sell their products online, including:
- Fresh Produce
- Handmade Jewelry
- Clothing & Apparel
- Artisan Food Products
- Art & Crafts
- Specialty Items

## Features

### Core Functionality
- **Multi-vendor Support**: Custom vendor field system for tracking product sellers
- **Category-based Browsing**: Intuitive category filtering for easy product discovery
- **Responsive Design**: Mobile-first approach ensuring seamless experience across all devices
- **Custom Product Templates**: Tailored WooCommerce templates for enhanced user experience
- **Advanced Product Sorting**: Multiple sorting options (price, popularity, rating, date)

### Technical Features
- Custom WordPress theme built from scratch
- WooCommerce integration with custom hooks and filters
- PHP-based backend with MySQL database
- Responsive CSS Grid layout
- Custom product meta fields for vendor information
- Breadcrumb navigation for improved UX
- Custom widget areas for enhanced functionality

## Technologies Used

- **WordPress CMS**: Content management system
- **WooCommerce**: eCommerce functionality
- **PHP**: Server-side logic and custom functionality
- **MySQL**: Database management
- **HTML/CSS**: Frontend structure and styling
- **JavaScript**: Interactive features

## Installation

1. Clone this repository into your WordPress themes directory:
```bash
cd wp-content/themes/
git clone https://github.com/Hydra5120/melbournemarketplace.git
```

2. Activate the theme from WordPress Admin Dashboard:
   - Navigate to Appearance > Themes
   - Find "Melbourne Marketplace" and click Activate

3. Install and activate WooCommerce plugin

4. Configure WooCommerce settings:
   - Set up product categories
   - Configure payment and shipping options
   - Add your products

## Project Structure

```
melbournemarketplace-theme/
├── style.css           # Main stylesheet with theme information
├── functions.php       # Theme functionality and WooCommerce customization
├── index.php          # Main template file
├── header.php         # Header template
├── footer.php         # Footer template
├── woocommerce.php    # Custom WooCommerce template
└── README.md          # Project documentation
```

## Custom Features

### Vendor Management
Products can be associated with specific vendors, allowing for future multi-vendor marketplace expansion:
```php
// Add vendor name to product
update_post_meta($post_id, '_vendor_name', 'Local Artisan Co.');
```

### Category Display
Custom function to display all product categories with product counts:
```php
melbournemarketplace_display_categories();
```

### Custom Sorting
Enhanced product sorting options for better user experience:
- Sort by popularity
- Sort by rating
- Sort by price (ascending/descending)
- Sort by latest additions

## Development

This theme was developed as part of learning WordPress theme development and WooCommerce customization. It demonstrates:
- Custom PHP function development
- WordPress hooks and filters
- WooCommerce template customization
- Responsive web design principles
- Database integration with custom meta fields

## Future Enhancements

- [ ] Full multi-vendor dashboard
- [ ] Vendor registration and management system
- [ ] Advanced search with filters
- [ ] Product reviews and ratings system
- [ ] Wishlist functionality
- [ ] Email notification system for vendors

## Author

**Daksh Nair**
- GitHub: [@Hydra5120](https://github.com/Hydra5120)
- Email: dakshnair2003@gmail.com

## License

This project is licensed under the GNU General Public License v2 or later.

## Acknowledgments

Inspired by Melbourne's iconic Queen Victoria Market, bringing the vibrant marketplace experience to the digital world.

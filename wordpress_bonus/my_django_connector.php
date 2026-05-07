<?php
/**
 * Plugin Name: Django Products Connector (Refactored)
 * Description: Plugin that fetches data directly from the Source API for better scalability.
 * Version: 2.0
 * Author: Matan Haimov
 */

if (!defined('ABSPATH')) exit;

/**
 * Fetches products directly from the Source API to prevent the Django backend
 * from becoming a single point of failure (Bottleneck).
 */
function display_django_products_shortcode() {
    // We now fetch directly from the API source to improve performance and scalability.
    $api_url = 'https://dummyjson.com/products?limit=10'; 
    
    $response = wp_remote_get($api_url);
    
    if (is_wp_error($response)) {
        return "Error: Could not connect to the Product API.";
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (empty($data) || !isset($data['products']) || !is_array($data['products'])) {
        return "No products found in the response.";
    }

    // Modern Grid Layout
    $output = '<div class="django-products-list" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; padding: 20px;">';
    
    foreach ($data['products'] as $product) {
        $title = isset($product['title']) ? $product['title'] : 'Unknown Product';
        $price = isset($product['price']) ? $product['price'] : '0.00';
        $image = isset($product['thumbnail']) ? $product['thumbnail'] : '';

        // Security: All outputs are escaped using WP built-in functions
        $output .= '<div class="product-card" style="border: 1px solid #ddd; padding: 15px; border-radius: 10px; text-align: center; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">';
        
        if ($image) {
            $output .= '<img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '" style="width: 100%; height: 150px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">';
        }
        
        $output .= '<h3 style="font-size: 1.1em; margin: 10px 0;">' . esc_html($title) . '</h3>';
        $output .= '<p style="color: #2c3e50; font-weight: bold;">Price: $' . esc_html($price) . '</p>';
        $output .= '</div>';
    }
    
    $output .= '</div>';

    return $output;
}

// Shortcode usage: [show_my_products]
add_shortcode('show_my_products', 'display_django_products_shortcode');
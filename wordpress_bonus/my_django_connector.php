<?php
/**
 * Plugin Name: Django Products Connector
 * Description: Plugin that fetches data from Django Backend and displays it in WordPress.
 * Version: 1.0
 * Author: Matan Haimov
 */

if (!defined('ABSPATH')) exit;

function display_django_products_shortcode() {
    // We use 'web' because it's the service name in docker-compose
    $django_url = 'http://web:8000/products/api/'; 
    
    $response = wp_remote_get($django_url);
    
    if (is_wp_error($response)) {
        return "Error: Could not connect to Django Backend. Check if the 'web' service is running.";
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (empty($data) || !isset($data['products']) || !is_array($data['products'])) {
        return "No products found in the response.";
    }

    $output = '<div class="django-products-list" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; padding: 20px;">';
    
    foreach ($data['products'] as $product) {
        $title = isset($product['title']) ? $product['title'] : 'Unknown Product';
        $price = isset($product['price']) ? $product['price'] : '0.00';
        $image = isset($product['thumbnail']) ? $product['thumbnail'] : '';

        $output .= '<div class="product-card" style="border: 1px solid #ddd; padding: 15px; border-radius: 10px; text-align: center; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">';
        if ($image) {
            $output .= '<img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '" style="max-width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">';
        }
        $output .= '<h3 style="font-size: 1.1em; margin: 10px 0;">' . esc_html($title) . '</h3>';
        $output .= '<p style="color: #2c3e50; font-weight: bold;">Price: $' . esc_html($price) . '</p>';
        $output .= '</div>';
    }
    
    $output .= '</div>';

    return $output;
}

add_shortcode('show_my_products', 'display_django_products_shortcode');
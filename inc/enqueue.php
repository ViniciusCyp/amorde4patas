<?php

declare(strict_types=1);

add_action('wp_enqueue_scripts', function (): void {
    $style_relative = '/dist/main.css';
    $script_relative = '/dist/main.js';

    wp_enqueue_style(
        'a4p-font-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'a4p-main',
        get_theme_file_uri($style_relative),
        ['a4p-font-inter'],
        a4p_asset_version($style_relative) ?: wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'a4p-main',
        get_theme_file_uri($script_relative),
        [],
        a4p_asset_version($script_relative) ?: wp_get_theme()->get('Version'),
        true
    );

    wp_script_add_data('a4p-main', 'defer', true);
});

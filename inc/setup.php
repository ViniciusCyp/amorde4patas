<?php

declare(strict_types=1);

add_action('after_setup_theme', function (): void {
    load_theme_textdomain('amor4patas-base', get_theme_file_path('/languages'));

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ]);

    register_nav_menus([
        'primary' => __('Menu principal', 'amor4patas-base'),
        'footer'  => __('Menu do rodape', 'amor4patas-base'),
    ]);

    add_editor_style('dist/main.css');
});

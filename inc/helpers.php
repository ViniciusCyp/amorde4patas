<?php

declare(strict_types=1);

if (! function_exists('a4p_asset_version')) {
    function a4p_asset_version(string $relative_path): ?int
    {
        $absolute_path = get_theme_file_path($relative_path);

        return file_exists($absolute_path) ? filemtime($absolute_path) : null;
    }
}

if (! function_exists('a4p_page_intro')) {
    function a4p_page_intro(string $title, string $description = ''): void
    {
        ?>
        <section class="page-hero">
            <div class="container">
                <div class="page-hero__content">
                    <p class="eyebrow"><?php esc_html_e('Amor de 4 Patas', 'amor4patas-base'); ?></p>
                    <h1><?php echo esc_html($title); ?></h1>
                    <?php if ($description) : ?>
                        <p class="page-hero__description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}

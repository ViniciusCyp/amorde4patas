<?php

declare(strict_types=1);

$page_id = (int) get_queried_object_id();

$desktop_id = (int) get_post_meta($page_id, 'a4p_home_hero_image_desktop', true);
$mobile_id  = (int) get_post_meta($page_id, 'a4p_home_hero_image_mobile', true);

$title = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_home_hero_title', [], $page_id))
    : '';

$description = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_home_hero_description', [], $page_id))
    : '';

$primary_text = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_home_hero_cta_primary_text', [], $page_id))
    : '';

$primary_url = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_home_hero_cta_primary_url', [], $page_id))
    : '';

$secondary_text = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_home_hero_cta_secondary_text', [], $page_id))
    : '';

$secondary_url = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_home_hero_cta_secondary_url', [], $page_id))
    : '';

if ($primary_text === '') {
    $primary_text = 'Quero Adotar';
}
if ($primary_url === '') {
    $primary_url = home_url('/adocao/');
}

if ($secondary_text === '') {
    $secondary_text = 'Quero Ajudar';
}
if ($secondary_url === '') {
    $secondary_url = home_url('/como-ajudar/');
}

$desktop_url = $desktop_id ? wp_get_attachment_image_url($desktop_id, 'full') : '';
$desktop_srcset = $desktop_id ? wp_get_attachment_image_srcset($desktop_id, 'full') : '';
$desktop_alt = $desktop_id
    ? (string) get_post_meta($desktop_id, '_wp_attachment_image_alt', true)
    : get_bloginfo('name');

$mobile_url = $mobile_id ? wp_get_attachment_image_url($mobile_id, 'full') : '';
$mobile_srcset = $mobile_id ? wp_get_attachment_image_srcset($mobile_id, 'full') : '';

$desktop_meta = $desktop_id ? wp_get_attachment_metadata($desktop_id) : [];
$desktop_width = !empty($desktop_meta['width']) ? (int) $desktop_meta['width'] : 1440;
$desktop_height = !empty($desktop_meta['height']) ? (int) $desktop_meta['height'] : 900;

$allowed_title_html = [
    'strong' => [],
    'br'     => [],
];

$has_any_content = $desktop_url || $title || $description || ($primary_text && $primary_url) || ($secondary_text && $secondary_url);

if (!$has_any_content) :
?>
    <section class="home-hero home-hero--empty" aria-label="Banner principal">
        <div class="container">
            <?php if (current_user_can('manage_options')) : ?>
                <p>Configure o banner principal da home no admin.</p>
            <?php endif; ?>
        </div>
    </section>
<?php
    return;
endif;
?>

<section class="home-hero" aria-label="Banner principal">
    <?php if ($desktop_url) : ?>
        <div data-animate="fade-up" class="home-hero__media">
            <picture>
                <?php if ($mobile_url) : ?>
                    <source
                        media="(max-width: 767px)"
                        srcset="<?php echo esc_attr($mobile_srcset ?: $mobile_url); ?>">
                <?php endif; ?>

                <img
                    src="<?php echo esc_url($desktop_url); ?>"
                    srcset="<?php echo esc_attr($desktop_srcset ?: $desktop_url); ?>"
                    alt="<?php echo esc_attr($desktop_alt ?: get_bloginfo('name')); ?>"
                    width="<?php echo esc_attr((string) $desktop_width); ?>"
                    height="<?php echo esc_attr((string) $desktop_height); ?>"
                    fetchpriority="high"
                    decoding="async">
            </picture>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="home-hero__content">
            <?php if ($title !== '') : ?>
                <h1 data-animate="fade-up" data-delay="100" class="home-hero__title">
                    <?php echo wp_kses(nl2br($title), $allowed_title_html); ?>
                </h1>
            <?php endif; ?>

            <?php if ($description !== '') : ?>
                <p data-animate="fade-up" data-delay="100" class="home-hero__description">
                    <?php echo nl2br(esc_html($description)); ?>
                </p>
            <?php endif; ?>

            <div data-animate="zoom-in" data-delay="180" class="home-hero__actions">
                <?php if ($primary_text && $primary_url) : ?>
                    <a class="home-hero__button home-hero__button--primary" href="<?php echo esc_url($primary_url); ?>">
                        <?php echo esc_html($primary_text); ?>
                    </a>
                <?php endif; ?>

                <?php if ($secondary_text && $secondary_url) : ?>
                    <a class="home-hero__button home-hero__button--secondary" href="<?php echo esc_url($secondary_url); ?>">
                        <?php echo esc_html($secondary_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
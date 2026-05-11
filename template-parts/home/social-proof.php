<?php
declare(strict_types=1);

$page_id = (int) get_queried_object_id();

$section_title = function_exists('rwmb_meta')
    ? (string) rwmb_meta('a4p_home_proof_title', [], $page_id)
    : '';

$section_title_highlight = function_exists('rwmb_meta')
    ? (string) rwmb_meta('a4p_home_proof_title_highlight', [], $page_id)
    : '';

$section_description = function_exists('rwmb_meta')
    ? (string) rwmb_meta('a4p_home_proof_description', [], $page_id)
    : '';

$item_1 = function_exists('rwmb_meta')
    ? (string) rwmb_meta('a4p_home_proof_item_1', [], $page_id)
    : '';

$item_2 = function_exists('rwmb_meta')
    ? (string) rwmb_meta('a4p_home_proof_item_2', [], $page_id)
    : '';

$image_main_id = function_exists('rwmb_meta')
    ? (int) rwmb_meta('a4p_home_proof_image_main', [], $page_id)
    : 0;

$image_top_id = function_exists('rwmb_meta')
    ? (int) rwmb_meta('a4p_home_proof_image_top', [], $page_id)
    : 0;

$image_bottom_id = function_exists('rwmb_meta')
    ? (int) rwmb_meta('a4p_home_proof_image_bottom', [], $page_id)
    : 0;

function a4p_get_image_data(int $attachment_id, string $size = 'large'): array
{
    if (!$attachment_id) {
        return [];
    }

    $src = wp_get_attachment_image_url($attachment_id, $size);

    if (!$src) {
        return [];
    }

    $srcset = wp_get_attachment_image_srcset($attachment_id, $size);
    $alt    = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    $meta   = wp_get_attachment_metadata($attachment_id);

    return [
        'src'    => $src,
        'srcset' => $srcset ?: '',
        'alt'    => is_string($alt) ? $alt : '',
        'width'  => !empty($meta['width']) ? (int) $meta['width'] : 800,
        'height' => !empty($meta['height']) ? (int) $meta['height'] : 800,
    ];
}

$image_main   = a4p_get_image_data($image_main_id, 'large');
$image_top    = a4p_get_image_data($image_top_id, 'large');
$image_bottom = a4p_get_image_data($image_bottom_id, 'large');
?>

<section class="home-proof">
    <div class="container">
        <div class="home-proof__grid">

            <div class="home-proof__content">
                <?php if ($section_title || $section_title_highlight) : ?>
                    <h2 data-animate="fade-left" data-delay="150" class="home-proof__title">
                        <?php if ($section_title) : ?>
                            <span class="home-proof__title-main"><?php echo esc_html($section_title); ?></span>
                        <?php endif; ?>

                        <?php if ($section_title_highlight) : ?>
                            <span class="home-proof__title-highlight"><?php echo esc_html($section_title_highlight); ?></span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>

                <?php if ($section_description) : ?>
                    <p data-animate="zoom-in" data-delay="200" class="home-proof__description"><?php echo nl2br(esc_html($section_description)); ?></p>
                <?php endif; ?>

                <div class="home-proof__items">
                    <?php if ($item_1) : ?>
                        <div data-animate="zoom-in" data-delay="250" class="home-proof__item">
                            <div class="home-proof__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M7.5 11.2c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.7 10.2c1 0 1.8-.8 1.8-1.8s-.8-1.8-1.8-1.8-1.8.8-1.8 1.8.8 1.8 1.8 1.8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.4 15.2c.9 0 1.6-.7 1.6-1.6S19.3 12 18.4 12s-1.6.7-1.6 1.6.7 1.6 1.6 1.6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.4 16c1 0 1.9-.8 1.9-1.9s-.8-1.9-1.9-1.9-1.9.8-1.9 1.9.8 1.9 1.9 1.9Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.1 20c1.8 0 4.8-1 4.8-3.3 0-1.7-1.4-3-3.1-3-.7 0-1.2.2-1.7.6-.5-.4-1.1-.6-1.8-.6-1.7 0-3.1 1.3-3.1 3C7.3 19 10.2 20 12.1 20Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p><?php echo esc_html($item_1); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($item_2) : ?>
                        <div data-animate="zoom-in" data-delay="300" class="home-proof__item">
                            <div class="home-proof__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-4.8v-6.2H9.8V21H5a1 1 0 0 1-1-1v-9.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p><?php echo esc_html($item_2); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="home-proof__gallery">
                <?php if (!empty($image_main)) : ?>
                    <figure data-animate="fade-up" data-delay="260" class="home-proof__card home-proof__card--main">
                        <img
                            src="<?php echo esc_url($image_main['src']); ?>"
                            <?php if (!empty($image_main['srcset'])) : ?>
                                srcset="<?php echo esc_attr($image_main['srcset']); ?>"
                            <?php endif; ?>
                            alt="<?php echo esc_attr($image_main['alt']); ?>"
                            width="<?php echo esc_attr((string) $image_main['width']); ?>"
                            height="<?php echo esc_attr((string) $image_main['height']); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                <?php endif; ?>

                <?php if (!empty($image_top)) : ?>
                    <figure data-animate="fade-right" data-delay="260" class="home-proof__card home-proof__card--top">
                        <img
                            src="<?php echo esc_url($image_top['src']); ?>"
                            <?php if (!empty($image_top['srcset'])) : ?>
                                srcset="<?php echo esc_attr($image_top['srcset']); ?>"
                            <?php endif; ?>
                            alt="<?php echo esc_attr($image_top['alt']); ?>"
                            width="<?php echo esc_attr((string) $image_top['width']); ?>"
                            height="<?php echo esc_attr((string) $image_top['height']); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                <?php endif; ?>

                <?php if (!empty($image_bottom)) : ?>
                    <figure data-animate="fade-left" data-delay="200" class="home-proof__card home-proof__card--bottom">
                        <img
                            src="<?php echo esc_url($image_bottom['src']); ?>"
                            <?php if (!empty($image_bottom['srcset'])) : ?>
                                srcset="<?php echo esc_attr($image_bottom['srcset']); ?>"
                            <?php endif; ?>
                            alt="<?php echo esc_attr($image_bottom['alt']); ?>"
                            width="<?php echo esc_attr((string) $image_bottom['width']); ?>"
                            height="<?php echo esc_attr((string) $image_bottom['height']); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </figure>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
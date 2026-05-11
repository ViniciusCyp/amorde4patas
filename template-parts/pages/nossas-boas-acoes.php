<?php
declare(strict_types=1);

$page_id = (int) get_queried_object_id();

$page_title_main = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_actions_page_title_main', [], $page_id))
    : '';

$page_title_highlight = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_actions_page_title_highlight', [], $page_id))
    : '';

$page_subtitle = function_exists('rwmb_meta')
    ? trim((string) rwmb_meta('a4p_actions_page_subtitle', [], $page_id))
    : '';

$page_title_main      = $page_title_main !== '' ? $page_title_main : 'Nossas Boas';
$page_title_highlight = $page_title_highlight !== '' ? $page_title_highlight : 'Ações';
$page_subtitle        = $page_subtitle !== '' ? $page_subtitle : 'Cada resgate é uma história de esperança. Veja o impacto que transformamos juntos na vida dos animais.';

$actions_query = new WP_Query([
    'post_type'      => 'a4p_action',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_key'       => 'a4p_action_order',
    'orderby'        => [
        'meta_value_num' => 'ASC',
        'date'           => 'DESC',
    ],
    'order'          => 'ASC',
]);
?>

<section class="actions-page">
    <div class="container">
        <header class="actions-page__hero">
            <h1 data-animate="fade-up" class="actions-page__title">
                <span class="actions-page__title-main"><?php echo esc_html($page_title_main); ?></span>
                <span class="actions-page__title-highlight"><?php echo esc_html($page_title_highlight); ?></span>
            </h1>

            <?php if ($page_subtitle) : ?>
                <p data-animate="fade-up" data-delay="100" class="actions-page__subtitle"><?php echo nl2br(esc_html($page_subtitle)); ?></p>
            <?php endif; ?>
        </header>

        <?php if ($actions_query->have_posts()) : ?>
            <div class="actions-grid">
                <?php while ($actions_query->have_posts()) : $actions_query->the_post(); ?>
                    <?php
                    $action_id    = (int) get_the_ID();
                    $badge        = function_exists('rwmb_meta') ? (string) rwmb_meta('a4p_action_badge', [], $action_id) : '';
                    $badge_tone   = function_exists('rwmb_meta') ? (string) rwmb_meta('a4p_action_badge_tone', [], $action_id) : 'orange';
                    $meta         = function_exists('rwmb_meta') ? (string) rwmb_meta('a4p_action_meta', [], $action_id) : '';
                    $description  = function_exists('rwmb_meta') ? (string) rwmb_meta('a4p_action_description', [], $action_id) : '';
                    $cover        = function_exists('rwmb_meta') ? rwmb_meta('a4p_action_cover', ['size' => 'large'], $action_id) : null;
                    $gallery      = function_exists('rwmb_meta') ? rwmb_meta('a4p_action_gallery', ['size' => 'large'], $action_id) : [];
                    $modal_id     = 'action-modal-' . $action_id;

                    $gallery_items = [];

                    if (!empty($cover) && is_array($cover) && !empty($cover['url'])) {
                        $gallery_items[] = $cover;
                    }

                    if (is_array($gallery)) {
                        foreach ($gallery as $image) {
                            if (!empty($image['url'])) {
                                $gallery_items[] = $image;
                            }
                        }
                    }

                    $gallery_items = array_values(array_filter($gallery_items, static function ($item) {
                        return is_array($item) && !empty($item['url']);
                    }));
                    ?>

                    <article data-animate="fade-up" class="action-card">
                        <button
                            class="action-card__button"
                            type="button"
                            data-open-action-modal="<?php echo esc_attr($modal_id); ?>"
                        >
                            <span class="action-card__media">
                                <?php if (!empty($cover['url'])) : ?>
                                    <img
                                        src="<?php echo esc_url($cover['url']); ?>"
                                        srcset="<?php echo esc_attr($cover['srcset'] ?? $cover['url']); ?>"
                                        alt="<?php echo esc_attr($cover['alt'] ?? get_the_title()); ?>"
                                        width="<?php echo esc_attr((string) ($cover['width'] ?? 640)); ?>"
                                        height="<?php echo esc_attr((string) ($cover['height'] ?? 760)); ?>"
                                        loading="lazy"
                                        decoding="async"
                                    >
                                <?php endif; ?>

                                <?php if ($badge) : ?>
                                    <span class="action-card__badge action-card__badge--<?php echo esc_attr($badge_tone); ?>">
                                        <?php echo esc_html($badge); ?>
                                    </span>
                                <?php endif; ?>

                                <span class="action-card__overlay">
                                    <?php if ($meta) : ?>
                                        <span class="action-card__meta"><?php echo esc_html($meta); ?></span>
                                    <?php endif; ?>

                                    <strong class="action-card__title"><?php the_title(); ?></strong>
                                </span>
                            </span>
                        </button>
                    </article>

                    <div class="action-modal" hidden data-action-modal="<?php echo esc_attr($modal_id); ?>">
                        <div class="action-modal__backdrop" data-close-action-modal></div>

                        <div class="action-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr($modal_id); ?>-title">
                            <button class="action-modal__close" type="button" aria-label="Fechar" data-close-action-modal>×</button>

                            <div class="action-modal__grid">
                                <div class="action-modal__gallery">
                                    <?php if (!empty($gallery_items)) : ?>
                                        <div class="action-modal__main">
                                            <img
                                                src="<?php echo esc_url($gallery_items[0]['url']); ?>"
                                                alt="<?php echo esc_attr($gallery_items[0]['alt'] ?? get_the_title()); ?>"
                                                data-action-modal-main
                                            >
                                        </div>

                                        <?php if (count($gallery_items) > 1) : ?>
                                            <div class="action-modal__thumbs">
                                                <?php foreach ($gallery_items as $index => $image) : ?>
                                                    <button
                                                        type="button"
                                                        class="action-modal__thumb<?php echo $index === 0 ? ' is-active' : ''; ?>"
                                                        data-action-modal-thumb
                                                        data-image="<?php echo esc_url($image['url']); ?>"
                                                        data-alt="<?php echo esc_attr($image['alt'] ?? get_the_title()); ?>"
                                                    >
                                                        <img
                                                            src="<?php echo esc_url($image['url']); ?>"
                                                            alt=""
                                                            loading="lazy"
                                                            decoding="async"
                                                        >
                                                    </button>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="action-modal__content">
                                    <?php if ($badge) : ?>
                                        <span class="action-modal__badge action-card__badge--<?php echo esc_attr($badge_tone); ?>">
                                            <?php echo esc_html($badge); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ($meta) : ?>
                                        <p class="action-modal__meta"><?php echo esc_html($meta); ?></p>
                                    <?php endif; ?>

                                    <h2 class="action-modal__title" id="<?php echo esc_attr($modal_id); ?>-title"><?php the_title(); ?></h2>

                                    <?php if ($description) : ?>
                                        <div class="action-modal__description">
                                            <?php echo wp_kses_post(wpautop($description)); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

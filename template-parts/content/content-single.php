<?php
declare(strict_types=1);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-card'); ?> data-animate="fade-up">
    <header class="entry-card__header stack-sm">
        <p class="eyebrow"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name ?? __('Post', 'amor4patas-base')); ?></p>
        <h1 data-animate="fade-up" data-delay="100"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content stack-md" data-animate="fade-up" data-delay="150">
        <?php if (has_post_thumbnail()) : ?>
            <figure class="entry-featured-image" data-animate="zoom-in" data-delay="180"><?php the_post_thumbnail('large', ['loading' => 'eager']); ?></figure>
        <?php endif; ?>
        <?php the_content(); ?>
    </div>
</article>

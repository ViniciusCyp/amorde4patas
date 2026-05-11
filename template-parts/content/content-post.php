<?php
declare(strict_types=1);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?> data-animate="fade-up">
    <a class="card__link" href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <div class="card__media"><?php the_post_thumbnail('medium_large'); ?></div>
        <?php endif; ?>
        <div class="card__body stack-sm">
            <h2 class="card__title"><?php the_title(); ?></h2>
            <p><?php echo esc_html(get_the_excerpt()); ?></p>
        </div>
    </a>
</article>

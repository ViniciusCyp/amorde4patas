<?php
declare(strict_types=1);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-card'); ?> data-animate="fade-up">
    <header class="entry-card__header stack-sm">
        <p class="eyebrow"><?php esc_html_e('Página', 'amor4patas-base'); ?></p>
        <h1 data-animate="fade-up" data-delay="100"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content stack-md" data-animate="fade-up" data-delay="150">
        <?php the_content(); ?>
    </div>
</article>

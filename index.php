<?php
declare(strict_types=1);

get_header();
?>
<section class="page-shell">
    <div class="container stack-lg">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content/content', get_post_type()); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <article class="entry-card">
                <h1><?php esc_html_e('Nada encontrado', 'amor4patas-base'); ?></h1>
                <p><?php esc_html_e('Adicione conteúdo no painel para começar.', 'amor4patas-base'); ?></p>
            </article>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();

<?php
declare(strict_types=1);

get_header();
?>
<section class="page-shell">
    <div class="container stack-lg">
        <header class="archive-header">
            <p class="eyebrow"><?php esc_html_e('Arquivo', 'amor4patas-base'); ?></p>
            <h1><?php the_archive_title(); ?></h1>
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
        </header>

        <?php if (have_posts()) : ?>
            <div class="cards-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content/content', get_post_type()); ?>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e('Nenhum conteúdo encontrado.', 'amor4patas-base'); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();

<?php
declare(strict_types=1);

get_header();
?>
<section class="page-shell">
    <div class="container stack-lg">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content/content', 'page'); ?>
        <?php endwhile; ?>
    </div>
</section>
<?php
get_footer();

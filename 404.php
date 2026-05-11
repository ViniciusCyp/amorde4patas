<?php
declare(strict_types=1);

get_header();
?>
<section class="page-shell page-shell--centered">
    <div class="container stack-md text-center">
        <p class="eyebrow"><?php esc_html_e('Erro 404', 'amor4patas-base'); ?></p>
        <h1><?php esc_html_e('Página não encontrada', 'amor4patas-base'); ?></h1>
        <p><?php esc_html_e('Esse conteúdo pode ter sido movido ou ainda não existe.', 'amor4patas-base'); ?></p>
        <a class="button" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Voltar para a home', 'amor4patas-base'); ?></a>
    </div>
</section>
<?php
get_footer();

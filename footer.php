<?php
declare(strict_types=1);
?>

<footer class="site-footer">
  <div class="container">
    <div class="site-footer__inner">

      <div data-animate="fade-right" data-delay="80" class="site-footer__brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-footer__logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
          <img
            src="<?php echo esc_url(get_theme_file_uri('/dist/images/logo.svg')); ?>"
            alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
            width="220"
            height="40"
            loading="lazy"
            decoding="async"
          >
        </a>
      </div>

      <div class="site-footer__info">
        <p class="site-footer__cnpj">CNPJ: XXXXXXXXXXXX · XXXXXXXXXXXX</p>
        <p class="site-footer__copy">© <?php echo esc_html(date('Y')); ?> Amor de 4 Patas. Todos os direitos reservados.</p>
      </div>

      <nav data-animate="fade-left" data-delay="180" class="site-footer__social" aria-label="<?php esc_attr_e('Redes sociais', 'amorde4patas'); ?>">
        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
          <img
            src="<?php echo esc_url(get_theme_file_uri('/dist/images/instagram.svg')); ?>"
            alt=""
            width="20"
            height="20"
            loading="lazy"
            decoding="async"
          >
        </a>

        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
          <img
            src="<?php echo esc_url(get_theme_file_uri('/dist/images/facebook.svg')); ?>"
            alt=""
            width="20"
            height="20"
            loading="lazy"
            decoding="async"
          >
        </a>

        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="E-mail">
          <img
            src="<?php echo esc_url(get_theme_file_uri('/dist/images/email.svg')); ?>"
            alt=""
            width="20"
            height="20"
            loading="lazy"
            decoding="async"
          >
        </a>
      </nav>

    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

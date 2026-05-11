<?php
declare(strict_types=1);

$contact_form_id = 106; 
?>

<section class="contact-page">
    <div class="container">
        <header class="contact-page__hero">
            <h1 data-animate="fade-up" class="contact-page__title">
                <span class="contact-page__title-main">Entre em</span>
                <span class="contact-page__title-highlight">Contato</span>
            </h1>

            <p data-animate="fade-up" data-delay="90" class="contact-page__subtitle">
                Dúvidas, parcerias ou denúncias? Fale conosco. Nossa equipe está
                pronta para ouvir você e ajudar nossos amigos de quatro patas.
            </p>
        </header>

        <div class="contact-page__grid">
            <aside data-animate="fade-right" data-delay="120" class="contact-page__info">
                <h2 class="contact-page__info-title">Informações</h2>

                <div class="contact-info-list">
                    <article data-animate="fade-up" data-delay="220" class="contact-info-item">
                        <span class="contact-info-item__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M6.6 10.8c1.8 3.5 3.1 4.8 6.6 6.6l2.2-2.2c.3-.3.8-.4 1.2-.3 1 .3 2.1.5 3.2.5.7 0 1.2.5 1.2 1.2V20c0 .7-.5 1.2-1.2 1.2C10.9 21.2 2.8 13.1 2.8 3.2 2.8 2.5 3.3 2 4 2h3.4c.7 0 1.2.5 1.2 1.2 0 1.1.2 2.2.5 3.2.1.4 0 .8-.3 1.2l-2.2 2.2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <div class="contact-info-item__content">
                            <span class="contact-info-item__label">Telefone</span>
                            <p>(11) 9 8765-4321</p>
                        </div>
                    </article>

                    <article data-animate="fade-up" data-delay="260" class="contact-info-item">
                        <span class="contact-info-item__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 6.5h16v11H4v-11Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                <path d="m4.5 7 7.5 6 7.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <div class="contact-info-item__content">
                            <span class="contact-info-item__label">Email</span>
                            <p>contato@refugiovivo.org.br</p>
                        </div>
                    </article>

                    <article data-animate="fade-up" data-delay="300" class="contact-info-item">
                        <span class="contact-info-item__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 20s6-5.2 6-10a6 6 0 1 0-12 0c0 4.8 6 10 6 10Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <div class="contact-info-item__content">
                            <span class="contact-info-item__label">Endereço</span>
                            <p>Rua Dr. Miranda de Azevedo, 470<br>Perdizes, São Paulo — SP</p>
                        </div>
                    </article>

                    <article data-animate="fade-up" data-delay="340" class="contact-info-item">
                        <span class="contact-info-item__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <div class="contact-info-item__content">
                            <span class="contact-info-item__label">Horário de atendimento</span>
                            <p>Seg a Sex: 9h às 18h<br>Sáb: 10h às 16h</p>
                        </div>
                    </article>
                </div>
            </aside>

            <div data-animate="fade-left" data-delay="150" class="contact-page__form-card">
                <?php if ($contact_form_id > 0) : ?>
                    <?php echo do_shortcode('[wpforms id="' . $contact_form_id . '" title="false" description="false"]'); ?>
                <?php else : ?>
                    <p>Defina o ID do formulário WPForms no arquivo da página de contato.</p>
                <?php endif; ?>

                <p data-animate="fade-up" data-delay="210" class="contact-form__privacy">
                    Seus dados estão seguros conosco. Ao enviar, você concorda com nossa
                    política de privacidade e proteção de dados.
                </p>
            </div>
        </div>
    </div>
</section>

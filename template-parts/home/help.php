<?php
declare(strict_types=1);
?>

<section class="home-help">
    <div class="container">
        <div class="home-help__header">
            <h2 data-animate="fade-up" class="home-help__title">
                <span class="home-help__title-main">Como Fazer a</span>
                <span class="home-help__title-highlight">Diferença</span>
            </h2>

            <p data-animate="fade-up" data-delay="90" class="home-help__subtitle">
                Escolha a melhor forma de apoiar nossa causa.
            </p>
        </div>

        <div class="home-help__grid">
            <article data-animate="fade-up" data-delay="130" class="home-help__card home-help__card--featured">
                <span data-animate="zoom-in" data-delay="180" class="home-help__badge">Destaque</span>

                <h3 class="home-help__card-title">Doação Imediata (PIX)</h3>

                <p class="home-help__card-text">
                    Qualquer valor garante a ração de hoje.
                </p>

                <div class="home-help__pix">
                    <div class="home-help__pix-key" id="a4p-pix-key">
                        XXXXXXXXXXXX
                    </div>

                    <button
                        class="home-help__pix-button"
                        type="button"
                        data-copy-target="#a4p-pix-key"
                        data-copy-label="Copiar Chave"
                        data-copy-success="Chave copiada!"
                    >
                        Copiar Chave
                    </button>
                </div>
            </article>

            <article data-animate="fade-up" data-delay="180" class="home-help__card">
                <h3 class="home-help__card-title">Apadrinhamento Mensal</h3>

                <p class="home-help__card-text">
                    Financie tratamentos contínuos através do Apoio Pet.
                </p>

                <a class="home-help__button home-help__button--dark" href="#">
                    Entre em Contato
                    <span aria-hidden="true">→</span>
                </a>
            </article>

            <article data-animate="fade-up" data-delay="230" class="home-help__card">
                <h3 class="home-help__card-title">Seja um Parceiro</h3>

                <p class="home-help__card-text">
                    Para empresas que querem transformar vidas.
                </p>

                <a class="home-help__button home-help__button--primary" href="#">
                    Entre em Contato
                    <span aria-hidden="true">→</span>
                </a>
            </article>
        </div>
    </div>
</section>

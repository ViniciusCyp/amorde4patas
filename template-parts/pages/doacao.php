<?php
declare(strict_types=1);
?>

<section class="donation-page">
    <div class="container">
        <div class="donation-page__grid">

            <div data-animate="fade-right" class="donation-page__content">
                <span data-animate="fade-up" data-delay="80" class="donation-page__eyebrow">Impacto imediato</span>

                <h1 data-animate="fade-up" data-delay="130" class="donation-page__title">
                    Sua doação garante
                    ração e amor para
                    centenas de
                    focinhos.
                </h1>

                <p data-animate="fade-up" data-delay="170" class="donation-page__description">
                    Com sua ajuda, o Refúgio Vivo continua transformando vidas.
                    Cada real doado se torna alimento, remédio e esperança para
                    animais resgatados.
                </p>

                <div class="donation-page__benefits">
                    <div data-animate="fade-up" data-delay="220" class="donation-benefit">
                        <span class="donation-benefit__icon" aria-hidden="true">✓</span>
                        <div class="donation-benefit__content">
                            <strong>R$ 15</strong>
                            <p>Garante refeições por 2 dias para um cão.</p>
                        </div>
                    </div>

                    <div data-animate="fade-up" data-delay="270" class="donation-benefit">
                        <span class="donation-benefit__icon" aria-hidden="true">✓</span>
                        <div class="donation-benefit__content">
                            <strong>R$ 50</strong>
                            <p>Custeia o kit básico de vacinação anual.</p>
                        </div>
                    </div>

                    <div data-animate="fade-up" data-delay="320" class="donation-benefit">
                        <span class="donation-benefit__icon" aria-hidden="true">✓</span>
                        <div class="donation-benefit__content">
                            <strong>R$ 150</strong>
                            <p>Mantém um animal idoso com cuidados especiais.</p>
                        </div>
                    </div>
                </div>
            </div>

            <aside
                data-animate="fade-left"
                data-delay="140"
                class="donation-card"
                aria-label="Doação por PIX"
                data-donation-card
                data-pix-key="55517969000126"
                data-pix-key-display="59.517.969/0001-26"
                data-pix-name="AMOR DE 4 PATAS"
                data-pix-city="SAO PAULO"
                data-pix-description="DOACAO"
                data-pix-txid="AMOR4PATAS"
            >
                <h2 class="donation-card__title">Faça um PIX</h2>

                <p data-animate="fade-up" data-delay="240" class="donation-card__subtitle">
                    Escolha um valor ou digite quanto deseja doar.
                </p>

                <div data-animate="fade-up" data-delay="280" class="donation-card__amounts" role="group" aria-label="Valores sugeridos">
                    <button type="button" class="donation-card__amount" data-donation-amount="15">R$15</button>
                    <button type="button" class="donation-card__amount" data-donation-amount="30">R$30</button>
                    <button type="button" class="donation-card__amount is-active" data-donation-amount="50">R$50</button>
                    <button type="button" class="donation-card__amount" data-donation-amount="100">R$100</button>
                </div>

                <label data-animate="fade-up" data-delay="320" class="donation-card__input-wrap" for="donation-amount-input">
                    <span class="donation-card__currency">R$</span>
                    <input
                        id="donation-amount-input"
                        class="donation-card__input"
                        type="text"
                        value="50,00"
                        inputmode="decimal"
                        autocomplete="off"
                        data-donation-input
                    >
                </label>

                <div data-animate="fade-up" data-delay="360" class="donation-card__pix-row">
                    <div class="donation-card__pix-copy">
                        <span class="donation-card__pix-label">Chave PIX (CNPJ)</span>
                        <strong id="a4p-pix-key-doacao" class="donation-card__pix-key">59.517.969/0001-26</strong>
                    </div>

                    <button
                        class="donation-card__copy"
                        type="button"
                        data-copy-target="#a4p-pix-key-doacao"
                        data-copy-label="Copiar"
                        data-copy-success="Copiado!"
                    >
                        Copiar
                    </button>
                </div>

                <button data-animate="zoom-in" data-delay="400" class="donation-card__submit" type="button" data-open-pix-modal>
                    Gerar QR Code PIX
                </button>

                <p data-animate="fade-up" data-delay="430" class="donation-card__secure">
                    Transação segura • Refúgio Vivo
                </p>
            </aside>

        </div>
    </div>
</section>

<div class="pix-modal" hidden data-pix-modal>
    <div class="pix-modal__backdrop" data-close-pix-modal></div>

    <div class="pix-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="pix-modal-title">
        <button class="pix-modal__close" type="button" aria-label="Fechar" data-close-pix-modal>×</button>

        <h3 id="pix-modal-title" class="pix-modal__title">Escaneie para doar</h3>
        <p class="pix-modal__amount">Valor: <strong data-pix-modal-amount>R$ 50,00</strong></p>

        <div class="pix-modal__qr-wrap">
            <img class="pix-modal__qr" src="" alt="QR Code PIX" data-pix-modal-image>
        </div>

        <div class="pix-modal__code-wrap">
            <span class="pix-modal__code-label">PIX Copia e Cola</span>
            <code id="a4p-pix-payload" class="pix-modal__code" data-pix-modal-code></code>
        </div>

        <button
            class="pix-modal__copy"
            type="button"
            data-copy-target="#a4p-pix-payload"
            data-copy-label="Copiar código PIX"
            data-copy-success="Código copiado!"
        >
            Copiar código PIX
        </button>
    </div>
</div> 

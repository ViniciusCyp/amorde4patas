ggo# Amor de 4 Patas Base

Tema base leve para WordPress com foco em performance, código próprio e Webpack.

## O que já vem pronto

- Estrutura classic theme enxuta para controle total do HTML.
- `theme.json` para presets globais e melhor integração com o editor.
- `Webpack + SCSS + Babel + PostCSS + minificação`.
- Templates para:
  - Home (`front-page.php`)
  - Doação (`page-doacao.php`)
  - Contato (`page-contato.php`)
  - Quem Somos (`page-quem-somos.php`)
  - Nossas Boas Ações (`page-nossas-boas-acoes.php`)
- `template-parts` organizados para facilitar evolução.
- `dist/main.css` e `dist/main.js` já inclusos para o tema funcionar mesmo antes de rodar o build.

## Estrutura principal

```bash
amor4patas-base/
├── assets/
│   └── src/
│       ├── js/
│       └── scss/
├── dist/
├── inc/
├── template-parts/
├── front-page.php
├── page.php
├── page-doacao.php
├── page-contato.php
├── page-quem-somos.php
├── page-nossas-boas-acoes.php
├── functions.php
├── style.css
├── theme.json
├── package.json
└── webpack.config.js
```

## Como instalar

1. Envie a pasta `amor4patas-base` para `wp-content/themes/`.
2. Ative o tema no painel do WordPress.
3. Vá em **Configurações > Leitura** e defina a página inicial estática para usar a Home.
4. Crie as páginas com estes slugs para o WordPress usar os templates automaticamente:
   - `doacao`
   - `contato`
   - `quem-somos`
   - `nossas-boas-acoes`

## Como compilar

```bash
npm install
npm run watch
```

Build de produção:

```bash
npm run build
```

## Onde editar

- Estrutura das páginas: `template-parts/pages/`
- Header e footer: `header.php` e `footer.php`
- SCSS global: `assets/src/scss/`
- JS: `assets/src/js/main.js`
- Supports e menus: `inc/setup.php`
- Enqueue: `inc/enqueue.php`

## Recomendações para manter leve

- Evite page builder se o objetivo é máxima performance.
- Não faça lazy-load da imagem principal do hero.
- Use WebP/AVIF para imagens e mantenha dimensões definidas.
- Carregue scripts de terceiros apenas onde forem necessários.
- Coloque funcionalidades persistentes em plugin próprio e deixe o tema focado no visual.

## Observação

Os links do Figma não ficaram acessíveis para inspeção automática aqui, então esta entrega foi preparada como base estrutural pronta para encaixar o layout final conforme o design evoluir.

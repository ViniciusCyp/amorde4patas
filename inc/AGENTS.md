# AGENTS.md

## Projeto
Tema WordPress customizado com foco em alta performance, organização de código e fidelidade ao layout do Figma.

## Stack e estrutura
- WordPress com tema customizado
- PHP para templates e arquivos do tema
- SCSS organizado em partials
- JS modular
- Build via npm/webpack
- Estrutura principal:
  - `functions.php`
  - `header.php`
  - `footer.php`
  - `inc/`
  - `template-parts/`
  - `assets/src/scss/`
  - `assets/src/js/`
  - `dist/`

## Objetivos principais
- Seguir o layout do Figma com máxima fidelidade possível
- Priorizar performance acima de efeitos desnecessários
- Manter HTML semântico e acessível
- Escrever código limpo, simples e fácil de manter
- Evitar dependências externas quando não forem realmente necessárias

## Regras de implementação
1. Sempre reutilize a arquitetura existente do projeto antes de criar novos arquivos.
2. Antes de editar, identifique quais arquivos realmente precisam ser alterados.
3. Não crie bibliotecas, frameworks ou plugins sem necessidade.
4. Prefira CSS/SCSS puro e JS leve.
5. Preserve compatibilidade com WordPress e boas práticas do tema.
6. Não duplique lógica entre templates, SCSS e JS.
7. Sempre manter responsividade.
8. Sempre considerar acessibilidade:
   - uso correto de heading tags
   - labels e aria quando necessário
   - navegação por teclado em menus e botões
9. Sempre considerar performance:
   - evitar DOM excessivo
   - evitar JS pesado
   - evitar imagens sem necessidade
   - evitar CSS redundante
10. Não alterar nomes de arquivos ou estrutura do projeto sem necessidade real.

## Padrão para SCSS
- Manter estilos separados por contexto:
  - `base/`
  - `components/`
  - `layout/`
  - `pages/`
- Não escrever SCSS gigante sem separação lógica
- Reaproveitar variáveis, espaçamentos e padrões visuais
- Preferir abordagem desktop + ajustes responsivos já compatíveis com a base atual do projeto

## Padrão para PHP
- Manter markup limpo e semântico
- Escapar saídas quando necessário
- Evitar lógica excessiva dentro do template
- Sempre respeitar a estrutura do WordPress

## Padrão para JS
- Usar JS apenas quando necessário
- Evitar manipulação desnecessária de layout
- Não incluir bibliotecas externas para tarefas simples
- Garantir que interações mobile funcionem bem

## Fluxo de trabalho esperado
Para cada tarefa:
1. Explicar rapidamente o que será alterado
2. Informar quais arquivos serão editados
3. Fazer mudanças pequenas e seguras
4. Rodar build ou validar se necessário
5. Resumir o que foi feito no final

## O que evitar
- Mudanças grandes sem explicar antes
- Refatorações amplas fora do escopo pedido
- Quebrar a estrutura atual do tema
- Criar arquivos desnecessários
- Inventar conteúdo visual sem referência

## Quando estiver implementando uma seção do Figma
- Primeiro analisar a estrutura ideal
- Depois implementar HTML/PHP
- Depois estilizar no SCSS correspondente
- Depois ajustar responsividade
- Depois validar espaçamento, alinhamento e consistência visual

## Prioridade de qualidade
1. Performance
2. Fidelidade ao layout
3. Clareza do código
4. Responsividade
5. Facilidade de manutenção
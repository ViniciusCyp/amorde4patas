<?php

declare(strict_types=1);

add_filter('rwmb_meta_boxes', static function (array $meta_boxes): array {
    $front_page_id = (int) get_option('page_on_front');

    $current_post_id = 0;

    if (isset($_GET['post'])) {
        $current_post_id = (int) $_GET['post'];
    } elseif (isset($_POST['post_ID'])) {
        $current_post_id = (int) $_POST['post_ID'];
    }

    if ($front_page_id <= 0 || $current_post_id !== $front_page_id) {
        return $meta_boxes;
    }
    $meta_boxes[] = [
        'id'         => 'a4p_home_hero',
        'title'      => 'Banner principal da Home',
        'post_types' => ['page'],
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => [
            [
                'name'       => 'Imagem desktop',
                'id'         => 'a4p_home_hero_image_desktop',
                'type'       => 'single_image',
                'image_size' => 'medium',
                'desc'       => 'Use a imagem principal do banner para desktop.',
            ],
            [
                'name'       => 'Imagem mobile',
                'id'         => 'a4p_home_hero_image_mobile',
                'type'       => 'single_image',
                'image_size' => 'medium',
                'desc'       => 'Use uma versão otimizada para mobile.',
            ],
            [
                'name' => 'Título',
                'id'   => 'a4p_home_hero_title',
                'type' => 'textarea',
                'rows' => 4,
                'desc' => 'Use <strong>...</strong> para destacar parte do texto. Ex.: Não mudamos o mundo inteiro. <strong>Mas mudamos o mundo inteiro deles.</strong>',
            ],
            [
                'name' => 'Descrição',
                'id'   => 'a4p_home_hero_description',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'name' => 'Texto do botão 1',
                'id'   => 'a4p_home_hero_cta_primary_text',
                'type' => 'text',
                'std'  => 'Quero Adotar',
            ],
            [
                'name' => 'Link do botão 1',
                'id'   => 'a4p_home_hero_cta_primary_url',
                'type' => 'url',
                'std'  => '',
            ],
            [
                'name' => 'Texto do botão 2',
                'id'   => 'a4p_home_hero_cta_secondary_text',
                'type' => 'text',
                'std'  => 'Quero Ajudar',
            ],
            [
                'name' => 'Link do botão 2',
                'id'   => 'a4p_home_hero_cta_secondary_url',
                'type' => 'url',
                'std'  => '',
            ],
        ],
    ];
    $meta_boxes[] = [
        'id'         => 'a4p_home_social_proof',
        'title'      => 'Seção Prova Social e Transparência',
        'post_types' => ['page'],
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => [
            [
                'name' => 'Título linha 1',
                'id'   => 'a4p_home_proof_title',
                'type' => 'text',
                'std'  => 'A Prova Social e',
            ],
            [
                'name' => 'Título destaque',
                'id'   => 'a4p_home_proof_title_highlight',
                'type' => 'text',
                'std'  => 'Transparência',
            ],
            [
                'name' => 'Descrição',
                'id'   => 'a4p_home_proof_description',
                'type' => 'textarea',
                'rows' => 4,
                'std'  => 'Nascemos de um sonho simples: esvaziar as ruas. Hoje, mantemos abrigos estruturados com tratamento veterinário de ponta, garantindo dignidade e uma segunda chance para centenas de vidas.',
            ],
            [
                'name' => 'Texto do item 1',
                'id'   => 'a4p_home_proof_item_1',
                'type' => 'text',
                'std'  => '+1500 Animais Acolhidos Constantemente',
            ],
            [
                'name' => 'Texto do item 2',
                'id'   => 'a4p_home_proof_item_2',
                'type' => 'text',
                'std'  => 'Nascemos de um sonho simples: Resgatar o amor em 4 patas',
            ],
            [
                'name'       => 'Imagem principal',
                'id'         => 'a4p_home_proof_image_main',
                'type'       => 'single_image',
                'image_size' => 'medium',
            ],
            [
                'name'       => 'Imagem superior direita',
                'id'         => 'a4p_home_proof_image_top',
                'type'       => 'single_image',
                'image_size' => 'medium',
            ],
            [
                'name'       => 'Imagem inferior direita',
                'id'         => 'a4p_home_proof_image_bottom',
                'type'       => 'single_image',
                'image_size' => 'medium',
            ],
        ],
    ];

    return $meta_boxes;
});

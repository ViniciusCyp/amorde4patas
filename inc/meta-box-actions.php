<?php

declare(strict_types=1);

add_filter('rwmb_meta_boxes', static function (array $meta_boxes): array {
    $current_post_id = 0;

    if (isset($_GET['post'])) {
        $current_post_id = (int) $_GET['post'];
    } elseif (isset($_POST['post_ID'])) {
        $current_post_id = (int) $_POST['post_ID'];
    }

    if ($current_post_id > 0) {
        $current_slug = (string) get_post_field('post_name', $current_post_id);

        if ($current_slug === 'nossas-boas-acoes') {
            $meta_boxes[] = [
                'id'         => 'a4p_actions_page_intro',
                'title'      => 'Conteúdo da página Nossas Boas Ações',
                'post_types' => ['page'],
                'context'    => 'normal',
                'priority'   => 'high',
                'fields'     => [
                    [
                        'name' => 'Título parte 1',
                        'id'   => 'a4p_actions_page_title_main',
                        'type' => 'text',
                        'std'  => 'Nossas Boas',
                    ],
                    [
                        'name' => 'Título destaque',
                        'id'   => 'a4p_actions_page_title_highlight',
                        'type' => 'text',
                        'std'  => 'Ações',
                    ],
                    [
                        'name' => 'Subtítulo',
                        'id'   => 'a4p_actions_page_subtitle',
                        'type' => 'textarea',
                        'rows' => 3,
                        'std'  => 'Cada resgate é uma história de esperança. Veja o impacto que transformamos juntos na vida dos animais.',
                    ],
                ],
            ];
        }
    }

    $meta_boxes[] = [
        'id'         => 'a4p_action_fields',
        'title'      => 'Detalhes da ação',
        'post_types' => ['a4p_action'],
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => [
            [
                'name' => 'Ordem',
                'id'   => 'a4p_action_order',
                'type' => 'number',
                'std'  => 0,
            ],
            [
                'name' => 'Selo',
                'id'   => 'a4p_action_badge',
                'type' => 'text',
                'std'  => 'Resgate',
            ],
            [
                'name'    => 'Cor do selo',
                'id'      => 'a4p_action_badge_tone',
                'type'    => 'select',
                'options' => [
                    'orange' => 'Laranja',
                    'green'  => 'Verde',
                    'blue'   => 'Azul',
                    'brown'  => 'Marrom',
                ],
                'std' => 'orange',
            ],
            [
                'name' => 'Legenda curta',
                'id'   => 'a4p_action_meta',
                'type' => 'text',
                'std'  => 'Março 2026',
            ],
            [
                'name'       => 'Imagem de capa',
                'id'         => 'a4p_action_cover',
                'type'       => 'single_image',
                'image_size' => 'medium',
            ],
            [
                'name' => 'Descrição do popup',
                'id'   => 'a4p_action_description',
                'type' => 'wysiwyg',
                'options' => [
                    'textarea_rows' => 6,
                    'media_buttons' => false,
                ],
            ],
            [
                'name'       => 'Galeria do popup',
                'id'         => 'a4p_action_gallery',
                'type'       => 'image_advanced',
                'image_size' => 'thumbnail',
            ],
        ],
    ];

    return $meta_boxes;
});
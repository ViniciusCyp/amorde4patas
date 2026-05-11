<?php

declare(strict_types=1);

add_action('init', static function (): void {
    register_post_type('a4p_action', [
        'labels' => [
            'name'               => 'Boas Ações',
            'singular_name'      => 'Boa Ação',
            'add_new'            => 'Adicionar nova',
            'add_new_item'       => 'Adicionar nova ação',
            'edit_item'          => 'Editar ação',
            'new_item'           => 'Nova ação',
            'view_item'          => 'Ver ação',
            'search_items'       => 'Buscar ações',
            'not_found'          => 'Nenhuma ação encontrada',
            'not_found_in_trash' => 'Nenhuma ação encontrada na lixeira',
            'menu_name'          => 'Boas Ações',
        ],
        'public'             => true,
        'publicly_queryable' => false,
        'exclude_from_search'=> true,
        'has_archive'        => false,
        'rewrite'            => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => ['title', 'thumbnail'],
    ]);
});
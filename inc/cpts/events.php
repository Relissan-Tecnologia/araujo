<?php

if (!defined('ABSPATH')) {
    exit;
}

class CPT_Events
{
    /**
     * Start up
     */
    public function __construct()
    {
        // Register post type "Banner"
        add_action('init', array($this, 'register_custom_post_type_events'));
        add_action('init', array($this, 'register_taxonomy_event_types'));
    }

    // Register post type "events"
    public function register_custom_post_type_events()
    {
        $labels = array(
            'name'               => _x( 'Eventos', 'post type general name', 'event' ),
            'singular_name'      => _x( 'Evento', 'post type singular name', 'event' ),
            'menu_name'          => _x( 'Eventos', 'admin menu', 'event' ),
            'name_admin_bar'     => _x( 'Evento', 'add new on admin bar', 'event' ),
            'add_new'            => _x( 'Novo Evento', 'Evento', 'event' ),
            'add_new_item'       => __( 'Adicionar Novo Evento', 'event' ),
            'new_item'           => __( 'Novo Evento', 'event' ),
            'edit_item'          => __( 'Editar Evento', 'event' ),
            'view_item'          => __( 'Ver Evento', 'event' ),
            'all_items'          => __( 'Todos os Eventos', 'event' ),
            'search_items'       => __( 'Buscar Evento', 'event' ),
            'not_found'          => __( 'Não existem Eventos cadastrados! ', 'event' ),
            'not_found_in_trash' => __( 'Não há Eventos na lixeira!', 'event' )
        );
    
        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'query_var'           => true,
            'rewrite'             => array( 'slug' => 'eventos' ),
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => true,
            'menu_position'       => 3,
            'menu_icon'           => 'dashicons-calendar-alt',
            'supports'            => array( 'title', 'revisions', 'thumbnail', 'editor' ),
            'show_in_rest'      => true
        );
        
        register_post_type( 'eventos', $args );
        flush_rewrite_rules();
    }
    
    // Register custom taxonomy
    public function register_taxonomy_event_types()
    {
        $labels = array(
            'name'              => _x('Tipos dos Eventos', 'taxonomy general name', 'event'),
            'singular_name'     => _x('Tipo do Evento', 'taxonomy singular name', 'event'),
            'search_items'      => __('Buscar Tipos de Evento', 'event'),
            'all_items'         => __('Todas os Tipos de Evento', 'event'),
            'parent_item'       => __('Tipo Principal', 'event'),
            'parent_item_colon' => __('Tipo Principal', 'event'),
            'edit_item'         => __('Editar Tipo de Evento', 'event'),
            'update_item'       => __('Atualizar Tipo de Evento', 'event'),
            'add_new_item'      => __('Adicionar Novo Tipo de Evento', 'event'),
            'new_item_name'     => __('Novo Tipo de Evento', 'event'),
            'menu_name'         => __('Tipos', 'event'),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'tipos', 'with_front' => false, 'hierarchical' => true),
            'show_in_rest'      => true
        );

        register_taxonomy('tipos', array('eventos'), $args);
    }
}

$CPT_Events = new CPT_Events();

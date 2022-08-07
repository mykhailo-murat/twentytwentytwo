<?php
/**
Plugin Name: My CPT plugin
 **/

function register_my_cpt_speakers() {

    /**
     * Post Type: Speakers.
     */

    $labels = [
        "name" => __( "Speakers", "twentytwentytwo" ),
        "singular_name" => __( "Speaker", "twentytwentytwo" ),
    ];

    $args = [
        "label" => __( "Speakers", "twentytwentytwo" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "can_export" => false,
        "rewrite" => [ "slug" => "speakers", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail", "page-attributes" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "speakers", $args );
}

add_action( 'init', 'register_my_cpt_speakers' );

function register_my_cpt_sessions() {

    /**
     * Post Type: Speakers.
     */

    $labels = [
        "name" => __( "Sessions", "twentytwentytwo" ),
        "singular_name" => __( "Session", "twentytwentytwo" ),
    ];

    $args = [
        "label" => __( "Sessions", "twentytwentytwo" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "can_export" => false,
        "rewrite" => [ "slug" => "sessions", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title"],
        "show_in_graphql" => false,
    ];

    register_post_type( "sessions", $args );
}

add_action( 'init', 'register_my_cpt_sessions' );

function register_my_taxes_positions() {

    /**
     * Taxonomy: Positions.
     */

    $labels = [
        "name" => __( "Positions", "twentytwentytwo" ),
        "singular_name" => __( "Position", "twentytwentytwo" ),
    ];


    $args = [
        "label" => __( "Positions", "twentytwentytwo" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'positions', 'with_front' => true, ],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "positions",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "positions", [ "speakers" ], $args );
}
add_action( 'init', 'register_my_taxes_positions' );


function register_my_taxes_countries() {

    /**
     * Taxonomy: Countries.
     */

    $labels = [
        "name" => __( "Countries", "twentytwentytwo" ),
        "singular_name" => __( "Country", "twentytwentytwo" ),
    ];


    $args = [
        "label" => __( "Countries", "twentytwentytwo" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'countries', 'with_front' => true, ],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "countries",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "countries", [ "speakers" ], $args );
}
add_action( 'init', 'register_my_taxes_countries' );

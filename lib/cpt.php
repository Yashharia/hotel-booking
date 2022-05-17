<?php function custom_post_type()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Hotel Bookings', 'Post Type General Name', 'twentytwentyone'),
        'singular_name'       => _x('Hotel Booking', 'Post Type Singular Name', 'twentytwentyone'),
        'menu_name'           => __('Hotel Bookings', 'twentytwentyone'),
        'parent_item_colon'   => __('Parent Hotel Booking', 'twentytwentyone'),
        'all_items'           => __('All Hotel Bookings', 'twentytwentyone'),
        'view_item'           => __('View Hotel Booking', 'twentytwentyone'),
        'add_new_item'        => __('Add New Hotel Booking', 'twentytwentyone'),
        'add_new'             => __('Add New', 'twentytwentyone'),
        'edit_item'           => __('Edit Hotel Booking', 'twentytwentyone'),
        'update_item'         => __('Update Hotel Booking', 'twentytwentyone'),
        'search_items'        => __('Search Hotel Booking', 'twentytwentyone'),
        'not_found'           => __('Not Found', 'twentytwentyone'),
        'not_found_in_trash'  => __('Not found in Trash', 'twentytwentyone'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __('Hotel Bookings', 'twentytwentyone'),
        'description'         => __('Hotel Booking news and reviews', 'twentytwentyone'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array('genres'),
        /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );

    // Registering your Custom Post Type
    register_post_type('hotel_booking', $args);


    
}

add_action('init', 'custom_post_type', 0);

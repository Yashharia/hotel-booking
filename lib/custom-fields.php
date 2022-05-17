<?php

function add_meta_box_function($post_type)

{

    // Limit meta box to certain post types.

    $post_types = array('hotel_booking');



    if (in_array($post_type, $post_types)) {

        add_meta_box(

            'pricing_fields',

            'Pricing Fields',

            'render_meta_box_content',

            $post_type

        );

    }

}

add_action('add_meta_boxes',  'add_meta_box_function');







function save($post_id)

{

    global $post;



    if (isset($_POST["premium_pricing"])) :

        update_post_meta($post->ID, 'premium_pricing', $_POST["premium_pricing"]);

    endif;



    if (isset($_POST["luxury_pricing"])) :

        update_post_meta($post->ID, 'luxury_pricing', $_POST["luxury_pricing"]);

    endif;



    if (isset($_POST["deluxe_pricing"])) :

        update_post_meta($post->ID, 'deluxe_pricing', $_POST["deluxe_pricing"]);

    endif;



    if (isset($_POST["standard_pricing"])) :

        update_post_meta($post->ID, 'standard_pricing', $_POST["standard_pricing"]);

    endif;



    if (isset($_POST["economy_pricing"])) :

        update_post_meta($post->ID, 'economy_pricing', $_POST["economy_pricing"]);

    endif;



    if (isset($_POST["number_of_days"])) :

        update_post_meta($post->ID, 'number_of_days', $_POST["number_of_days"]);

    endif;



    if (isset($_POST["cp"])) :

        update_post_meta($post->ID, 'cp', $_POST["cp"]);

    endif;

    if (isset($_POST["map"])) :

        update_post_meta($post->ID, 'map', $_POST["map"]);

    endif;

    if (isset($_POST["ap"])) :

        update_post_meta($post->ID, 'ap', $_POST["ap"]);

    endif;

}



function render_meta_box_content($post)

{

    wp_nonce_field('myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce');



    // Use get_post_meta to retrieve an existing value from the database.

    $premium_pricing = get_post_meta($post->ID, 'premium_pricing', true);

    $luxury_pricing = get_post_meta($post->ID, 'luxury_pricing', true);

    $deluxe_pricing = get_post_meta($post->ID, 'deluxe_pricing', true);

    $standard_pricing = get_post_meta($post->ID, 'standard_pricing', true);

    $economy_pricing = get_post_meta($post->ID, 'economy_pricing', true);



    $number_of_days = get_post_meta($post->ID, 'number_of_days', true);



    $cp = get_post_meta($post->ID, 'cp', true);

    $map = get_post_meta($post->ID, 'map', true);

    $ap = get_post_meta($post->ID, 'ap', true);



?>

    <label for="myplugin_new_field"><?php _e('Number of days'); ?></label>

    <input type="number" style="width:100%;" class="form-control" name="number_of_days" value="<?php echo esc_attr($number_of_days); ?>">

    <label for="myplugin_new_field">

        <?php _e('Premium Packages - Best available Hotel '); ?>

    </label>

    <input type="number" style="width:100%;" class="form-control" name="premium_pricing" value="<?php echo esc_attr($premium_pricing); ?>">

    <label for="myplugin_new_field">

        <?php _e('Luxury Packages - Equivalent 4* Hotel'); ?>

    </label>

    <input type="number" style="width:100%;" class="form-control" name="luxury_pricing" value="<?php echo esc_attr($luxury_pricing); ?>">

    <label for="myplugin_new_field">

        <?php _e('Deluxe Packages - Equivalent 3* Hotel'); ?>

    </label>

    <input type="number" style="width:100%;" class="form-control" name="deluxe_pricing" value="<?php echo esc_attr($deluxe_pricing); ?>">

    <label for="myplugin_new_field">

        <?php _e('Standard Packages - Equivalent 2* Hotel with Basic Facilities'); ?>

    </label>

    <input type="number" style="width:100%;" class="form-control" name="standard_pricing" value="<?php echo esc_attr($standard_pricing); ?>">

    <label for="myplugin_new_field">

        <?php _e('Economy Packages - Equivalent 1* Hotel with Basic Facilities'); ?>

    </label>

    <input type="number" style="width:100%;" class="form-control" name="economy_pricing" value="<?php echo esc_attr($economy_pricing); ?>">



    <div class="meal-plans">

        <h4>Meal plans</h4>

        <label for="cp">

            <?php _e('Breakfast only (CP)'); ?>

        </label>

        <input type="number" style="width:100%;" class="form-control" id="cp" name="cp" value="<?php echo esc_attr($cp); ?>">

        <label for="map">

            <?php _e('Breakfast and Dinner (MAP)'); ?>

        </label>

        <input type="number" style="width:100%;" class="form-control" id="map" name="map" value="<?php echo esc_attr($map); ?>">

        <label for="ap">

            <?php _e('Breakfast, Lunch and Dinner ( AP)'); ?>

        </label>

        <input type="number" style="width:100%;" class="form-control" id="ap" name="ap" value="<?php echo esc_attr($ap); ?>">

    </div>

<?php

}

add_action('save_post',       'save');


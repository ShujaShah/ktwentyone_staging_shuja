<?php

wp_enqueue_script('jquery-ui-tabs');
wp_enqueue_style('jqueryuicss', get_stylesheet_directory_uri().'/css/jquery-ui.css', array());
remove_action('genesis_entry_header', 'genesis_do_post_title');
add_action('genesis_before_content', 'genesis_do_post_title');

// Add specific CSS class by filter
add_filter( 'body_class', 'wdm_enrolled_user_class' );
function wdm_enrolled_user_class( $classes ) {
    global $post;
    if(!sfwd_lms_has_access($post->ID)){
        // add 'class-name' to the $classes array
        $classes[] = 'wdm-no-access';
        
    }
    else {
        $classes[] = 'wdm-has-access';
    }
    // return the $classes array
        return $classes;
}

genesis();

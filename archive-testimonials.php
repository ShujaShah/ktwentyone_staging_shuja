<?php
/* Testimonials Template */

// set full width layout

add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

add_action('genesis_before_content_sidebar_wrap', 'wdm_page_title');

function wdm_page_title()
{
    echo '<h1 class="archive-title">';
    post_type_archive_title();
    echo '</h1>';

}
remove_action('genesis_loop', 'genesis_do_loop');

//add a custom loop
add_action('genesis_loop', 'wdm_testimonial_loop');

remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
add_action('genesis_entry_header', 'genesis_do_post_image', 4);
function wdm_thumb()
{
    if (!has_post_thumbnail()) {
        echo '<a href="'.get_permalink().'" aria-hidden="true"><img src="'.get_stylesheet_directory_uri().'/images/avatar.gif" alt="avatar"/></a>';
    }
}

add_action('genesis_entry_header', 'wdm_thumb', 4);
remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_entry_content', 'genesis_do_post_content');
add_action('genesis_entry_content', 'the_content');
remove_action('genesis_entry_header', 'genesis_do_post_title');

function wdm_meta()
{
    
    global $post;
    if (get_post_meta($post->ID, "linkedin", true))
        $social_site = '<a href="http://'.get_post_meta($post->ID, "linkedin", true).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
    elseif (get_post_meta($post->ID, "facebook", true))
        $social_site = '<a href="http://'.get_post_meta($post->ID, "facebook", true).'"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
    elseif (get_post_meta($post->ID, "twitter", true))
        $social_site = '<a href="http://'.get_post_meta($post->ID, "twitter", true).'"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
    else
        $social_site = '';
    if (get_post_meta($post->ID, "_designation", true) && get_post_meta($post->ID, "_company", true))
        $comma = ',';
    echo '<div class="wdm-testi-person-details">
           <h6 class="wdm-testi-person-name">'.$social_site.' '.the_title("", "", false).'</h6>
    <p>'.get_post_meta($post->ID, "_designation", true).''.$comma.' '.get_post_meta($post->ID, "_company", true).'</p>
     </div>';


}
add_action('genesis_entry_header', 'wdm_meta', 6);
// remove Genesis default loop
function wdm_testimonial_loop()
{
    
    //* Use old loop hook structure if not supporting HTML5
    if (! genesis_html5()) {
        genesis_legacy_loop();
        return;
    }

    if (have_posts()) :

        do_action('genesis_before_while');
        while (have_posts()) : the_post();

            do_action('genesis_before_entry');

            printf('<article class="wdm-testi-wrap wdm-testi-pg">', genesis_attr('entry'));

                do_action('genesis_entry_header');

               // do_action('genesis_before_entry_content');

                printf('<div %s>', genesis_attr('entry-content'));
                do_action('genesis_entry_content');
                echo '</div>';

                do_action('genesis_after_entry_content');

            echo '</article>';

            do_action('genesis_after_entry');

        endwhile; //* end of one post
        do_action('genesis_after_endwhile');

    else : //* if no posts exist
        do_action('genesis_loop_else');
    endif; //* end loop

}
// add_filter("the_content", "plugin_myContentFilter");

//   function plugin_myContentFilter($content)
//   {
//     // Take the existing content and return a subset of it
//     return substr($content, 0, 300);
//   }
add_filter("the_content", "break_text");
function break_text($text){
    $text = strip_tags($text);
    $length = 200;
    if(strlen($text)<$length+10) return $text;//don't cut if too short

    $break_pos = strpos($text, ' ', $length);//find next space after desired length
    $visible = substr($text, 0, $break_pos);
    return balanceTags($visible) . "<a href=" . get_permalink() . ">...[Read more]</a>";
    // $string = strip_tags($text);

    // if (strlen($string) > 200) {

    // // truncate string
    // $stringCut = substr($string, 0, 200);

    // // make sure it ends in a word so assassinate doesn't become ass...
    // $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href=" '. get_permalink() .' ">Read More</a>'; 
    // }
    // return $string;
}

// function wpdocs_five_posts_on_homepage( $query ) {
//     $query->set( 'posts_per_page', 5 );
// }
// add_action( 'pre_get_posts', 'wpdocs_five_posts_on_homepage' );



genesis();

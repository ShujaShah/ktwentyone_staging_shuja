<?php
//* Template Name: Blog
add_action('genesis_before_content_sidebar_wrap', 'wdm_blog_title');
function wdm_blog_title()
{
    echo '<h1 class="archive-title">Blog</h1>';
}
add_filter('get_the_content_more_link', 'sp_read_more_link');
function sp_read_more_link()
{
    return '';
}
//remove_action('genesis_before_content', 'genesis_do_post_title');
remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
remove_action('genesis_post_content', 'genesis_do_post_image');
remove_action('genesis_loop', 'genesis_do_loop');
remove_action('genesis_entry_header', 'genesis_do_post_title');
add_action('genesis_entry_header', 'genesis_do_post_image', 10);
add_action('genesis_entry_header', 'genesis_do_post_title', 11);
remove_action('genesis_entry_header', 'genesis_post_info', 12);
add_action('genesis_loop', 'wdm_loop', 5);
function wdm_loop()
{
    //* Use old loop hook structure if not supporting HTML5
    if (! genesis_html5()) {
        genesis_legacy_loop();
        return;
    }

    if (have_posts()) :
        do_action('genesis_before_while');
        while (have_posts()) :
            the_post();
            // $imgTag = get_avatar( get_the_author_meta( 'ID' ) , 60 );
            // $imgTag = '"'.$imgTag.'"';
            // error_log(print_r($imgTag, true));
            do_action('genesis_before_entry');
            printf('<article %s post_class("wdm-each-post");>', genesis_attr('entry'));
                do_action('genesis_entry_header');
                remove_action('genesis_entry_header', 'genesis_do_post_info');

                do_action('genesis_before_entry_content');

                echo get_avatar( get_the_author_meta( 'ID' ), 60 );

                echo '<div class="wdm-post-meta">';
                
                echo do_shortcode('[post_date] [post_comments]');
                echo '</div>';
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

genesis();

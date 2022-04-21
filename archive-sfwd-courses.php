<?php
/* Courses Template */

// set full width layout
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

add_action('genesis_before_content_sidebar_wrap', 'wdm_page_title');

function wdm_page_title()
{
    echo '<h1 class="archive-title">';
    post_type_archive_title();
    echo '</h1>';

}

/**
 * Archive Post Class
 * @since 1.0.0
 *
 * Breaks the posts into three columns
 * @link http://www.billerickson.net/code/grid-loop-using-post-class
 * @ref http://www.billerickson.net/a-better-and-easier-grid-loop/
 * @param array $classes
 * @return array
 */
function be_archive_post_class($classes)
{
    $classes[] = 'one-fourth';
    global $wp_query;
    if (0 == $wp_query->current_post || 0 == $wp_query->current_post % 4) {
        $classes[] = 'first';
    }
    return $classes;
}
add_filter('post_class', 'be_archive_post_class');

// remove Genesis default loop
remove_action('genesis_loop', 'genesis_do_loop');

// add a custom loop
add_action('genesis_loop', 'wdm_course_loop');

function wdm_course_loop()
{
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $noofpages = 8;
    if(!is_user_logged_in()) {
        $noofpages = -1;
    }
    // if(!is_user_logged_in())
    // {
    //     $query = new WP_Query(array(
    //         'post_type' => 'sfwd-courses',
    //         'posts_per_page' => 8,
    //         'paged'          => $paged,
    //         'meta_query' => array(
    //             array(
    //                 'key' => '_is4wp_prohibited_action',
    //                 'value' => 'hide',
    //                 'compare' => 'LIKE'
    //             )
    //         )
    //     ));
    // }
    // else
    // {
        $query = new WP_Query(array(
            'post_type' => 'sfwd-courses',
            'post_status' => array( 'publish', 'graded', 'not_graded', 'private' ),
            'posts_per_page' => $noofpages,
            'paged'          => $paged
        ));
    // }


     //'post_status' => array( 'publish', 'private' )

    // echo "<pre>";
    // var_dump($query);
    // echo "</pre>";
    // $wdm_count=0;
    // while ($query->have_posts()) :
    //         $query->the_post();
    //     $wdm_count=$wdm_count+1;
    // endwhile;
    // var_dump($wdm_count);
    //$wdm_count=0;
    // while ($query->have_posts()) {
    //     $wdm_count++;
    // }
    // var_dump($wdm_count);
    if ($query->have_posts()) :
        ?>
        <div class="wdm-course-grid clearfix">
        <?php
        do_action('genesis_before_while');
        $icourse=0;
        while ($query->have_posts()) :
            
            $query->the_post();

            //* Remove the entry meta in the entry header (requires HTML5 theme support)
            remove_action('genesis_entry_header', 'genesis_post_info', 12);

            remove_action('genesis_after_post_content', 'genesis_post_meta');
            remove_action('genesis_entry_content', 'genesis_do_post_content');

            do_action('genesis_before_entry');
            $ms='';
            if($icourse%4 == 0) {
                $ms = ' style="margin-left:0px !important;" ';
            }
            printf('<article '.$ms.' %s>', genesis_attr('entry'));

                do_action('genesis_before_entry_content');

                printf('<div %s>', genesis_attr('entry-content'));
                do_action('genesis_entry_content');
                echo '</div>';

                do_action('genesis_after_entry_content');
                do_action('genesis_entry_header');
                //do_action('genesis_entry_footer');
                ?>
                <div class="course-price clearfix">
                    <p class="alignleft">Price</p>
                    <p class="alignright"><?php wdm_course_price(); ?></p>
                </div>
                <div class="wdm-course-meta clearfix">
                    <?php
                        wdm_course_rating();
                    ?>
                    <p class="alignright wdm-course-learners"><?php wdm_course_learners(); ?></p>
                </div>
               
                <?php
                
                echo '</article>';
                $icourse++;
                if($icourse%4 == 0) {
                    echo '<div style="clear:both;"></div>';
                }
                // $wdm_count=$wdm_count+1;
                // if($wdm_count==8)
                // {
                //     break;
                // }

                do_action('genesis_after_entry');



        endwhile; //* end of one post
        if(is_user_logged_in()) {
            do_action('genesis_after_endwhile');
        }
    ?>
    <style type="text/css">
    .archive .wdm-course-grid .one-fourth:nth-child(4n+5) {
        margin-left: 29px !important;
    }</style>
    </div><!-- /.wdm-course-grid -->
    <?php
    else : //* if no posts exist
        do_action('genesis_loop_else');
    endif; //* end loop

    wp_reset_postdata();
}
genesis();

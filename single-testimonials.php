<?php
/* Testimonials Single Template */

// set full width layout
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

/* Code to Display Featured Image */
add_action( 'genesis_before_entry_header', 'featured_testimonial_image', 8 );
function featured_testimonial_image() {
    echo '<div class="wdm-testi-img">';
    if (!has_post_thumbnail()) {
        echo '<a href="'.get_permalink().'" aria-hidden="true"><img src="'.get_stylesheet_directory_uri().'/images/avatar.gif" alt="avatar"/></a>';
    }
    else {
        the_post_thumbnail('post-image');
    }
    echo '</div>';
}

add_action( 'genesis_entry_header', 'wdm_single_person_social_site', 11);
function wdm_single_person_social_site() {
    if (get_post_meta(get_the_ID(), "linkedin", true))
        $social_site = '<span><a class="single-testi-icons" href="http://'.get_post_meta(get_the_ID(), "linkedin", true).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span>';
    elseif (get_post_meta(get_the_ID(), "facebook", true))
        $social_site = '<span><a class="single-testi-icons" href="http://'.get_post_meta(get_the_ID(), "facebook", true).'"><i class="fa fa-facebook" aria-hidden="true"></i></a></span>';
    elseif (get_post_meta(get_the_ID(), "twitter", true))
        $social_site = '<span><a class="single-testi-icons" href="http://'.get_post_meta(get_the_ID(), "twitter", true).'"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>';
    else
        $social_site = '';
    // echo '<h1 class="social-networking-icons hidden">'.$social_site.'</h1>';
    ?><script>
        jQuery('.entry-title').append('<?php echo $social_site ?>');
    </script><?php
}

/* Code to Display designation and company */
add_action( 'genesis_entry_header', 'wdm_single_person_details', 11 );
function wdm_single_person_details() {
    if (get_post_meta(get_the_ID(), "_designation", true) && get_post_meta(get_the_ID(), "_company", true))
        $comma = ',';
    echo '<p>'. get_post_meta(get_the_ID(), "_designation", true). ''.$comma.' '. get_post_meta(get_the_ID(), "_company", true).'</p>';
}

/* Code to Display back button */
add_action( 'genesis_after_endwhile', 'wdm_back_to_archive', 11 );
function wdm_back_to_archive() {
    
    echo '<a href="'.get_post_type_archive_link('testimonials').'" class="wdm-testi-archive-link">View All Testimonials</a>';
}

// remove Genesis default loop
remove_action('genesis_loop', 'genesis_do_loop');

// add a custom loop
add_action('genesis_loop', 'wdm_single_testimonial_loop');

function wdm_single_testimonial_loop()
{
        //* Use old loop hook structure if not supporting HTML5
    if ( ! genesis_html5() ) {
        genesis_legacy_loop();
        return;
    }

    if ( have_posts() ) :

        do_action( 'genesis_before_while' );
        while ( have_posts() ) : the_post();

            //* Remove the entry meta in the entry header (requires HTML5 theme support)
            remove_action('genesis_entry_header', 'genesis_post_info', 12);

            do_action( 'genesis_before_entry' );

            printf( '<article %s><i class="fa fa-quote-right" aria-hidden="true"></i>', genesis_attr( 'entry' ) );

                do_action( 'genesis_before_entry_header' );

                do_action( 'genesis_entry_header' );

                
                do_action( 'genesis_before_entry_content' );

                printf( '<div %s>', genesis_attr( 'entry-content' ) );
                do_action( 'genesis_entry_content' );
                echo '</div>';

                do_action( 'genesis_after_entry_content' );

                //do_action( 'genesis_entry_footer' );

            echo '</article>';

            do_action( 'genesis_after_entry' );

        endwhile; //* end of one post
        do_action( 'genesis_after_endwhile' );

    else : //* if no posts exist
        do_action( 'genesis_loop_else' );
    endif; //* end loop
}
genesis();

<?php
//* Start the engine
include_once(get_template_directory() . '/lib/init.php');

//* Child theme (do not remove)
define('CHILD_THEME_NAME', 'ktwentyone');
define('CHILD_THEME_URL', 'https://wisdmlabs.com/');
define('CHILD_THEME_VERSION', '1.0.0');

//* Enqueue Lato Google font
add_action('wp_enqueue_scripts', 'genesis_sample_google_fonts');
function genesis_sample_google_fonts()
{
    wp_enqueue_style('google-font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800', array(), CHILD_THEME_VERSION);
    wp_enqueue_style('temp-css', get_stylesheet_directory_uri().'/temp.css', array());
    wp_enqueue_style('tempnew-css', get_stylesheet_directory_uri().'/temp-new.css', array());
    wp_enqueue_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array());
    wp_enqueue_script('debouncedresize-js', get_stylesheet_directory_uri().'/js/jquery.debouncedresize.js', array());
    wp_enqueue_script('script-js', get_stylesheet_directory_uri().'/js/script.js', array());
    wp_localize_script('script-js', 'wdm_script_obj', array('site_url_wdm' => site_url()));
    wp_enqueue_style('ld-css', get_stylesheet_directory_uri().'/learndash/learndash_template_style.css');
    wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri().'/css/bootstrap.css', array());
    wp_enqueue_style('fa-css', get_stylesheet_directory_uri().'/css/font-awesome.css', array());
    wp_deregister_style('sfwd_template_css');
    if (is_singular('post') || is_home()) {
        wp_enqueue_style('source-sans-pro', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600,600italic,700,700italic,300italic,300');
    }
}

//* Add HTML5 markup structure
add_theme_support('html5', array( 'search-form', 'comment-form', 'comment-list'));

//* Add viewport meta tag for mobile browsers
add_theme_support('genesis-responsive-viewport');

//* Add support for custom background
add_theme_support('custom-background');

//* Add support for 3-column footer widgets
add_theme_support('genesis-footer-widgets', 4);


//* Register Homepage widget areas
genesis_register_sidebar(array(
    'id'            => 'hp-1',
    'name'          => __('Homepage Section 1', 'ktwentyone'),
    'description'   => __('This is a widget area for Section 1 of Homepage', 'ktwentyone'),
    'before_title'  => '<div class="wdm-widget-title-wrap"><h4 class="widget-title widgettitle">',
    'after_title'   => "</h4></div>"
));

genesis_register_sidebar(array(
    'id'            => 'hp-2',
    'name'          => __('Homepage Section 2', 'ktwentyone'),
    'description'   => __('This is a widget area for Section 2 of Homepage', 'ktwentyone'),
    'before_title'  => '<div class="wdm-widget-title-wrap"><h4 class="widget-title widgettitle">',
    'after_title'   => "</h4></div>"
));

genesis_register_sidebar(array(
    'id'            => 'hp-3',
    'name'          => __('Homepage Section 3', 'ktwentyone'),
    'description'   => __('This is a widget area for Section 3 of Homepage', 'ktwentyone'),
    'before_title'  => '<div class="wdm-widget-title-wrap"><h4 class="widget-title widgettitle">',
    'after_title'   => "</h4></div>"
));

genesis_register_sidebar(array(
    'id'            => 'hp-4',
    'name'          => __('Homepage Section 4', 'ktwentyone'),
    'description'   => __('This is a widget area for Section 4 of Homepage', 'ktwentyone'),
    'before_title'  => '<div class="wdm-widget-title-wrap"><h4 class="widget-title widgettitle">',
    'after_title'   => "</h4></div>"
));

genesis_register_sidebar(array(
    'id'            => 'hp-5',
    'name'          => __('Homepage Section 5', 'ktwentyone'),
    'description'   => __('This is a widget area for Section 5 of Homepage', 'ktwentyone'),
    'before_title'  => '<div class="wdm-widget-title-wrap"><h4 class="widget-title widgettitle">',
    'after_title'   => "</h4></div>"
));

//* Shortcode for displaying course grid on homepage
add_shortcode('wdm-course-grid', 'wdm_course_grid');

function wdm_course_grid()
{
    ob_start();

            $wdm_count=0;
            $query = new WP_Query(array(
            'post_type' => 'sfwd-courses',
            'posts_per_page' => -1,
            ));
        

            if ($query->have_posts()) {
                ?>
       
                <div class="wdm-course-grid clearfix">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    if ($wdm_count==4) {
                        break;
                    }
            ?>
                
                <article id="post-<?php the_ID();
            ?>" <?php post_class('one-fourth');
        ?>>
                   <div itemprop="text" class="entry-content">
                       <a href="<?php the_permalink();
            ?>"><?php
                echo '<img src="'.wp_get_attachment_image_src(get_post_thumbnail_id(), array(300,188))[0].'"/>';
              
        ?></a>
                   </div> 
                    <header class="entry-header">
                        <h2 itemprop="headline" class="entry-title"><a href="<?php the_permalink();
            ?>"><?php the_title();
        ?></a></h2>
                    </header>
                    
                    <div class="course-price clearfix">
                        <p class="alignleft">Price</p>
                        <p class="alignright"><?php wdm_course_price();
            ?></p>
                    </div>
                    <div class="wdm-course-meta clearfix">
                    <?php
                        wdm_course_rating();
            ?>
                        <p class="alignright wdm-course-learners"><?php wdm_course_learners();
            ?></p>
                    </div>
                </article>
               
            <?php

            $wdm_count=$wdm_count+1;


                endwhile;
                wp_reset_postdata();
                ?>
                </div>
            <?php $myvariable = ob_get_clean();
            return $myvariable;
            }
}


//* Course Price function
function wdm_course_price()
{
    $course_meta = get_post_meta(get_the_ID(), '_sfwd-courses', true);
    echo '<span class="wdm-course-price">';
                
    if ($course_meta['sfwd-courses_course_price_type'] == 'free') {
        echo 'Free';
    } elseif ($course_meta['sfwd-courses_course_price_type'] == 'paynow') {
        echo '<i class="fa fa-usd"></i> ';
        echo $course_meta['sfwd-courses_course_price'];
    } elseif ($course_meta['sfwd-courses_course_price_type'] == 'open') {
        echo 'Free';
    } elseif ($course_meta['sfwd-courses_course_price_type'] == 'closed') {
        $price = $course_meta['sfwd-courses_course_price'];
        if ($price == 0) {
            echo 'Free';
        } else {
            echo '<i class="fa fa-usd"></i> ';
            echo $price;
        }
    } elseif ($course_meta['sfwd-courses_course_price_type'] == 'subscribe') {
        echo '<i class="fa fa-usd"></i> ';
        echo $course_meta['sfwd-courses_course_price'];
    }
    echo '</span>';
}

//* Course Rating
function wdm_course_rating()
{
    $wdm_course_rating=1;
    $course_rating = get_post_meta(get_the_ID(), 'Rating', true);
    if ($course_rating!=null) {
        $wdm_course_rating=get_post_meta(get_the_ID(), 'Rating', true);
        $wdm_rating_class = 'wdm-rating-'.$wdm_course_rating;
    }

    echo '<ul class="wdm-course-rating alignleft '. $wdm_rating_class . '">';
                        
    for ($i = 0; $i < 5; $i++) {
        if ($i < $wdm_course_rating) {
            $star_class = "wdm-filled-star";
        } else {
            $star_class = "wdm-empty-star";
        }
        echo '<li class="fa fa-star wdm-star '.$star_class.'"></li>';
    }
    echo '</ul>';
}

//* Course Learners
function wdm_course_learners()
{
    $wdm_no_of_users=1;
              
    if (get_post_meta(get_the_ID(), '_sfwd-courses', true)!=null) {
        $all_setting_field=get_post_meta(get_the_ID(), '_sfwd-courses', true);
        $wdm_no_of_users=$all_setting_field['sfwd-courses_course_access_list'];
        if ($wdm_no_of_users=="") {
            $wdm_learner_count=0;
        } else {
            $wdm_array_users=explode(',', $wdm_no_of_users);
            $wdm_learner_count=count($wdm_array_users);
        }
    }
    echo '<i class="fa fa-users"></i>'.$wdm_learner_count. ' Learners';
}

function wdm_login()
{
    ?>
    <div class="modal fade" id="wdm-login" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <a class="close" data-dismiss="modal" href="#">&times;</a>
          <h4 class="modal-title"><img src="<?php echo  get_stylesheet_directory_uri();?>/images/logo.png"></h4>
        </div>
        <div class="modal-body">
        <?php echo do_shortcode('[memb_loginform button_label="Log In" username_label="" password_label="" show="always" redirect="/my-courses/"]');
    ?>
         <a href="/lost-password/" class="wdm-lost-pwd-link"><?php _e('Forgot Password?', 'wdm'); ?></a>
        </div>
      </div>
    </div>
  </div>
    <?php

}
add_action('genesis_after', 'wdm_login');

function wdm_register()
{
    ?>
    <div class="modal fade" id="wdm-register" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?php _e('REGISTER', 'wdm');
    ?></h4>
        </div>
        <div class="modal-body">
        <?php echo do_shortcode('[theme-my-login default_action="register"]');
    ?>
        </div>
      </div>
    </div>
  </div>
    <?php

}
//add_action('genesis_after', 'wdm_register');

// hamburger menu
function wdm_mobile_menu()
{
    echo '<span class="fa fa-bars"></span>';
}
add_action('genesis_header_right', 'wdm_mobile_menu');
//remove_action('genesis_header_right', 'genesis_do_nav');
//add_action('genesis_header_right', 'genesis_do_nav');
/*remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'wdm_footer');*/
add_filter( 'genesis_footer_creds_text','wdm_footer');
function wdm_footer($creds_text)
{
   $creds_text = '<p>© Copyrights 2012-18, K21Academy. All Rights Reserved</p>';
    return $creds_text;
}
/*function wdm_footer()
{
    echo '<p>© Copyrights 2017 , K21Academy. All Rights Reserved</p>';
}*/

/* Code to Display Featured Image on top of the post */
// add_action('genesis_entry_header', 'featured_post_image', 8);
// function featured_post_image()
// {
//     if (! is_singular('post')) {
//         return;
//     }
//     the_post_thumbnail('post-image');
// }

// Add testimonials on single course page
function wdm_course_testimonial()
{
    if (is_singular('sfwd-courses')) {
        echo '<div class="wdm-course-testi">';
        echo '<h2>Testimonials</h2>';
        echo do_shortcode('[wdmtestimonials_slider]');
        echo '</div>';
    }
}
add_action('genesis_after_content', 'wdm_course_testimonial');

add_filter('genesis_prev_link_text', 'gt_review_prev_link_text');
function gt_review_prev_link_text()
{
        $prevlink = '<i class="fa fa-angle-left"></i>';
        return $prevlink;
}
add_filter('genesis_next_link_text', 'gt_review_next_link_text');
function gt_review_next_link_text()
{
        $nextlink = '<i class="fa fa-angle-right"></i>';
        return $nextlink;
}

add_filter('learndash_previous_post_link', 'wdm_learndash_previous', 10, 4);
function wdm_learndash_previous($link, $permalink, $link_name, $post)
{
    $link = '<a href="'.$permalink.'" rel="prev"><i class="fa fa-angle-left"></i> ' . $link_name . '</a>';
    return $link;
}
add_filter('learndash_next_post_link', 'wdm_learndash_next', 10, 4);
function wdm_learndash_next($link, $permalink, $link_name, $post)
{
    $link = '<a href="'.$permalink.'" rel="next">' . $link_name . ' <i class="fa fa-angle-right"></i></a>';
    return $link;
}

// add_filter( 'wp_nav_menu_items', 'my_custom_menu_item');
// function my_custom_menu_item($items)
// {
//     if(is_user_logged_in())
//     {
//         $user=wp_get_current_user();
//         $name=$user->display_name; // or user_login , user_firstname, user_lastname
//         $items .= '<li style="color:balck" id="menu-item-000" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-000"><span itemprop="name">'.$name.'</span></li>';
//     }
//     return $items;
// }


add_filter("wp_get_nav_menu_items", "wdm_display_name_custom_menu", 10, 3);

function wdm_display_name_custom_menu($items, $menus, $args)
{
    if (is_admin()) {
        return $items;
    }
    $current_user = wp_get_current_user();
    $display_name_link_title = "%user-display-name%";
    foreach ($items as $key => $value) {
        if ($value->post_title == $display_name_link_title) {
            $value->post_title = $current_user->display_name;
            $value->title = ' <i class="fa fa-user"></i> ';
            $value->title .= $current_user->display_name;
            // $value->title .= ' <i class="fa fa-caret-down"></i>';
           // $value->url = get_edit_user_link();
           // $value->classes[0] = "wdm-profile-item";
        }
    }
    return $items;
}

function wdm_tabs()
{
    if (is_singular('sfwd-courses')) {
        wp_enqueue_script('jquery-ui-tabs');
        echo '<script> jQuery( "#tabs" ).tabs();</script>';
    }
}
add_action('wp_footer', 'wdm_tabs', 100);

// Dequeue visual composer's css
function wdm_remove_css()
{
    //wp_deregister_style('js_composer_front');
    wp_enqueue_style('wdm_js_composer_front', get_stylesheet_directory_uri().'/css/wdm_js_composer.css');
}
add_action('wp_enqueue_scripts', 'wdm_remove_css', 30);

function pw_remove_genesis_comments()
{
    remove_action('genesis_after_post', 'genesis_get_comments_template');
}

add_action('wp_enqueue_scripts', 'pw_remove_genesis_comments');


function add_og_img()
{
    global $post;

    if (is_singular('sfwd-courses')) {
        echo '<meta property="og:image" content="'.wp_get_attachment_image_src(get_post_thumbnail_id($post->ID))[0].'"/>
        <meta property="og:title" content="'.$post->post_title.'" />
        <meta property="og:url" content="'.get_permalink($post->ID).'" />';
    }

    //echo '<meta property="og:description" content="'.$post->post_content.'" />';
}
add_action('wp_head', 'add_og_img', 3);




function wdmAweberForm()
{
    ob_start();
    ?>
    <form method="post" class="af-form-wrapper" accept-charset="UTF-8" action="https://www.aweber.com/scripts/addlead.pl">
        <div style="display: none;">
            <input type="hidden" name="meta_web_form_id" value="218211373" />
            <input type="hidden" name="meta_split_id" value="" />
            <input type="hidden" name="listname" value="awlist4271174" />
            <input type="hidden" name="redirect" value="" id="redirect_e502dbdfe4fe5863e5f1994db5316e3e" />
            <input type="hidden" name="meta_adtracking" value="K21_Academy_Subscribers_Forum" />
            <input type="hidden" name="meta_message" value="1" />
            <input type="hidden" name="meta_required" value="name,email" />
            <input type="hidden" name="meta_tooltip" value="name||Name,,email||Email" />
            <input type="hidden" name="redirect" value="http://k21academy.com/thank-you-subscribing-for-the-blog" id="redirect_31a59e2ed82a6b997c95881967295ec8" />
        </div>
        <div id="af-form-218211373" class="af-form">
            <div id="af-header-218211373" class="af-header">
                <div class="bodyText">
                    <p>&nbsp;</p>
                </div>
            </div>
            <div id="af-body-218211373" class="af-body af-standards">
                <div class="af-element">
                    <label class="previewLabel" for="awf_field-83573730"></label>
                    <div class="af-textWrap">
                        <input id="awf_field-83573730" type="text" name="name" class="text" placeholder="Name" onfocus=" if (this.value == 'Name') { this.value = ''; }" onblur="if (this.value == '') { this.value='Name';} " tabindex="500" />
                    </div>
                    <div class="af-clear"></div>
                </div>
                <div class="af-element">
                    <label class="previewLabel" for="awf_field-83573731"></label>
                    <div class="af-textWrap">
                        <input class="text" id="awf_field-83573731" type="text" name="email" placeholder="Email" tabindex="501" onfocus=" if (this.value == 'Email') { this.value = ''; }" onblur="if (this.value == '') { this.value='Email';} " />
                    </div>
                    <div class="af-clear"></div>
                </div>
                <div class="af-element buttonContainer">
                    <input name="submit" class="submit wdm-green-btn" type="submit" value="Get It Now" tabindex="502" />
                    <div class="af-clear"></div>
                </div>
            </div>
            <div id="af-footer-218211373" class="af-footer">
                <div class="bodyText">
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
        <div style="display: none;"><img src="https://forms.aweber.com/form/displays.htm?id=TIwcTIyMzOzM" alt="" /></div>
    </form>
    <script type="text/javascript">
    // Special handling for facebook iOS since it cannot open new windows
    (function() {
        if (navigator.userAgent.indexOf('FBIOS') !== -1 || navigator.userAgent.indexOf('Twitter for iPhone') !== -1) {
            document.getElementById('af-form-218211373').parentElement.removeAttribute('target');
        }
    })();
    </script>
    <script type="text/javascript">
    (function() {
        var IE = /*@cc_on!@*/ false;
        if (!IE) {
            return;
        }
        if (document.compatMode && document.compatMode == 'BackCompat') {
            if (document.getElementById("af-form-218211373")) {
                document.getElementById("af-form-218211373").className = 'af-form af-quirksMode';
            }
            if (document.getElementById("af-body-218211373")) {
                document.getElementById("af-body-218211373").className = "af-body inline af-quirksMode";
            }
            if (document.getElementById("af-header-218211373")) {
                document.getElementById("af-header-218211373").className = "af-header af-quirksMode";
            }
            if (document.getElementById("af-footer-218211373")) {
                document.getElementById("af-footer-218211373").className = "af-footer af-quirksMode";
            }
        }
    })();
    </script>
    <script type="text/javascript">
    document.getElementById('redirect_e502dbdfe4fe5863e5f1994db5316e3e').value = document.location;
    </script>
    <!-- /AWeber Web Form Generator 3.0.1 -->

    <?php
    return ob_get_clean();
}

add_shortcode('wdm_aweber_form', 'wdmAweberForm');

//-------------------------------------------------------------------swapnil code begins----------------------------------------------------------------------------------------------------
// Social Networking Meta fileds for Testimonials


add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
    add_meta_box( 'my-meta-box-id', 'Social Networking', 'cd_meta_box_cb', 'testimonials', 'normal', 'high' );
}

function cd_meta_box_cb( $post )
{
$values = get_post_custom( $post->ID );
$fb = isset( $values['facebook'] ) ? esc_attr( $values['facebook'][0] ) : '';
$twtr = isset( $values['twitter'] ) ? esc_attr( $values['twitter'][0] ) : '';
$lnkd = isset( $values['linkedin'] ) ? esc_attr( $values['linkedin'][0] ) : '';

wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
<h3>Testimonials Social Networking</h3>

    <table class="form-table">
    <tr>
      <th><label for="facebook">Facebook</label></th>
      <td>
        <input type="text" name="facebook" id="facebook" value="<?php echo $fb; ?>" class="facebook"/><br />
    </td>
    </tr>
    <tr>
      <th><label for="twitter">Twitter</label></th>
      <td>
        <input type="text" name="twitter" id="twitter" value="<?php echo $twtr; ?>" class="twitter"/><br />
    </td>
    </tr>
    <tr>
      <th><label for="linkedin">Linked In</label></th>
      <td>
        <input type="text" name="linkedin" id="linkedin" value="<?php echo $lnkd; ?>" class="linkedin"/><br />
    </td>
    </tr>
    </table>
    <?php        
}



add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['facebook'] ) )
        update_post_meta( $post_id, 'facebook', wp_kses( $_POST['facebook'], $allowed ) );
    if( isset( $_POST['twitter'] ) )
        update_post_meta( $post_id, 'twitter', wp_kses( $_POST['twitter'], $allowed ) );
    if( isset( $_POST['linkedin'] ) )
        update_post_meta( $post_id, 'linkedin', wp_kses( $_POST['linkedin'], $allowed ) );
         
}


//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
add_action( 'add_meta_boxes', 'cd_meta_box_add_image_course' );
function cd_meta_box_add_image_course()
{
    add_meta_box( 'my-meta-box-id', 'Course Image Meta Box', 'cd_meta_box_cb_image_course', 'sfwd-courses', 'normal', 'high' );
}

function cd_meta_box_cb_image_course( $post )
{
$values = get_post_custom( $post->ID );
$text = isset( $values['upload_image'] ) ? esc_attr( $values['upload_image'][0] ) : '';

wp_nonce_field( 'my_meta_box_nonce_image_course', 'meta_box_nonce_image_course' );
    ?>
<h3>Course Image</h3>

    <table class="form-table">
    <script>
       jQuery(document).ready(function() {

         function uploadImage($buttonid, $textid) {
           jQuery($buttonid).click(function() {
            formfield = jQuery($textid).attr('name');
            tb_show('Upload a photo', 'media-upload.php?type=image&amp;TB_iframe=true&post_id=0', false);
            return false;
           });

           window.send_to_editor = (function(html) {
             var imgurl = jQuery('img',html).attr('src');
            jQuery($textid).val(imgurl);
            tb_remove();
           });
         }
         uploadImage('#upload_image_button', '#upload_image');
       });
     </script>
       <tr>
           <th><label for="upload_image">Upload Image</label></th>

           <td>
               <label for="upload_image">
                   <input id="upload_image" type="text" size="36" name="upload_image" value="<?php echo $text; ?>" />
                   <input id="upload_image_button" type="button" value="Upload Image" />
                   <br/>Enter an URL or upload an image
               </label>
           </td>
       </tr>
    </table>
    <?php        
}



add_action( 'save_post', 'cd_meta_box_save_image_course' );
function cd_meta_box_save_image_course( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce_image_course'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_image_course'], 'my_meta_box_nonce_image_course' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['upload_image'] ) )
        update_post_meta( $post_id, 'upload_image', wp_kses( $_POST['upload_image'], $allowed ) );
         
}


//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------





add_action( 'genesis_before_content', 'add_search_box_in_content' );

function add_search_box_in_content(){
   global $post;
   if ($_SERVER['REQUEST_URI'] == '/search/' || strpos($_SERVER['REQUEST_URI'], '/?s') !== false){
        get_search_form();
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
   }
}


add_action( 'genesis_before_loop', 'sk_excerpts_search_page' );
function sk_excerpts_search_page() {
    if ($_SERVER['REQUEST_URI'] == '/search/' || strpos($_SERVER['REQUEST_URI'], '/?s=') !== false){
        function new_excerpt_more($more) {
            global $post;
            return '<a href="'. get_permalink($post->ID) . '">...Read More</a>';
        }
        add_filter('excerpt_more', 'new_excerpt_more');
        add_filter( 'genesis_pre_get_option_content_archive', 'sk_show_excerpts' );
    }
}

function sk_show_excerpts() {
    return 'excerpts';

}

add_action( 'genesis_entry_header', 'single_post_featured_image', 10 );

function single_post_featured_image() {

if ( ! is_singular( 'post' ) )
return;

echo get_avatar( get_the_author_meta( 'ID' ), 60 );

}


add_action( 'pre_get_posts', 'mp_design_cat_posts_per_page');
function mp_design_cat_posts_per_page( $query ) {
    
    if ( is_post_type_archive( 'testimonials' ) ) {
        $query->set( 'posts_per_page', 9);
    }
}


function SearchFilter($query) {
           if ($query->is_search) {
                  $query->set('post_type', 'post');
          }
         return $query;
 }
add_filter('pre_get_posts','SearchFilter');

add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'blog-thumbnail', 370, 240, true);

}

function my_courses_sign_in() {
    if (!is_user_logged_in()){
        echo do_shortcode('[memb_loginform button_label="Log In" username_label="" password_label="" show="always" redirect="/my-courses/"]');
    }
}

add_shortcode('my_courses_sign_up', 'my_courses_sign_in');

remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);
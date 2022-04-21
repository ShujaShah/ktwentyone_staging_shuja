<?php
/**
* Template Name: k21 sales page
* Description: Template used for the about page
*/

// Remove page title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Remove header
remove_action( 'genesis_header', 'genesis_do_header' );
//unregister_sidebar( 'header-right' );
add_action('genesis_header','wdm_inject_header');
function wdm_inject_header(){ ?>
<div class="wdm-oam-head">
            <div id="wdm-oam-logo-1" class="wdm-oam-logos">
            <a href="http://k21academy.com/" target="_blank" class="logo">
            <img src="<?php echo get_stylesheet_directory_uri().'/images/logo3.png' ?>" alt="K21 Sales" class="img-responsive"></a> 
            </div>
            <div id="wdm-oam-logo-2" class="wdm-oam-logos wdm-text-right"> <img class="header-padding img-responsive  pull-right" src="<?php echo get_stylesheet_directory_uri().'/images/oracle.png' ?>" alt="Oracle Partners"> 
            </div>
            <?php $nav_menu_selected_id = esc_attr( get_post_meta( get_the_ID(), 'page_menu', true ) );
                wp_nav_menu( array('menu' => $nav_menu_selected_id, 'menu_class' => 'custom-menu', 'menu_id' => 'menu-main-menu' ,'container_class' => 'header-custom-menu', ) );
            ?>
            <span class="fa fa-bars"></span>
</div>

<?php }

//remove footer
remove_action( 'genesis_footer', 'genesis_do_footer');
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Customize the site footer
add_action( 'genesis_footer', 'wdm_custom_footer' );
function wdm_custom_footer() { ?>
  <div class='wdm-oam-footer'><span class="wdm-login-btn"><a href="#">Existing Member Sign In Here &nbsp; | &nbsp;</a></span><a href="http://k21academy.com/terms-and-conditions/" target="_blank"> Terms and Conditions &nbsp; | &nbsp; </a> <a href="http://k21academy.com/privacy-policy/" target="_blank">Privacy Policy &nbsp; | &nbsp; </a> <a href="http://k21academy.com/contact-us/" target="_blank">Contact </a></div>
<?php

}

genesis();
?>
<script>
jQuery(document).ready(function($){

    $('#wdm-oam-contact > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
      $('#k21-header > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-desc > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-desc > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-fusion > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-icons-1 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-icons-2 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-director-row > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-consultants > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-faq-questions > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-cbd-content > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-owner > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-manager > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('header.site-header > .wrap > div').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-iconpanel-wrapper > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-icon-wrap-1 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-icon-wrap-2 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-desc > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-course-br-wrapper > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-signs > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-signs-1 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-award-3 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-award-2 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-award-1 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('.wdm-oam-look > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
        $('#wdm-oam-take-look > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
      $('#wdm-oam-instant-1 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
      $('#wdm-oam-instant-2 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
      $('#wdm-oam-instant-3 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
       $('.wdm-oam-bn-3 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
       $('.wdm-oam-bn-2 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
       $('.wdm-oam-bn-1 > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
       $('#wdm-oam-money-back-text > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');
       $('#wdm-oam-mb-guarantee-txt > .wpb_column').wrapAll('<div class="k21-container clearfix"></div>');

var len = jQuery('.wdm-oam-icons .k21-container > .wpb_column').length;
for(var i=1; i<=len ; i++){
  var fig =jQuery('.wdm-oam-icon-'+i).find('.vc_figure'); 
  jQuery('.wdm-oam-icon-'+i).find('.wpb_heading ').insertAfter(fig);
}

var length = jQuery('#wdm-oam-signs .k21-container > .wpb_column').length;
for(var j=1; j<=length ; j++){
  var fig1 =jQuery('#wdm-oam-signs .wdm-oam-sign-'+j).find('.vc_figure');
  jQuery('#wdm-oam-signs .wdm-oam-sign-'+j).find('.wpb_heading ').insertAfter(fig1);
}
var l = jQuery('#wdm-oam-signs-1 .k21-container > .wpb_column').length;
for(var k=1; k<=l ; k++){
  var fig2 =jQuery('#wdm-oam-signs-1 .wdm-oam-sign-'+k).find('.vc_figure');
  jQuery('#wdm-oam-signs-1 .wdm-oam-sign-'+k).find('.wpb_heading ').insertAfter(fig2);
}

var length1 = jQuery('#wdm-oam-award-2 .k21-container > .wpb_column').length;
for(var h=1; h<=length1 ; h++){
  var fig3 =jQuery('#wdm-oam-award-2 .wdm-oam-ad-'+h).find('.vc_figure');
  jQuery('#wdm-oam-award-2 .wdm-oam-ad-'+h).find('h3').insertAfter(fig3);
}

var len1 = jQuery('#wdm-oam-award-1 .k21-container > .wpb_column').length;
for(var m=1; m<=len1 ; m++){
  var fig4 =jQuery('#wdm-oam-award-1 .wdm-oam-ad-'+m).find('.vc_figure');
  jQuery('#wdm-oam-award-1 .wdm-oam-ad-'+m).find('h3').insertAfter(fig4);
}

var size = jQuery('#wdm-oam-award-3 .k21-container > .wpb_column').length;
for(var n=1; n<=size ; n++){
  var fig5 =jQuery('#wdm-oam-award-3 .wdm-oam-ad-'+n).find('.vc_figure');
  jQuery('#wdm-oam-award-3 .wdm-oam-ad-'+n).find('h3').insertAfter(fig5);
}

});
 </script>

 <script type="text/javascript">
  jQuery(document).on('click', '.header-custom-menu ul > li > a[href^="#"]', function(e) {
     <?php if(wp_is_mobile()) { ?>
       jQuery('.header-custom-menu .custom-menu').hide();
     <?php } ?>
      // target element id
      var id = jQuery(this).attr('href');
      // target element
      if (jQuery(id).length === 0) {
          return;
      }
      // prevent standard hash navigation (avoid blinking in IE)
      e.preventDefault();

      var height = 0;
      if(jQuery('.ub-emb-iframe-wrapper').length > 0) {
       height = jQuery('.ub-emb-iframe-wrapper').height() + jQuery('.site-header').height();
      } else {
       height = jQuery('.site-header').height();
      }

      // top position relative to the document
      var pos = jQuery(id).offset().top - height;

      // animated top scrolling
      jQuery('body, html').animate({scrollTop: pos}, 1500);
  });
 </script>

<!--Start of Zopim Live Chat Script Old
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?32uIqf1BpNecXz8lPtamsPWEp1cjBXHA";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script> -->
<!--End of Zopim Live Chat Script-->

<!--Automatic popup of zopim live chat only for desktop view delay set to 15 sec
<script>
	if (window.innerWidth > 1000) { 
	window.setTimeout(function() {
    $zopim(function() {
		var audio = new Audio("https://k21academy.com/wp-content/uploads/2021/11/new_chat.mp3");
audio.play();
    $zopim.livechat.window.show();
        }); },15000);
	}
</script>-->
<!--End of the Script-->

<!-- Start of New Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=16144192-961e-4ba8-8abf-051020c8978b"> </script>
<!-- End of  Zendesk Widget script -->
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
            <a href="https://k21academy.com/" target="_blank" class="logo">
            <img src="<?php echo get_stylesheet_directory_uri().'/images/logo3.png' ?>" alt="K21 Sales" class="img-responsive"></a> 
            </div>
            <div id="wdm-oam-logo-2" class="wdm-oam-logos wdm-text-right"> <img class="header-padding img-responsive  pull-right" src="<?php echo get_stylesheet_directory_uri().'/images/oracle.png' ?>" alt="Oracle Partners"> 
            </div>
</div>

<?php }

//remove footer
remove_action( 'genesis_footer', 'genesis_do_footer');
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Customize the site footer
add_action( 'genesis_footer', 'wdm_custom_footer' );
function wdm_custom_footer() { ?>
  <div class='wdm-oam-footer'><span class="wdm-login-btn"><a href="#">Existing Member Sign In Here &nbsp; | &nbsp;</a></span><a href="https://k21academy.com/terms-and-conditions/" target="_blank"> Terms and Conditions &nbsp; | &nbsp; </a> <a href="https://k21academy.com/privacy-policy/" target="_blank">Privacy Policy &nbsp; | &nbsp; </a> <a href="https://k21academy.com/contact-us/" target="_blank">Contact </a></div>
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


});
 </script>


<!-- Start of  Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=16144192-961e-4ba8-8abf-051020c8978b"> </script>
<!-- End of  Zendesk Widget script -->


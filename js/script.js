jQuery(document).ready(function(){
    jQuery('.hp-5.widget-area').append('<a class="all_testi_link_href" href="/testimonials/"><button class="all_testi_link_btn">View All</button></a>');
    jQuery('#menu-main-menu').append('<li class="menu-item search-icon-menu"><a href="/search/" class="search-icon-href"><i class="fa fa-search"></i></a></li>');
   jQuery('.widget-area.header-widget-area').prepend('<li class="search-icon-display"><a href="/search"><i class="fa fa-search"></i></a></li>')
    jQuery('#menu-sign-in').prepend('<li class="wdm-login-btn menu-item menu-item-type-custom menu-item-object-custom menu-item-518"><a href="/search" class="search-icon-href"><i class="fa fa-search"></i></a></li>')
    jQuery('.wdm_my_courses main #loginform').prepend('<p class="login-info">Please Login to see my courses!</p>');
    jQuery(".home iframe").wrap("<div class='iframe-wrapper'/>");
    if (jQuery('.wdm-login-btn').length == 0){
        jQuery('.search-icon-display').removeClass('hidden');
    }
    else{
        jQuery('.search-icon-display').addClass('hidden');
    }


    jQuery('.hp-4 .entry-title').each(function(i, v){
        var img = jQuery(v).parent('.entry-header').siblings('span').find('img');
        jQuery(img).insertAfter(v);
    });



    jQuery(".wdm-login-btn a:not(.search-icon-href)").on('click',function(){
        jQuery("#wdm-login").modal();
        return false;
    });
    jQuery(".wdm-register-btn a").on('click',function(){
        jQuery("#wdm-register").modal();
        return false;
    });
    jQuery('#wdm-login #loginform').submit(function(e) {
        e.preventDefault();
        var loginBtnText = jQuery(this).find('#wp-submit').val();
        jQuery(this).find('#wp-submit').attr('disabled', 'disabled').val('Validating...');
        jQuery('.ajax-response').addClass('hidden').html('').removeClass('error success');
        jQuery.ajax({
            url: wdm_script_obj.ajax_url+'?action=k21_login_handler',
            type: 'POST',
            dataType: 'json', // type of response data
            data: jQuery('#loginform').serialize(),
            success: function (data,status,xhr) {   // success callback function
                jQuery('#wdm-login #loginform').find('#wp-submit').removeAttr('disabled').val(loginBtnText);
                if(data.success) {
                    jQuery('.ajax-response').html(data.data.message).addClass('success').removeClass('hidden');
                    setTimeout(function() {
                        window.location.href = data.data.redirect_url;
                    }, 1000);
                } else {
                    jQuery('.ajax-response').html(data.data.message).addClass('error').removeClass('hidden');
                }
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback
            }
        });
    });
    jQuery(".wdm-register-btn.wdm-register-now a").on('click',function(){
        jQuery("#wdm-login").modal("hide");
        return false;
    });
    if(jQuery('.modal-body .memberium-login-error').length > 0){
    	jQuery("#wdm-login").modal("show");
    }
 //    jQuery('.tml-login input[type="submit"]').on('click',function(){
	//     if(jQuery('.tml-login .input').val()==''){
	//     	return false;
	//     }
	// });
 //    jQuery('.tml-login input[type="submit"]').on('click',function(){
	//     if(jQuery('.tml-register .input').val()==''){
	//     	return false;
	//     }
	// });
	jQuery('.site-header .fa-bars').on('click',function(){
		jQuery('#menu-main-menu').slideToggle();
	});
	// jQuery('.site-inner').on('click',function(){
	// 	jQuery('#menu-main-menu').slideUp();
	// });
    jQuery(document).on('scroll',function(){
        //console.log(jQuery(window).scrollTop());
        if(jQuery(window).scrollTop() > 10) {
            jQuery('body').addClass('wdm-sticky');
        }
        else{
            jQuery('body').removeClass('wdm-sticky');
        }
    });


    jQuery("body").keypress(function(e) {
      if(e.keyCode === 62){
      jQuery('#tabs .ui-tabs-active').next('li.ui-state-default').find('a').trigger( "click" );
     }  if(e.keyCode === 60){
      jQuery('#tabs .ui-tabs-active').prev('li.ui-state-default').find('a').trigger( "click" );
     }
     });
    // });
    jQuery('#user_login').attr('placeholder','Username or E-mail');
    jQuery('#user_pass').attr('placeholder','Password');

    function setEqualHeight(selector) {
        if (selector.length > 0) {
            var arr = [];
            var selector_height;
            selector.css("min-height", "initial");
            selector.each(function (index, elem) {
                selector_height = elem.offsetHeight;
                arr.push(selector_height);
            });
            selector_height = Math.max.apply(null, arr);
            selector.css("min-height", selector_height);
        }
    }

    setEqualHeight(jQuery(".sfwd-courses .entry-title a"));
    setEqualHeight(jQuery(".blog .type-post .entry-title a,.home .type-post .entry-title a"));
    setEqualHeight(jQuery(".blog .type-post .entry-header > a,.home .type-post .entry-header > a"));
    setEqualHeight(jQuery(".blog .type-post > a,.home .type-post > a"));
    var current_topic=jQuery('#course_navigation .learndash_topic_widget_list a.topic-notcompleted');
    jQuery(current_topic).each(function(){
        if(window.location.href === jQuery(this).attr('href')){
            jQuery(this).addClass('wdm-current-topic');
        }
    });

    jQuery('input[type="submit"]').click(function(){
        var pwdMsg = jQuery('.password_change_message').html();
        var emailMsg = jQuery('.email_change_message').html();
        jQuery('.wdm-edit-prof-messages').html(pwdMsg);
    });
   jQuery('body').on('mouseover', '.menu-item-has-children',function(){
        var elm = jQuery(this).children('ul');
        var off = elm.offset().left;
        var elem_width = elm.width();
        var docW = jQuery(".site-header > .wrap").width();
        var elm_right = off + elem_width;
        if (elm_right > docW) {
            jQuery(this).children('ul').addClass('wdm-edge');
        }
    });
   jQuery('.menu-item').each(function(){
        if(jQuery(this).hasClass('menu-item-has-children')){
            jQuery(this).children('a').append('<i class="fa fa-caret-down"></i>');
        }
    });
   jQuery('body').on('click', '.menu-item-has-children .fa-caret-down', function(){
        jQuery(this).parent('a').next('.sub-menu').slideToggle().parent().siblings('li').find('.fa-caret-down').not(this).parent('a').next('.sub-menu').slideUp();
        return false;
   });



//-------------

    var url = window.location.href;
    console.log(wdm_script_obj.site_url_wdm);
    if (url == wdm_script_obj.site_url_wdm+'/search/' || jQuery('.search').length > 0) {
        jQuery('form.search-form').addClass('search-form-half-width');
        jQuery('.search-form input[type="search"]').addClass('search-box-eighty');
    }
    if (url == wdm_script_obj.site_url_wdm+'/search/') {
        jQuery('.archive-pagination ul li a').click(function(e){
            e.preventDefault();
            window.location.replace(wdm_script_obj.site_url_wdm+'/page/'+this.innerHTML+'/?s');
        });
    }

    if (jQuery('.archive-title').text() == 'Search Results for: '){
        jQuery('.archive-title').addClass('hidden');
    }

});

window.onload = function() {

        jQuery('.home div.play').click(function(){
            jQuery('.home .youtube-player').css('padding-bottom','55.4%');
        });


        setEqualHeightForCourses(jQuery(".wdm_my_courses #course_list .courses-list, .post-type-archive-testimonials .wdm-testi-wrap.wdm-testi-pg, .blog .content article, .home .content .wdm-homepage .hp-4.widget-area article"));


};

function setEqualHeightForCourses(selector) {
            if (selector.length > 0) {
                var arr = [];
                var selector_height;
                selector.css("min-height", "initial");
                selector.each(function (index, elem) {
                    selector_height = elem.offsetHeight;
                    arr.push(selector_height);
                });
                selector_height = Math.max.apply(null, arr);
                if (window.location.href ==  wdm_script_obj.site_url_wdm+'/my-courses/'){
                    selector.css("min-height", selector_height + 95);
                }
                else {
                    selector.css("min-height", selector_height);
                }
            }
        }

jQuery(window).on("debouncedresize", function( event ) {
            setEqualHeightForCourses(jQuery(".wdm_my_courses #course_list .courses-list, .post-type-archive-testimonials .wdm-testi-wrap.wdm-testi-pg, .blog .content article, .home .content .wdm-homepage .hp-4.widget-area article"));
});

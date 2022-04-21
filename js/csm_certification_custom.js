jQuery(document).ready(function($){
	if(!$('.csm-certification-navbar ul.menu').has('li.close-menu-item').length){
		var closeMenuItem = '<li class="menu-item menu-item-type-custom menu-item-object-custom close-menu-item"><a href="#">Menu<i class="fa fa-remove"></i></a></li>' ;
		$('.csm-certification-navbar ul.menu').prepend(closeMenuItem);
	}

	var btnSearch = '<button class="search-form-submit search btn" type="submit"> <div class="header-search-icon"><i class="f-icons f-search-icon lazyloaded"></i></div> </button>';
	$('.csm-header-section .search-form-submit').replaceWith(btnSearch);

	$('.humberg-menu-icon').click(function(){
		$('.csm-certification-navbar').toggleClass('show-menu-on-mobile-view');
	});

	$(document).on("click", '.close-menu-item .fa-remove', function(){
		$('.csm-certification-navbar').removeClass('show-menu-on-mobile-view');
	});

	$('.btn-bonus').click(function(){
		$(this).next().toggleClass('hide');
	});

	$(document).on("click", '.all-dates a', function(){
		$(this).closest('div').find('.schedule-dates').removeClass('hide');
		$(this).closest('div').find('.schedule-dates').addClass('fixed');
	});

	$(document).mouseup(function (e) {
		var container = $(".schedule-dates");
        if(!container.is(e.target) &&  container.has(e.target).length === 0) {
            container.addClass('hide');
        	container.removeClass('fixed');
        }
    });

    $( document ).on( 'keydown', function ( e ) {
        if ( e.keyCode === 27 ) { // ESC
        	$(".schedule-dates").addClass('hide');
        	$(".schedule-dates").removeClass('fixed');
        }
    });

    $(document).on('click', '.elementor-toggle-item .elementor-tab-title', function(e){
    	$('.elementor-tab-title').removeClass('elementor-active');
    	$('.elementor-tab-content').removeClass('elementor-active');
    	$('.elementor-tab-content').attr('style', "display:none");
    	$(this).addClass('elementor-active');
    	$(this).closest('.elementor-toggle-item').find('.elementor-tab-content').addClass('elementor-active');
    	$(this).closest('.elementor-toggle-item').find('.elementor-tab-content').attr('style', "display:block");
    });

	var stickyMenuScroll = $('.overview-top-section').offset().top;
	var OverView 		= $('#overview').offset().top;
	var Prerequisites 	= $('#prerequisites').offset().top;
	var knowledgehut 	= $('#knowledgehut').offset().top;
	var curriculum 		= $('#curriculum').offset().top;
	var careerPath 		= $('#career-path').offset().top;
	var corporates 		= $('#corporates').offset().top;
	var schedules 		= $('#schedules').offset().top;
	var discount 		= $('#discount').offset().top;
	var faqs 			= $('#faqs').offset().top;
	var footerSection 	= $('.footer-section').offset().top;
	var new_width = $('.sticky-right-section').width();
	var new_width_curriculum = $('#course-curriculum-right').width();
	var isDone = false;
	var isChatDone = false;
	var webWidgetbtn = '';

	$(window).scroll(function() {
	    var windscroll = $(window).scrollTop();
	    if (windscroll >= (stickyMenuScroll-20)) {
	    	$('.overview-top-section').addClass('fixed');
	    	if(windscroll>=OverView-1000){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#overview]').addClass('active');
	    	}
	    	if(windscroll>=Prerequisites-1000){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#prerequisites]').addClass('active');
	    	}
	    	if(windscroll>=knowledgehut-600){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#knowledgehut]').addClass('active');
	    	}
	    	if(windscroll>=curriculum-1000){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#curriculum]').addClass('active');
	    	}
	    	if(windscroll>=schedules-1000){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#schedules]').addClass('active');
	    	}
	    	if(windscroll>=discount-1000){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#discount]').addClass('active');
	    	}
	    	if(windscroll>=careerPath-1000){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#career-path]').addClass('active');
	    	}
	    	if(windscroll>=corporates-1000){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#corporates]').addClass('active');
	    	}
	    	if(windscroll>=faqs-1400){
	    		$('.overview-sticky-menu a').removeClass('active');
	    		$('.overview-sticky-menu a[href=#faqs]').addClass('active');
	    	}
	    }else{
	    	$('.overview-top-section').removeClass('fixed');
	    	$('.sticky-right-section .elementor-element-populated').removeClass('fixed');
	    }

	    if(windscroll>=parseInt(footerSection-3000)){
	    	$('.overview-top-section').removeClass('fixed');
	    }

	    $('#course-curriculum-right').hide();
	    if (windscroll >= 4760 && windscroll <= 5800) {
	    	$('.sticky-right-section .elementor-element-populated').removeClass('fixed');
	    	$('.sticky-right-section').hide();
	    	$('#course-curriculum-right .elementor-element-populated').addClass('fixed');
	    	$('#course-curriculum-right').show();
	    	$('#course-curriculum-right .elementor-element-populated').width(new_width_curriculum-20);
	    } else {
	    	$('#course-curriculum-right').hide();
	    	$('#course-curriculum-right .elementor-element-populated').removeClass('fixed');
		    if(windscroll<=parseInt(footerSection-3000) && windscroll >= (stickyMenuScroll-20)){
		    	$('.sticky-right-section').show();
		    	$('.sticky-right-section .elementor-element-populated').addClass('fixed');
		    	$('.sticky-right-section .elementor-element-populated.fixed').width(new_width-20); 
		    }else{
		    	$('.sticky-right-section .elementor-element-populated').removeClass('fixed');	    	
		    }
	    }

		if($('iframe#launcher').length>0){
			var btnChatHeight = $('iframe#launcher').height();
			setTopScrollButtonPossition(btnChatHeight+20);
		}

		if($('iframe#webWidget').length>0){
			var webWidgetHeight = $('iframe#webWidget').height();
			setTopScrollButtonPossition(webWidgetHeight);
		}
	});

	if($('iframe#launcher').length>0){
		var documentContent = $('iframe#launcher')[0].contentDocument || $('iframe#launcher')[0].contentWindow.document;
		var btn = $(documentContent).find('button');
		if(btn.length>0){
			$(btn).on("click", function(){
				setTimeout(function() {
					if($('iframe#webWidget').length>0){
						var webWidgetHeight = $('iframe#webWidget').height();
						var documentContent = $('iframe#webWidget')[0].contentDocument || $('iframe#webWidget')[0].contentWindow.document;
						webWidgetbtn = $(documentContent).find('button');
						$(webWidgetbtn).on('click', function(){
							var btnChatHeight = $('iframe#launcher').height();
							var bottomPos = 70;
							if(btnChatHeight>0){
								bottomPos = btnChatHeight+20;
							}
							setTopScrollButtonPossition(bottomPos);
						});
						setTopScrollButtonPossition(webWidgetHeight);
					}else{
						var btnChatHeight = $('iframe#launcher').height();
						var bottomPos = 70;
						if(btnChatHeight>0){
							bottomPos = btnChatHeight+20;
						}
						setTopScrollButtonPossition(bottomPos);
					}
			    }, 100);
			});
		}
	}

	
	if($('iframe#webWidget').length>0){
		var webWidgetHeight = $('iframe#webWidget').height();
		setTopScrollButtonPossition(webWidgetHeight);
		var documentContent = $('iframe#webWidget')[0].contentDocument || $('iframe#webWidget')[0].contentWindow.document;
		webWidgetbtn = $(documentContent).find('button');
		$(webWidgetbtn).on('click', function(){
			setTimeout(function() {
				var btnChatHeight = $('iframe#launcher').height();
				var bottomPos = 70;
				if(btnChatHeight>0){
					bottomPos = btnChatHeight+20;
				}
				setTopScrollButtonPossition(bottomPos);
			}, 100);
		});
	}

	function setTopScrollButtonPossition(posistion){
		$('#wpfront-scroll-top-container').css({ bottom: posistion });
	}
});
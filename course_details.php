<style type="text/css">
.custom-course-navigation .learndash_navigation_lesson_topics_list ul li a span,
.custom-course-navigation .learndash_navigation_lesson_topics_list ul li .topic_item span {
    background: none;
    /*background: url(images/right_arrow-1.png);*/
    background-repeat: no-repeat;
    background-position: left center;
    padding-left: 16px;
    margin: 0;
    color: #333;
    font-size: 15px;
    text-transform: uppercase;
}
@media only screen and (max-width: 800px){
    #wdm-oam-award-3 .wpb_column.vc_column_container, #wdm-oam-award-2 .wpb_column.vc_column_container, #wdm-oam-award-1 .wpb_column.vc_column_container {
        width: 100% !important;
    }
    .security-icons.wdm-oam-awards .vc_figure {
        float: none !important;
    }
    .vc_custom_1573474447152 {
        margin-left:0px !important;
    }
}
</style>
<div class="course_navigation custom-course-navigation">
	<div class="ld-course-navigation-widget-content-contaiiner">
		<div class="learndash_navigation_lesson_topics_list">
			<?php if ( ! empty( $lessons) ) {
				foreach( $lessons as $course_lesson) {
					$current_topic_ids = '';
					//$topics = learndash_topic_dots( $course_lesson->ID, false, 'array' );
					$topics = get_post_meta( $course_lesson->ID, 'module_lessons', true );
					$lesson_quiz_list = array();
				
					$list_arrow_class = '';
					if ( ( ! empty( $topics ) ) )
						$list_arrow_class .= 'collapse flippable';
					
					$lesson_topic_child_item_active = false;
				?>
					<div class='inactive' id='lesson_list-<?php echo esc_attr( $course_lesson->ID ); ?>'>
						<?php if ( ! empty( $topics ) ) { ?>
			            	<div class='list_arrow <?php echo esc_attr( $list_arrow_class ); ?>' onClick='return accordion_expand_me("#lesson_list", <?php echo esc_attr( $course_lesson->ID ); ?>);' ><div><i class="fa fa-plus"></i><i class="fa fa-minus"></i></div></div>
			            <?php } ?>
			            <div class="list_lessons">
							<div class="lesson" >
								<?php if ( ! empty( $topics ) ) { ?>
									<a href='javascript:void(0);' class='<?php echo esc_attr( $list_arrow_class ); ?>' onClick='return accordion_expand_me("#lesson_list", <?php echo esc_attr( $course_lesson->ID ); ?>);' ><?php echo $course_lesson->post_title; ?></a>
								<?php } else { ?>
									<a href='javascript:void(0);'><?php echo $course_lesson->post_title; ?></a>
								<?php } ?>
							</div> 

							<?php if ( ! empty( $topics ) ) { ?>
								<div id='learndash_topic_dots-<?php echo esc_attr( $course_lesson->ID ); ?>' class="flip learndash_topic_widget_list"  style='<?php echo ( strpos( $list_arrow_class, 'collapse' ) !== false ) ? 'display:none' : '' ?>'>
									<ul>								
										<?php $odd_class = '';
											foreach ( $topics as $key => $topic ) {
												$odd_class = empty( $odd_class ) ? 'nth-of-type-odd' : '';
												$completed_class = 'topic-notcompleted';
												$current_topic_class = '';
												?>
												<li class="<?php echo $current_topic_class ?>">
													<?php /*<span class="topic_item"><a class='<?php echo esc_attr( $completed_class ); ?>' href='javascript:void(0);' title='<?php echo $topic; ?>'><span><?php echo $topic; ?></span></a></span>*/ ?>
													<span class="topic_item"><span><?php echo $topic; ?></span></span>
												</li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
function accordion_expand_me(what, id) {
	var hasClass = jQuery(what + '-' + id + ' .list_arrow').hasClass('expand');
	console.log(hasClass);
	if(!hasClass) {
		cb_flip_collapse_all('.learndash_navigation_lesson_topics_list');
	}
	return cb_flip_expand_collapse(what, id);
}
function cb_flip_collapse_all(what) {
    jQuery( what + ' .list_arrow.flippable' ).removeClass( 'expand' );
    jQuery( what + ' .list_arrow.flippable' ).addClass( 'collapse' );
    jQuery( what + ' .flip' ).slideUp();
    return false;
}
function cb_flip_expand_collapse(what, id) {
    if (jQuery( what + '-' + id + ' .list_arrow.flippable' ).hasClass( 'expand' ) ) {
        jQuery( what + '-' + id + ' .list_arrow.flippable' ).removeClass( 'expand' );
        jQuery( what + '-' + id + ' .list_arrow.flippable' ).addClass( 'collapse' );
        jQuery( what + '-' + id + ' .flip' ).slideUp();
    } else {
        jQuery( what + '-' + id + ' .list_arrow.flippable' ).removeClass( 'collapse' );
        jQuery( what + '-' + id + ' .list_arrow.flippable' ).addClass( 'expand' );
        jQuery( what + '-' + id + ' .flip' ).slideDown();
    }
    return false;
}
</script>
<?php
/**
 * Displays a course
 * @since 2.1.0
 *
 * @package LearnDash\Course
 */
?>

<?php if (has_post_thumbnail()) {
    the_post_thumbnail();
} else {
    ?>
		<img src="<?php bloginfo('template_directory');
    ?>/images/default-image.jpg" alt="<?php the_title();
    ?>" />
		<?php

} ?>

<?php
/**
 * Display course status
 */
?>
<?php if ($logged_in) : ?>
	<span id="learndash_course_status">
		<b><?php _e('Course Status:', 'learndash'); ?></b> <?php echo $course_status; ?>
		<br />
	</span>

	<?php  if (! empty($course_certficate_link)) : ?>
		<div id="learndash_course_certificate">
			<a href='<?php echo esc_attr($course_certficate_link); ?>' class="btn-blue" target="_blank"><?php _e('PRINT YOUR CERTIFICATE!', 'learndash'); ?></a>
		</div>
		<br />
	<?php endif; ?>
<?php endif; ?>

<script type="text/javascript">
	jQuery(document).ready(function(){
jQuery("a[href=#tabs-2]").trigger('click');

	});
</script>

<div id="tabs">
  <ul>
    <?php /*<li><a href="#tabs-1">Course Description</a></li>*/ ?>
    <li><a href="#tabs-2">Curriculum</a></li>
    <li><a href="#tabs-3">FAQ</a></li>
  </ul>
  <?php /*
  	<div id="tabs-1">
    	<?php echo $content; ?>
	    <?php if (isset($materials)) : ?>
		<div id="learndash_course_materials">
			<h4><?php _e('Course Materials', 'learndash'); ?></h4>
			<p><?php echo $materials; ?></p>
		</div>
		<?php endif; ?>
  	</div>
  	*/
  ?>
  <div id="tabs-2">

    <?php   //if user is logged in and user is enrolled to this course the display the content of course
         $user_ID = get_current_user_id();
        // $wdm_results=get_post_meta(get_the_ID(), '_sfwd-courses', true);
        // $wdm_all_user_list=array_map('intval', explode(",", $wdm_results['sfwd-courses_course_access_list']));
        if (is_user_logged_in() && sfwd_lms_has_access(get_the_ID(), $user_ID)) {
        ?>

    <?php if ($has_course_content) : ?>
	
	<div id="learndash_course_content">
		<h4 id="learndash_course_content_title"><?php _e('Course Content', 'learndash'); ?></h4>

		<?php
        /**
         * Display lesson list
         */
        ?>
			
		<?php if (! empty($lessons)) : ?>

			<?php if ($has_topics) : ?>
				<div class="expand_collapse">
					<a href="#" onClick='jQuery("#learndash_post_<?php echo $course_id; ?> .learndash_topic_dots").slideDown(); return false;'><?php _e('Expand All', 'learndash'); ?></a> | <a href="#" onClick='jQuery("#learndash_post_<?php echo esc_attr($course_id); ?> .learndash_topic_dots").slideUp(); return false;'><?php _e('Collapse All', 'learndash'); ?></a>
				</div>
			<?php endif; ?>

			<div id="learndash_lessons">

				<div id="lesson_heading">
					<span><?php _e('Lessons', 'learndash'); ?></span>
					<span class="right"><?php _e('Status', 'learndash'); ?></span>
				</div>

				<div id="lessons_list">
					<?php foreach ($lessons as $lesson) : ?>
						<div class='post-<?php echo esc_attr($lesson['post']->ID); ?> <?php echo esc_attr($lesson['sample']); ?>'>

							<div class="list-count">
								<?php echo $lesson['sno']; ?>
							</div>

							<h4>
							    <?php if(!is_user_logged_in ())
                                {
							    ?>
								<a class='wdm_pop_up_login <?php echo esc_attr($lesson['status']); ?>' href='<?php echo esc_attr($lesson['permalink']); ?>'><?php echo $lesson['post']->post_title; ?><i class="fa fa-check wdm-tick"></i></a>

                                <?php
                                } else {
                                	?>
                                <a class='<?php echo esc_attr($lesson['status']); ?>' href='<?php echo esc_attr($lesson['permalink']); ?>'><?php echo $lesson['post']->post_title; ?><i class="fa fa-check wdm-tick"></i></a>

                                	<?php
                                }


                                ?>
								<?php
                                /**
                                 * Not available message for drip feeding lessons
                                 */
                                ?>
								<?php if (! empty($lesson['lesson_access_from'])) : ?>
									<small class="notavailable_message">
										<?php echo sprintf(__('Available on: %s ', 'learndash'), date_i18n('d-M-Y', $lesson['lesson_access_from'])); ?>
									</small>
								<?php endif; ?>

								<?php
                                /**
                                 * Lesson Topics
                                 */
                                ?>
							
								
								<?php $topics = @$lesson_topics[ $lesson['post']->ID ]; ?>
								
								
									<div id='learndash_topic_dots-<?php echo esc_attr($lesson['post']->ID); ?>' class="learndash_topic_dots type-list" style="display:block;">
										<ul>
											<?php // download file top link starts here ?>
											<?php 
											$URLs = array();
											$odd_class = '';
											$URLs = getDownloadURLs($lesson['post']->ID);
											if(isset($URLs['ppt']) && isset($URLs['ppt']['title']) && isset($URLs['ppt']['url']) && !empty($URLs['ppt']['title']) && !empty($URLs['ppt']['url'])) {
												$odd_class = empty($odd_class) ? 'nth-of-type-odd' : '';
											?>
											    <li>
											        <span class="topic_item"><a class='topic-notcompleted' href="<?php echo $URLs['ppt']['url']; ?>" target="_blank" title="<?php echo esc_attr( $URLs['ppt']['title'] ); ?>" download><span><?php echo $URLs['ppt']['title']; ?></span></a></span>
											    </li>
											<?php } ?>
											<?php // download file top link ends here ?>
											<?php if (! empty($topics)) : ?>
												<?php foreach ($topics as $key => $topic) : ?>
													<?php $odd_class = empty($odd_class) ? 'nth-of-type-odd' : ''; ?>
													<?php $completed_class = empty($topic->completed) ? 'topic-notcompleted':'topic-completed'; ?>												
													<li class='<?php echo esc_attr($odd_class); ?>'>
														<span class="topic_item">
	                                                        
	                                                        <?php if(!is_user_logged_in ())
	                                                        {
								                            ?>

															<a class='wdm_pop_up_login <?php echo esc_attr($completed_class); ?>' href='<?php echo esc_attr(get_permalink($topic->ID)); ?>' title='<?php echo esc_attr($topic->post_title); ?>'>
																<span><?php echo $topic->post_title; ?></span>
															</a>

															<?php
	                                                        } else {
	                                	                    ?>

	                                	                    <a class='<?php echo esc_attr($completed_class); ?>' href='<?php echo esc_attr(get_permalink($topic->ID)); ?>' title='<?php echo esc_attr($topic->post_title); ?>'>
																<span><?php echo $topic->post_title; ?></span>
															</a>

															<?php
	                                                        }
	                                                        ?>



														</span>
													</li>
												<?php endforeach; ?>
											<?php endif; ?>
											<?php // download file bottom two links starts here ?>
											<?php
											if(isset($URLs['activityGuide']) && isset($URLs['activityGuide']['title']) && isset($URLs['activityGuide']['url']) && !empty($URLs['activityGuide']['title']) && !empty($URLs['activityGuide']['url'])) {
												$odd_class = empty($odd_class) ? 'nth-of-type-odd' : '';
												?> 
											    <li>
											        <span class="topic_item"><a class='topic-notcompleted' href="<?php echo $URLs['activityGuide']['url']; ?>" target="_blank" title="<?php echo esc_attr( $URLs['activityGuide']['title'] ); ?>" download><span><?php echo $URLs['activityGuide']['title']; ?></span></a></span>
											    </li>
											<?php } ?>
											<?php 
											if(isset($URLs['quiz']) && isset($URLs['quiz']['title']) && isset($URLs['quiz']['url']) && !empty($URLs['quiz']['title']) && !empty($URLs['quiz']['url'])) {
												$odd_class = empty($odd_class) ? 'nth-of-type-odd' : ''; ?>
											    <li>
											        <span class="topic_item"><a class='topic-notcompleted' href="<?php echo $URLs['quiz']['url']; ?>" target="_blank" title="<?php echo esc_attr( $URLs['quiz']['title'] ); ?>"><span><?php echo $URLs['quiz']['title']; ?></span></a></span>
											    </li>
											<?php } ?>
											<?php // download file bottom two links ends here ?>
										</ul>
									</div>								

							</h4>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		<?php endif; ?>


		<?php
        /**
         * Display quiz list
         */
        ?>
		<?php if (! empty($quizzes)) : ?>
			<div id="learndash_quizzes">
				<div id="quiz_heading">
					<span><?php _e('Quizzes', 'learndash'); ?></span><span class="right"><?php _e('Status', 'learndash'); ?></span>
				</div>
				<div id="quiz_list">

					<?php foreach ($quizzes as $quiz) : ?>
						<div id='post-<?php echo esc_attr($quiz['post']->ID); ?>' class='<?php echo esc_attr($quiz['sample']); ?>'>
							<div class="list-count"><?php echo $quiz['sno']; ?></div>
							<h4>
                                <a class='<?php echo esc_attr($quiz['status']); ?>' href='<?php echo esc_attr($quiz['permalink']); ?>'><?php echo $quiz['post']->post_title; ?><i class="fa fa-check wdm-tick"></i></a>
                            </h4>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>


   <?php   //other wise display user message from course meta box
        } else {
            $wdm_tag_html=get_post_meta(get_the_ID(), 'wdm_user_html_tag', true);
            echo $wdm_tag_html;
        }
        ?>


  </div>
  <div id="tabs-3">
  	<?php echo do_shortcode('[wdm_faq]'); ?>
  </div>
</div>



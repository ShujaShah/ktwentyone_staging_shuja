<?php
/**
 * Displays a user's profile.
 *
 * Available Variables:
 *
 * $user_id         : Current User ID
 * $current_user    : (object) Currently logged in user object
 * $user_courses    : Array of course ID's of the current user
 * $quiz_attempts   : Array of quiz attempts of the current user
 *
 * @since 2.1.0
 *
 * @package LearnDash\User
 */
?>
<div id="learndash_profile">
<div class="wdm-box">
    <div class="learndash_profile_heading">
        <span><?php _e('Profile', 'learndash'); ?></span>
    </div>

    <div class="profile_info clear_both">
        <div class="profile_avatar">
            <?php echo get_avatar($current_user->user_email, 120); ?>
           
        </div>

        <div class="learndash_profile_details">
            <?php if ((! empty($current_user->user_lastname)) || (! empty($current_user->user_firstname))) : ?>
                <div><span class="wdm-profile-label"><?php _e('Name', 'learndash'); ?></span> <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></div>
            <?php endif; ?>
            <div><span class="wdm-profile-label"><?php _e('Username', 'learndash'); ?></span> <?php echo $current_user->user_login; ?></div>
            <div><span class="wdm-profile-label"><?php _e('Email', 'learndash'); ?></span> <?php echo $current_user->user_email; ?></div>
        </div>
         <div class="profile_edit_profile" align="center">
                <a href='/edit-profile/'><?php _e('Edit Profile', 'learndash'); ?></a>
        </div>
    </div>
</div>
<div class="wdm-box">
    <div class="learndash_profile_heading no_radius clear_both">
            <span><?php _e('Registered Courses', 'learndash'); ?></span>
            <span class="ld_profile_status" style="display:none;"><?php _e('Status', 'learndash'); ?></span>
    </div>

    <div id="course_list">

        <?php if (! empty($user_courses)) : ?>
<?php 
$page = get_query_var('paged');
if($page == '0'){ $page = 1; }
$limit = 12;
$start = ($page * $limit) - $limit;
$end = $page * $limit;
$user_courses1 = array_slice($user_courses, $start, 12); 
$total_course =  sizeof($user_courses);
$total_pages = ceil($total_course / $limit);

?>

            <?php foreach ($user_courses1 as $course_id) : ?>
                <?php
                    $course = get_post($course_id);

                    $course_link = get_permalink($course_id);

                    $progress = learndash_course_progress(array(
                        'user_id'   => $user_id,
                        'course_id' => $course_id,
                        'array'     => true
                    ));

                    $status = ($progress['percentage'] == 100) ? 'completed' : 'notcompleted';
                ?>
                <div id='course-<?php echo esc_attr($user_id) . '-' . esc_attr($course->ID); ?>' class="courses-list">


                    <?php
                    /**
                     * @todo Remove h4 container.
                     */
                    ?>
                    <h4>
                        <?php if($course->upload_image) { ?>
                            <a class='wdm-no-space' href='<?php echo esc_attr($course_link); ?>'><img src="<?php echo $course->upload_image; ?>"/></a>
                        <?php }
                        else { ?>
                            <a class='wdm-no-space' href='<?php echo esc_attr($course_link); ?>'><img src="http://k21academy.staging.wpengine.com/wp-content/plugins/learndash-course-grid/no_image.png"/></a>
                        <?php } ?>
                        <a class='<?php echo esc_attr($status); ?>' href='<?php echo esc_attr($course_link); ?>'><?php echo $course->post_title; ?><i class="fa fa-check wdm-tick" style="display:none;"></i></a>

                        <div class="flip">

                            <div>
                                <dd class="course_progress" title='<?php echo sprintf(__('%s out of %s steps completed', 'learndash'), $progress['completed'], $progress['total']); ?>'>
                                    <div class="course_progress_blue" style='width: <?php echo esc_attr($progress['percentage']); ?>%;'>
                                </dd>

                                <div class="right">
                                    <?php echo sprintf(__('%s%% Complete', 'learndash'), $progress['percentage']); ?>
                                </div>
                            </div>

                            <?php if (! empty($quiz_attempts[ $course_id ])) : ?>
                                <div class="learndash_profile_quizzes clear_both">

                                    <div class="learndash_profile_quiz_heading">
                                        <div class="quiz_title"><?php _e('Quizzes', 'learndash'); ?></div>
                                        <div class="certificate"><?php _e('Certificate', 'learndash'); ?></div>
                                        <div class="scores"><?php _e('Score', 'learndash'); ?></div>
                                        <div class="quiz_date"><?php _e('Date', 'learndash'); ?></div>
                                    </div>

                                    <?php foreach ($quiz_attempts[ $course_id ] as $k => $quiz_attempt) : ?>
                                        <?php
                                            $certificateLink = @$quiz_attempt['certificate']['certificateLink'];

                                            $status = empty($quiz_attempt['pass']) ? 'failed' : 'passed';

                                            $quiz_title = ! empty($quiz_attempt['post']->post_title) ? $quiz_attempt['post']->post_title : @$quiz_attempt['quiz_title'];

                                            $quiz_link = ! empty($quiz_attempt['post']->ID) ? get_permalink($quiz_attempt['post']->ID) : '#';
                                        ?>
                                        <?php if (! empty($quiz_title)) : ?>
                                            <div class='<?php echo esc_attr($status); ?>'>

                                                <div class="quiz_title">
                                                    <span class='<?php echo esc_attr($status); ?>_icon'></span>
                                                    <a href='<?php echo esc_attr($quiz_link); ?>'><?php echo esc_attr($quiz_title); ?></a>
                                                </div>

                                                <div class="certificate">
                                                    <?php if (! empty($certificateLink)) : ?>
                                                        <a href='<?php echo esc_attr($certificateLink); ?>&time=<?php echo esc_attr($quiz_attempt['time']) ?>' target="_blank">
                                                        <div class="certificate_icon"></div></a>
                                                    <?php else : ?>
                                                        <?php echo '-'; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="scores"><?php echo round($quiz_attempt['percentage'], 2); ?>%</div>

                                                <div class="quiz_date"><?php echo date_i18n('d-M-Y', $quiz_attempt['time']); ?></div>

                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </div>
                            <?php endif; ?>

                        </div>
                    </h4>
                </div>
            <?php endforeach; ?>
			
			<div class="archive-pagination pagination">
				<ul>
				<?php for($i=1;$i<=$total_pages;$i++){ ?>
					<li <?php if($i==$page){?> class="active" <?php } ?>><a href="<?php echo get_home_url(); ?>/my-courses/page/<?php echo $i;?>" aria-label="Current page"><?php echo $i;?></a></li>
				<?php } ?>	
				</ul>
			</div>
			
        <?php endif; ?>

    </div>
    </div>
</div>

<?php function pw_add_image_sizes() {
    add_image_size( 'pw-thumb', 300, 100, true );
    add_image_size( 'pw-large', 600, 300, true );
}
add_action( 'init', 'pw_add_image_sizes' );

?>

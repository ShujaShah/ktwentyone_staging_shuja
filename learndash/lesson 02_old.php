<?php
/**
 * Displays a lesson.
 *
* @since 2.1.0
 *
 * @package LearnDash\Lesson
 */
?>
<span  class="wdm-back-to"><a href="<?php echo get_permalink($course_id); ?>"><i class="fa fa-angle-left"></i> Back to Course</a></span>

<?php if (@$lesson_progression_enabled && ! @$previous_lesson_completed) : ?>
    <span id="learndash_complete_prev_lesson"><?php _e('Please go back and complete the previous lesson.', 'learndash'); ?></span><br />
    <?php add_filter('comments_array', 'learndash_remove_comments', 1, 2); ?>
<?php endif; ?>

<?php if ($show_content) : ?>

    <?php echo $content; ?>


    <?php
    /**
     * Lesson Topics
     */
    ?>
    <?php if (! empty($topics)) : ?>
        <div id="learndash_lesson_topics_list">
            <div id='learndash_topic_dots-<?php echo esc_attr($post->ID); ?>' class="learndash_topic_dots type-list" style="display:block;">
                <strong><?php _e('Lesson Topics', 'learndash'); ?></strong>
                <ul>
                    <?php $odd_class = ''; ?>

                    <?php foreach ($topics as $key => $topic) : ?>

                        <?php $odd_class = empty($odd_class) ? 'nth-of-type-odd' : ''; ?>
                        <?php $completed_class = empty($topic->completed) ? 'topic-notcompleted' : 'topic-completed'; ?>

                        <li class='<?php echo esc_attr($odd_class); ?>'>
                            <span class="topic_item">
                                <a class='<?php echo esc_attr($completed_class); ?>' href='<?php echo esc_attr(get_permalink($topic->ID)); ?>' title='<?php echo esc_attr($topic->post_title); ?>'>
                                    <span><?php echo $topic->post_title; ?></span>
                                </a>
                            </span>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    <?php endif; ?>


    <?php
    /**
     * Show Quiz List
     */
    ?>
    <?php if (! empty($quizzes)) : ?>
        <div id="learndash_quizzes">
            <div id="quiz_heading"><span><?php _e('Quizzes', 'learndash'); ?></span><span class="right"><?php _e('Status', 'learndash'); ?></span></div>
            <div id="quiz_list">

            <?php foreach ($quizzes as $quiz) : ?>
                <div id='post-<?php echo esc_attr($quiz['post']->ID); ?>' class='<?php echo esc_attr($quiz['sample']); ?>'>
                    <div class="list-count"><?php echo esc_attr($quiz['sno']); ?></div>
                    <h4>
                        <a class='<?php echo esc_attr($quiz['status']); ?>' href='<?php echo esc_attr($quiz['permalink']); ?>'><?php echo $quiz['post']->post_title; ?></a>
                    </h4>
                </div>
            <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>


    <?php
    /**
     * Display Lesson Assignments
     */
    ?>
    <?php if (lesson_hasassignments($post)) : ?>
        <?php $assignments = learndash_get_user_assignments($post->ID, $user_id); ?>
        
        <div id="learndash_uploaded_assignments">
            <h2><?php _e('Files you have uploaded', 'learndash'); ?></h2>
            <table>
                <?php if (! empty($assignments)) : ?>
                    <?php foreach ($assignments as $assignment) : ?>
                        <tr>
                            <td><a href='<?php echo esc_attr(get_post_meta($assignment->ID, 'file_link', true)); ?>' target="_blank"><?php echo __('Download', 'learndash') . ' ' . get_post_meta($assignment->ID, 'file_name', true); ?></a></td>
                            <td><a href='<?php echo esc_attr(get_permalink($assignment->ID)); ?>'><?php _e('Comments', 'learndash'); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    <?php endif; ?>


    <?php
    /**
     * Display Mark Complete Button
     */
    ?>
    <?php if ($all_quizzes_completed && $logged_in) : ?>
        <br />
        <?php echo learndash_mark_complete($post); ?>
    <?php endif; ?>
    
<?php endif; ?>

<br />

<?php
$wdm_dwn_driv_link=get_post_meta(get_the_ID(), 'wdm_dwn_dri_link', true);
if(!empty($wdm_dwn_driv_link))
{
	//echo "<p style='text-align: right;'>";
	echo $wdm_dwn_driv_link;
	//echo "</p>";
}
?>

<p id="learndash_next_prev_link"><?php echo learndash_previous_post_link(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo learndash_next_post_link(); ?></p>

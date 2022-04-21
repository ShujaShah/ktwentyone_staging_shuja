<?php
/**
 * Displays the course progress widget.
 * @since 2.1.0
 * @package LearnDash\Course
 */
?>
<div class="wdm-widget-body">
	<dd class="course_progress" title='<?php echo sprintf(__('%s out of %s steps completed', 'learndash'), $completed, $total); ?>'>
		<div class="course_progress_blue" style='width: <?php echo esc_attr($percentage); ?>%;'></div>
	</div>
	<div class="wdm-course-percent"><?php echo esc_attr($percentage); ?>% Complete</div>
</div>
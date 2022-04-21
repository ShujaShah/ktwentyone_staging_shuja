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

    <div class="expand_collapse">
        <a href="#" onClick='return flip_expand_all("#course_list");'><?php _e( 'Expand All', 'learndash' ); ?></a> | <a href="#" onClick='return flip_collapse_all("#course_list");'><?php _e( 'Collapse All', 'learndash' ); ?></a>
    </div>

    <div class="learndash_profile_heading">
        <span><?php _e( 'Profile', 'learndash' ); ?></span>
    </div>

    <div class="profile_info clear_both">
        <div class="profile_avatar">
            <?php echo get_avatar( $current_user->user_email, 96 ); ?>
            <div class="profile_edit_profile" align="center">
                <a href='<?php echo get_edit_user_link(); ?>'><?php _e( 'Edit profile', 'learndash' ); ?></a>
            </div>
        </div>

        <div class="learndash_profile_details">
            <?php if ( ( ! empty( $current_user->user_lastname) ) || ( ! empty( $current_user->user_firstname ) ) ): ?>
                <div><b><?php _e( 'Name', 'learndash' ); ?>:</b> <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></div>
            <?php endif; ?>
            <div><b><?php _e( 'Username', 'learndash' ); ?>:</b> <?php echo $current_user->user_login; ?></div>
            <div><b><?php _e( 'Email', 'learndash' ); ?>:</b> <?php echo $current_user->user_email; ?></div>
        </div>
    </div>

    <div class="learndash_profile_heading no_radius clear_both">
            <span><?php printf( __( 'Registered %s', 'learndash' ), LearnDash_Custom_Label::get_label( 'courses' ) ); ?></span>
            <span class="ld_profile_status"><?php _e( 'Status', 'learndash' ); ?></span>
    </div>

    <div id="course_list">

        <?php if ( ! empty( $user_courses ) ) : ?>

            <?php foreach ( $user_courses as $course_id ) : ?>
                <?php
                    $course = get_post( $course_id);

                    $course_link = get_permalink( $course_id);

                    $progress = learndash_course_progress( array(
                        'user_id'   => $user_id,
                        'course_id' => $course_id,
                        'array'     => true
                    ) );

                    $status = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';
                ?>
                <div id='course-<?php echo esc_attr( $user_id ) . '-' . esc_attr( $course->ID ); ?>'>
                    <div class="list_arrow collapse flippable"  onClick='return flip_expand_collapse("#course-<?php echo esc_attr( $user_id ); ?>", <?php echo esc_attr( $course->ID ); ?>);'></div>


                    <?php
                    /**
                     * @todo Remove h4 container.
                     */
                    ?>
                    <h4>
                        <a class='<?php echo esc_attr( $status ); ?>' href='<?php echo esc_attr( $course_link ); ?>'><?php echo $course->post_title; ?></a>

                        <div class="flip" style="display:none;">

                            <div class="learndash_profile_heading course_overview_heading"><?php printf( __( '%s Progress Overview', 'learndash' ), LearnDash_Custom_Label::get_label( 'course' ) ); ?></div>

                            <div>
                                <dd class="course_progress" title='<?php echo sprintf( __( '%s out of %s steps completed', 'learndash' ), $progress['completed'], $progress['total'] ); ?>'>
                                    <div class="course_progress_blue" style='width: <?php echo esc_attr( $progress['percentage'] ); ?>%;'>
                                </dd>

                                <div class="right">
                                    <?php echo sprintf( __( '%s%% Complete', 'learndash' ), $progress['percentage'] ); ?>
                                </div>
                            </div>

                            <?php if ( ! empty( $quiz_attempts[ $course_id ] ) ) : ?>
                                <div class="learndash_profile_quizzes clear_both">

                                    <div class="learndash_profile_quiz_heading">
                                        <div class="quiz_title"><?php echo LearnDash_Custom_Label::get_label( 'quizzes' ); ?></div>
                                        <div class="certificate"><?php _e( 'Certificate', 'learndash' ); ?></div>
                                        <div class="scores"><?php _e( 'Score', 'learndash' ); ?></div>
                                        <div class="quiz_date"><?php _e( 'Date', 'learndash' ); ?></div>
                                    </div>

                                    <?php foreach ( $quiz_attempts[ $course_id ] as $k => $quiz_attempt ) : ?>
                                        <?php
                                            $certificateLink = @$quiz_attempt['certificate']['certificateLink'];

                                            $status = empty( $quiz_attempt['pass'] ) ? 'failed' : 'passed';

                                            $quiz_title = ! empty( $quiz_attempt['post']->post_title) ? $quiz_attempt['post']->post_title : @$quiz_attempt['quiz_title'];

                                            $quiz_link = ! empty( $quiz_attempt['post']->ID) ? get_permalink( $quiz_attempt['post']->ID ) : '#';
                                        ?>
                                        <?php if ( ! empty( $quiz_title ) ) : ?>
                                            <div class='<?php echo esc_attr( $status ); ?>'>

                                                <div class="quiz_title">
                                                    <span class='<?php echo esc_attr( $status ); ?>_icon'></span>
                                                    <a href='<?php echo esc_attr( $quiz_link ); ?>'><?php echo esc_attr( $quiz_title ); ?></a>
                                                </div>

                                                <div class="certificate">
                                                    <?php if ( ! empty( $certificateLink ) ) : ?>
                                                        <a href='<?php echo esc_attr( $certificateLink ); ?>&time=<?php echo esc_attr( $quiz_attempt['time'] ) ?>' target="_blank">
                                                        <div class="certificate_icon"></div></a>
                                                    <?php else : ?>
                                                        <?php echo '-'; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="scores"><?php echo round( $quiz_attempt['percentage'], 2 ); ?>%</div>

                                                <div class="quiz_date"><?php echo date_i18n( 'd-M-Y h:i:s', $quiz_attempt['time']+(get_option('gmt_offset') * 3600) ); ?></div>

                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </div>
                            <?php endif; ?>

                        </div>
                    </h4>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

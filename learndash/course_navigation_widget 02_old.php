<?php
/**
 * Displays the course navigation widget
 */
?>
<?php 
    // download links code starts here
    global $post;
    $URls = array();
    $URls = getDownloadURLs($post->ID);
    function getDownloadURLs($post_id) {
        $returnArray = array();
        $attachmentMeta = unserialize(get_post_meta( $post_id, 'lesson_attachments', true ));
        if($attachmentMeta) {
            //PPT
            $returnArray['ppt']['url'] = $attachmentMeta['ppt']['url'];
            $returnArray['ppt']['title'] = $attachmentMeta['ppt']['title'];

            //Activity guide
            $returnArray['activityGuide']['url'] = $attachmentMeta['activityGuide']['url'];
            $returnArray['activityGuide']['title'] = $attachmentMeta['activityGuide']['title'];

            //Quiz
            $returnArray['quiz']['url'] = $attachmentMeta['quiz']['url'];
            $returnArray['quiz']['title'] = $attachmentMeta['quiz']['title'];
        }
        return $returnArray;
    }
    // download links code ends here
?>
<div class="wdm-widget-body">
<div id="course_navigation">    
    <?php
    /**
     * @todo fix typo in navigation - consider reverse compatibility
     */
    ?>
    <div class="learndash_nevigation_lesson_topics_list">

    <?php global $post; ?>

        <?php if ($post->post_type == 'sfwd-topic' || $post->post_type == 'sfwd-quiz') : ?>
            <?php $lesson_id = learndash_get_setting($post, 'lesson'); ?>
        <?php else : ?>
            <?php $lesson_id = $post->ID; ?>
        <?php endif; ?>

        <?php if (! empty($lessons)) : ?>
            <?php foreach ($lessons as $course_lesson) : ?>

                <?php
                    $current_topic_ids = '';
                    $topics =  learndash_topic_dots($course_lesson['post']->ID, false, 'array');
                    $is_current_lesson = ($lesson_id == $course_lesson['post']->ID);
                    $lesson_list_class = ($is_current_lesson) ? 'active' : 'inactive';
                    $lesson_lesson_completed = ($course_lesson['status'] == 'completed') ? 'lesson_completed' : 'lesson_incomplete';
                    //$list_arrow_class = ($is_current_lesson && ! empty($topics)) ? 'expand' : 'collapse';
                    $list_arrow_class = ($is_current_lesson) ? 'expand' : 'collapse';
                ?>

                <?php if (! empty($topics)) : ?>
                    <?php $list_arrow_class .= ' flippable'; ?>
                <?php endif; ?>

                <div class='<?php echo esc_attr($lesson_list_class); ?>' id='lesson_list-<?php echo esc_attr($course_lesson['post']->ID); ?>'>

                    <div class='list_arrow <?php echo esc_attr($list_arrow_class); ?> <?php echo esc_attr($lesson_lesson_completed); ?>' onClick='return flip_expand_collapse("#lesson_list", <?php echo esc_attr($course_lesson['post']->ID); ?>);' ></div>

                    <div class="list_lessons">
                        <div class="lesson" >
                            <a href='<?php echo esc_attr(get_permalink($course_lesson['post']->ID)); ?>'><?php echo $course_lesson['post']->post_title; ?></a>
                        </div> 

                        
                            <div id='learndash_topic_dots-<?php echo esc_attr($course_lesson['post']->ID); ?>' class="flip learndash_topic_widget_list"  style='<?php echo (strpos($list_arrow_class, 'collapse') !== false) ? 'display:none' : '' ?>'>
                                <ul>
                                    <?php $odd_class = ''; ?>
                                    <?php // download file top link starts here ?>
                                    <?php if(!$URLs && $is_current_lesson) {
                                        $URLs = getDownloadURLs($course_lesson['post']->ID);
                                    }
                                    if(isset($URLs['ppt']) && isset($URLs['ppt']['title']) && isset($URLs['ppt']['url']) && !empty($URLs['ppt']['title']) && !empty($URLs['ppt']['url'])) { ?>
                                        <li>
                                            <span class="topic_item"><a class='topic-notcompleted' href='<?php echo $URLs['ppt']['url']; ?>' target="_blank" title='<?php echo esc_attr( $URLs['ppt']['title'] ); ?>' download><span><?php echo $URLs['ppt']['title']; ?></span></a></span>
                                        </li>
                                    <?php } ?>
                                    <?php // download file top link ends here ?>
                                    <?php if (! empty($topics)) : ?>
                                    <?php foreach ($topics as $key => $topic) : ?>
                                        <?php $odd_class = empty($odd_class) ? 'nth-of-type-odd' : ''; ?>
                                        <?php $completed_class = empty($topic->completed) ? 'topic-notcompleted' : 'topic-completed'; ?>

                                        <li>
                                            <span class="topic_item">
                                                <a class='<?php echo esc_attr($completed_class); ?>' href='<?php echo esc_attr(get_permalink($topic->ID)); ?>' title='<?php echo esc_attr($topic->post_title); ?>'>
                                                    <span><?php echo $topic->post_title; ?></span>
                                                </a>
                                            </span>
                                        </li>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php // download file bottom two links starts here ?>
                                    <?php
                                    if(isset($URLs['activityGuide']) && isset($URLs['activityGuide']['title']) && isset($URLs['activityGuide']['url']) && !empty($URLs['activityGuide']['title']) && !empty($URLs['activityGuide']['url'])) { ?> 
                                        <li>
                                            <span class="topic_item"><a class='topic-notcompleted' href='<?php echo $URLs['activityGuide']['url']; ?>' target="_blank" title='<?php echo esc_attr( $URLs['activityGuide']['title'] ); ?>' download><span><?php echo $URLs['activityGuide']['title']; ?></span></a></span>
                                        </li>
                                    <?php } ?>
                                    <?php if(isset($URLs['quiz']) && isset($URLs['quiz']['title']) && isset($URLs['quiz']['url']) && !empty($URLs['quiz']['title']) && !empty($URLs['quiz']['url'])) { ?>
                                        <li>
                                            <span class="topic_item"><a class='topic-notcompleted' href='<?php echo $URLs['quiz']['url']; ?>' target="_blank" title='<?php echo esc_attr( $URLs['quiz']['title'] ); ?>' download><span><?php echo $URLs['quiz']['title']; ?></span></a></span>
                                        </li>
                                    <?php } ?>
                                    <?php // download file bottom two links ends here ?>
                                </ul>
                            </div>                        

                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div> <!-- Closing <div class='learndash_nevigation_lesson_topics_list'> -->

</div> <!-- Closing <div id='course_navigation'> -->
    </div>
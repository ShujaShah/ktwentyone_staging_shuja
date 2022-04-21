<?php
/**
 * Video thumb
 *
 * This template can be overridden by copying it to yourtheme/wp-carousel-pro/templates/loop/video-type/image.php
 *
 * @package WP_Carousel_Pro
 * @subpackage WP_Carousel_Pro/public/templates
 */

?>
<div class="wpcp-slide-image">
<?php
if ( filter_var( $image_src, FILTER_VALIDATE_URL ) && 'image_only' !== $sp_url['video_type'] ) {
	$img_alter_text = strip_tags( $sp_url['video_desc'] );
	?>
<a class="wcp-video" data-fancybox="wpcp_view" data-buttons='["zoom","slideShow","fullScreen","share","download","thumbs","close"]' href="<?php echo $sp_url['video_url']; ?>">
	<img src="<?php echo $image_src; ?>" alt="<?php echo $img_alter_text; ?>"  width="<?php echo $image_width_attr; ?>" height="<?php echo $image_height_attr; ?>"><i class="fa fa-play-circle-o" aria-hidden="true"></i>
</a>
	<?php
} elseif ( 'image_only' === $sp_url['video_type'] && 'img_link' === $sp_url['img_click_action'] && ! empty( $image_linking_url ) ) {
	?>
		<a href="<?php echo esc_url( $image_linking_url ); ?>" target="_blank">
			<img src="<?php echo esc_url( $image_src ); ?>" <?php echo $image_alt_title; ?> width="<?php echo $image_width_attr; ?>" height="<?php echo $image_height_attr; ?>">
			<i class="fa fa-link" aria-hidden="true"></i>
		</a>
	<?php
} elseif ( 'image_only' === $sp_url['video_type'] && 'img_link' === $sp_url['img_click_action'] && empty( $image_linking_url ) ) {
	?>
	<img src="<?php echo $image_src; ?>" <?php echo $image_alt_title; ?> width="<?php echo $image_width_attr; ?>" height="<?php echo $image_height_attr; ?>">
	<?php
} elseif ( 'image_only' === $sp_url['video_type'] && 'img_lbox' === $sp_url['img_click_action'] ) {
	?>
		<a class="wcp-light-box" href="<?php echo $wpcp_img_full; ?>" data-fancybox="wpcp_view" data-buttons='["zoom","slideShow","fullScreen","share","download","thumbs","close"]' data-lightbox-gallery="group-<?php echo $post_id; ?>">
			<img src="<?php echo $image_src; ?>" <?php echo $image_alt_title; ?> width="<?php echo $image_width_attr; ?>" height="<?php echo $image_height_attr; ?>">
			<i class="fa fa-search-plus" aria-hidden="true"></i>
		</a>
	<?php
}
?>
</div>

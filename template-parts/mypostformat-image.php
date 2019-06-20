<?php
/*
@packge sunset-theme
	This Template For Image Post Format
*/
$showClass = get_query_var( 'post-show');
?>
<article <?php post_class(array('image-format',$showClass));?> id="post-<?php the_ID(); ?>">
	<div class="post-content">
		<div class="post-image background-image overlay" style="background-image: url(<?php echo sunset_get_attachment(); ?>);">
			<div class="post-header text-center">
				<?php the_title('<h2 class="post-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h2>');?>
				<div class="post-meta">
					<?php echo sunset_posted_meta(); ?>
				</div>
			</div>
			<div class="post-text photo-caption">
				<?php the_excerpt(); ?>
			</div>
			<div class="share-icon"><span class="sunset-icon sunset-share"></span></div>
		</div>
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>

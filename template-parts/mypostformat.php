<?php
/*
@packge sunset-theme
	This Template For Standard Post Format
*/	
?>
<article <?php post_class();?> id="post-<?php the_ID(); ?>">
	<div class="post-header text-center">
		<?php the_title('<h2 class="post-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h2>')?>
		<div class="post-meta">
			<?php echo sunset_posted_meta(); ?>
		</div>
	</div>
	<div class="post-content">
		<?php 
			if (has_post_thumbnail()){ 
				$postImage = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
			echo "<a href='".get_permalink()."' rel='bookmark'>"	
		?>
			<div class="post-image background-image overlay" style="background-image: url(<?php echo $postImage; ?>);">
			</div>
		<?php 
			echo "</a>";
			} 
		?>
		<div class="post-text">
			<?php the_excerpt(); ?>
		</div>
		<div class="button-container text-center">
			<a href="<?php the_permalink();?>" class="btn btn-gray btn-primary"><?php _e('Read More');?></a>
		</div>
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>
<?php
/*
@packge sunset-theme
	This Template For Video Post Format
*/	
?>
<article <?php post_class('video-format');?> id="post-<?php the_ID(); ?>">
	<div class="post-content">
		<div class="video-container">
			<div class="video-file embed-responsive embed-responsive-21by9">
				<?php 
					echo sunset_get_embeded_media(array('video','iframe')); 
				?>
			</div>
			<div class="share-icon"><span class="sunset-icon sunset-share"></span></div>
		</div>
		<div class="post-body">
			<div class="post-header text-center">
				<?php the_title('<h2 class="post-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h2>');?>
				<div class="post-meta">
					<?php echo sunset_posted_meta(); ?>
				</div>
			</div>
			<div class="post-text"> 
				<?php the_excerpt(); ?>
			</div>
			<div class="button-container text-center">
				<a href="<?php the_permalink();?>" class="btn btn-gray btn-primary"><?php _e('Read More');?></a>
			</div>
		</div>
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>
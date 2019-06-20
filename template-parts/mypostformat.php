<?php
/*
@packge sunset-theme
	This Template For Standard Post Format
*/
$showClass = get_query_var( 'post-show');
?>
<article <?php post_class($showClass);?> id="post-<?php the_ID(); ?>">
	<div class="post-header text-center">
		<?php the_title('<h2 class="post-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h2>')?>
		<div class="post-meta">
			<?php echo sunset_posted_meta(); ?>
		</div>
	</div>
	<div class="post-content">
		<?php if (sunset_get_attachment()):?>
			<a class="standard-featured-link" href="<?php the_permalink(); ?>">
				<div class="post-image background-image overlay" style="background-image: url(<?php echo sunset_get_attachment(); ?>);"></div>
			</a>
		<?php endif; ?>
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

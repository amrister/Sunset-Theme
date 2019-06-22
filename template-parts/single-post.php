<?php
/*
	@package Sunset-theme
  This Template is For Single Standard Post Display
*/
?>
<article <?php post_class(array('reveal','no-padding','single'));?> id="post-<?php the_ID(); ?>">
	<div class="post-header text-center">
		<?php the_title('<h2 class="post-title">','</h2>')?>
		<div class="post-meta">
			<?php echo sunset_posted_meta(); ?>
		</div>
	</div>
	<div class="post-content">
		<div class="post-text clearfix">
			<?php the_content(); ?>
		</div>
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>

<?php
/*
@packge sunset-theme
	This Template For Aside Post Format
*/	
?>
<article <?php post_class('aside-format');?> id="post-<?php the_ID(); ?>">
	<div class="post-content">
		<div class="media">
			<div class="image">
				<img src="<?php echo sunset_get_attachment(); ?>" alt="person image">
			</div>
			<div class="media-body">
				<div class="post-meta">
					<?php echo sunset_posted_meta(); ?>
				</div>
				<div class="post-text">
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="share-icon"><span class="sunset-icon sunset-share"></span></div>
		</div>
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>
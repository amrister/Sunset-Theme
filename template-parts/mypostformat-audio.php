<?php
/*
@packge sunset-theme
	This Template For Audio Post Format
*/
$showClass = get_query_var( 'post-show');
?>
<article <?php post_class(array('audio-format',$showClass));?> id="post-<?php the_ID(); ?>">
	<div class="post-content">
		<div class="post-body">
			<div class="post-header">
				<?php the_title('<h2 class="post-title no-wrapers"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h2>');?>
				<div class="post-meta">
					<?php echo sunset_posted_meta(); ?>
				</div>
			</div>
			<div class="audio-file">
				<?php
					echo sunset_get_embeded_media(array('audio','iframe'));
				?>
			</div>
			<div class="share-icon"><span class="sunset-icon sunset-share"></span></div>
		</div>
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>

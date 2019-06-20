<?php
/*
@packge sunset-theme
	This Template For Quote Post Format
*/
$showClass = get_query_var( 'post-show');
?>
<article <?php post_class(array('quote-format',$showClass));?> id="post-<?php the_ID(); ?>">

	<div class="post-content">
		<div class="quote-container">
			<div class="row">
				<div class="col-10 offset-1">
					<a href="<?php get_permalink(); ?>" rel="bookmark">
						<div class="post-text text-center">
							<h2><?php echo get_the_content(); ?></h2>
						</div>
					</a>
					<div class="post-header text-center">
						<?php the_title('<h6 class="post-title">','</h6>')?>
					</div>
				</div>
			</div>
		</div>
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>

<?php
/*
@packge sunset-theme
	This Template For Gallery Post Format
*/
$showClass = get_query_var( 'post-show');
?>
<article <?php post_class(array('gallery-format',$showClass));?> id="post-<?php the_ID(); ?>">
	<div class="post-content">
		<?php if (sunset_get_attachment()):?>
			<div id="<?php the_ID(); ?>" class="carousel gallery slide" data-ride="carousel">
			<div class="carousel-inner">
					<?php
							$postImages = sunset_get_bs_slides(sunset_get_attachment(100));
							foreach ( $postImages as $element ) :
					?>
							<div class="carousel-item<?php echo $element['class']; ?> image">
								<img src="<?php  echo $element['url']; ?>" alt="image Gallery">
								<div class="d-none next-preview" data-image="<?php echo $element['next'];; ?>"></div>
								<div class="d-none prev-preview" data-image="<?php echo $element['prev'];; ?>"></div>
								<div class="photo-caption">
									<p><?php  echo $element['caption'];; ?></p>
								</div>
							</div>
					<?php endforeach;?>
			</div>
			<a class="carousel-control-prev" href="#<?php the_ID(); ?>" role="button" data-slide="prev">
				<div class="preview-container left">
					<span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span>
					<span class="preview-image background-image" style="background-image: url();"></span>
				</div>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#<?php the_ID(); ?>" role="button" data-slide="next">
				<div class="preview-container right">
					<span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span>
					<span class="preview-image background-image" style="background-image: url();"></span>
				</div>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<?php endif;?>


		<div class="post-header text-center">
			<?php the_title('<h2 class="post-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a></h2>')?>
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
		<div class="post-footer">
			<?php echo sunset_posted_footer(); ?>
		</div>
	</div>
</article>

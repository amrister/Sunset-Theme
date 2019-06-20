<?php
/*
@packge sunset-theme
	This Template For Link Post Format
*/
$showClass = get_query_var( 'post-show');
?>
<article <?php post_class(array('link-format',$showClass));?> id="post-<?php the_ID(); ?>">
	<div class="post-header text-center">
		<?php
			$link = sunset_grab_link();
			the_title('<h2 class="post-title no-wrapers">','</a></h2>');
			echo '<a href="'.$link.'" target="_blank">'.'<div class="share-icon-container"><span class="sunset-icon sunset-link"></span></div>'.'</a>';
		?>
	</div>
</article>

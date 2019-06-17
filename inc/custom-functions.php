<?php
/*
@package Sunset-theme
    ===============================
      Post Data Retrievers
    ===============================
*/
	function sunset_posted_meta(){
		$postedOn = human_time_diff ( get_the_time('U'), current_time('timestamp') );
		$cats = get_the_category();
		$postedIn='';
		$sep = ', ';
		$i=0;
		if(!empty($cats)){
			foreach($cats as $cat){
				$i++;
				if($i>1){ $postedIn.=$sep; } 
				$postedIn .= '<a href="'.esc_url( get_category_link( $cat->term_id ) ).'" alt="'.esc_attr('View All Posts in%s', $cat->name ).'" >'.esc_html($cat->name).'</a>';

			}
		}
		$output = '<h6><span class="posted-on">Posted <a href="'.esc_url( get_permalink() ).'">'.$postedOn.'</a> ago / </span><span class="posted-in">'.$postedIn.'</span></h6>';
		return $output;
	}
	function sunset_posted_footer(){
		$comments_num = get_comments_number();
		$comments = '';
		if(comments_open()){
			if($comments_num==0){
				$comments = __('No Comments');
			}elseif($comments_num > 1 ){
				$comments = $comments_num . __(' Comments');
			}elseif($comments_num ==1 ){
				$comments = __('1 Comment');
			}
			$comments = '<a href="'.get_comments_link().'">'.$comments.' <span class="sunset-icon sunset-comment"></span></a>';
		}else{
			$comments = __('Comments closed');
		}	

		return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'. get_the_tag_list('<div class="tags-list"><span class="sunset-icon sunset-tag"></span>', ' ', '</div>') .'</div><div class="col-xs-12 col-sm-6 text-right">'. $comments .'</div></div></div>';
	}
/*
  	===============================
      Get Attachments of Post
    ===============================
*/
    function sunset_get_attachment(){
    	$output='';
    	if(has_post_thumbnail()){
    		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    	}else{
    		$attachments = get_posts(array(
    				'post_type' => 'attachment',
    				'posts_per_page' => 1,
    				'post_parent' => get_the_ID(),
    			)
    		);
    		if($attachments){
    			foreach ($attachments as $element) {
    				$output = wp_get_attachment_url( $element->ID);
    			}
    		}
    		wp_reset_postdata();
    	}	
    	return $output;
    }

/*
  	=======================================
      Get Audio IFrame with visual false
    =======================================
*/
    function sunset_get_embeded_media( $types = array()){
		$content = do_shortcode( apply_filters('the_content', get_the_content()));
		$embed = get_media_embedded_in_content( $content, $array);
		return str_replace('?visual=true', '?visual=false', $embed[0]);
    }
/*
  	=======================================
     	Grab Link Inside Post Content
    =======================================
*/

    function sunset_grab_link(){
    	if( !preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i' , get_the_content() ,$output) ){ // to get href value inside the link
    		return false;
    	}
    	return esc_url_raw($output[1]);
    }

?>
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
    function sunset_get_attachment($num = 1){
			$output='';
    	if(has_post_thumbnail() && $num == 1){
    		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    	}else{
    		$attachments = get_posts(array(
    				'post_type' => 'attachment',
    				'posts_per_page' => $num,
    				'post_parent' => get_the_ID(),
    			)
    		);
    		if($attachments && $num == 1){
					$output = wp_get_attachment_url( $attachments[0]->ID);
    		}elseif($attachments && $num > 1){
					$output = $attachments;
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

/*
  	=======================================
     	Clean Gallery Format Code
    =======================================
*/
		function sunset_get_bs_slides($postImages){
			$output = array();
			$count = count($postImages);
			for ($i=0; $i < $count ; $i++){
				$active  = (!$i) ? ' active' : '';
				$imageUrl = wp_get_attachment_url( $postImages[$i]->ID );
				$n = ( $i == $count-1 ) ? 0 : $i+1;
				$nextImage = wp_get_attachment_url( $postImages[$n]->ID );
				$p = ( $i == 0 ) ? $count-1 : $i-1;
				$prevImage = wp_get_attachment_url( $postImages[$p]->ID );
				$caption = $postImages[$i]->post_excerpt;
				$output[$i] = array(
					'class' 	=> $active,
					'url' 		=> $imageUrl,
					'next' 		=> $nextImage,
					'prev' 		=> $prevImage,
					'caption' => $caption,
				);
			}
			return $output;
		}

/*
  	=======================================
     	Get Current Page Url
    =======================================
*/
	function susnet_grab_page_url(){
		$http = ( isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://' );
		$prefix = $http . $_SERVER["HTTP_HOST"];
		$finalUrl = $prefix . $_SERVER["REQUEST_URI"];
		return $finalUrl;
	}

/*
  	=======================================
     	Get Element index
    =======================================
*/
	function sunset_get_archType_index($arr){
		$types = array('category','tag','author');
		$arrSize = count($arr);
		for ($i=3; $i < $arrSize ; $i++) {
			if(in_array($arr[$i],$types)){
				return $i;
			}
		}
		return -1;
	}

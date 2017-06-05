<?php
function mt_pl_views_shares() {

	if ( false == get_theme_mod( 't_pl_shares', false ) ) { $t_shares = esc_html__("shares", "magazine-plug");  } else { $t_shares = get_theme_mod( 't_pl_shares' ); }
	if ( false == get_theme_mod( 't_pl_views', false ) ) { $t_views = esc_html__("views", "magazine-plug");  } else { $t_views = get_theme_mod( 't_pl_views' ); }

	// Share count meta real and fake.
	$share_real = "0";
	$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
	$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
	$shares = $share_real;
	if (!empty($share)){ $shares = $share+$share_real; $shares = number_format($shares);}


	// View count meta real and fake.
	$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
	$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
	$viewes = $views + "0";
	if (!empty($view)){ $viewes = $view + $views; $viewes = number_format($viewes); }

	// Post data, share counts.
	$data ='';
	if($shares!="0" and $shares!="" or $viewes!="0" and $viewes!=""){
		$data .='<div class="poster-data color-silver-light">';
		if($shares!="0" and $shares!=""){ $data .='<span class="poster-shares">'. $shares .' <span class="mt-data-text">'. esc_html($t_shares) .'</span></span>';}
		if($viewes!="0" and $viewes!=""){ $data .='<span class="poster-views">'. $viewes .' <span class="mt-data-text">'. esc_html($t_views) .'</span></span>';}
		if (get_comments_number()!="0") { $data .='<span class="poster-comments">'.get_comments_number().'</span>'; }
		$data .='</div>';
	}

	return $data;
}
function mt_pl_views_shares_grid() {

	if ( false == get_theme_mod( 't_pl_shares', false ) ) { $t_shares = esc_html__("shares", "magazine-plug");  } else { $t_shares = get_theme_mod( 't_pl_shares' ); }
	if ( false == get_theme_mod( 't_pl_views', false ) ) { $t_views = esc_html__("views", "magazine-plug");  } else { $t_views = get_theme_mod( 't_pl_views' ); }

	// Share count meta real and fake.
	$share_real = "0";
	$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
	$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
	$shares = $share_real;
	if (!empty($share)){ $shares = $share+$share_real; $shares = number_format($shares);}


	// View count meta real and fake.
	$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
	$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
	$viewes = $views + "0";
	if (!empty($view)){ $viewes = $view + $views; $viewes = number_format($viewes); }
	$shortcode = "";
	$shortcode .='<div class="post-info">';
		if($shares!="0" or $shares!=""){ $shortcode .='<span class="poster-shares">'. $shares .' <span class="mt-data-text">'. esc_html($t_shares) .'</span></span>';}
		if($viewes!="0" or $viewes!=""){ $shortcode .='<span class="poster-views">'. $viewes .' <span class="mt-data-text">'. esc_html($t_views) .'</span></span>';}
		if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
	$shortcode .='</div>';

	return $shortcode;
}
function mt_pl_categories() {
	// Category Code.
	$category_name = get_the_category(get_the_ID());
	$categorys = '';
	$categorys .='<div class="poster-cat"><span class="mt-theme-text">';
	$cat_nr = get_theme_mod( 'mt_post_meta_cat', 1 );
	if(!empty($category_name[0]) and $cat_nr == 1 or $cat_nr == 2 or $cat_nr == 3) { $categorys .=''.$category_name[0]->name.''; }
	if(!empty($category_name[1]) and $cat_nr == 2 or $cat_nr == 3) { $categorys .=', '.$category_name[1]->name.''; }
	if(!empty($category_name[2]) and $cat_nr == 3) { $categorys .=', '.$category_name[2]->name.''; }
	$categorys .='</span></div>';

	return $categorys;
}
function mt_pl_excerpt_tabs() {
	$option = get_option("magazin_option");
	$excerpt_ = magazin_custom_excerpts(27);
	if (!empty($option['post_meta_excerpt'])) {
		if($option['post_meta_excerpt']==2){
			$excerpt_ = get_the_excerpt();
		}
		else if($option['post_meta_excerpt']==3){
			$excerpt = get_post_meta(get_the_ID(), "magazin_excerpt", true);
			if (!empty($excerpt)) { $excerpt_ = $excerpt; }
		}
		else if($option['post_meta_excerpt']==4){
			$excerpt = get_post_meta(get_the_ID(), "magazin_subtitle", true);
			if (!empty($excerpt)) { $excerpt_ = $excerpt; }
		}

	} else {
		$excerpt = get_post_meta(get_the_ID(), "magazin_excerpt", true);
		if (!empty($excerpt)) { $excerpt_ = $excerpt; }
	}

	return $excerpt_;
}
function posts_tabs( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'posttype' => 'post',
			'item_nr' => '',
			'order' => '',
			'orderby' => '',
			'include' => '',
			'exclude' => '',
			'category' => '',
			'tag' => '',
			'class' => '',
			'type' => 'normal-right',
			'offset'=> '',
			'title_type'=> 'off',
			'title'=> 'Latest News',
			'tab_popular' => 'off',
			'tab_hot' => 'off',
			'tab_trending' => 'off',
			'tab_posts' => 'on',
			'tab_videos' => 'on',
			'tab_galleries' => 'on',
			'author' => '',
			'review_star' => 'on',
			), $atts));

			global $post;

			if ( false == get_theme_mod( 't_pl_view_post', false ) ) { $t_view_post = esc_html__("View Post", "magazine-plug");  } else { $t_view_post = get_theme_mod( 't_pl_view_post' ); }
			if ( false == get_theme_mod( 't_pl_load_more_posts', false ) ) { $t_load_more_posts = esc_html__("Load More Posts", "magazine-plug");  } else { $t_load_more_posts = get_theme_mod( 't_pl_load_more_posts' ); }
			if ( false == get_theme_mod( 't_pl_congratulations', false ) ) { $t_congratulations = esc_html__("Congratulations, you've reached all posts.", "magazine-plug");  } else { $t_congratulations = get_theme_mod( 't_pl_congratulations' ); }
			if ( false == get_theme_mod( 't_pl_galleries', false ) ) { $t_galleries = esc_html__("Galleries", "magazine-plug");  } else { $t_galleries = get_theme_mod( 't_pl_galleries' ); }
			if ( false == get_theme_mod( 't_pl_videos', false ) ) { $t_videos = esc_html__("Videos", "magazine-plug");  } else { $t_videos = get_theme_mod( 't_pl_videos' ); }
			if ( false == get_theme_mod( 't_pl_posts', false ) ) { $t_posts = esc_html__("Posts", "magazine-plug");  } else { $t_posts = get_theme_mod( 't_pl_posts' ); }
			if ( false == get_theme_mod( 't_pl_popular', false ) ) { $t_popular = esc_html__("Popular", "magazine-plug");  } else { $t_popular = get_theme_mod( 't_pl_popular' ); }
			if ( false == get_theme_mod( 't_pl_hot', false ) ) { $t_hot = esc_html__("Hot", "magazine-plug");  } else { $t_hot = get_theme_mod( 't_pl_hot' ); }
			if ( false == get_theme_mod( 't_pl_trending', false ) ) { $t_trending = esc_html__("Trending", "magazine-plug");  } else { $t_trending = get_theme_mod( 't_pl_trending' ); }
			if ( false == get_theme_mod( 't_pl_all', false ) ) { $t_all = esc_html__("All", "magazine-plug");  } else { $t_all = get_theme_mod( 't_pl_all' ); }



      if (is_single()) { $exclude = get_the_ID(); }

			$zoom_option = get_option("zoom");
			$zoom = "on";
			if(!empty($zoom_option)) {
				if($zoom_option=="off"){ $zoom = "off"; }
				else if($zoom_option=="on"){ $zoom = "on"; }
			}

			$loadmore ='<div data-type="all" data-tag="'.$tag.'" data-review_star="'.$review_star.'" data-author="'.$author.'" data-category="'.$category.'" data-ppp="'.$item_nr.'" data-orderby="'.$orderby.'" data-orderbyp="'.$tab_popular.'" data-orderbyh="'.$tab_hot.'" data-orderbyt="'.$tab_trending.'" class="mt-load-more mt-radius"><span class="on">'. esc_html($t_load_more_posts) .'</span><span class="off">'. esc_html($t_congratulations) .'</span></div>';

			$meta_key = "";

			if($orderby=="popular") { $meta_key = "magazin_post_views_count"; $orderby = "meta_value_num"; }
			if($orderby=="shares") { $meta_key = "meta_value_num"; $orderby = "magazin_share_count_real"; }

			$args_1 = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'meta_key' => $meta_key,
				'orderby'=>$orderby,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'author_name'=>$author,
				'category_name'=>$category,
				'tag'=>$tag
			);

			$args_2 = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'orderby'=>$orderby,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'author_name'=>$author,
				'category_name'=>$category,
				'tag'=>$tag,
				'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field'    => 'slug',
							'terms' => array( 'post-format-gallery', 'post-format-video' ),
              'operator' => 'NOT IN'
						),
					),
			);

			$args_3 = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'orderby'=>$orderby,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'author_name'=>$author,
				'category_name'=>$category,
				'tag'=>$tag,
				'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field'    => 'slug',
							'terms' => array( 'post-format-video' ),
						),
					),
			);

			$args_4 = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'orderby'=>$orderby,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'author_name'=>$author,
				'category_name'=>$category,
				'tag'=>$tag,
				'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field'    => 'slug',
							'terms' => array( 'post-format-gallery' ),
						),
					),
			);

			$meta_key_popular = "";

			if($tab_popular=="popular") { $meta_key_popular = "magazin_post_views_count"; $tab_popular = "meta_value_num"; }
			if($tab_popular=="shares") { $meta_key_popular = "magazin_share_count_real"; $tab_popular = "meta_value_num"; }

			$args_popular = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'meta_key' => $meta_key_popular,
				'orderby'=>$tab_popular,
				'include'=>$include,
				'author_name'=>$author,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'category_name'=>$category,
				'tag'=>$tag
			);

			$meta_key_hot = "";

			if($tab_hot=="popular") { $meta_key_hot = "magazin_post_views_count"; $tab_hot = "meta_value_num"; }
			if($tab_hot=="shares") { $meta_key_hot = "magazin_share_count_real"; $tab_hot = "meta_value_num"; }

			$args_hot = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'meta_key' => $meta_key_hot,
				'orderby'=>$tab_hot,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'author_name'=>$author,
				'category_name'=>$category,
				'tag'=>$tag
			);

			$meta_key_trending = "";

			if($tab_trending=="popular") { $meta_key_trending = "magazin_post_views_count"; $tab_trending = "meta_value_num"; }
			if($tab_trending=="shares") { $meta_key_trending = "magazin_share_count_real"; $tab_trending = "meta_value_num"; }

			$args_trending = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'meta_key' => $meta_key_trending,
				'orderby'=>$tab_trending,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'author_name'=>$author,
				'category_name'=>$category,
				'tag'=>$tag
			);


			if ($orderby == "popular") {
				$the_query = new WP_Query( $args_popular );
			}
			else if ($orderby == "shares") {
				$the_query = new WP_Query( $args_shares );
			}

			$the_query_tab_1 = new WP_Query( $args_1 );
			$the_query_tab_2 = new WP_Query( $args_2 );
			$the_query_tab_3 = new WP_Query( $args_3 );
			$the_query_tab_4 = new WP_Query( $args_4 );
			$the_query_tab_popular = new WP_Query( $args_popular );
			$the_query_tab_hot = new WP_Query( $args_hot );
			$the_query_tab_trending = new WP_Query( $args_trending );

			$shortcode = '';

			$shortcode .='<div class="mt-tab-wrap">';
			$shortcode .= '<div class="mt-post-tabs"><h2 class="heading heading-left pull-left"><span>'.$title.'</span></h2><div class="pull-right mt-post-tabs-nav">';
			if($tab_galleries=="on"){ if($the_query_tab_4->have_posts()) { $shortcode .= '<div class="mt-tabc mt-tabc-4 pull-right" data-tab="mt-tab-4">'. esc_html($t_galleries) .'</div>'; } }
			if($tab_videos=="on"){ if($the_query_tab_3->have_posts()) { $shortcode .= '<div class="mt-tabc mt-tabc-3 pull-right" data-tab="mt-tab-3">'. esc_html($t_videos) .'</div>'; } }
			if($tab_posts=="on"){ if($the_query_tab_2->have_posts()) { $shortcode .= '<div class="mt-tabc mt-tabc-2 pull-right" data-tab="mt-tab-2">'. esc_html($t_posts) .'</div>'; } }
			if($tab_popular!="off"){ if($the_query_tab_popular->have_posts()) { $shortcode .= '<div class="mt-tabc mt-tabc-popular pull-right" data-tab="mt-tab-popular">'. esc_html($t_popular) .'</div>'; } }
			if($tab_hot!="off"){ if($the_query_tab_hot->have_posts()) { $shortcode .= '<div class="mt-tabc mt-tabc-hot pull-right" data-tab="mt-tab-hot">'. esc_html($t_hot) .'</div>'; } }
			if($tab_trending!="off"){ if($the_query_tab_trending->have_posts()) { $shortcode .= '<div class="mt-tabc mt-tabc-trending pull-right" data-tab="mt-tab-trending">'. esc_html($t_trending) .'</div>'; } }
			$shortcode .= '<div class="mt-tabc mt-tabc-1 pull-right active" data-tab="mt-tab-1">'. esc_html($t_all) .'</div>';
			$shortcode .= '</div></div><div class="clearfix"></div>';


				if($type=="normal-right"){

					if($the_query_tab_1->have_posts()) {
						$shortcode .='<div class="mt-tab mt-tab-1 show">';
						$shortcode .='<div id="ajax-posts_1">';
						$i=1;
							while ( $the_query_tab_1->have_posts() ) : $the_query_tab_1->the_post();

							$icon = '';
							if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
							else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
							else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

							// Shortcode
							$shortcode .='<div class="poster normal '.review_type().'  size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } if (has_post_format( 'gallery' )) { $shortcode .= ' gallery'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
									$shortcode .= $icon;
									if($zoom=="on") {
										$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
									} else {
										$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_430').'" width="430" height="240" /></div>';
									}
									$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
								$shortcode .='</a>';
							}
								$shortcode .='<div class="poster-content">';
									if ($review_star!="off") { $shortcode .= mt_review_star(); }
									$shortcode .= mt_pl_categories();
									$shortcode .= mt_pl_views_shares();
									$shortcode .='<a href="'. get_permalink().'"><div><h2>'. get_the_title() .'</h2></div></a>';
									$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date() ) .'</span></small>';
									$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
									$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
								$shortcode .='</div>';
								$shortcode .='<div class="clearfix"></div>';
							$shortcode .='</div>';
							$i++;
							endwhile;
						$shortcode .='</div>';
						if($i > $item_nr){ $shortcode .= $loadmore; }
					$shortcode .='</div>';
					}

					if($tab_posts=="on"){
						if($the_query_tab_2->have_posts()) {
							$shortcode .='<div class="mt-tab mt-tab-2">';
							$shortcode .='<div id="ajax-posts_2">';
							$i=1;
								while ( $the_query_tab_2->have_posts() ) : $the_query_tab_2->the_post();

									$icon = '';
									if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
									else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
									else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

									// Shortcode
									$shortcode .='<div class="poster normal '.review_type().'  size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } if (has_post_format( 'gallery' )) { $shortcode .= ' gallery'; } $shortcode .='">';
									if ( has_post_thumbnail() ) {
										$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
											$shortcode .= $icon;
											if($zoom=="on") {
												$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
											} else {
												$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_430').'" width="430" height="240" /></div>';
											}
											$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
										$shortcode .='</a>';
									}
										$shortcode .='<div class="poster-content">';
											if ($review_star!="off") { $shortcode .= mt_review_star(); }
											$shortcode .= mt_pl_categories();
											$shortcode .= mt_pl_views_shares();
											$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
											$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date() ) .'</span></small>';
											$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
											$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
										$shortcode .='</div>';
										$shortcode .='<div class="clearfix"></div>';
									$shortcode .='</div>';
									$i++;
								endwhile;
							$shortcode .='</div>';
							if($i > $item_nr){ $shortcode .= $loadmore; }
						$shortcode .='</div>';
					}
				}

				if($tab_videos=="on"){
					if($the_query_tab_3->have_posts()) {
						$shortcode .='<div class="mt-tab mt-tab-3">';
						$shortcode .='<div id="ajax-posts_3">';
						$i=1;
							while ( $the_query_tab_3->have_posts() ) : $the_query_tab_3->the_post();

								$icon = '';
								if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
								else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
								else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

								// Shortcode
								$shortcode .='<div class="poster normal '.review_type().'  size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } if (has_post_format( 'gallery' )) { $shortcode .= ' gallery'; } $shortcode .='">';
								if ( has_post_thumbnail() ) {
									$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
										$shortcode .= $icon;
										if($zoom=="on") {
											$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
										} else {
											$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_430').'" width="430" height="240" /></div>';
										}
										$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
									$shortcode .='</a>';
								}
									$shortcode .='<div class="poster-content">';
										if ($review_star!="off") { $shortcode .= mt_review_star(); }
										$shortcode .= mt_pl_categories();
										$shortcode .= mt_pl_views_shares();
										$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
										$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date() ) .'</span></small>';
										$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
										$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
									$shortcode .='</div>';
									$shortcode .='<div class="clearfix"></div>';
								$shortcode .='</div>';
							$i++;
							endwhile;
						$shortcode .='</div>';
						if($i > $item_nr){ $shortcode .= $loadmore; }
					$shortcode .='</div>';
				}
			}

			if($tab_galleries=="on"){
				if($the_query_tab_4->have_posts()) {
					$shortcode .='<div class="mt-tab mt-tab-4">';
					$shortcode .='<div id="ajax-posts_4">';
					$i=1;
						while ( $the_query_tab_4->have_posts() ) : $the_query_tab_4->the_post();

							$icon = '';
							if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
							else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
							else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

							// Shortcode
							$shortcode .='<div class="poster normal '.review_type().'  size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } if (has_post_format( 'gallery' )) { $shortcode .= ' gallery'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
									$shortcode .= $icon;
									if($zoom=="on") {
										$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
									} else {
										$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_430').'" width="430" height="240" /></div>';
									}
									$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
								$shortcode .='</a>';
							}
								$shortcode .='<div class="poster-content">';
									if ($review_star!="off") { $shortcode .= mt_review_star(); }
									$shortcode .= mt_pl_categories();
									$shortcode .= mt_pl_views_shares();
									$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
									$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date() ) .'</span></small>';
									$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
									$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
								$shortcode .='</div>';
								$shortcode .='<div class="clearfix"></div>';
							$shortcode .='</div>';
							$i++;
						endwhile;
					$shortcode .='</div>';
					if($i > $item_nr){ $shortcode .= $loadmore; }
				$shortcode .='</div>';
			}
		}

		if($tab_popular!="off"){
			if($the_query_tab_popular->have_posts()) {
				$shortcode .='<div class="mt-tab mt-tab-popular">';
				$shortcode .='<div id="ajax-posts_popular">';
				$i=1;
					while ( $the_query_tab_popular->have_posts() ) : $the_query_tab_popular->the_post();

						$icon = '';
						if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
						else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
						else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

						// Shortcode
						$shortcode .='<div class="poster normal '.review_type().'  size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } if (has_post_format( 'gallery' )) { $shortcode .= ' gallery'; } $shortcode .='">';
						if ( has_post_thumbnail() ) {
							$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
								$shortcode .= $icon;
								if($zoom=="on") {
									$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
								} else {
									$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_430').'" width="430" height="240" /></div>';
								}
								$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
							$shortcode .='</a>';
						}
							$shortcode .='<div class="poster-content">';
								if ($review_star!="off") { $shortcode .= mt_review_star(); }
								$shortcode .= mt_pl_categories();
								$shortcode .= mt_pl_views_shares();
								$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
								$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date() ) .'</span></small>';
								$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
								$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
							$shortcode .='</div>';
							$shortcode .='<div class="clearfix"></div>';
						$shortcode .='</div>';
						$i++;
					endwhile;
				$shortcode .='</div>';
				if($i > $item_nr){ $shortcode .= $loadmore; }
			$shortcode .='</div>';
		}
	}

	if($tab_hot!="off"){
		if($the_query_tab_hot->have_posts()) {
			$shortcode .='<div class="mt-tab mt-tab-hot">';
			$shortcode .='<div id="ajax-posts_hot">';
			$i=1;
				while ( $the_query_tab_hot->have_posts() ) : $the_query_tab_hot->the_post();

					$icon = '';
					if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
					else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
					else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

					// Shortcode
					$shortcode .='<div class="poster normal '.review_type().'  size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } if (has_post_format( 'gallery' )) { $shortcode .= ' gallery'; } $shortcode .='">';
					if ( has_post_thumbnail() ) {
						$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
							$shortcode .= $icon;
							if($zoom=="on") {
								$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
							} else {
								$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_430').'" width="430" height="240" /></div>';
							}
							$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
						$shortcode .='</a>';
					}
						$shortcode .='<div class="poster-content">';
							if ($review_star!="off") { $shortcode .= mt_review_star(); }
							$shortcode .= mt_pl_categories();
							$shortcode .= mt_pl_views_shares();
							$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
							$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date() ) .'</span></small>';
							$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
							$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
						$shortcode .='</div>';
						$shortcode .='<div class="clearfix"></div>';
					$shortcode .='</div>';
					$i++;
				endwhile;
			$shortcode .='</div>';
			if($i > $item_nr){ $shortcode .= $loadmore; }
		$shortcode .='</div>';
	}
}

if($tab_trending!="off"){
	if($the_query_tab_trending->have_posts()) {
		$shortcode .='<div class="mt-tab mt-tab-trending">';
		$shortcode .='<div id="ajax-posts_trending">';
		$i=1;
			while ( $the_query_tab_trending->have_posts() ) : $the_query_tab_trending->the_post();

				$icon = '';
				if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
				else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
				else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

				// Shortcode
				$shortcode .='<div class="poster normal '.review_type().'  size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } if (has_post_format( 'gallery' )) { $shortcode .= ' gallery'; } $shortcode .='">';
				if ( has_post_thumbnail() ) {
					$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
						$shortcode .= $icon;
						if($zoom=="on") {
							$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
						} else {
							$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img alt="'. get_the_title() .'" class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_430').'" width="430" height="240" /></div>';
						}
						$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
					$shortcode .='</a>';
				}
					$shortcode .='<div class="poster-content">';
						if ($review_star!="off") { $shortcode .= mt_review_star(); }
						$shortcode .= mt_pl_categories();
						$shortcode .= mt_pl_views_shares();
						$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
						$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date() ) .'</span></small>';
						$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
						$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
					$shortcode .='</div>';
					$shortcode .='<div class="clearfix"></div>';
				$shortcode .='</div>';
				$i++;
			endwhile;
		$shortcode .='</div>';
		if($i > $item_nr){ $shortcode .= $loadmore; }
	$shortcode .='</div>';
}
}

		wp_reset_postdata();

		}
		$shortcode .='</div>';

			wp_reset_postdata();
			return $shortcode;
}
add_shortcode('posts_tabs', 'posts_tabs');
?>

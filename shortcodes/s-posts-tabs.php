<?php
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
			), $atts));

			global $post;

      if (is_single()) { $exclude = get_the_ID(); }


			$args_1 = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'orderby'=>$orderby,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
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

			$args_popular = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'orderby'=>"meta_value_num",
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'meta_key' => 'magazin_post_views_count',
				'category_name'=>$category,
				'tag'=>$tag
			);
			$args_shares = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'orderby'=>"meta_value_num",
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'meta_key' => 'magazin_share_count_real',
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

			$count_1 = $the_query_tab_1->found_posts;
			$count_2 = $the_query_tab_2->found_posts;
			$count_3 = $the_query_tab_3->found_posts;
			$count_4 = $the_query_tab_4->found_posts;


			$shortcode = '';
			$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
			$shares = "0";
			if (!empty($share)){
				$shares = $share;
			}

			$loadmore ='<div data-type="all" class="mt-load-more mt-radius"><span class="on">'. esc_html__("Load More Posts", "magazine-plug") .'</span><span class="off">'. esc_html__("Congratulations, you've reached all posts.", "magazine-plug") .'</span></div>';

			$shortcode .='<div class="mt-tab-wrap">';
			$shortcode .= '<div class="mt-post-tabs"><h2 class="heading heading-left pull-left"><span>'.$title.'</span></h2>';
			if($count_4 > 0 ) { $shortcode .= '<div class="mt-tabc mt-tabc-4 pull-right" data-tab="mt-tab-4">'. esc_html__("Galleries", "magazine-plug") .'</div>'; }
			if($count_3 > 0 ) { $shortcode .= '<div class="mt-tabc mt-tabc-3 pull-right" data-tab="mt-tab-3">'. esc_html__("Videos", "magazine-plug") .'</div>'; }
			if($count_2 > 0 ) { $shortcode .= '<div class="mt-tabc mt-tabc-2 pull-right" data-tab="mt-tab-2">'. esc_html__("Posts", "magazine-plug") .'</div>'; }
			$shortcode .= '<div class="mt-tabc mt-tabc-1 pull-right active" data-tab="mt-tab-1">'. esc_html__("All", "magazine-plug") .'</div>';
			$shortcode .= '</div><div class="clearfix"></div>';


				if($type=="normal-right"){

					if($the_query_tab_1->have_posts()) {
						$shortcode .='<div class="mt-tab mt-tab-1 show">';
						$shortcode .='<div id="ajax-posts_1">';
							while ( $the_query_tab_1->have_posts() ) : $the_query_tab_1->the_post();

							// Category Code.
							$category_name = get_the_category(get_the_ID());
							$categorys = '';
							$categorys .='<div class="poster-cat"><span class="mt-theme-text">';
							if(!empty($category_name[0])) { $categorys .=''.$category_name[0]->name.''; }
							if(!empty($category_name[1])) { $categorys .=', '.$category_name[1]->name.''; }
							if(!empty($category_name[2])) { $categorys .=', '.$category_name[2]->name.''; }
							$categorys .='</span></div>';

							// Share count meta real and fake.
							$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
							$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
							$shares = $share_real;
							if (!empty($share)){ $shares = $share+$share_real; }

							// View count meta real and fake.
							$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
							$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
							$viewes = $views + "0";
							if (!empty($view)){ $viewes = $view + $views; }

							// Post data, share counts.
							$data ='';
							$data .='<div class="poster-data color-silver-light">';
							$data .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazin") .'</span>';
							$data .='<span class="poster-views">'. $viewes .' views</span>';
							if (get_comments_number()!="0") { $data .='<span class="poster-comments">'.get_comments_number().'</span>'; }
							$data .='</div>';


							$icon = '';
							if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
							else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
							else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

							// Shortcode
							$shortcode .='<div class="poster normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
									$shortcode .= $icon;
									$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
									$shortcode .='<div class="poster-info">'; $shortcode .= $categorys; $shortcode .= $data; $shortcode .='</div>';
								$shortcode .='</a>';
							}
								$shortcode .='<div class="poster-content">';
									$shortcode .= $categorys;
									$shortcode .= $data;
									$shortcode .='<a href="'. get_permalink().'"><div><h2>'. get_the_title() .'</h2></div></a>';
									$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
									$shortcode .='<p>'.magazin_custom_excerpts(27).'</p>';
								$shortcode .='</div>';
								$shortcode .='<div class="clearfix"></div>';
							$shortcode .='</div>';
							endwhile;
						$shortcode .='</div>';
						if($count_1 > 10){ $shortcode .= $loadmore; }
					$shortcode .='</div>';
					}

					if($the_query_tab_2->have_posts()) {
					$shortcode .='<div class="mt-tab mt-tab-2">';
					$shortcode .='<div id="ajax-posts_2">';
						while ( $the_query_tab_2->have_posts() ) : $the_query_tab_2->the_post();

							// Category Code.
							$category_name = get_the_category(get_the_ID());
							$categorys = '';
							$categorys .='<div class="poster-cat"><span class="mt-theme-text">';
							if(!empty($category_name[0])) { $categorys .=''.$category_name[0]->name.''; }
							if(!empty($category_name[1])) { $categorys .=', '.$category_name[1]->name.''; }
							if(!empty($category_name[2])) { $categorys .=', '.$category_name[2]->name.''; }
							$categorys .='</span></div>';

							// Share count meta real and fake.
							$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
							$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
							$shares = $share_real;
							if (!empty($share)){ $shares = $share+$share_real; }

							// View count meta real and fake.
							$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
							$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
							$viewes = $views + "0";
							if (!empty($view)){ $viewes = $view + $views; }

							// Post data, share counts.
							$data ='';
							$data .='<div class="poster-data color-silver-light">';
							$data .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazin") .'</span>';
							$data .='<span class="poster-views">'. $viewes .' views</span>';
							if (get_comments_number()!="0") { $data .='<span class="poster-comments">'.get_comments_number().'</span>'; }
							$data .='</div>';

							$icon = '';
							if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
							else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
							else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

							// Shortcode
							$shortcode .='<div class="poster normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
									$shortcode .= $icon;
									$shortcode .='<div class="mt-post-image" ><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
									$shortcode .='<div class="poster-info">'; $shortcode .= $categorys; $shortcode .= $data; $shortcode .='</div>';
								$shortcode .='</a>';
							}
								$shortcode .='<div class="poster-content">';
									$shortcode .= $categorys;
									$shortcode .= $data;
									$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
									$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
									$shortcode .='<p>'.magazin_custom_excerpts(27).'</p>';
								$shortcode .='</div>';
								$shortcode .='<div class="clearfix"></div>';
							$shortcode .='</div>';
						endwhile;
					$shortcode .='</div>';
					if($count_2 > 10){ $shortcode .= $loadmore; }
				$shortcode .='</div>';
				}

				if($the_query_tab_3->have_posts()) {
				$shortcode .='<div class="mt-tab mt-tab-3">';
				$shortcode .='<div id="ajax-posts_3">';
					while ( $the_query_tab_3->have_posts() ) : $the_query_tab_3->the_post();

						// Category Code.
						$category_name = get_the_category(get_the_ID());
						$categorys = '';
						$categorys .='<div class="poster-cat"><span class="mt-theme-text">';
						if(!empty($category_name[0])) { $categorys .=''.$category_name[0]->name.''; }
						if(!empty($category_name[1])) { $categorys .=', '.$category_name[1]->name.''; }
						if(!empty($category_name[2])) { $categorys .=', '.$category_name[2]->name.''; }
						$categorys .='</span></div>';

						// Share count meta real and fake.
						$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
						$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
						$shares = $share_real;
						if (!empty($share)){ $shares = $share+$share_real; }

						// View count meta real and fake.
						$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
						$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
						$viewes = $views + "0";
						if (!empty($view)){ $viewes = $view + $views; }

						// Post data, share counts.
						$data ='';
						$data .='<div class="poster-data color-silver-light">';
						$data .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazin") .'</span>';
						$data .='<span class="poster-views">'. $viewes .' views</span>';
						if (get_comments_number()!="0") { $data .='<span class="poster-comments">'.get_comments_number().'</span>'; }
						$data .='</div>';

						$icon = '';
						if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
						else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
						else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

						// Shortcode
						$shortcode .='<div class="poster normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
						if ( has_post_thumbnail() ) {
							$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
								$shortcode .= $icon;
								$shortcode .='<div class="mt-post-image" ><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
								$shortcode .='<div class="poster-info">'; $shortcode .= $categorys; $shortcode .= $data; $shortcode .='</div>';
							$shortcode .='</a>';
						}
							$shortcode .='<div class="poster-content">';
								$shortcode .= $categorys;
								$shortcode .= $data;
								$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
								$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
								$shortcode .='<p>'.magazin_custom_excerpts(27).'</p>';
							$shortcode .='</div>';
							$shortcode .='<div class="clearfix"></div>';
						$shortcode .='</div>';
					endwhile;
				$shortcode .='</div>';
				if($count_3 > 10){ $shortcode .= $loadmore; }
			$shortcode .='</div>';
			}

			if($the_query_tab_4->have_posts()) {
			$shortcode .='<div class="mt-tab mt-tab-4">';
			$shortcode .='<div id="ajax-posts_4">';
				while ( $the_query_tab_4->have_posts() ) : $the_query_tab_4->the_post();

					// Category Code.
					$category_name = get_the_category(get_the_ID());
					$categorys = '';
					$categorys .='<div class="poster-cat"><span class="mt-theme-text">';
					if(!empty($category_name[0])) { $categorys .=''.$category_name[0]->name.''; }
					if(!empty($category_name[1])) { $categorys .=', '.$category_name[1]->name.''; }
					if(!empty($category_name[2])) { $categorys .=', '.$category_name[2]->name.''; }
					$categorys .='</span></div>';

					// Share count meta real and fake.
					$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
					$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
					$shares = $share_real;
					if (!empty($share)){ $shares = $share+$share_real; }

					// View count meta real and fake.
					$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
					$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
					$viewes = $views + "0";
					if (!empty($view)){ $viewes = $view + $views; }

					// Post data, share counts.
					$data ='';
					$data .='<div class="poster-data color-silver-light">';
					$data .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazin") .'</span>';
					$data .='<span class="poster-views">'. $viewes .' views</span>';
					if (get_comments_number()!="0") { $data .='<span class="poster-comments">'.get_comments_number().'</span>'; }
					$data .='</div>';

					$icon = '';
					if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
					else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
					else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

					// Shortcode
					$shortcode .='<div class="poster normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
					if ( has_post_thumbnail() ) {
						$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
							$shortcode .= $icon;
							$shortcode .='<div class="mt-post-image" ><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
							$shortcode .='<div class="poster-info">'; $shortcode .= $categorys; $shortcode .= $data; $shortcode .='</div>';
						$shortcode .='</a>';
					}
						$shortcode .='<div class="poster-content">';
							$shortcode .= $categorys;
							$shortcode .= $data;
							$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
							$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
							$shortcode .='<p>'.magazin_custom_excerpts(27).'</p>';
						$shortcode .='</div>';
						$shortcode .='<div class="clearfix"></div>';
					$shortcode .='</div>';
				endwhile;
			$shortcode .='</div>';
			if($count_4 > 10){ $shortcode .= $loadmore; }
		$shortcode .='</div>';
		} wp_reset_postdata();

			}
$shortcode .='</div>';

			wp_reset_postdata();
			return $shortcode;
}
add_shortcode('posts_tabs', 'posts_tabs');
?>

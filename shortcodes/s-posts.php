<?php
function posts( $atts, $content = null ) {
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
			'type' => 'small-two',
			'offset'=> '',
			'pagination'=> 'off',
			'title_type'=> 'off',
			'title'=> 'Title',
			), $atts));

			global $post;

      if (is_single()) { $exclude = get_the_ID(); }

			if($pagination == "on") {
				if(is_front_page()) {
					$paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
				} else {
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
				}
			}
			else {
				$paged = "";
			}


			$args = array(
				'post_type'=>$posttype,
				'order'=>$order,
				'orderby'=>$orderby,
				'include'=>$include,
				'post__not_in'=>array( $exclude ),
				'posts_per_page'=>$item_nr,
				'offset'=>$offset,
				'category_name'=>$category,
				'paged' => $paged,
				'tag'=>$tag
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
				'paged' => $paged,
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
				'paged' => $paged,
				'tag'=>$tag
			);

			if ($orderby == "popular") {
				$the_query = new WP_Query( $args_popular );
			}
			else if ($orderby == "shares") {
				$the_query = new WP_Query( $args_shares );
			}
			else {
				$the_query = new WP_Query( $args );
			}

			if(is_search() and $type=="normal-right"){

			global $query_string;

				$query_args = explode("&", $query_string);
				$search_query = array();

				if( strlen($query_string) > 0 ) {
					foreach($query_args as $key => $string) {
						$query_split = explode("=", $string);
						$search_query[$query_split[0]] = urldecode($query_split[1]);
					} // foreach
				} //if
				$the_query = new WP_Query($search_query);
			}

			$shortcode = '';
			$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
			$shares = "0";
			if (!empty($share)){
				$shares = $share;
			}
			if($title_type=="center" and $title != ""){ $shortcode .= '<h2 class="heading"><span>'.$title.'</span></h2>'; }
			if($title_type=="left" and $title != ""){ $shortcode .= '<h2 class="heading heading-left"><span>'.$title.'</span></h2>'; }
			if($title_type=="right" and $title != ""){ $shortcode .= '<h2 class="heading heading-right"><span>'.$title.'</span></h2>'; }



			if($the_query->have_posts()) {
				$shortcode .='<div>';
				if($type=="small-bottom"){
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$attachment_id = get_post_thumbnail_id( get_the_ID() );
					$img_src = wp_get_attachment_image_url( $attachment_id, 'full' );
					$img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'full' );
						$shortcode .='<div class="poster-small-bottom'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
									if ( has_post_format( 'video' )) {
										$shortcode .='<span class="video-icon"></span>';
									}
									if ( has_post_thumbnail() ) {
										$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'medium').'" width="480" height="480" /></div>';
									}

								$shortcode .='</a>';
							}
							$shortcode .='<div class="poster-text">';
								$shortcode .='<a href="'. get_permalink().'"><h4>'. get_the_title() .'</h4></a>';
							$shortcode .='</div>';
							$shortcode .='<div class="clearfix"></div>';
						$shortcode .='</div>';
					endwhile;
				}
				if($type=="small"){
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$attachment_id = get_post_thumbnail_id( get_the_ID() );
					$img_src = wp_get_attachment_image_url( $attachment_id, 'full' );
					$img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'full' );
						$shortcode .='<div class="poster-small'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
									if ( has_post_format( 'video' )) {
										$shortcode .='<span class="video-icon"></span>';
									}
									if ( has_post_thumbnail() ) {
										$shortcode .='<div class="mt-post-image" ><img  class="img-small" src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').'" width="300" height="300" alt="'. get_the_title() .'" /><img src="image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'large').'" alt="'. get_the_title() .'" /></div>';
									}
									$shortcode .='</a>';
							}
							$shortcode .='<div class="poster-text">';
								$shortcode .='<a href="'. get_permalink().'"><h4>'. get_the_title() .'</h4></a>';
								$shortcode .='<small><span class="color-silver-light"> '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
							$shortcode .='</div>';
							$shortcode .='<div class="clearfix"></div>';
						$shortcode .='</div>';
					endwhile;
				}
				if($type=="small-two"){
					$shortcode .='<div class="row">';
					$counter = 0;
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$column = 'column-first';
						if(++$counter % 2 === 0) {
				        $column = 'column-second';
				    }
						$shortcode .='<div class="col-md-6 '.$column.'">';

						$shortcode .='<div class="poster-small'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
							$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
								if ( has_post_format( 'video' )) {
									$shortcode .='<span class="video-icon"></span>';
								}
								if ( has_post_thumbnail() ) {
								  $shortcode .='<div class="mt-post-image" ><img  class="img-small" src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').'" width="544" height="1000" alt="'. get_the_title() .'" /><img src="image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'medium').'" alt="'. get_the_title() .'" /></div>';
								}
								$shortcode .='</a>';
						}
							$shortcode .='<div class="poster-text">';
								$shortcode .='<a href="'. get_permalink().'"><h4>'. get_the_title() .'</h4></a>';
								$shortcode .='<small><span class="color-silver-light"> '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
							$shortcode .='</div>';
							$shortcode .='<div class="clearfix"></div>';
						$shortcode .='</div>';
						$shortcode .='</div>';
					endwhile;
					$shortcode .='</div>';
				}
				if($type=="normal"){
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
						$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
						$shares = $share_real;
						if (!empty($share)){
							$shares = $share+$share_real;
						}
						$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
						$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
						$viewes = $views + "0";
						if (!empty($view)){
							$viewes = $view + $views;
						}
						$shortcode .='<div class="poster size-normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius" href="'. get_permalink().'">';
								if ( has_post_format( 'video' )) {
									$shortcode .='<span class="video-icon"></span>';
								}
								if ( has_post_thumbnail() ) {
								  $shortcode .='<div class="mt-post-image"><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_480').'" /></div>';
								}
								if ( !has_post_format( 'video' ) ) {
									$shortcode .='<i class="ic-open open"></i>';
									$shortcode .='<div class="poster-info mt-theme-background">';
										if ( has_post_thumbnail() ) {
											$shortcode .='<div class="poster-cat "><span class="mt-theme-text">';
												$category_name = get_the_category(get_the_ID());
												if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
												if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
												if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
											$shortcode .='</span></div>';
										}
										$shortcode .='<div class="poster-data color-silver-light">';
											$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
											$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
											if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
										$shortcode .='</div>';
									$shortcode .='</div>';
								}
								if ( has_post_format( 'video' ) and has_post_thumbnail() ) {
									$shortcode .='<div class="poster-info mt-theme-background">';
									$shortcode .='<div class="poster-cat"><span class="mt-theme-text">';
										$category_name = get_the_category(get_the_ID());
										if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
										if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
										if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
									$shortcode .='</span></div>';
									$shortcode .='<div class="poster-data color-silver-light">';
										$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
										$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
										if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
									$shortcode .='</div>';
									$shortcode .='</div>';
								}
							$shortcode .='</a>';
						}
							$shortcode .='<div class="poster-content-wrap">';

										$shortcode .='<div class="poster-data color-silver-light">';
											$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
											$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
											if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
										$shortcode .='</div>';

								$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
								$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
							$shortcode .='</div>';
						$shortcode .='</div>';
					endwhile;
				}
				if($type=="normal-two"){
					$shortcode .='<div class="row">';
					$counter = 0;
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
						$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
						$shares = $share_real;
						if (!empty($share)){
							$shares = $share+$share_real;
						}
						$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
						$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
						$viewes = $views + "0";
						if (!empty($view)){
							$viewes = $view + $views;
						}
						$column = 'column-first';
						if(++$counter % 2 === 0) {
				        $column = 'column-second';
				    }
						$shortcode .='<div class="col-md-6 '.$column.'">';
						$shortcode .='<div class="poster size-normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
							$shortcode .='<a class="poster-image mt-radius" href="'. get_permalink().'">';
								if ( has_post_format( 'video' )) {
									$shortcode .='<span class="video-icon"></span>';
								}
								if ( has_post_thumbnail() ) {
								  $shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_480').'" width="480" height="480" /></div>';
								}
								if ( !has_post_format( 'video' ) ) {
									$shortcode .='<i class="ic-open open"></i>';
									$shortcode .='<div class="poster-info mt-theme-background">';
										if ( has_post_thumbnail() ) {
											$shortcode .='<div class="poster-cat"><span>';
												$category_name = get_the_category(get_the_ID());
												if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
												if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
												if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
											$shortcode .='</span></div>';
										}
										$shortcode .='<div class="poster-data color-silver-light">';
											$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
											$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
											if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
										$shortcode .='</div>';
									$shortcode .='</div>';
								}
								if ( has_post_format( 'video' ) and has_post_thumbnail() ) {
									$shortcode .='<div class="poster-info mt-theme-background">';
									$shortcode .='<div class="poster-cat"><span>';
										$category_name = get_the_category(get_the_ID());
										if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
										if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
										if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
									$shortcode .='</span></div>';
									$shortcode .='<div class="poster-data color-silver-light">';
										$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
										$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
										if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
									$shortcode .='</div>';
									$shortcode .='</div>';
								}
							$shortcode .='</a>';
						}
									$shortcode .='<div class="poster-data color-silver-light">';
										$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
										$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
										if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
									$shortcode .='</div>';

							$shortcode .='<div class="poster-content-wrap"><a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
							$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
						$shortcode .='</div></div>';
						$shortcode .='</div>';
					endwhile;
					$shortcode .='</div>';
				}

				if($type=="normal-right"){
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
						$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
						$shares = $share_real;
						if (!empty($share)){
							$shares = $share+$share_real;
						}
						$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
						$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
						$viewes = $views + "0";
						if (!empty($view)){
							$viewes = $view + $views;
						}

						$shortcode .='<div class="poster normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
						if ( has_post_thumbnail() ) {
							$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
								if ( has_post_format( 'video' )) {
									$shortcode .='<span class="video-icon mt-theme-background"></span>';
								}
								if ( has_post_thumbnail() ) {
								$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
								}
								if ( !has_post_format( 'video' ) ) {
									$shortcode .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>';
									$shortcode .='<div class="poster-info">';
										if ( has_post_thumbnail() ) {
											$shortcode .='<div class="poster-cat"><span class="mt-theme-text">';
												$category_name = get_the_category(get_the_ID());
												if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
												if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
												if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
											$shortcode .='</span></div>';
										}
										$shortcode .='<div class="poster-data color-silver-light">';
											$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
											$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
											if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
										$shortcode .='</div>';
									$shortcode .='</div>';
								}
								if ( has_post_format( 'video' ) and has_post_thumbnail() ) {
									$shortcode .='<div class="poster-info">';
									$shortcode .='<div class="poster-cat"><span class="mt-theme-text">';
										$category_name = get_the_category(get_the_ID());
										if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
										if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
										if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
									$shortcode .='</span></div>';
									$shortcode .='<div class="poster-data color-silver-light">';
										$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
										$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
										if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
									$shortcode .='</div>';
									$shortcode .='</div>';
								}
							$shortcode .='</a>';
						}
							$shortcode .='<div class="poster-content">';
							$shortcode .='<div class="poster-cat"><span class="mt-theme-text">';
								$category_name = get_the_category(get_the_ID());
								if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
								if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
								if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
							$shortcode .='</span></div>';
								$shortcode .='<div class="poster-data color-silver-light">';
									$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
									$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
									if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
								$shortcode .='</div>';
								$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
								$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
								$shortcode .='<p>'.magazin_custom_excerpts(27).'</p>';
							$shortcode .='</div>';
							$shortcode .='<div class="clearfix"></div>';
						$shortcode .='</div>';
					endwhile;
				}
				if($type=="normal-right-small"){
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$share = get_post_meta(get_the_ID(), "magazin_share_count", true);
						$share_real = get_post_meta(get_the_ID(), "magazin_share_count_real", true);
						$shares = $share_real;
						if (!empty($share)){
							$shares = $share+$share_real;
						}
						$view = get_post_meta(get_the_ID(), "magazin_view_count", true);
						$views = get_post_meta(get_the_ID(), "magazin_post_views_count", true);
						$viewes = $views + "0";
						if (!empty($view)){
							$viewes = $view + $views;
						}

						$shortcode .='<div class="poster normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
							if ( has_post_thumbnail() ) {
								$shortcode .='<a class="poster-image mt-radius normal-right-small pull-left" href="'. get_permalink().'">';
								if ( has_post_format( 'video' )) {
									$shortcode .='<span class="video-icon mt-theme-background"></span>';
								}
								if ( has_post_thumbnail() ) {
								  $shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_480').'" width="480" height="480" /></div>';
								}
								if ( !has_post_format( 'video' ) ) {
									$shortcode .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>';
									$shortcode .='<div class="poster-info">';
										if ( has_post_thumbnail() ) {
											$shortcode .='<div class="poster-cat"><span class="mt-theme-text">';
												$category_name = get_the_category(get_the_ID());
												if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
												if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
												if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
											$shortcode .='</span></div>';
										}
										$shortcode .='<div class="poster-data color-silver-light">';

												$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';

											$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
											if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
										$shortcode .='</div>';
									$shortcode .='</div>';
								}
								if ( has_post_format( 'video' ) and has_post_thumbnail() ) {
									$shortcode .='<div class="poster-info">';
									$shortcode .='<div class="poster-cat"><span class="mt-theme-text">';
										$category_name = get_the_category(get_the_ID());
										if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
										if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
										if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
									$shortcode .='</span></div>';
									$shortcode .='<div class="poster-data color-silver-light">';
										$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
										$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
										if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
									$shortcode .='</div>';
									$shortcode .='</div>';
								}
							$shortcode .='</a>';
						}
							$shortcode .='<div class="poster-content">';
							$shortcode .='<div class="poster-cat"><span class="mt-theme-text">';
								$category_name = get_the_category(get_the_ID());
								if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
								if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
								if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
							$shortcode .='</span></div>';
								$shortcode .='<div class="poster-data color-silver-light">';
									$shortcode .='<span class="poster-shares">'. $shares .' '. esc_html__("shares", "magazine-plug") .'</span>';
									$shortcode .='<span class="poster-views">'. $viewes .' '. esc_html__("views", "magazine-plug") .'</span>';
									if (get_comments_number()!="0") { $shortcode .='<span class="poster-comments">'.get_comments_number().'</span>'; }
								$shortcode .='</div>';

								$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
								$shortcode .='<small><strong>'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light"> - '. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
								$shortcode .='<p>'.magazin_custom_excerpts(20).'</p>';
							$shortcode .='</div>';
							$shortcode .='<div class="clearfix"></div>';
						$shortcode .='</div>';
					endwhile;
				}
				if($type=="carousel-post-slider"){
					$shortcode .='<div class="poster-carousel">';
					$shortcode .='<div class="post-carousel">';
					while ( $the_query->have_posts() ) : $the_query->the_post();
						if (has_post_thumbnail()) {
							$shortcode .='<div class="poster large '; if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
								$shortcode .='<div class="poster-image mt-radius">';
									$shortcode .='<div class="poster-large-content">';

										$shortcode .='<div class="poster-large-content-in">';
											$shortcode .='<div class="poster-large-cat"><span class="mt-theme-background">';
												$category_name = get_the_category(get_the_ID());
												if(!empty($category_name[0])) { $shortcode .=''.$category_name[0]->name.''; }
												if(!empty($category_name[1])) { $shortcode .=', '.$category_name[1]->name.''; }
												if(!empty($category_name[2])) { $shortcode .=', '.$category_name[2]->name.''; }
											$shortcode .='</span></div>';
											$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
											$shortcode .='<p>'.magazin_custom_excerpts(19).'</p>';
											$shortcode .='<a class="poster-large-link" href="'. get_permalink().'"><div><span>'. esc_html__( 'Read More', 'magazine-plug'  ) .'</span></div></a>';
										$shortcode .='</div>';
									$shortcode .='</div>';
									if ( has_post_thumbnail() ) {
										$shortcode .='<div class="mt-post-image" ><div class="mt-post-image-background" style="background-image:url('. get_the_post_thumbnail_url(get_the_ID(),'magazin_5').');"></div><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-lazy="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_625').'"  alt="'. get_the_title() .'" /></div>';
									}
								$shortcode .='</div>';
							$shortcode .='</div>';
						}
					endwhile;
					$shortcode .='</div>';
					$shortcode .='</div>';
				}
				$shortcode .='</div>';
			}

			if($pagination == "on") {

			 $pag_args1 = array(
              'format'  => '?paged=%#%',
              'current' => $paged,
							'prev_text' => "<span></span>",
							'next_text' => "<span></span>",
              'total'   => $the_query->max_num_pages
          );

			  $shortcode .=  '<div class="pagination">'.paginate_links($pag_args1) .'</div>';

			}
			wp_reset_postdata();
			return $shortcode;
}
add_shortcode('posts', 'posts');
?>

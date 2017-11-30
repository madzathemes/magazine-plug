<?php
#include_once ('plugins/easy-google-fonts/easy-google-fonts.php');
include_once ('plugins/megamenu-master/df-megamenu.php');
#include_once ('plugins/megadropdownmenu-master/megadropdown.php');
if (class_exists('WPBakeryShortCode')) {
	include_once ('vc-shortcodes/vc-posts-tabs.php');
	include_once ('vc-shortcodes/vc-ads.php');
	include_once ('vc-shortcodes/vc-subscribe.php');
	include_once ('vc-shortcodes/vc-social.php');
	include_once ('vc-shortcodes/vc-grid.php');
	include_once ('vc-shortcodes/vc-posts.php');
}
include_once ('shortcodes/s-ads.php');
include_once ('shortcodes/s-posts.php');
include_once ('shortcodes/s-posts-tabs.php');
include_once ('shortcodes/s-trending.php');
include_once ('shortcodes/s-space.php');
include_once ('shortcodes/s-social.php');
include_once ('shortcodes/s-share.php');
include_once ('shortcodes/s-subscribe.php');
include_once ('shortcodes/s-grid.php');

include_once ('widgets/w-ads.php');
include_once ('widgets/w-posts.php');
include_once ('widgets/w-posts-tabs.php');
include_once ('widgets/w-space.php');
include_once ('widgets/w-social.php');
include_once ('widgets/w-subscribe.php');
include_once ('widgets/w-grid.php');
include_once ('widgets/w-trending.php');


include_once ('example-functions.php');
include_once ('plugins/kirki/kirki.php');
include_once ('customizer/customizer-general.php');
include_once ('customizer/customizer-ads.php');
include_once ('customizer/customizer-posts.php');
include_once ('customizer/customizer-text.php');
include_once ('customizer/customizer-fonts.php');
include_once ('plugins/social-count-plus-master/social-count-plus.php');
add_filter('widget_text', 'do_shortcode');

// Disable Importer Branding
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true');

//Speed import process, cutt xml
function ocdi_change_time_of_single_ajax_call() {
	return 10;
}
add_action( 'pt-ocdi/time_for_one_ajax_call', 'ocdi_change_time_of_single_ajax_call' );

function magazin_text_domain() {
	load_plugin_textdomain( 'magazine-plug', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'magazin_text_domain' );

add_action('init','magazin_random_add_rewrite');
function magazin_random_add_rewrite() {
       global $wp;
       $wp->add_query_var('random');
       add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}

add_action('template_redirect','magazin_random_template');
function magazin_random_template() {
       if (get_query_var('random') == 1) {
               $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
               foreach($posts as $post) {
                       $link = get_permalink($post);
               }
               wp_redirect($link,307);
               exit;
       }
}


function magazin_theme_setup() {

	add_image_size( 'magazin_430', 430, 240, true);
	add_image_size( 'magazin_585', 585, 285, true);
	add_image_size( 'magazin_550', 550, 550, false );
	add_image_size( 'magazin_480', 520, 520, false );
	add_image_size( 'magazin_625', 625, 625, false );
	add_image_size( 'magazin_100', 100, 68, true );
	add_image_size( 'magazin_5', 15, 99, false );
	if(function_exists('fullstory_theme_setup')) {
		add_image_size( 'magazin_1300', 1300, 370, true );
		add_image_size( 'magazin_1300_5', 26, 8, true );
	}

}

add_action( 'after_setup_theme', 'magazin_theme_setup' );

function magazin_header_hooks() {

	if ( is_singular() ) {

	wp_enqueue_script( "comment-reply" ); ?>

	<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); if ( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) { ?>
	<?php global $post;

	$option = get_option("magazin_option");

	$excerpt = apply_filters('get_the_excerpt', get_post_field('post_excerpt', $post->ID));
	$excerpt_ = magazin_custom_excerpts(27);
	if (!empty($option['post_meta_excerpt'])) {
		if($option['post_meta_excerpt']==3){
			$excerpt = get_post_meta($post->ID, "magazin_excerpt", true);
			if (!empty($excerpt)) { $excerpt_ = $excerpt; }
		}
		else if($option['post_meta_excerpt']==4){
			$excerpt = get_post_meta($post->ID, "magazin_subtitle", true);
			if (!empty($excerpt)) { $excerpt_ = $excerpt; }
		}

	}


	$excerpt_count = "55";
	$excerpt_count_option = get_option("magazin_facebook_description");

	if(!empty($excerpt_count_option)) {
			$excerpt_count = $excerpt_count_option;
	}

	if ( $excerpt_ == '' ) {
	    $excerpt_ = wp_trim_words( $post->post_content, $excerpt_count );
	} ?>
	<?php if ( true == get_theme_mod( 'mt_facebook_meta', true ) ) {
		$mt_social = get_option( 'socialcountplus_settings');
		$facebook_token = "";
		if(isset($mt_social['facebook_app_id'])) { $facebook_token = $mt_social['facebook_app_id']; }
		?>
		<meta property="fb:app_id"        content="<?php echo esc_html($facebook_token);?>" />
	  <meta property="og:url"           content="<?php the_permalink();?>" />
		<meta property="og:type"          content="<?php wp_title();?>" />
		<meta property="og:title"         content="<?php the_title();?>" />
		<meta property="og:description"   content="<?php echo esc_html( $excerpt_ ); ?>" />
		<meta property="og:image"         content="<?php  if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } ?>" />
	<?php } } } ?>
	<style type="text/css"><?php echo balanceTags(get_option("custom_css")); ?></style>
	<?php
}

add_action('wp_head', 'magazin_header_hooks');

function mt_header_script() {

		$autoplay = get_option("carousel_autoplay");
		$options = get_option("sticky_sidebar");
		wp_enqueue_script('mt-effects', get_template_directory_uri() . '/inc/js/effects.js', array('jquery'), '1.0', true);

		if(is_rtl()){
			wp_add_inline_script( 'mt-effects', 'var $rtl = true;', 'before' );
		} else {
			wp_add_inline_script( 'mt-effects', 'var $rtl = false;', 'before' );
		}

		if(!empty($autoplay)){
			if($autoplay=="1"){
				wp_add_inline_script( 'mt-effects', 'var $autoplay = true;', 'before' );
			}
			else {
				wp_add_inline_script( 'mt-effects', 'var $autoplay = false;', 'before' );
			}
		} else {
			wp_add_inline_script( 'mt-effects', 'var $autoplay = false;', 'before' );
		}

		if(!empty($options)){
			if($options=="1"){
				wp_add_inline_script( 'mt-effects', 'jQuery(document).ready(function() {jQuery(".sidebar, .sticky_row .panel-grid-cell").theiaStickySidebar({additionalMarginTop: 29,	minWidth: 1200});});', 'after' );
				wp_add_inline_script( 'mt-effects', 'jQuery(document).ready(function() {jQuery(".mt-signle-share-sidebar").theiaStickySidebar({additionalMarginTop: 70,	minWidth: 1200});});', 'after' );
			}
		} else {
			wp_add_inline_script( 'mt-effects', 'jQuery(document).ready(function() {jQuery(".sidebar, .sticky_row .panel-grid-cell").theiaStickySidebar({additionalMarginTop: 29,	minWidth: 1200});});', 'after' );
			wp_add_inline_script( 'mt-effects', 'jQuery(document).ready(function() {jQuery(".mt-signle-share-sidebar").theiaStickySidebar({additionalMarginTop: 70,	minWidth: 1200});});', 'after' );
		}


		if ( true == get_theme_mod( 'mt_header_time', false ) ) {
			wp_add_inline_script( 'mt-effects', '
			var today = new Date();
			var h = today.getHours();
			function startTime() {
			    var today = new Date();
			    var m = today.getMinutes();
			    var s = today.getSeconds();
			    m = checkTime(m);
			    s = checkTime(s);
			    document.getElementById("time-live").innerHTML =
			    h + ":" + m + "<span>:" + s + "</span>";
			    var t = setTimeout(function(){requestAnimationFrame(startTime)}, 1000);
			}
			function checkTime(i) { if (i < 10) {i = "0" + i};   return i; }
			', 'before' );
			wp_add_inline_script( 'mt-effects', 'window.onload=startTime; ', 'after' );
		}


}
add_action('wp_enqueue_scripts', 'mt_header_script');



function magazin_custom_excerpts($limit) {
    return wp_trim_words(get_the_content(), $limit);
}

function html_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/*-----------------------------------------------------------------------------------*/
/* Magazin Framework post views function
/*-----------------------------------------------------------------------------------*/
function magazin_PostViews($post_ID) {

    //Set the name of the Posts Custom Field.
    $count_key = 'magazin_post_views_count';

    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);

    //If the the Post Custom Field value is empty.
    if($count == ''){
        $count = 0; // set the counter to zero.

        //Delete all custom fields with the specified key from the specified post.
        delete_post_meta($post_ID, $count_key);

        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count . '';

    //If the the Post Custom Field value is NOT empty.
    }else{
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);

        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
        return $count . '';
        }
        //In all other cases return (count) Views
        else {
        return $count . '';
        }
    }
}

function magazin_custom_oembed_filter($html, $url, $attr, $post_ID) {
		$input = get_the_title().' '.get_the_permalink(); $title = str_replace( ' ', '+', $input );
		$urls = wp_get_attachment_url( get_post_thumbnail_id($post_ID));
		$return = "";
    $return .='<div class="single-share">';
			$return .='<div class="video-wrap">';
				$return .='<div class="video-container">';
					$return .='<div class="single-share-socials mt-radius-b" >';
						$return .='<a target="_blank"  href="http://www.facebook.com/sharer.php?u='. get_the_permalink() .'" ><div class="facebook mt-radius-b"></div></a>';
						$return .='<a target="_blank"  href="http://twitter.com/home/?status='. $title .'" ><div class="twiiter mt-radius-b"></div></a>';
						$return .='<a target="_blank"  href="https://plus.google.com/share?url='. get_the_permalink() .'" ><div class="google mt-radius-b"></div></a>';
					$return .='<a target="_blank"  href="http://pinterest.com/pin/create/button/?url='. get_the_permalink() .'&media='. esc_url($urls) .'" ><div class="pinterest mt-radius-b"></div></a>';
				$return .='</div>'.$html.'</div>';
			$return .='</div>';
		$return .='</div>';
    return $return;
}
add_filter( 'embed_oembed_html', 'magazin_custom_oembed_filter', 10, 4 ) ;



add_filter('body_class','magazin_class');
function magazin_class($classes) {

	$body_class = "";

	$title = get_post_meta(get_the_ID(), "magazin_page_title", true);
	if(!empty($title) and !is_search()){
		$body_class .= 'remove-title';
	}

	$radius_option = get_option("radius");

	$colors_option = get_option("colors");

	$zoom_option = get_option("zoom");
	$zoom = "zoom-on";
	if(!empty($zoom_option)) {
		if($zoom_option=="off"){ $zoom = "zoom-off"; }
		else if($zoom_option=="on"){ $zoom = "zoom-on"; }
	}

	$colors = "mt-color-1";
	if(!empty($colors_option)) {
		if($colors_option=="color2"){
			$colors = "mt-color-2";
		}
	}

	$radius = "mt-radius-5";
	if(!empty($radius_option)) {
		if($radius_option=="0px"){
			$radius = "mt-radius-0";
		} else
		if($radius_option=="25px"){
			$radius = "mt-radius-25";
		}
	}

	// Post meta
	if ( false == get_theme_mod( 'mt_post_meta_author', true ) ) {
		$body_class .=' remove-pl-author ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_date', true ) ) {
		$body_class .=' remove-pl-date ';
	}
	if ( 4 == get_theme_mod( 'mt_post_meta_cat', 1 ) ) {
		$body_class .=' remove-pl-cat ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_author_post', true ) ) {
		$body_class .=' remove-ps-author ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_author_post_img', true ) ) {
		$body_class .=' remove-ps-author-img ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_date_post', true ) ) {
		$body_class .=' remove-ps-date ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_view_post', true ) ) {
		$body_class .=' remove-ps-view ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_share_post', true ) ) {
		$body_class .=' remove-ps-share ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_share_post_list', true ) ) {
		$body_class .=' remove-pl-share ';
	}
	if ( false == get_theme_mod( 'mt_post_meta_view_post_list', true ) ) {
		$body_class .=' remove-pl-view ';
	}

	if ( true == get_theme_mod( 'mt_menu_full', true ) ) {
		$body_class .=' mt-menu-full ';
	}

	$first_leter = get_post_meta(get_the_ID(), "magazin_first_letter", true);
	if(!empty($first_leter)){
		if ($first_leter=="on") {
			$body_class .= ' mt-fl-on ';
		}
	} else {
		if ( true == get_theme_mod( 'mt_first_letter', false ) ) {
			$body_class .=' mt-fl-on ';
		}
	}

	$body_class .= ' '.$zoom.' '.$radius.' '.$colors;
	$classes[] =  $body_class;
	return $classes;
}

function admin_js() {
    if ( is_admin() ) {
			wp_enqueue_script('magazin-admin', get_template_directory_uri() . '/inc/js/admin.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_footer', 'admin_js');



function magazin_get_shares( $post_id ) {
		$mt_social = get_option( 'socialcountplus_settings');
		$cache_key = 'magazin_share_cache' . $post_id;
		if(isset($mt_social['facebook_app_id']) and isset($mt_social['facebook_app_secret'])) { $facebook_token = $mt_social['facebook_app_id'].'|'.$mt_social['facebook_app_secret']; } else { $facebook_token = ""; }
		$count = get_transient( $cache_key ); // try to get value from Wordpress cache
		$share_time = get_option("share_time");

		if(!empty( $share_time )){ $share_times = $share_time; } else { $share_times = 36000;  }

		if ( $count === false ) {

				$count = "0";
				$response = wp_remote_get('https://graph.facebook.com/v2.7/?id=' . urlencode( get_permalink( $post_id ) ) . '&access_token=' . $facebook_token);

				if(!is_wp_error($response)) {
					if (!empty($response)) {
						$body = json_decode( $response['body'] );
					}

					if (!empty($body->share)) {
			      $count = intval( $body->share->share_count );
			    }

					update_post_meta($post_id, 'magazin_share_count_real', $count);

					set_transient( $cache_key, $count, $share_times ); // store value in cache for a 10 hour
				}

			}

	return $count;

}



function SearchFilter($query) {

	if (!is_admin()) {

		if ($query->is_search) {

			$query->set('post_type', 'post');

		}

		return $query;

	}
}

add_filter('pre_get_posts','SearchFilter');

function do_not_filter_anything( $value ) {
	return $value;
}

add_action('pre_get_posts', 'myprefix_query_offset', 1 );
function myprefix_query_offset(&$query) {

    //Before anything else, make sure this is the right query...
    if ( ! $query->is_category() ) {
        return;
    }

    $offset = 4;
    $option = get_option("magazin_theme_options");
    if(!empty($option['category_grid_style'])) {
    	if($option['category_grid_style']=="1"){
    		$offset = 0;
    	} else if($option['category_grid_style']=="2"){
    		$offset = 2;
    	} else if($option['category_grid_style']=="3"){
    		$offset = 3;
    	}
    }

    $default_posts_per_page = get_option( 'posts_per_page' );

    //First, define your desired offset...
    $offset = $offset;

    //Next, determine how many posts per page you want (we'll use WordPress's settings)
    $ppp = $default_posts_per_page;

    //Next, detect and handle pagination...
    if ( $query->is_paged ) {

        //Manually determine page query offset (offset + current page (minus one) x posts per page)
        $page_offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );

        //Apply adjust page offset
        $query->set('offset', $page_offset );

    }
}

add_filter('found_posts', 'myprefix_adjust_offset_pagination', 1, 2 );
function myprefix_adjust_offset_pagination($found_posts, $query) {

    //Define our offset again...
		$offset = 4;
    $option = get_option("magazin_theme_options");
    if(!empty($option['category_grid_style'])) {
    	if($option['category_grid_style']=="1"){
    		$offset = 0;
    	} else if($option['category_grid_style']=="2"){
    		$offset = 2;
    	} else if($option['category_grid_style']=="3"){
    		$offset = 3;
    	}
    }

    //Ensure we're modifying the right query object...
    if ( $query->is_category() ) {
        //Reduce WordPress's found_posts count by the offset...
        return $found_posts - $offset;
    }
    return $found_posts;
}

function more_post_ajax(){


	if ( false == get_theme_mod( 't_pl_view_post', false ) ) { $t_view_post = esc_html__("View Post", "magazine-plug");  } else { $t_view_post = get_theme_mod( 't_pl_view_post' ); }

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
		$format = (isset($_POST['format'])) ? $_POST['format'] : "all";
		$category = (isset($_POST['category'])) ? $_POST['category'] : "";
		$tag = (isset($_POST['tag'])) ? $_POST['tag'] : "";
		$offset = (isset($_POST['offset'])) ? $_POST['offset'] : "";
		$orderby = (isset($_POST['orderby'])) ? $_POST['orderby'] : "";
		$author = (isset($_POST['author'])) ? $_POST['author'] : "";
		$review_star = (isset($_POST['review_star'])) ? $_POST['review_star'] : "";

		$meta_key = "";

		if($orderby=="popular") { $meta_key = "magazin_post_views_count"; $orderby = "meta_value_num"; }
		if($orderby=="shares") { $meta_key = "meta_value_num"; $orderby = "magazin_share_count_real"; }

		$args = array(
        'suppress_filters' => true,
        'post_type' => 'post',
				'post_status' => 'publish',
        'posts_per_page' => $ppp,
				'category_name'=>$category,
				'tag'=>$tag,
				'author_name'=>$author,
				'orderby'=> $orderby,
				'meta_key' => $meta_key,
				'offset' => $offset,
    );
		if($format=="gallery") {
			$args = array(
	        'suppress_filters' => true,
	        'post_type' => 'post',
					'post_status' => 'publish',
	        'posts_per_page' => $ppp,
					'category_name'=>$category,
					'tag'=>$tag,
					'author_name'=>$author,
					'offset' => $offset,
					'orderby'=> $orderby,
					'meta_key' => $meta_key,
					'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'field'    => 'slug',
								'terms' => array( 'post-format-gallery' ),
							),
						),
	    );
		}

		if($format=="posts") {
			$args = array(
	        'suppress_filters' => true,
	        'post_type' => 'post',
					'post_status' => 'publish',
	        'posts_per_page' => $ppp,
					'category_name'=>$category,
					'offset' => $offset,
					'author_name'=>$author,
					'orderby'=> $orderby,
					'tag'=>$tag,
					'meta_key' => $meta_key,
					'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field'    => 'slug',
							'terms' => array( 'post-format-gallery', 'post-format-video' ),
							'operator' => 'NOT IN'
						),
					),
	    );
		}

		if($format=="video") {
			$args = array(
	        'suppress_filters' => true,
	        'post_type' => 'post',
					'post_status' => 'publish',
	        'posts_per_page' => $ppp,
					'category_name'=>$category,
					'offset' => $offset,
					'author_name'=>$author,
					'orderby'=> $orderby,
					'tag'=>$tag,
					'meta_key' => $meta_key,
					'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'field'    => 'slug',
								'terms' => array( 'post-format-video' ),
							),
						),
	    );
		}

    $loop = new WP_Query($args);

    $shortcode = '';

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();


		$icon = '';
		if ( has_post_format( 'video' ) ) { $icon .='<span class="video-icon mt-theme-background"></span>'; }
		else if ( has_post_format( 'gallery' ) ) { $icon .='<span class="video-icon mt-theme-background gallery-icon"></span>'; }
		else { $icon .='<span class="post-icon mt-theme-background"><i class="ic-open open"></i></span>'; }

		// Shortcode
		$shortcode .='<div class="poster normal size-350'; if (!has_post_thumbnail()) { $shortcode .= ' img-empty'; } if (has_post_format( 'video' )) { $shortcode .= ' video'; } $shortcode .='">';
		if ( has_post_thumbnail() ) {
			$shortcode .='<a class="poster-image mt-radius pull-left" href="'. get_permalink().'">';
				$shortcode .= $icon;
				$shortcode .='<div class="mt-post-image" ><img src="'. get_the_post_thumbnail_url(get_the_ID(),'magazin_550').'" width="550" height="550" /></div>';
				$shortcode .='<div class="poster-info">'; $shortcode .= mt_pl_categories(); $shortcode .= mt_pl_views_shares(); $shortcode .='</div>';
			$shortcode .='</a>';
		}
			$shortcode .='<div class="poster-content">';
			if ($review_star!="off") { $shortcode .= mt_review_star(); }
				$shortcode .= mt_pl_categories();
				$shortcode .= mt_pl_views_shares();
				$shortcode .='<a href="'. get_permalink().'"><h2>'. get_the_title() .'</h2></a>';
				$shortcode .='<small class="mt-pl"><strong class="mt-pl-a">'. get_the_author_meta( "display_name" ) .'</strong><span class="color-silver-light mt-ml"> - </span><span class="color-silver-light mt-pl-d">'. esc_attr( get_the_date('M d, Y') ) .'</span></small>';
				$shortcode .='<p>'.mt_pl_excerpt_tabs().'</p>';
				$shortcode .='<div class="hidden mt-readmore"><a class="mt-readmore-url" href="'. get_permalink().'">'. esc_html($t_view_post) .'</a></div>';
			$shortcode .='</div>';
			$shortcode .='<div class="clearfix"></div>';
		$shortcode .='</div>';

    endwhile;
		wp_reset_postdata();
    endif;
    die($shortcode);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

function remove_caption_extra_width($width) {
   return $width - 10;
}
add_filter('img_caption_shortcode_width', 'remove_caption_extra_width');

function magazin_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'magazin_javascript_detection', 0 );

function modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['twitter'] = 'Twitter URL';
	$profile_fields['facebook'] = 'Facebook URL';
	$profile_fields['gplus'] = 'Google+ URL';
	$profile_fields['instagram'] = 'Instagram URL';
	$profile_fields['linkedin'] = 'LinkedIn URL';
	$profile_fields['pinterest'] = 'Pinterest URL';
	$profile_fields['youtube'] = 'YouTube URL';
	$profile_fields['dribbble'] = 'Dribbble URL';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

function review_type(){
	$review_type = get_post_meta(get_the_ID(), "magazin_review_type", true);
	return $review_type;
}
function mt_review_star(){
	$star = "";
	if ( true == get_theme_mod( 'mt_post_meta_review_star', true ) ) {

	  $star .= mt_review_stars();

	}
	return $star;
}

function mt_review_single(){
	$review_type = get_post_meta(get_the_ID(), "magazin_review_type", true);
	$review_head = get_post_meta(get_the_ID(), "magazin_review_head", true);
	$review_decs = get_post_meta(get_the_ID(), "magazin_review_decs", true);
	$review_btn_url = get_post_meta(get_the_ID(), "magazin_review_btn_url", true);
	$review_btn_name = get_post_meta(get_the_ID(), "magazin_review_btn_name", true);
	$review_group = get_post_meta(get_the_ID(), "magazin_review_group", true);
	$star = "";

	if ( $review_type == "star" ) {

		$star .= '<div class="mt-review">';

		if(!empty($review_head)){ $star .= '<h2 class="heading heading-left"><span>'.$review_head.'</span></h2>'; }

			foreach ( (array) $review_group as $key => $entry ) {
				if ( !empty( $entry['number'] ) and !empty( $entry['name'] ) ) {
					$star .= '<div class="mt-review-field">';
						$star .= '<div class="mt-review-field-name pull-left">';
							$star .= $entry['name'];
						$star .= '</div>';
						$result = $entry['number'];

						$star1 = $star2 = $star3 = $star4 = $star5 = "mt-star-full";
						if($result<="4.74") { $star5="mt-star-half";
						if($result<="4.24") { $star5="mt-star-not";
						if($result<="3.74") { $star4="mt-star-half"; $star5="mt-star-not";
						if($result<="3.24") { $star4=$star5="mt-star-not";
						if($result<="2.74") { $star3="mt-star-half"; $star4=$star5="mt-star-not";
						if($result<="2.24") { $star3=$star4=$star5="mt-star-not";
						if($result<="1.74") { $star2="mt-star-half"; $star3=$star4=$star5="mt-star-not";
						if($result<="1.24") { $star2=$star3=$star4=$star5="mt-star-not";
						if($result<="0.74") { $star1="mt-star-half"; $star2=$star3=$star4=$star5="mt-star-not"; }}}}}}}}}

						$star .= '<div class="mt-stars pull-right">';
							$star .='<div class="mt-star '.$star1.'"></div>';
							$star .='<div class="mt-star '.$star2.'"></div>';
							$star .='<div class="mt-star '.$star3.'"></div>';
							$star .='<div class="mt-star '.$star4.'"></div>';
							$star .='<div class="mt-star '.$star5.'"></div>';
						$star .= '</div>';
						$star .= '<div class="clearfix"></div>';
					$star .= '</div>';
				}
			}
			$star .= '<div class="mt-review-info">';
				$star .= '<div class="mt-review-desc pull-left">';
					if(!empty($review_decs)){ $star .= '<p>'.$review_decs.'</p>'; }
					if(!empty($review_btn_name) and !empty($review_btn_url)){ $star .= '<a href="'.$review_btn_url.'">'.$review_btn_name.'</a>'; }
				$star .= '</div>';
				$star .= '<div class="mt-review-all-stars pull-right">';
					$star .= '<h5>'.mt_review_numbers().'/5</h5>';
					$star .= mt_review_stars();
				$star .= '</div>';
				$star .= '<div class="clearfix"></div>';
			$star .= '</div>';
		$star .= '</div>';
	}
	return $star;
}

function mt_review_stars(){
	$review_type = get_post_meta(get_the_ID(), "magazin_review_type", true);
	$review_group = get_post_meta(get_the_ID(), "magazin_review_group", true);

	$star = "";


		if ( $review_type == "star" ) {

			$sum = 0; foreach ( (array) $review_group as $key => $entry ) { if ( !empty( $entry['number'] ) ) { $sum+= $entry['number']; } } $result = $sum/count($review_group); $result = substr($result, 0, 4);
			$star1 = $star2 = $star3 = $star4 = $star5 = "mt-star-full";
			if($result<="4.74") { $star5="mt-star-half";
			if($result<="4.24") { $star5="mt-star-not";
			if($result<="3.74") { $star4="mt-star-half"; $star5="mt-star-not";
			if($result<="3.24") { $star4=$star5="mt-star-not";
			if($result<="2.74") { $star3="mt-star-half"; $star4=$star5="mt-star-not";
			if($result<="2.24") { $star3=$star4=$star5="mt-star-not";
			if($result<="1.74") { $star2="mt-star-half"; $star3=$star4=$star5="mt-star-not";
			if($result<="1.24") { $star2=$star3=$star4=$star5="mt-star-not";
			if($result<="0.74") { $star1="mt-star-half"; $star2=$star3=$star4=$star5="mt-star-not"; }}}}}}}}}

			$star .= '<div class="mt-stars">';
				$star .='<div class="mt-star '.$star1.'"></div>';
				$star .='<div class="mt-star '.$star2.'"></div>';
				$star .='<div class="mt-star '.$star3.'"></div>';
				$star .='<div class="mt-star '.$star4.'"></div>';
				$star .='<div class="mt-star '.$star5.'"></div>';
			$star .= '</div>';
		}

	return $star;
}

function mt_review_numbers(){
	$review_type = get_post_meta(get_the_ID(), "magazin_review_type", true);
	$review_group = get_post_meta(get_the_ID(), "magazin_review_group", true);
	$result = "";
		if ( $review_type != "" ) {

			$sum = 0; foreach ( (array) $review_group as $key => $entry ) { if ( !empty( $entry['number'] ) ) { $sum+= $entry['number']; } } $result = $sum/count($review_group); $result = substr($result, 0, 4);
		}

	return $result;
}

function mt_review_title() {
	$review_type = get_post_meta(get_the_ID(), "magazin_review_type", true);
	if ( false == get_theme_mod( 't_review_score', false ) ) { $our_score = esc_html__("Our score:", "magazine-plug");  } else { $our_score = get_theme_mod( 't_review_score' ); }
	$review = "";
	if ( $review_type != "" ) {
		$review .= '<div class="mt-single-title-score"><span>'. esc_html($our_score) .'</span>'. mt_review_stars() .'<span>'. mt_review_numbers() .'/5</span></div>';
	}
	return $review;
}

function mt_ad_footer(){
	if ( true == get_theme_mod( 'mt_footer_ad', true ) ) {
		$optionz = get_option("magazin_theme_options");
		if (!empty($optionz['article_ad_bottom'])) {  ?><div class="advertise text-center"> <?php echo do_shortcode(html_entity_decode($optionz['article_ad_bottom'])); ?> </div> <?php }
	}
}

function mt_header_ad_top(){
		$optionz = get_option("magazin_theme_options");
		if (!empty($optionz['header_ad_top'])) {  ?><div class="text-center"> <?php echo do_shortcode(html_entity_decode($optionz['header_ad_top'])); ?> </div>  <?php }
}

function mt_header_ad_menu(){
		$optionz = get_option("global_theme_options");
		if (!empty($optionz['header_ad_menu'])) {  ?><?php echo do_shortcode(html_entity_decode($optionz['header_ad_menu'])); ?> <?php }
}

function mt_article_ad_top(){
		$optionz = get_option("magazin_theme_options");
		if (!empty($optionz['article_ad_top'])) {  ?><div class="advertise text-center"> <?php echo do_shortcode(html_entity_decode($optionz['article_ad_top'])); ?> </div> <?php }
}

function mt_article_ad_bottom(){
		$optionz = get_option("magazin_theme_options");
		if (!empty($optionz['article_ad_bottom'])) {  ?><div class="advertise text-center"> <?php echo do_shortcode(html_entity_decode($optionz['article_ad_bottom'])); ?> </div> <?php }
}

function mt_sidebar_ad_top(){
		$optionz = get_option("magazin_theme_options");
		if (!empty($optionz['sidebar_ad_top'])) {  ?><div class="advertise text-center"> <?php echo do_shortcode(html_entity_decode($optionz['sidebar_ad_top'])); ?> </div> <?php }
}

function mt_sidebar_ad_middle(){
		$optionz = get_option("magazin_theme_options");
		if (!empty($optionz['sidebar_ad_middle'])) {  ?><div class="advertise text-center"> <?php echo do_shortcode(html_entity_decode($optionz['sidebar_ad_middle'])); ?> </div> <?php }
}

function mt_sidebar_ad_bottom(){
		$optionz = get_option("magazin_theme_options");
		if (!empty($optionz['sidebar_ad_bottom'])) {  ?><div class="advertise text-center"> <?php echo do_shortcode(html_entity_decode($optionz['sidebar_ad_bottom'])); ?> </div> <?php }
}

function mt_weather_funciton(){ ?>

<div class="weather-city hidden"><?php
					if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
						$ip = $_SERVER['HTTP_CLIENT_IP'];
					} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
						$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
					$query = @unserialize(wp_remote_fopen('http://ip-api.com/php/'.$ip));
					if($query && $query['status'] == 'success') {
						echo esc_attr($query['city']);
					} else {
						echo 'London';
					}
				?></div>
				<div class="head-weather">
					<div id="weather"></div>
				</div>
<?php }
function custom_row_style_fields($fields) {
  $fields['sticky_row'] = array(
      'name'        => __('Sticky Sidebar', 'siteorigin-panels'),
      'type'        => 'checkbox',
      'group'       => 'attributes',
      'description' => __('Enabled sticky for columns', 'siteorigin-panels'),
      'priority'    => 1,
  );

  return $fields;
}

add_filter( 'siteorigin_panels_row_style_fields', 'custom_row_style_fields' );

function custom_row_style_attributes( $attributes, $args ) {
    if( !empty( $args['sticky_row'] ) ) {
        array_push($attributes['class'], 'sticky_row');
    }

    return $attributes;
}

add_filter('siteorigin_panels_row_style_attributes', 'custom_row_style_attributes', 10, 2);


function mt_share_top(){
	$share_top = "";
	$share_top = get_post_meta(get_the_ID(), "magazin_post_share_top", true);
	$option = get_option("xnews_theme_options");
	$optionz = get_option("magazin_theme_options");
	$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
	if ( false == get_theme_mod( 't_p_share_on_facebook', false ) ) { $t_p_share_on_facebook = esc_html__("Share on Facebook", "xnews");  } else { $t_p_share_on_facebook = get_theme_mod( 't_p_share_on_facebook' ); }
	if ( false == get_theme_mod( 't_p_share_on_twitter', false ) ) { $t_p_share_on_twitter = esc_html__("Tweet on Twitter", "xnews");  } else { $t_p_share_on_twitter = get_theme_mod( 't_p_share_on_twitter' ); }
	if($share_top == "no"){} else if($share_top == "yes"){ ?>
	  <ul class="share top">
	    <li class="share-facebook"><a class="mt-radius" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><span><?php echo esc_html($t_p_share_on_facebook); ?></span></a></li>
	    <?php $input = get_the_title().' '.get_the_permalink(); $title = str_replace( ' ', '+', $input ); ?>
	    <li class="share-twitter"><a class="mt-radius" href="http://twitter.com/home/?status=<?php echo esc_attr($title); ?>" target="_blank"><span><?php echo esc_html($t_p_share_on_twitter); ?></span></a></li>
	    <li class="share-more">
	      <div class="share-more-wrap"><div class="share-more-icon mt-radius">+</div></div>
	      <a class="mt-radius" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo esc_url($url); ?>" target="_blank"><div class="pinterest mt-radius-b"></div></a>
	      <a class="mt-radius" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank"><div class="google mt-radius-b"></div></a>
	    </li>
	  </ul>
	<?php } else if ( true == get_theme_mod( 'mt_post_top_share', true ) ) {  ?>
	  <ul class="share top">
	    <li class="share-facebook"><a class="mt-radius" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><span><?php echo esc_html($t_p_share_on_facebook); ?></span></a></li>
	    <?php $input = get_the_title().' '.get_the_permalink(); $title = str_replace( ' ', '+', $input ); ?>
	    <li class="share-twitter"><a class="mt-radius" href="http://twitter.com/home/?status=<?php echo esc_attr($title); ?>" target="_blank"><span><?php echo esc_html($t_p_share_on_twitter); ?></span></a></li>
	    <li class="share-more">
	      <div class="share-more-wrap"><div class="share-more-icon mt-radius">+</div></div>
	      <a class="mt-radius" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo esc_url($url); ?>" target="_blank"><div class="pinterest mt-radius-b"></div></a>
	      <a class="mt-radius" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank"><div class="google mt-radius-b"></div></a>
	    </li>
	  </ul>
	<?php }
}

function mt_share_bottom(){
	$option = get_option("xnews_theme_options");
	$optionz = get_option("magazin_theme_options");
	$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));
	$share_bottom = "";
	$share_bottom = get_post_meta(get_the_ID(), "magazin_post_share_bottom", true);
	if ( false == get_theme_mod( 't_p_share_on_facebook', false ) ) { $t_p_share_on_facebook = esc_html__("Share on Facebook", "xnews");  } else { $t_p_share_on_facebook = get_theme_mod( 't_p_share_on_facebook' ); }
	if ( false == get_theme_mod( 't_p_share_on_twitter', false ) ) { $t_p_share_on_twitter = esc_html__("Tweet on Twitter", "xnews");  } else { $t_p_share_on_twitter = get_theme_mod( 't_p_share_on_twitter' ); }
	if($share_bottom == "no"){} else if($share_bottom == "yes"){ ?>
	<ul class="share down">
		<li class="share-facebook"><a class="mt-radius" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><span><?php echo esc_html($t_p_share_on_facebook); ?></span></a></li>
		<?php $input = get_the_title().' '.get_the_permalink(); $title = str_replace( ' ', '+', $input ); ?>
		<li class="share-twitter"><a class="mt-radius" href="http://twitter.com/home/?status=<?php echo esc_attr($title); ?>" target="_blank"><span><?php echo esc_html($t_p_share_on_twitter); ?></span></a></li>
		<li class="share-more">
			<a class="mt-radius" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank"><div class="google mt-radius-b"></div></a>
			<a class="mt-radius" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo esc_url($url); ?>" target="_blank"><div class="pinterest mt-radius-b"></div></a>
			<div class="share-more-wrap"><div class="share-more-icon mt-radius">+</div></div>
		</li>
	</ul>
	<?php } else if ( true == get_theme_mod( 'mt_post_bottom_share', true ) ) {  ?>
		<ul class="share down">
			<li class="share-facebook"><a class="mt-radius" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><span><?php echo esc_html($t_p_share_on_facebook); ?></span></a></li>
			<?php $input = get_the_title().' '.get_the_permalink(); $title = str_replace( ' ', '+', $input ); ?>
			<li class="share-twitter"><a class="mt-radius" href="http://twitter.com/home/?status=<?php echo esc_attr($title); ?>" target="_blank"><span><?php echo esc_html($t_p_share_on_twitter); ?></span></a></li>
			<li class="share-more">
				<a class="mt-radius" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank"><div class="google mt-radius-b"></div></a>
				<a class="mt-radius" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo esc_url($url); ?>" target="_blank"><div class="pinterest mt-radius-b"></div></a>
				<div class="share-more-wrap"><div class="share-more-icon mt-radius">+</div></div>
			</li>
		</ul>
	<?php }
}
function rimi_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'Full Demo', 'rimi' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/import/demo1/demo.xml',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/import/demo1/customizer.dat',
						#'import_widget_file_url' => trailingslashit( get_template_directory() ) . 'inc/import/demo1/widget_data.json',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'rimi' ),
						'import_nr'                		 => '1',
        ),
				array(
            'import_file_name'             => esc_html__( 'Only Page Samples', 'rimi' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/import/demo1/pages.xml',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'rimi' ),
						'import_nr'                		 => '2',
        ),
				array(
            'import_file_name'             => esc_html__( 'Only Style', 'rimi' ),
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/import/demo1/customizer.dat',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'rimi' ),
						'import_nr'                		 => '3',
        ),
				array(
            'import_file_name'             => esc_html__( 'Only Page Samples & Style', 'rimi' ),
						'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/import/demo1/pages.xml',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/import/demo1/customizer.dat',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'rimi' ),
						'import_nr'                		 => '4',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'rimi_import_files' );

$theme = wp_get_theme( 'rimi' );
if($theme->exists()){
function magazine_theme_after_import_setup($selected_import) {

	if ( 'Full Demo' === $selected_import['import_file_name'] ) {
	    // Assign menus to their locations.
	    $main_menu = get_term_by( 'name', 'Header', 'nav_menu' );
			$mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
			$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

	    set_theme_mod( 'nav_menu_locations', array(
	            'primary' => $main_menu->term_id,
							'mobile' => $mobile_menu->term_id,
							'footer_menu' => $main_menu->term_id,
	        )
	    );
			wp_delete_post(1);
	    // Assign front page and posts page (blog page).
	    $front_page_id = get_page_by_title( 'Homepage1' );

	    update_option( 'show_on_front', 'page' );
	    update_option( 'page_on_front', $front_page_id->ID );

	}
}
add_action( 'pt-ocdi/after_import', 'function_magazine_theme_after_import_setup' );
}

function ouch_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'ouch Full', 'ouch' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/import/demo1/demo.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/import/demo1/widgets.json',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/import/demo1/customizer.dat',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'ouch' ),
        ),
				array(
            'import_file_name'             => esc_html__( 'ouch - Style & Pages', 'ouch' ),
						'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/import/demo1/pages.xml',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/import/demo1/customizer.dat',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'ouch' ),
        ),
				array(
            'import_file_name'             => esc_html__( 'BoomCraft Full', 'ouch' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/import/demo2/demo.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/import/demo2/widgets.json',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/import/demo2/customizer.dat',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'ouch' ),
        ),
				array(
            'import_file_name'             => esc_html__( 'BoomCraft - Style & Pages', 'ouch' ),
						'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/import/demo2/pages.xml',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/import/demo2/customizer.dat',
            'import_notice'                => esc_html__( 'Customize this theme from Appearance/Customize', 'ouch' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'ouch_import_files' );
$theme = wp_get_theme( 'ouch' );
if($theme->exists()){
function ouch_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Header', 'nav_menu' );
		$mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
		$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
						'mobile' => $mobile_menu->term_id,
						'footer_menu' => $footer_menu->term_id,
        )
    );
		wp_delete_post(1);
    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'News' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ouch_after_import_setup' );
}
?>

<?php

add_shortcode( 'mt_posts_tabs', 'mt_posts_tabs_func' );
	function mt_posts_tabs_func( $atts ) {

        extract(shortcode_atts(array(
            'title' => '',
            'category' => '',
            'orderby' => '',
            'item_nr' => '10',
            'tab_popular' => '',
            'tab_hot' => '',
            'tab_trending' => '',
            'tab_posts' => '',
            'tab_videos' => '',
            'tab_galleries' => '',
        ), $atts));

        $content_ = "[posts_tabs item_nr='$item_nr' orderby='$orderby' category='$category' title='$title' tab_popular='$tab_popular' tab_hot='$tab_hot' tab_trending='$tab_trending' tab_posts='$tab_posts' tab_videos='$tab_videos' tab_galleries='$tab_galleries']";

        return  do_shortcode($content_);

    }

add_action( 'vc_before_init', 'mt_posts_tabs_fields' );
function mt_posts_tabs_fields() {
  vc_map( array(
      "base"        => "mt_posts_tabs",
      "name"        => esc_html__("mt Posts Tabs", "magazin"),
      "class"        => "mt-post-tabs",
      "icon"      => "",
      "category" => "mt Moduls",
      "params"    => array(
        array(
             "type" => "textfield",
             "heading" => esc_html__("Title", "magazin"),
             "param_name" => "title",
             "value" => "",
         ),
      	 array(
              "type" => "textfield",
              "heading" => esc_html__("Item Nr", "magazin"),
              "param_name" => "item_nr",
              "value" => "10",
          ),
          array(
               "type" => "textfield",
               "heading" => esc_html__("Category slug", "magazin"),
               "param_name" => "category",
               "value" => "",
           ),
          array(
              "type" => "dropdown",
              "heading" => esc_html__("OrderBy", "magazin"),
              "param_name" => "orderby",
              "value" => array('Date' => 'date', 'Most Viewed' => 'popular', 'Most Shares' => 'shares', 'Most Comments' => 'comment_count'),
          ),
          array(
              "type" => "dropdown",
              "heading" => esc_html__("Tab: Popular", "magazin"),
              "param_name" => "tab_popular",
              "std" => "disabled",
              "value" => array('Date' => 'date', 'Most Viewed' => 'popular', 'Most Shares' => 'shares', 'Most Comments' => 'comment_count', 'Disabled' => 'off'),
          ),
          array(
              "type" => "dropdown",
              "heading" => esc_html__("Tab: Hot", "magazin"),
              "param_name" => "tab_hot",
              "std" => "disabled",
              "value" => array('Date' => 'date', 'Most Viewed' => 'popular', 'Most Shares' => 'shares', 'Most Comments' => 'comment_count', 'Disabled' => 'off'),
          ),
          array(
              "type" => "dropdown",
              "heading" => esc_html__("Tab: Trending", "magazin"),
              "param_name" => "tab_trending",
              "std" => "disabled",
              "value" => array('Date' => 'date', 'Most Viewed' => 'popular', 'Most Shares' => 'shares', 'Most Comments' => 'comment_count', 'Disabled' => 'off'),
          ),
          array(
              "type" => "dropdown",
              "heading" => esc_html__("Tab: Posts", "magazin"),
              "param_name" => "tab_posts",
              "std" => "enabled",
              "value" => array('Enabled' => 'on', 'Disabled' => 'off'),
          ),
          array(
              "type" => "dropdown",
              "heading" => esc_html__("Tab: Videos", "magazin"),
              "param_name" => "tab_videos",
              "std" => "enabled",
              "value" => array('Enabled' => 'on', 'Disabled' => 'off'),
          ),
          array(
              "type" => "dropdown",
              "heading" => esc_html__("Tab: Galleries", "magazin"),
              "param_name" => "tab_galleries",
              "std" => "enabled",
              "value" => array('Enabled' => 'on', 'Disabled' => 'off'),
          ),

      )
  ));
}

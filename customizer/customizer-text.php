<?php
function magazin_customize_text($wp_customize){

  $wp_customize->add_panel( 'magazin_translate', array(
    'priority'       => 500,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'    	=> esc_html__('Translate', 'magazin'),
    'description'    => '',
  ));

  $wp_customize->add_section('mt_translate_reviews', array(
    'title'    	=> esc_html__('Reviews', 'magazin'),
    'priority'       => 1001,
    'panel'  => 'magazin_translate'
  ));

  $wp_customize->add_section('mt_translate_post_list', array(
   'title'    	=> esc_html__('Post Lists', 'magazin'),
   'priority'       => 501,
   'panel'  => 'magazin_translate'
  ));

  $wp_customize->add_section('mt_translate_subscribe', array(
    'title'    	=> esc_html__('Subscribe Form Widget', 'magazin'),
    'priority'       => 601,
    'panel'  => 'magazin_translate'
  ));

  $wp_customize->add_section('mt_translate_social', array(
    'title'    	=> esc_html__('Social Widget', 'magazin'),
    'priority'       => 701,
    'panel'  => 'magazin_translate'
  ));

  $wp_customize->add_section('mt_translate_pages', array(
    'title'    	=> esc_html__('Pages', 'magazin'),
    'priority'       => 701,
    'panel'  => 'magazin_translate'
  ));

  $wp_customize->add_section('mt_translate_post', array(
    'title'    	=> esc_html__('Post', 'magazin'),
    'priority'       => 801,
    'panel'  => 'magazin_translate'
  ));

  $wp_customize->add_section('mt_translate_comments', array(
    'title'    	=> esc_html__('Comments', 'magazin'),
    'priority'       => 901,
    'panel'  => 'magazin_translate'
  ));

  $wp_customize->add_section('mt_translate_other', array(
    'title'    	=> esc_html__('Other', 'magazin'),
    'priority'       => 1101,
    'panel'  => 'magazin_translate'
  ));

} add_action('customize_register', 'magazin_customize_text');
if ( class_exists( 'Kirki' ) ) {
Kirki::add_field( 't_review_score', array(
 'type'        => 'text',
 'settings'    => 't_review_score',
 'label'       => esc_attr__( 'Our Scores:', 'magazin' ),
 'section'     => 'mt_translate_reviews',
));

Kirki::add_field( 't_pl_view_post', array(
  'type'        => 'text',
  'settings'    => 't_pl_view_post',
  'label'       => esc_attr__( 'View Post', 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_read_more', array(
  'type'        => 'text',
  'settings'    => 't_pl_read_more',
  'label'       => esc_attr__( 'Read More', 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_load_more_posts', array(
  'type'        => 'text',
  'settings'    => 't_pl_load_more_posts',
  'label'       => esc_attr__( 'Load More Posts', 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_congratulations', array(
  'type'        => 'text',
  'settings'    => 't_pl_congratulations',
  'label'       => esc_attr__( "Congratulations, you've reached all posts.", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_galleries', array(
  'type'        => 'text',
  'settings'    => 't_pl_galleries',
  'label'       => esc_attr__( "Galleries", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_videos', array(
  'type'        => 'text',
  'settings'    => 't_pl_videos',
  'label'       => esc_attr__( "Videos", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_posts', array(
  'type'        => 'text',
  'settings'    => 't_pl_posts',
  'label'       => esc_attr__( "Posts", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));

Kirki::add_field( 't_pl_popular', array(
  'type'        => 'text',
  'settings'    => 't_pl_popular',
  'label'       => esc_attr__( "Popular", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_hot', array(
  'type'        => 'text',
  'settings'    => 't_pl_hot',
  'label'       => esc_attr__( "Hot", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_trending', array(
  'type'        => 'text',
  'settings'    => 't_pl_trending',
  'label'       => esc_attr__( "Trending", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_all', array(
  'type'        => 'text',
  'settings'    => 't_pl_all',
  'label'       => esc_attr__( "All", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_shares', array(
  'type'        => 'text',
  'settings'    => 't_pl_shares',
  'label'       => esc_attr__( "shares", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_pl_views', array(
  'type'        => 'text',
  'settings'    => 't_pl_views',
  'label'       => esc_attr__( "views", 'magazin' ),
  'section'     => 'mt_translate_post_list',
));
Kirki::add_field( 't_s_get_the_best', array(
  'type'        => 'text',
  'settings'    => 't_s_get_the_best',
  'label'       => esc_attr__( "Get the best viral stories straight into your inbox!", 'magazin' ),
  'section'     => 'mt_translate_subscribe',
));
Kirki::add_field( 't_s_get_the_best', array(
  'type'        => 'text',
  'settings'    => 't_s_your_email_address',
  'label'       => esc_attr__( "Your email adress", 'magazin' ),
  'section'     => 'mt_translate_subscribe',
));
Kirki::add_field( 't_s_sign_up', array(
  'type'        => 'text',
  'settings'    => 't_s_sign_up',
  'label'       => esc_attr__( "Sign Up", 'magazin' ),
  'section'     => 'mt_translate_subscribe',
));
Kirki::add_field( 't_s_spam', array(
  'type'        => 'text',
  'settings'    => 't_s_spam',
  'label'       => esc_attr__( "Don't worry, we don't spam", 'magazin' ),
  'section'     => 'mt_translate_subscribe',
));
Kirki::add_field( 't_s_follow', array(
  'type'        => 'text',
  'settings'    => 't_s_follow',
  'label'       => esc_attr__( "Follow us on", 'magazin' ),
  'section'     => 'mt_translate_social',
));
Kirki::add_field( 't_s_subscribe', array(
  'type'        => 'text',
  'settings'    => 't_s_subscribe',
  'label'       => esc_attr__( "Subscribe us on", 'magazin' ),
  'section'     => 'mt_translate_social',
));
Kirki::add_field( 't_p_tag', array(
  'type'        => 'text',
  'settings'    => 't_p_tag',
  'label'       => esc_attr__( "Tag", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_nothing_found', array(
  'type'        => 'text',
  'settings'    => 't_p_nothing_found',
  'label'       => esc_attr__( "Nothing Found", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_apologies', array(
  'type'        => 'text',
  'settings'    => 't_p_apologies',
  'label'       => esc_attr__( "Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_to_search', array(
  'type'        => 'text',
  'settings'    => 't_p_to_search',
  'label'       => esc_attr__( "Type and hit enter to search ...", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_permalink_to', array(
  'type'        => 'text',
  'settings'    => 't_p_permalink_to',
  'label'       => esc_attr__( "Permalink to", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_search_result_for', array(
  'type'        => 'text',
  'settings'    => 't_p_search_result_for',
  'label'       => esc_attr__( "Search Results for:", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_sorry_search', array(
  'type'        => 'text',
  'settings'    => 't_p_sorry_search',
  'label'       => esc_attr__( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_last_rumor', array(
  'type'        => 'text',
  'settings'    => 't_p_last_rumor',
  'label'       => esc_attr__( "Last Rumor:", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_pages', array(
  'type'        => 'text',
  'settings'    => 't_p_pages',
  'label'       => esc_attr__( "Pages:", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_category', array(
  'type'        => 'text',
  'settings'    => 't_p_category',
  'label'       => esc_attr__( "Category", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_page', array(
  'type'        => 'text',
  'settings'    => 't_p_page',
  'label'       => esc_attr__( "Page", 'magazin' ),
  'section'     => 'mt_translate_pages',
));
Kirki::add_field( 't_p_featured_post', array(
  'type'        => 'text',
  'settings'    => 't_p_featured_post',
  'label'       => esc_attr__( "Featured Post", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_trending_posts', array(
  'type'        => 'text',
  'settings'    => 't_p_trending_posts',
  'label'       => esc_attr__( "Trending Posts", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_our_picks', array(
  'type'        => 'text',
  'settings'    => 't_p_our_picks',
  'label'       => esc_attr__( "Our Picks", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_most_popular', array(
  'type'        => 'text',
  'settings'    => 't_p_most_popular',
  'label'       => esc_attr__( "Most Popular", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_shares', array(
  'type'        => 'text',
  'settings'    => 't_p_shares',
  'label'       => esc_attr__( "Shares", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_views', array(
  'type'        => 'text',
  'settings'    => 't_p_views',
  'label'       => esc_attr__( "Views", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_share_on_facebook', array(
  'type'        => 'text',
  'settings'    => 't_p_share_on_facebook',
  'label'       => esc_attr__( "Share on Facebook", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_share_on_twitter', array(
  'type'        => 'text',
  'settings'    => 't_p_share_on_twitter',
  'label'       => esc_attr__( "Tweet on Twitter", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_share_post', array(
  'type'        => 'text',
  'settings'    => 't_p_share_post',
  'label'       => esc_attr__( "Share Post", 'magazin' ),
  'section'     => 'mt_translate_post',
));

Kirki::add_field( 't_p_read_more', array(
  'type'        => 'text',
  'settings'    => 't_p_read_more',
  'label'       => esc_attr__( "Read More:", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_previous_article', array(
  'type'        => 'text',
  'settings'    => 't_p_previous_article',
  'label'       => esc_attr__( "Previous article", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_next_article', array(
  'type'        => 'text',
  'settings'    => 't_p_next_article',
  'label'       => esc_attr__( "Next article", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_may_be_intrested', array(
  'type'        => 'text',
  'settings'    => 't_p_may_be_intrested',
  'label'       => esc_attr__( "You may be interested", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_most_from_this_cat', array(
  'type'        => 'text',
  'settings'    => 't_p_most_from_this_cat',
  'label'       => esc_attr__( "Most from this category", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_view_all_posts_by', array(
  'type'        => 'text',
  'settings'    => 't_p_view_all_posts_by',
  'label'       => esc_attr__( "View all posts by", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_older_posts', array(
  'type'        => 'text',
  'settings'    => 't_p_older_posts',
  'label'       => esc_attr__( "Older posts", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_newer_posts', array(
  'type'        => 'text',
  'settings'    => 't_p_newer_posts',
  'label'       => esc_attr__( "Newer posts", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_p_posted_on', array(
  'type'        => 'text',
  'settings'    => 't_p_posted_on',
  'label'       => esc_attr__( "Posted on", 'magazin' ),
  'section'     => 'mt_translate_post',
));
Kirki::add_field( 't_c_comments', array(
  'type'        => 'text',
  'settings'    => 't_c_comments',
  'label'       => esc_attr__( "Comments", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_one_comment', array(
  'type'        => 'text',
  'settings'    => 't_c_one_comment',
  'label'       => esc_attr__( "One Comment", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_comments_passowrd', array(
  'type'        => 'text',
  'settings'    => 't_c_comments_passowrd',
  'label'       => esc_attr__( "This post is password protected. Enter the password to view and post comments.", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_name', array(
  'type'        => 'text',
  'settings'    => 't_c_name',
  'label'       => esc_attr__( "Name", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_email', array(
  'type'        => 'text',
  'settings'    => 't_c_email',
  'label'       => esc_attr__( "Email", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_website', array(
  'type'        => 'text',
  'settings'    => 't_c_website',
  'label'       => esc_attr__( "Website", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_email_not_publish', array(
  'type'        => 'text',
  'settings'    => 't_c_email_not_publish',
  'label'       => esc_attr__( "Your email address will not be published.", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_leave_a_comment', array(
  'type'        => 'text',
  'settings'    => 't_c_leave_a_comment',
  'label'       => esc_attr__( "Leave a Comment", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_leave_a_reply_to', array(
  'type'        => 'text',
  'settings'    => 't_c_leave_a_reply_to',
  'label'       => esc_attr__( "Leave a Reply to", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_submit_comment', array(
  'type'        => 'text',
  'settings'    => 't_c_submit_comment',
  'label'       => esc_attr__( "Submit Comment", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_older_comments', array(
  'type'        => 'text',
  'settings'    => 't_c_older_comments',
  'label'       => esc_attr__( "Older Comments", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_newer_comments', array(
  'type'        => 'text',
  'settings'    => 't_c_newer_comments',
  'label'       => esc_attr__( "Newer Comments", 'magazin' ),
  'section'     => 'mt_translate_comments',
));

Kirki::add_field( 't_c_you_must_be', array(
  'type'        => 'text',
  'settings'    => 't_c_you_must_be',
  'label'       => esc_attr__( "You must be", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_logged_in', array(
  'type'        => 'text',
  'settings'    => 't_c_logged_in',
  'label'       => esc_attr__( "logged in", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_to_post_a_comment', array(
  'type'        => 'text',
  'settings'    => 't_c_to_post_a_comment',
  'label'       => esc_attr__( "to post a comment.", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_loged_in_as', array(
  'type'        => 'text',
  'settings'    => 't_c_loged_in_as',
  'label'       => esc_attr__( "Logged in as", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_log_out', array(
  'type'        => 'text',
  'settings'    => 't_c_log_out',
  'label'       => esc_attr__( "Log out?", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_log_out_of_this', array(
  'type'        => 'text',
  'settings'    => 't_c_log_out_of_this',
  'label'       => esc_attr__( "Log out of this account", 'magazin' ),
  'section'     => 'mt_translate_comments',
));

Kirki::add_field( 't_c_edit', array(
  'type'        => 'text',
  'settings'    => 't_c_edit',
  'label'       => esc_attr__( "Edit", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_reply', array(
  'type'        => 'text',
  'settings'    => 't_c_reply',
  'label'       => esc_attr__( "Reply", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_comment_awaiting_moteration', array(
  'type'        => 'text',
  'settings'    => 't_c_comment_awaiting_moteration',
  'label'       => esc_attr__( "Your comment is awaiting moderation.", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_c_at', array(
  'type'        => 'text',
  'settings'    => 't_c_at',
  'label'       => esc_attr__( "at", 'magazin' ),
  'section'     => 'mt_translate_comments',
  'description' => '2017-07-20 at 3:09 pm'
));
Kirki::add_field( 't_c_pingback', array(
  'type'        => 'text',
  'settings'    => 't_c_pingback',
  'label'       => esc_attr__( "Pingback:", 'magazin' ),
  'section'     => 'mt_translate_comments',
));
Kirki::add_field( 't_o_followers', array(
  'type'        => 'text',
  'settings'    => 't_o_followers',
  'label'       => esc_attr__( "Followers", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_latest', array(
  'type'        => 'text',
  'settings'    => 't_o_latest',
  'label'       => esc_attr__( "LATEST", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_popular', array(
  'type'        => 'text',
  'settings'    => 't_o_popular',
  'label'       => esc_attr__( "POPULAR", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_hot', array(
  'type'        => 'text',
  'settings'    => 't_o_hot',
  'label'       => esc_attr__( "HOT", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_trending', array(
  'type'        => 'text',
  'settings'    => 't_o_trending',
  'label'       => esc_attr__( "TRENDING", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_posts', array(
  'type'        => 'text',
  'settings'    => 't_o_posts',
  'label'       => esc_attr__( "Posts", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_about_us', array(
  'type'        => 'text',
  'settings'    => 't_o_about_us',
  'label'       => esc_attr__( "About Us", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_follow_us', array(
  'type'        => 'text',
  'settings'    => 't_o_follow_us',
  'label'       => esc_attr__( "Follow Us", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_contact_us', array(
  'type'        => 'text',
  'settings'    => 't_o_contact_us',
  'label'       => esc_attr__( "Contact Us:", 'magazin' ),
  'section'     => 'mt_translate_other',
));
Kirki::add_field( 't_o_all', array(
  'type'        => 'text',
  'settings'    => 't_o_all',
  'label'       => esc_attr__( "All", 'magazin' ),
  'section'     => 'mt_translate_other',
));
}
?>

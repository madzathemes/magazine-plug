<?php
function magazin_customize_ads($wp_customize){

  $wp_customize->add_panel( 'magazin_ads', array(
    'priority'       => 310,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'    	=> esc_html__('Ads', 'magazin'),
    'description'    => '',
  ));

  $wp_customize->add_section('bg_ad_top', array(
  'title'    	=> esc_html__('Background ad', 'magazin'),
  'priority' => 1,
  'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('sidebar_ad_top', array(
    'title'    	=> esc_html__('Sidebar top ad', 'magazin'),
    'priority' => 5,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('sidebar_ad_middle', array(
    'title'    	=> esc_html__('Sidebar middle ad', 'magazin'),
    'priority' => 6,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('sidebar_ad_bottom', array(
    'title'    	=> esc_html__('Sidebar bottom ad', 'magazin'),
    'priority' => 7,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('article_ad_top', array(
    'title'    	=> esc_html__('Article top ad', 'boomnews'),
    'priority' => 8,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('article_ad_bottom', array(
    'title'    	=> esc_html__('Article bottom ad', 'magazin'),
    'priority' => 8,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('footer_ad_top', array(
    'title'    	=> esc_html__('Footer top ad', 'magazin'),
    'priority' => 9,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_1', array(
    'title'    	=> esc_html__('Custom ad 1', 'magazin'),
    'priority' => 11,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_2', array(
    'title'    	=> esc_html__('Custom ad 2', 'magazin'),
    'priority' => 12,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_3', array(
    'title'    	=> esc_html__('Custom ad 3', 'magazin'),
    'priority' => 13,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_4', array(
    'title'    	=> esc_html__('Custom ad 4', 'magazin'),
    'priority' => 14,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_5', array(
    'title'    	=> esc_html__('Custom ad 5', 'magazin'),
    'priority' => 15,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_6', array(
    'title'    	=> esc_html__('Custom ad 6', 'magazin'),
    'priority' => 16,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_7', array(
    'title'    	=> esc_html__('Custom ad 7', 'magazin'),
    'priority' => 17,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_8', array(
    'title'    	=> esc_html__('Custom ad 8', 'magazin'),
    'priority' => 18,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('custom_ad_9', array(
    'title'    	=> esc_html__('Custom ad 9', 'magazin'),
    'priority' => 19,
    'panel'  => 'magazin_ads',
  ));

  $wp_customize->add_section('header_ad_top', array(
    'title'    	=> esc_html__('Header Ad Top', 'magazin'),
    'priority' => 1,
    'panel'  => 'magazin_ads',
  ));




}


add_action('customize_register', 'magazin_customize_ads');
if ( class_exists( 'Kirki' ) ) {

function mytheme_kirki_fields__( $fields ) {

  $fields[] =  array(
    'type'        => 'background',
    'settings'    => 'magazin_bg_ad',
    'label'       => esc_attr__( 'Add Background', 'magazin' ),
    'section'     => 'bg_ad_top',
    'priority'    => 2,
    'default'     => array(
            'color'    => 'rgba(25,170,141,0.7)',
            'image'    => '',
            'repeat'   => 'no-repeat',
            'size'     => 'cover',
            'attach'   => 'fixed',
            'position' => 'center-bottom',
        ),
        'output'      => array(
          array(
            'element' => '.background-ad',
            'suffix'   => ' !important',
          ),
        ),
  );

  $fields[] =  array(
    'type'        => 'text',
    'settings'    => 'magazin_bg_ad_url',
    'label'       => esc_attr__( 'URL', 'magazin' ),
    'section'     => 'bg_ad_top',
    'priority'    => 1,

  );
  $fields[] =  array(
    'type'        => 'spacing',
    'settings'    => 'magazin_bg_ad_space',
    'label'       => esc_attr__( 'Top & Bottom Space', 'magazin' ),
    'section'     => 'bg_ad_top',
    'priority'    => 1,
    'default'     => array(
  		'top'    => '0px',
  		'bottom' => '0px',
  	),

  );


  return $fields;
}
add_filter( 'kirki/fields', 'mytheme_kirki_fields__' );

Kirki::add_field( 'magazin_theme_options[sidebar_ad_top]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[sidebar_ad_top]',
  'label'       => esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'sidebar_ad_top',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[sidebar_ad_middle]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[sidebar_ad_middle]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'sidebar_ad_middle',
  'default'     => '',
  'priority'    => 10,
  'option_type' => 'option',
  'sanitize_callback' => 'do_not_filter_anything',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[sidebar_ad_bottom]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[sidebar_ad_bottom]',
  'label'       => esc_html__('YOUR AD CODE', 'magazin' ),
  'section'     => 'sidebar_ad_bottom',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[article_ad_top]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[article_ad_top]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'boomnews' ),
  'section'     => 'article_ad_top',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[article_ad_bottom]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[article_ad_bottom]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'article_ad_bottom',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[footer_ad_top]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[footer_ad_top]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'footer_ad_top',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_1]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_1]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_1',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_2]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_2]',
  'label'       => esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_2',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_3]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_3]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_3',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_4]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_4]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_4',
  'default'     => '',
  'sanitize_callback' => 'do_not_filter_anything',
  'priority'    => 10,
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_5]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_5]',
  'label'       => esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_5',
  'default'     => '',
  'sanitize_callback' => 'do_not_filter_anything',
  'priority'    => 10,
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_6]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_6]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_6',
  'default'     => '',
  'sanitize_callback' => 'do_not_filter_anything',
  'priority'    => 10,
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_7]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_7]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_7',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_8]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_8]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_8',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[custom_ad_9]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[custom_ad_9]',
  'label'       =>  esc_html__('YOUR AD CODE', 'magazin' ),
  'section'     => 'custom_ad_9',
  'default'     => '',
  'priority'    => 10,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));

Kirki::add_field( 'magazin_theme_options[header_ad_top]', array(
  'type'        => 'code',
  'settings'    => 'magazin_theme_options[header_ad_top]',
  'label'       =>  esc_html__( 'YOUR AD CODE', 'magazin' ),
  'section'     => 'header_ad_top',
  'default'     => '',
  'priority'    => 1,
  'sanitize_callback' => 'do_not_filter_anything',
  'option_type' => 'option',
  'choices'     => array(
    'language' => 'css, html, javascript',
    'theme'    => 'monokai',
    'height'   => 250,
  ),
));
}
?>

<?php
/*
Plugin Name: Magazine Plug
Plugin URI: https://themeforest.net
Description: Magazin Plugins
Author: Madars Bitenieks
Version: 4.4.5
Author URI: https://themeforest.net
*/
include_once ('magazin-extras.php');

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'my_setting',
	'label'       => esc_attr__( 'Control Label', 'textdomain' ),
	'section'     => 'section_id',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '14px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#333333',
		'text-transform' => 'none',
		'text-align'     => 'left',
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

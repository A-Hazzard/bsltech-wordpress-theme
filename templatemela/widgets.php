<?php
/*
  Plugin Name: Templatemela Custom Widgets
  Description: Templatemela Default Homepage Slide Show for templatemela WordPress themes.
  Version: 1.0
  Author: Templatemela
  @copyright  Copyright (c) 2010 TemplateMela. 
 */
?>
<?php 
//  Creating Widget 
// Reference : http://codex.wordpress.org/Widgets_API
/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override tmpmela_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 
 * @uses register_sidebar
 */
function tmpmela_register_sidebars() {
	register_sidebar( array(
		'name' => esc_html__( 'Header Shopping Cart Widget Area', 'expend' ),
		'id' => 'header-widget',
		'description' => esc_html__( 'The Cart on header', 'expend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s tab_content">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Header Search Widget Area', 'expend' ),
		'id' => 'header-search',
		'description' => esc_html__( 'The header search widget area', 'expend' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => ' ',
		'after_title' => ' ',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Product Category Widget Area', 'expend' ),
		'id' => 'header-category',
		'description' => esc_html__( 'The Product category widget area', 'expend' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Newsletter Widget Area', 'expend' ),
		'id' => 'footer-newsletter-widget-area',
		'description' => esc_html__( 'The Footer Newsletter widget area', 'expend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'First Footer Widget Area', 'expend' ),
		'id' => 'first-footer-widget-area',
		'description' => esc_html__( 'The first footer widget area', 'expend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Second Footer Widget Area', 'expend' ),
		'id' => 'second-footer-widget-area',
		'description' => esc_html__( 'The second footer widget area', 'expend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Third Footer Widget Area', 'expend' ),
		'id' => 'third-footer-widget-area',
		'description' => esc_html__( 'The third footer widget area', 'expend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Fourth Footer Widget Area', 'expend' ),
		'id' => 'fourth-footer-widget-area',
		'description' => esc_html__( 'The fourth footer widget area', 'expend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Footer Payment Method Widget Area', 'expend' ),
		'id' => 'footer-bottom-widget-area',
		'description' => esc_html__( 'The Footer Payment Method widget area', 'expend' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
}
/**
 * Register sidebars by running tmpmela_widgets_init() on the widgets_init hook. 
 */
add_action( 'widgets_init', 'tmpmela_register_sidebars' );
get_template_part('templatemela/widgets/tmpmela-follow-us');
get_template_part('templatemela/widgets/tmpmela-static-links');
get_template_part('templatemela/widgets/tmpmela-left-banner');
get_template_part('templatemela/widgets/tmpmela-advance-search');
get_template_part('templatemela/widgets/tmpmela-footer-aboutus');
?>
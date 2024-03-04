<?php echo get_template_directory_uri(); ?>
wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.min.css');
add_action('wp_enqueue_scripts','su_magajobe_css_and_js');
wp_enqueue_script('all',get_template_directory_uri().'/js/all.js',array('jquery','bootstrap'));
<?php wp_footer(); ?>
<?php

	wp_nav_menu(array(
		'menu' =>'main-menu',
		'menu_class' => 'nav navbar-nav'	
		
	));


?>
<?php wp_head();?>
<?php get_header();?>
<?php get_footer();?>

function read_more($limit){
		
		$post_content = explode(" ",get_the_content());
		$less_content = array_slice($post_content, 0, $limit);
		
		echo implode(" ",$less_content);
	}
	
		add_theme_support('title-tag');	
	add_theme_support('post-thumbnails');
	add_theme_support('custom-background');
	add_theme_support('woocommerce');
	register_nav_menu('main-menu','Main Menu');
	
	add_action('after_setup_theme','Airohead_Basic_Settings');
	
	
		register_post_type('career',array(
		'labels' => array('name' => 'Career Post','add_new_item' => 'Add New career Post'),
		'public' => true,
		'supports' => array('title','editor','thumbnail'),
		'menu_icon' => 'dashicons-portfolio'		
	));
	
	

	
	
}

add_action('after_setup_theme','Airohead_Basic_Settings');


function SWD_register_taxonomy(){
	
	$label = array(
		'name'				=>'Media Catagory',
		'singular_name'		=>'Media Catagory',
		'add_new_item'		=>'Category',
		);
	
	$args = array(
		'labels'=>$label,
		'public'=>true,
		'show_ui'=>true,
		'show_in_nav_menus'=>true,
		'show_in_quick_edit'=>true,
		'show_admin_column'=>true,
		'hierarchical'=>true,
		'query_var'=>true,
		'rewrite'=>array('slug'=>'media_cat')
	
	);
	
	register_taxonomy('media_type','media', $args);
	
	
		category
	<?php
	$wsubcats = get_categories(array(
										'hierarchical' => 1,
										'show_option_none' => '',
										'hide_empty' => 0,
										'parent' => $category->term_id,
										'taxonomy' => 'product_cat'
										));
										foreach ($wsubcats as $wsc):
										
										
										
										 $sub = get_categories(array(
										'parent' => $wsc->term_id,
										'hide_empty' => 0,
										'taxonomy' => 'product_cat'
										)); 
									
										foreach($sub as $subb):
								?>
								
								<?php echo get_term_link( $wsc->slug, $wsc->taxonomy );?>
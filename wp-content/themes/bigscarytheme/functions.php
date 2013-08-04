<?php
function ajax_update_project() 
{
	global $wpdb;
		
	$project = $_POST['project'];
	$field = $_POST['field'];
	$value = $_POST['value'];

	update_post_meta($project, $field, $value);

	if($field == "status" && $value == "started")
	{
		date_default_timezone_set("America/Halifax");
		$date = date("F jS Y");
		
		echo update_post_meta($project, "start date", $date);
		echo update_post_meta($project, "progress", "0%");
	}

	die();
}

function redirect_on_login() {
	$referrer = $_SERVER['HTTP_REFERER'];
	$homepage = get_option('siteurl');
	if (strstr($referrer, 'incorrect')) {
		wp_redirect( $homepage );
		exit;
	} elseif (strstr($referrer, 'empty')) {
		wp_redirect( $homepage );
		exit;
	} else {  
		wp_redirect( $referrer );
		exit;
	}
}
function register_scripts()
{
	wp_register_script( 'jquery-new', 'http://code.jquery.com/jquery-1.10.2.min.js');
	wp_register_script( 'fancy', get_stylesheet_directory_uri() . '/scripts/fancybox/jquery.fancybox.js');

	wp_enqueue_script( 'jquery-new' ); 
	wp_enqueue_script( 'fancy' ); 
}

function register_styles()
{
	wp_register_style( 'fancy', get_stylesheet_directory_uri() . '/scripts/fancybox/jquery.fancybox.css');
	wp_register_style( 'fluid', get_stylesheet_directory_uri() . '/styles/fluid.css');
	wp_register_style( 'fontawesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');

	wp_enqueue_style( 'fancy' );
	wp_enqueue_style( 'fluid' );
	wp_enqueue_style( 'fontawesome' );
}

function new_idea()
{		
	$idea = $_POST['idea'];
	$desc =	$_POST['desc'];
	
	$project = wp_insert_post( array(
		'post_title'		=> $idea,
		'post_content'		=> $desc,
		'post_status'		=> 'publish',
		'post_author'       => get_current_user_id(),
		'post_type'			=> 'scaryideas'
	) );

	
	if($project != 0  )
	{	
		echo $project;
		$field = "status";
		$value = "idea";

		update_post_meta($project, $field, $value);
	}

	die();
}

add_action( 'wp_ajax_new_idea', 'new_idea' );
add_action('wp_ajax_update_project', 'ajax_update_project');
add_action( 'wp_login', 'redirect_on_login' );
add_action( 'wp_enqueue_scripts', 'register_scripts' ); 
add_action( 'wp_enqueue_scripts', 'register_styles' );
<?php
/**
 * 
 * 
 */
/*
Plugin Name: Contact Form WP
Description: This is not just a plugin for test. Use short code "contact_form_wp". (Like:- <?php echo do_shortcode('[contact_form_wp]');?>).
Author: Soumya Utthasini
Version: 1.0.0
*/
defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
	define( 'WC_PLUGIN_FILE', __FILE__ );
}

// Admin Menu

add_action('admin_menu','my_plugin_settings');
function my_plugin_settings(){
	add_menu_page(
		__( 'Contact Menu Title', 'textdomain' ),
		'Contact WP Menu',
		'manage_options',
		'contactwp-menu',
		'contact_data_call_function',
		"dashicons-email-alt",
		6
	);
}

// Admin  Menu Call Back Function
function contact_data_call_function(){
  include "assets/admin-table.php";
}

register_activation_hook(__FILE__, 'your_plugin_activation');

function your_plugin_activation() {
  
    include "assets/create-table.php";

    add_option('your_plugin_activated', true);
}

// Enqueue scripts and styles
function enqueue_custom_scripts_styles() {
  // Enqueue custom style
  wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'assets/css/main.css');
  wp_enqueue_style('bootstrap-style', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css');

  // Enqueue custom script
  wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'assets/js/custom.js', array('jquery'), null, true);
}

// Hook into WordPress
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts_styles');
add_action('admin_enqueue_scripts','enqueue_custom_scripts_styles');

// Create ShortCode For Contact Form
function contactform_wp(){
 include "assets/contact-form.php";
}

add_shortcode('contact_form_wp', 'contactform_wp');


// AjAX Store Contact Form Records

function contact_form_record() {
  global $wpdb;

  $table_name = $wpdb->prefix.'contact_form_table';

  $wp_full_name = $_POST['wp_full_name'];
  $wp_subject = $_POST['wp_subject'];
  $wp_message = $_POST['wp_message'];
  $wp_email_id = $_POST['wp_email_id'];


  $inst =  $wpdb->insert($table_name,
      array( 
        'full_name' 			=> $wp_full_name, 
        'email_id' 		    => $wp_email_id,
        'user_subject' 		=> $wp_subject, 
        'user_message' 		=> $wp_message, 
      ) 
    );

  echo json_encode(array('status'=> $inst));
  exit();
}
add_action('wp_ajax_contact_form_record', 'contact_form_record'); 
add_action('wp_ajax_nopriv_contact_form_record', 'contact_form_record'); 


// AjAX Deleted Contact
function contact_record_delete() {
  global $wpdb;

  $table_name = $wpdb->prefix.'contact_form_table';

  $contact_id = $_POST['contact_id'];


  $delid =  $wpdb->delete( $table_name, array( 'id' => $contact_id ) );

  echo json_encode(array('status'=> $delid));
  exit();
}
add_action('wp_ajax_contact_record_delete', 'contact_record_delete'); 
add_action('wp_ajax_nopriv_contact_record_delete', 'contact_record_delete'); 




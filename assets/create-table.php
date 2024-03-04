<?php

global $wpdb;

	$table_name = $wpdb->prefix.'contact_form_table';
	$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  full_name varchar(50) NOT NULL,
		  email_id varchar(50) NOT NULL,
		  user_subject varchar(500) NOT NULL,
		  user_message varchar(500) NOT NULL,
		  PRIMARY KEY  (id)
		) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	
				
		




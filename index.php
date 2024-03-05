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



                                // Register custom REST API endpoint for retrieving books
function custom_get_books_endpoint() {
    register_rest_route( 'custom/v1', '/books', array(
        'methods'   => 'GET',
        'callback'  => 'custom_get_books_callback',
    ));
}
add_action( 'rest_api_init', 'custom_get_books_endpoint' );

// Callback function to handle the GET request for retrieving books
function custom_get_books_callback( $request ) {
    $args = array(
        'post_type'      => 'book', // Assuming 'book' is the custom post type
        'posts_per_page' => -1,
    );

    $books_query = new WP_Query( $args );
    $books = $books_query->posts;

    // Prepare response data
    $response_data = array();

    foreach ( $books as $book ) {
        $response_data[] = array(
            'id'       => $book->ID,
            'title'    => $book->post_title,
            'author'   => get_post_meta( $book->ID, 'author', true ), // Assuming 'author' is a custom field
            'excerpt'  => $book->post_excerpt,
            'content'  => $book->post_content,
            // Add more fields as needed
        );
    }

    // Return a JSON response
    return rest_ensure_response( $response_data );
}


//========= Post Published

// Register webhook endpoint to receive data from Site 1
add_action( 'rest_api_init', function () {
    register_rest_route( 'site2/v1', '/webhook', array(
        'methods' => 'POST',
        'callback' => 'handle_webhook_data',
    ) );
} );

// Function to handle data received from Site 1's webhook
function handle_webhook_data( $request ) {
    // Retrieve data from Site 1's REST API endpoint
    $response = wp_remote_get( 'https://site1.com/wp-json/custom/v1/data' );

    if ( is_wp_error( $response ) ) {
        return new WP_Error( 'site1_error', 'Error fetching data from Site 1', array( 'status' => 500 ) );
    }

    $data = json_decode( wp_remote_retrieve_body( $response ), true );

    // Create a new post on Site 2
    $post_data = array(
        'post_title'    => $data['title'],
        'post_content'  => $data['content'],
        'post_status'   => 'publish',
        // Add more fields as needed
    );

    $post_id = wp_insert_post( $post_data );

    if ( is_wp_error( $post_id ) ) {
        return new WP_Error( 'site2_error', 'Error creating post on Site 2', array( 'status' => 500 ) );
    }

    return new WP_REST_Response( 'Post created on Site 2', 200 );
}

// Token
// Register custom REST API endpoint with token authentication
function custom_api_get_data() {
    register_rest_route( 'custom/v1', '/data', array(
        'methods'   => 'GET',
        'callback'  => 'custom_get_data_callback',
        'permission_callback' => 'jwt_auth_validate_token', // Require token authentication
    ));
}
add_action( 'rest_api_init', 'custom_api_get_data' );


// Example function to fetch data from the custom endpoint
function fetchDataFromCustomEndpoint() {
    // Replace 'YOUR_TOKEN' with the actual JWT token obtained from your WordPress site
    const token = 'YOUR_TOKEN';
    
    // Endpoint URL
    const endpointUrl = 'https://yourwordpresssite.com/wp-json/custom/v1/data';
    
    // Fetch data from the endpoint
    fetch(endpointUrl, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }
        return response.json();
    })
    .then(data => {
        // Process the retrieved data
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

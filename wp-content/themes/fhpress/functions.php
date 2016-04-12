<?php

include('theme-functions/page-meta.php');

add_filter('show_admin_bar', '__return_false');


// get rid of huge header image
function fhpress_remove_custom_header() {
	remove_theme_support( 'custom-header' );
}
add_action( 'after_setup_theme', 'fhpress_remove_custom_header', 12 );

// disable that pesky wysiwyg editor!
//add_filter( 'user_can_richedit' , create_function ( '$a', 'return false;' ), 50 );

//custom excerpt length
function custom_excerpt_length( $length ) {
return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//add prev_next link styling
add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');
 
function post_link_attributes($output) {
    $code = 'class="btn btn-primary"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}

// remove p tags from images
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// disable xmlrpc
add_filter( 'xmlrpc_methods', function( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
} );

// Remove new emoji junk
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove new embed junk
function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'disable_embeds_init', 9999);

// add scripts and styles we DO want
function fhpress_style_script() {
	wp_dequeue_style( 'genericons' );
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3');
	wp_enqueue_script('jquery');
	
	wp_enqueue_style( 
		'fhpress-style', 
		get_stylesheet_directory_uri() . '/style.min.css',
		array() 
	);
	
   
	
	wp_enqueue_script(
		'fhpressplugins',
		get_stylesheet_directory_uri() . '/js/final.min.js',
		array( 'jquery' )
	);
}
add_action( 'wp_enqueue_scripts', 'fhpress_style_script', 11 );

//add excerpt to pages
add_post_type_support('page', 'excerpt');

//add support for custom thumbnails
add_theme_support('post-thumbnails');

// add menus
add_theme_support( 'menus' );
if( function_exists( 'register_nav_menus' ) ):
	register_nav_menus(
		array(
			'primary-nav' => 'Primary',
			'secondary-nav' => 'Secondary',
			'footer-nav' => 'Footer'
		)
	);
endif;

// add widgets
function fhpress_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Widgets', 'fhpress' ),
		'id'            => 'sidebar',
		'description'   => __( 'Appears in the sidebar.', 'fhpress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );

	register_sidebar( array(
		'name'          => __( 'The small print', 'fhpress' ),
		'id'            => 'the-small-print',
		'description'   => __( 'Copyright info, etc..', 'fhpress' ),
		'before_widget' => '<small id="%1$s" class="widget %2$s">',
		'after_widget'  => '</small>',
		'before_title'  => '<h3 class="widget-title">'
	) );
}
add_action( 'widgets_init', 'fhpress_widgets_init' );

/* custom wp login for presencemaker */
function custom_login() { 
echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/css/custom-login.css" />'; 
}
add_action('login_head', 'custom_login');

function my_login_logo_url() {
    return 'http://www.fasthorseinc.com';
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_links() {
    echo '<p id="assistance"><a href="mailto:joer@fasthorseinc.com">Email for assistance</a></p>'; 
}
add_filter( 'login_form', 'my_login_links' );


$prefix = "custom_";
$post_type = $_POST['post_type'];

//Add the Meta Box  
function add_custom_meta_box() { 
global $post, $post_type;

	// specific template
	//if('page-templatename.php' == get_post_meta($post->ID, '_wp_page_template', true)) {
    	add_meta_box(  
        	'custom_meta_box', // $id  
			'More Stuff!', // $title   
			'show_custom_meta_box', // $callback  
			'post', // $page  
			'normal', // $context  
			'high'
		); // $priority 
	//}
	
	//specific post-type
	/*if('custom post type' == $post_type) {
    	add_meta_box(  
        	'custom_meta_box', // $id  
			'Options', // $title   
			'show_custom_meta_box', // $callback  
			'custom post type', // $page  
			'normal', // $context  
			'high'
		); // $priority 
	}*/
}  
add_action('add_meta_boxes', 'add_custom_meta_box');  


$custom_meta_fields = array(  
array(  
        'label'=> 'Subtitle',
        'desc'  => 'Write a short subtitle',
        'id'    => $prefix.'subtitle',
        'type'  => 'text'
     )
); 

// The Callback  
function show_custom_meta_box() {  
global $custom_meta_fields, $post, $post_type;  


// Use nonce for verification  
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
      
    // Begin the field table and loop  
    echo '<table class="form-table">'; 

    foreach ($custom_meta_fields as $field) {  
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // begin a table row with  
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  
                    
					// text
					case 'text':
					echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
						<br /><span class="description">'.$field['desc'].'</span>';
					break;
                } //end switch  
        echo '</td></tr>';  
    } // end foreach 

    echo '</table>'; // end table  
}  

// Save the Data  
function save_custom_meta($post_id) { 

global $custom_meta_fields, $post_type; 
    // verify nonce  
    if ( !isset( $_POST['custom_meta_box_nonce'] ) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
 
    
 
    // loop through fields and save the data   REPEAT FOR EACH
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        } 
 
    } // end foreach 
 

}  
add_action('save_post', 'save_custom_meta');  

// important: note the priority of 99, the js needs to be placed after tinymce loads
add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99);
function my_admin_print_footer_scripts()
{ ?>

<script type="text/javascript">/* <![CDATA[ */
        jQuery(function($){
                                $('#$meta_box_id #editor-toolbar > a').click(function(){
                                        $('#$meta_box_id #editor-toolbar > a').removeClass('active');
                                        $(this).addClass('active');
                                });
                                
                                if($('#$meta_box_id #edButtonPreview').hasClass('active')){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                }
                                
                                $('#$meta_box_id #edButtonPreview').click(function(){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                });
                                
                                $('#$meta_box_id #edButtonHTML').click(function(){
                                        $('#$meta_box_id #ed_toolbar').show();
                                });
 
//Tell the uploader to insert content into the correct WYSIWYG editor
$('#media-buttons a').bind('click', function(){
var customEditor = $(this).parents('#$meta_box_id');
if(customEditor.length > 0){
edCanvas = document.getElementById('$editor_id');
}
else{
edCanvas = document.getElementById('content');
}
});
                        });
        
    /* ]]> */</script>

<?php }

add_filter( 'meta_content', 'wptexturize');
add_filter( 'meta_content', 'convert_smilies');
add_filter( 'meta_content', 'convert_chars');
add_filter( 'meta_content', 'wpautop');
add_filter( 'meta_content', 'shortcode_unautop');
add_filter( 'meta_content', 'prepend_attachment');
add_filter( 'meta_content', 'do_shortcode');

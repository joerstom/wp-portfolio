<?php


$screens = array( 'post', 'page', 'custom_post_type' );


/* OUTPUT */

function construct_meta() {
	
	/* URL */
	$page_meta_url = get_bloginfo('url').$_SERVER["REQUEST_URI"] ;
	
	/* TWITTER */
	$option_twitter_handle = get_option('twitter_handle');
	
	/* TITLE */
	$fhpress_meta_title = get_post_meta( get_the_ID() , 'page_title', true );
    if( $fhpress_meta_title == '' ):
    	$fhpress_meta_title = get_the_title() . " | " . get_bloginfo('name');
    endif;
    if( !is_single() ) {
	    $fhpress_meta_title .=  " | " . get_bloginfo('description');
    }
    
    $fhpress_meta_title = esc_attr( strip_tags( stripslashes( $fhpress_meta_title ) ) );
    
    /* KEYWORDS */
    $fhpress_meta_keywords = get_post_meta( get_the_ID() , 'page_tags', true );
    if( $fhpress_meta_keywords == '' ):
    	$fhpress_meta_keywords = '';
    endif;
    
    $fhpress_meta_keywords = esc_attr( strip_tags( stripslashes( $fhpress_meta_keywords ) ) );
    
    /* DESC */
    $fhpress_meta_description = get_post_meta( get_the_ID() , 'page_description', true );
    if( $fhpress_meta_description == '' ):
		$fhpress_meta_description = get_bloginfo( 'description' );
    endif;
    
    $fhpress_meta_description =  esc_attr( strip_tags( stripslashes( $fhpress_meta_description ) ) );
    
    /* THUMB */
    $fhpress_share_thumb = get_post_meta( get_the_ID() , 'share_thumb', true );
    if( $fhpress_share_thumb == '' ):
    	$fhpress_share_thumb = '';
    endif;
    
    $fhpress_share_thumb = esc_attr( strip_tags( stripslashes( $fhpress_share_thumb) ) );
	
	
	/* Echo */
	echo '<meta charset="' . get_bloginfo( 'charset' ) .'" />'
	. '<link rel="icon" href="' . get_bloginfo('stylesheet_directory') . '/favicon.ico" type="image/x-icon" />'
	. '<!-- facebook meta -->'
	. '<meta property="fb:app_id" content=""/>'
	. '<meta property="og:title" content="' . $fhpress_meta_title . '"/>'
	. '<meta property="og:description" content="' . $fhpress_meta_description . '"/>'
	. '<meta property="og:url" content="' . $page_meta_url . '"/>';
	if(!empty($fhpress_share_thumb)) { echo '<meta property="og:image" content="' . $fhpress_share_thumb . '"/>'; }
	echo '<meta property="og:type" content="website"/>'
	. '<!-- twitter meta -->'
	. '<meta name="twitter:site" content="' . $option_twitter_handle . '">'
	. '<meta name="twitter:title" content="' . $fhpress_meta_title . '">'
	. '<meta name="twitter:description" content="' . $fhpress_meta_description . '">';
	if(!empty($fhpress_share_thumb)) { echo '<meta property="twitter:image" content="' . $fhpress_share_thumb . '"/>'; }
	echo '<meta property="twitter:card" content="summary_large_image" />'
	. '<!-- additional meta -->'
	. '<meta name="keywords" content="' . $fhpress_meta_keywords . '" />'
	. '<meta name="description" content="' . $fhpress_meta_description . '" />'
	. '<title>' . $fhpress_meta_title . '</title>'
	. '<meta name="viewport" content="initial-scale=1, maximum-scale=1">';	

}
add_action('wp_head', 'construct_meta', 1);


// GOOGLE ANALYTICS

function get_google_analytics() {
     
   $gaid = get_option( 'google_analytics_id' );
    if( $gaid != '' ):
		$gacode = "<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '".$gaid."');
		ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->";
	endif;
	
	echo $gacode;
}
add_action('wp_head', 'get_google_analytics');

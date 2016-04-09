<?php
// General
function get_current_url() {
	$page_meta_url = get_bloginfo('url').$_SERVER["REQUEST_URI"] ;

	return $page_meta_url;
} 
add_shortcode('get-current-url', 'get_current_url');

function get_google_analytics_code() {
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
	
	return $gacode;
}
add_shortcode('get-google-analytics', 'get_google_analytics_code');

// Meta
function get_meta_title( $atts ) {
	extract(shortcode_atts( array('pageid' => ''), $atts));
	
	if( have_posts() ) : while ( have_posts() ) : the_post();
		$fhpress_meta_title = get_metadata( 'post', $pageid, 'page_title', true );
		if($fhpress_meta_title == '' ):
			$fhpress_meta_title = get_the_title();
		endif;
	endwhile; endif; wp_reset_query();
	
	$fhpress_meta_title = trim( $fhpress_meta_title );

	return $fhpress_meta_title;
}
add_shortcode('get-meta-title', 'get_meta_title');

function get_meta_keywords( $atts ) {
	extract(shortcode_atts( array('pageid' => ''), $atts));
	
	if( have_posts() ) : while ( have_posts() ) : the_post();
		$fhpress_meta_keywords = get_metadata( 'post', $pageid, 'page_tags', true );
		if( $fhpress_meta_keywords == '' ):
			$fhpress_meta_keywords = '';
		endif;
	endwhile; endif; wp_reset_query();

	return $fhpress_meta_keywords;
}
add_shortcode('get-meta-keywords', 'get_meta_keywords');

function get_meta_description( $atts ) {
	extract(shortcode_atts( array('pageid' => ''), $atts));
	
	if( have_posts() ) : while ( have_posts() ) : the_post();
		$fhpress_meta_description = get_metadata( 'post', $pageid, 'page_description', true );
		if( $fhpress_meta_description == '' ):
			$fhpress_meta_description = get_bloginfo( 'description' );
		endif;
	endwhile; endif; wp_reset_query();
	
	return $fhpress_meta_description;
}
add_shortcode('get-meta-description', 'get_meta_description');

function get_share_thumb( $atts ) {
	extract(shortcode_atts( array('pageid' => ''), $atts));
	
	if( have_posts() ) : while ( have_posts() ) : the_post();
		$fhpress_share_thumb = get_site_url().get_metadata( 'post', $pageid, 'share_thumb', true );
		if( $fhpress_share_thumb == '' ):
			$fhpress_share_thumb = '';
		endif;
	endwhile; endif; wp_reset_query();
	
	return $fhpress_share_thumb;
}
add_shortcode('get-share-thumb', 'get_share_thumb');
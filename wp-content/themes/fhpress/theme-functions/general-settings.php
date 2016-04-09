<?php
add_filter('admin_init', 'my_general_settings_register_fields');
 
function my_general_settings_register_fields(){
	//google analytics
	register_setting('general', 'google_analytics_id', 'esc_attr');
	add_settings_field('google_analytics_id', '<label for="google_analytics_id">'.__('Google Analytics ID' , 'google_analytics_id' ).'</label>' , 'google_analytics_box_html', 'general');
	
	//facebook page name
	register_setting('general', 'facebook_pagename', 'esc_attr');
	add_settings_field('facebook_pagename', '<label for="facebook_pagename">'.__('Facebook Page Name' , 'facebook_pagename' ).'</label>' , 'facebook_pagename_box_html', 'general');
	
	//twitter username
	register_setting('general', 'twitter_handle', 'esc_attr');
	add_settings_field('twitter_handle', '<label for="twitter_handle">'.__('Twitter Handle' , 'twitter_handle' ).'</label>' , 'twitter_handle_box_html', 'general');
}

function google_analytics_box_html(){
	$value = get_option( 'google_analytics_id', '' );
	echo '<input type="text" id="google_analytics_id" name="google_analytics_id" value="' . $value . '" class="regular-text" />';
}

function facebook_pagename_box_html(){
	$value = get_option( 'facebook_pagename', '' );
	echo '<input type="text" id="facebook_pagename" name="facebook_pagename" value="' . $value . '" class="regular-text" />';
}

function twitter_handle_box_html(){
	$value = get_option( 'twitter_handle', '' );
	echo '<input type="text" id="twitter_handle" name="twitter_handle" value="' . $value . '" class="regular-text" />';
}
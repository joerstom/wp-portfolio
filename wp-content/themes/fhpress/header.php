<?php header('X-UA-Compatible: IE=edge'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
	<!-- Pulls from page-meta.php now!  -->
	
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>
	
		
	<div class="site">
		
		<div class="navigation row">
			
				<div class="col span2">
					<h1><a href="http://joerstom.com/">Joe Rstom</a></h1>
				</div>
				<div class="col span8">
					<nav role="navigation" class="main-navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary-nav', 'menu_class' => 'cf', 'container' => false ) );?>		</nav>
				</div>
				<div class="col span2 social">
					<ul class="social-icons h-list cf">
						<li><a href="#" class="icon-linkedin">&nbsp;</a></li>
						<li><a href="#" class="icon-github">&nbsp;</a></li>
						<li><a href="#" class="icon-twitter">&nbsp;</a></li>
					</ul>
				</div>
		
			
		</div>
		
		<header class="header">
			
			<div class="row">
				<?php if(is_home() || is_front_page()) { ?>
					<div class="col span6">
						
					</div>
					<div class="col span6">
												
						<h1>Hey! I'm Joe.</h1>		
						<h4>I'm a developer, designer and aspiring technologist.<br/>I may write about the web occasionally.<sup>*</sup><br/><small><sup>*</sup>Or books. Or what I'm up to. Who cares, really.</small></h4>
							
					</div>
				
				<?php } else { ?>
				
					<div class="col span12">
						
						<h1><?php echo get_the_title(); ?></h1>
						
					</div>
					
				<?php } ?>
					
			</div>
				
			<div class="bg">&nbsp;</div>
			
		</header>
		
		
		
		
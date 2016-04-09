<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
*/
$search_term = substr($_SERVER['REQUEST_URI'],1);
$search_term = urldecode(stripslashes($search_term));
$find = array ("'.html'", "'.+/'", "'[-/_]'") ;
$replace = " " ;
$search_term = trim(preg_replace ( $find , $replace , $search_term ));
get_header();?>

<section role="main" class="container">
	<div class="container">
		<div class="row">
			<h1>We're sorry! We seem to be having trouble finding that!</h1>
			<p>It's possible something has moved or there was a problem copying/pasting the address. You can head to the <a href="/" title="">Homepage</a>, try a site search, or we've provided some suggestions based on the URL you were trying to view.</p>

			<h2>Try a search</h2>
			<?php get_search_form(); ?>

			<h2>See Our Suggestions</h2>
			<ul>
				<?php $search404 = new WP_Query( 's=' . $search_term );
				if( $search404->have_posts() ):  while( $search404->have_posts() ): $search404->the_post();?>
				<li>
					<h3><a href="<?=the_permalink();?>" title=""><?=the_title();?></a></h3>
					<p><?=get_the_excerpt();?></p>
				</li>
				<?php endwhile; endif; wp_reset_query();?>
			</ul>
		</div>
	</div>
</section>
<?php get_footer();?>
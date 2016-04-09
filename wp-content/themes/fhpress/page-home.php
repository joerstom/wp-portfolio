<?php
/* Template Name: Homepage */
get_header(); ?>
<main role="main" class="main">
	<section role="section" class="section">

		<div class="row title dark-gray">
			<div class="container">
			<h1>Notes & Articles</h1><a href="/writing" class="arrow">Read More</a>
			</div>
		</div>
	
			<?php $i = 0;
				
			$index = new WP_Query(array('post_type' => 'post', 'order' => 'DESC', 'posts_per_page' => 6));
			if($index) : while ($index->have_posts()) : $index->the_post(); 
			
			$subtitle = get_post_meta($post->ID, 'custom_subtitle', true);
			$categories = get_the_category();
			
			if($i % 3 == 0 && $i > 2) { echo '</div></div>'; }
			if($i % 3 == 0) { echo '<div class="row content"><div class="container">'; } ?>
			
			<div class="col span4 equalheight single-post">
			
				<?php the_title('<h3><a href="' . get_the_permalink() . '">','</a></h3>'); ?>
				
				<?php if (!empty($subtitle)) { echo "<h5>" . $subtitle . "</h5>"; }?>
				
				<h6>Posted on <?php the_date('F d, Y'); ?> in <?php $c = 1; foreach($categories as $category){ 
					$cat_link = get_category_link($category->cat_ID);
					if($c>1) { echo ', '; } echo '<a href="'.$cat_link.'">'.$category->name.'</a>'; // category link
				$c++; } ?></h6>
			
				<?php the_excerpt(); ?>
				
				<a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary"><span>Read More</span></a>
			</div>
				
			<?php   $i++; ?>
			
			<?php endwhile; endif; ?>
			
		</div></div>
		
		<div class="row title red">
			<div class="container">
			<h1>Latest Work</h1><a href="#" class="arrow">See All</a>
			</div>
		</div>
	
			<!--<?php $i = 0;
				
			$index = new WP_Query(array('post_type' => 'portfolio', 'order' => 'ASC'));
			if($index) : while ($index->have_posts()) : $index->the_post(); 
			
			$subtitle = get_post_meta($post->ID, 'custom_subtitle', true);
			$categories = get_the_category();
			
			if($i % 3 == 0) { echo '<div class="row"><div class="container">'; } ?>
			
			<div class="col span4 equalheight single-post">
			
				<?php the_title('<h3>','</h3>'); ?>
				
				<?php if (!empty($subtitle)) { echo "<h5>" . $subtitle . "</h5>"; }?>
				
				<h6>Posted on <?php the_date('F d, Y'); ?> in <?php foreach($categories as $category){ 
					$cat_link = get_category_link($category->cat_ID);
					echo '<a href="'.$cat_link.'">'.$category->name.'</a>'; // category link
				} ?></h6>
			
				<?php the_excerpt(); ?>
				
				<a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary"><span>Read More</span></a>
			</div>
				
			<?php $i++; if($i % 3 == 0) { echo '</div></div>'; } ?>
			
			<?php endwhile; endif; ?>-->
		<div class="row content">
			<div class="container">
				
				<div class="col span12 equalheight single-post">
					<h3>Just hold your horses, will ya?</h3>
			
					<p>I'm working on getting portfolio items back up here in a new format. Currently, I'm documenting the creation of this site, which you can read about here. Check <a href="http://www.fasthorseinc.com">Fast Horse</a> for some other new stuff!</p>
				</div>
				
			</div>
		
		</div>
			
		<div class="row title brown">
			<div class="container">
				<h1>About Me</h1><a href="/about" class="arrow">More Info</a>
				<p>I am currently strategizing, concocting and creating stuff for <a href="http://www.fasthorseinc.com">Fast Horse, Inc.</a> in the bitter tundra of  Minneapolis, MN.</p>
				<p>You can find me sporadically contributing - but constantly consuming - content on twitter, reddit and github. If you want to contact me the old fashioned way, <a href="mailto:hey@joerstom.com">shoot me an email.</a></p>
			</div>
		</div>
			
	</section>
</main>

<?php get_footer(); ?>
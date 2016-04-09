<?php
/* Template Name: Writing */
get_header(); ?>
<main role="main" class="main writing">
	<section role="section" class="section">
	
			<?php $i = 0;
				
			$index = new WP_Query(array('post_type' => 'post', 'order' => 'DESC', 'posts_per_page' => 6));
			if($index) : while ($index->have_posts()) : $index->the_post(); 
			
			$subtitle = get_post_meta($post->ID, 'custom_subtitle', true);
			$categories = get_the_category(); ?>
			<div class="row content">
				<div class="container">
					<div class="col span12 single-post">
			
						<?php the_title('<h3><a href="' . get_the_permalink() . '">','</a></h3>'); ?>
				
						<?php if (!empty($subtitle)) { echo "<h5>" . $subtitle . "</h5>"; }?>
				
						<h6>Posted on <?php the_date('F d, Y'); ?> in <?php $c = 1; foreach($categories as $category){ 
					$cat_link = get_category_link($category->cat_ID);
					if($c>1) { echo ', '; } echo '<a href="'.$cat_link.'">'.$category->name.'</a>'; // category link
					$c++; } ?></h6>
			
						<?php the_excerpt(); ?>
				
						<a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary"><span>Read More</span></a>
					</div>
				</div>
			</div>
			
			<?php endwhile; endif; ?>
			
				
	</section>
</main>
<?php get_footer(); ?>
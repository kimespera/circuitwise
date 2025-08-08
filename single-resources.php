<?php get_header(); ?>

<main class="main-content">
	<!-- Filters -->
	<div class="single-resources-filter">
		<div class="container">
			<?php
				// Get all terms
				$terms = get_terms(array(
					'taxonomy'   => 'resource_category',
					'hide_empty' => true,
				));

				// Get current post's category
				$resource_terms = wp_get_post_terms(get_the_ID(), 'resource_category');
				$current_category_slug = !empty($resource_terms) ? $resource_terms[0]->slug : '';

				// Get link to the listing page (replace 'resources' with actual slug if different)
				$listing_page = get_page_by_path('resources');
				$listing_url  = $listing_page ? get_permalink($listing_page->ID) : home_url('/resources/');
			?>

			<!-- Mobile Dropdown -->
			<div class="filter-mobile">
				<div>Filter by category:</div>
				<form method="get" action="<?php echo esc_url($listing_url); ?>" id="filter-form">
					<select name="category" onchange="document.getElementById('filter-form').submit();">
						<option value="">All</option>
						<?php foreach ($terms as $term) : ?>
							<option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current_category_slug, $term->slug); ?>>
								<?php echo esc_html($term->name); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</form>
			</div>

			<!-- Desktop Tabs -->
			<div class="filter-desktop">
				<ul class="filter-tabs">
					<li class="<?php echo $current_category_slug === '' ? 'active' : ''; ?>">
						<a href="<?php echo esc_url($listing_url); ?>">All</a>
					</li>
					<?php foreach ($terms as $term) : ?>
						<li class="<?php echo $current_category_slug === $term->slug ? 'active' : ''; ?>">
							<a href="<?php echo esc_url(add_query_arg('category', $term->slug, $listing_url)); ?>">
								<?php echo esc_html($term->name); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="single-resources-image">
				<div class="single-image-box"><?php the_post_thumbnail('full'); ?></div>
			</div>
		<?php endif; ?>
		<div class="single-resources-wrap">
			<div class="single-resource-date"><?php echo get_field('date'); ?></div>
			<h1 class="single-resources-title"><?php the_title(); ?></h1>
			<div class="single-resources-content"><?php the_content(); ?></div>
			<?php
				$terms = get_the_terms(get_the_ID(), 'resource_category');

				if ($terms && !is_wp_error($terms)) :
					$listing_page = get_page_by_path('resources');
					$listing_url  = $listing_page ? get_permalink($listing_page->ID) : home_url('/resources/');

					echo '<div class="single-resources-categories">';
					foreach ($terms as $term) {
						$filtered_url = add_query_arg('category', $term->slug, $listing_url);
						echo '<a href="' . esc_url($filtered_url) . '">' . esc_html($term->name) . '</a> ';
					}
					echo '</div>';
				endif;
			?>
		</div>
	<?php endwhile; endif; ?>
	
	<?php
		// Build main query
		$args = array(
			'post_type'      => 'resources',
			'posts_per_page' => 5,
		);

		$resources_query = new WP_Query($args);
	?>
	<!-- Resource List -->
	<div class="additional-resources">
		<div class="container">
			<div class="slider-resources">
				<?php if ($resources_query->have_posts()) : ?>
				<?php while ($resources_query->have_posts()) : $resources_query->the_post(); ?>
					<article class="resource-item">
						<div class="resource-img">
							<?php if (has_post_thumbnail()) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
							<?php else : ?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/image-placeholder.jpg" alt="Placeholder">
							<?php endif; ?>
						</div>
						<div class="resource-content">
							<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
							<p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
							<a class="btn-link" href="<?php the_permalink(); ?>">Read More<i class="fa-solid fa-chevron-right"></i></a>
						</div>
					</article>
				<?php endwhile; ?>
			<?php else : ?>
				<p>No resources found.</p>
			<?php endif; ?>
			</div>
		</div>
	</div>

	<?php wp_reset_postdata(); ?>
	
</main>

<?php get_footer(); ?>
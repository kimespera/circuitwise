<?php /* Template Name: Resources Page */ ?>
<?php get_header(); ?>

<main class="main-content resources-listing">
	<div class="container">
		<h1><?php the_title(); ?></h1>

		<?php
		// Featured Resource
		$featured_args = array(
			'post_type'      => 'resources',
			'posts_per_page' => 1,
			'meta_key'       => 'is_featured',
			'meta_value'     => '1',
		);

		$featured_query = new WP_Query($featured_args);

		if ($featured_query->have_posts()) : ?>
			<div class="resources-featured">
				<?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
					<div class="featured-col featured-desc"><?php echo get_the_excerpt(); ?></div>
					<div class="featured-col featured-img">
						<div class="featured-imgwrap">
							<?php if (has_post_thumbnail()) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
							<?php else : ?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/image-placeholder.jpg" alt="Placeholder">
							<?php endif; ?>
						</div>
						<div class="featured-link">
							<h4>Featured article</h4>
							<a class="btn-link" href="<?php the_permalink(); ?>">Read More<i class="fa-solid fa-chevron-right"></i></a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; wp_reset_postdata(); ?>

		<div class="resources-list">
			<?php
			// Get filters from URL
			$selected_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

			// Build main query
			$args = array(
				'post_type'      => 'resources',
				'posts_per_page' => -1,
			);

			
			if (!empty($selected_category)) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'resource_category',
						'field'    => 'slug',
						'terms'    => $selected_category,
					),
				);
			}

			$resources_query = new WP_Query($args);

			// Get taxonomy terms for filters
			$terms = get_terms(array(
				'taxonomy'   => 'resource_category',
				'hide_empty' => true,
			));
			?>

			<!-- Filters -->
			<div class="resource-filters">
				<!-- Mobile Dropdown -->
				<div class="filter-mobile">
					<div>Filter by category:</div>
					<form method="get" id="filter-form">
						<label for="cate-filter"></label>
						<select id="cate-filter" name="category" onchange="document.getElementById('filter-form').submit();">
							<option value="">All</option>
							<?php foreach ($terms as $term) : ?>
								<option value="<?php echo esc_attr($term->slug); ?>" <?php selected($selected_category, $term->slug); ?>>
									<?php echo esc_html($term->name); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</form>
				</div>

				<!-- Desktop Tabs -->
				<div class="filter-desktop">
					<ul class="filter-tabs">
						<li class="<?php echo $selected_category === '' ? 'active' : ''; ?>">
							<a href="?category=">All</a>
						</li>
						<?php foreach ($terms as $term) : ?>
							<li class="<?php echo $selected_category === $term->slug ? 'active' : ''; ?>">
								<a href="?category=<?php echo esc_attr($term->slug); ?>">
									<?php echo esc_html($term->name); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

			<!-- Resource List -->
			<div class="resource-list">
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

			<?php wp_reset_postdata(); ?>
		</div>
	</div>

	<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
				the_content();
			endwhile;
		else :
			echo '<p>No content found.</p>';
		endif;
	?>
</main>

<?php get_footer(); ?>
<?php get_header(); ?>

	<main class="main-content">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile;
		?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
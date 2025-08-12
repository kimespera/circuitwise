<?php get_header(); ?>

	<main class="main-content error-404 not-found">
		<div class="container">
			<h1>404 Page not found.</h1>
			<p>The page you're looking for doesn't exist, moved, or the link is incorrect.<br>Return to the homepage to continue exploring. </p>
			<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Back To Homepage</a>
		</div>
	</main>

<?php get_footer(); ?>
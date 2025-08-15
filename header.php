<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-7KGMKBTGV0"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-7KGMKBTGV0');
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="header" class="header">
		<div id="menu-burger" class="menu-burger"></div>
		<div class="header-inner container">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php
						$logo = get_field('logo','option');
						echo wp_get_attachment_image($logo, 'full');
					?>
				</a>
			</div>
			<?php
				wp_nav_menu(array(
					'container' => 'nav',
					'container_id' => 'main-nav',
					'container_class' => 'main-nav',
					'menu' => '2',
					'menu_id' => 'main-menu',
					'menu_class' => 'main-menu'
				));
			?>
		</div>
	</header>

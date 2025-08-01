<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header class="header">
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

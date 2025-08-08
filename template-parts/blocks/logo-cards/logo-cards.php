<?php
	$heading = get_field('heading');
	$description = get_field('description');
	$logo_cards = get_field('logo_cards');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'logocards-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<h2><?php echo $heading; ?></h2>
		<p><?php echo $description; ?></p>

		<?php if ($logo_cards) : ?>
			<div class="logo-cards">
				<?php foreach( $logo_cards as $row ):
					$logo = $row['logo'];
					$description = $row['description']; ?>

					<?php if($logo): ?>
						<div class="logo-card-item">
							<div class="logo-card-img"><?php echo wp_get_attachment_image( $logo, 'full' ); ?></div>
							<div class="logo-card-desc"><?php echo $description; ?></div>
						</div>
					<?php endif; ?>

				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
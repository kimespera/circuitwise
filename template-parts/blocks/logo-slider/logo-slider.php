<?php
	$heading = get_field('heading');
	$description = get_field('description');
	$logo_list = get_field('logo_list');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'logoslider-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<h3><?php echo $heading; ?></h3>
		<?php if($description): ?>
			<p><?php echo $description; ?></p>
		<?php endif; ?>

		<?php if ($logo_list) : ?>
			<div id="logo-list" class="logo-list">
				<?php foreach( $logo_list as $row ):
					$logo = $row['logo']; ?>

					<?php if($logo): ?>
						<div class="logo-item"><?php echo wp_get_attachment_image( $logo, 'full' ); ?> </div>
					<?php endif; ?>

				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
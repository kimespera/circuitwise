<?php
	$heading = get_field('heading');
	$description = get_field('description');
	$cards = get_field('cards');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'cards-block';

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

		<?php if ($cards) : ?>
			<div class="cards">
				<?php foreach( $cards as $row ):
					$image = $row['image'];
					$title = $row['title'];
					$description = $row['description'];
					$button = $row['button'];
					$button_url = $button['url'];
					$button_title = $button['title'];
					$button_target = $button['target'] ? $button['target'] : '_self'; ?>

					<div class="card-item">
						<div class="card-img"><?php echo wp_get_attachment_image( $image, 'full' ); ?></div>
						
						<div class="card-content">
							<h3><?php echo $title; ?></h3>
							<p><?php echo $description; ?></p>
							<?php if ($button) : ?>
								<a class="button" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>"><?php echo $button_title; ?></a>
							<?php endif; ?>
						</div>
					</div>

				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
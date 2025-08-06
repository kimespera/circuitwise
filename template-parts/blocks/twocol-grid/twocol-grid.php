<?php
	$heading = get_field('heading');
	$grid = get_field('grid');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'twocolgrid-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<h3 class="twocolgrid-heading"><?php echo $heading; ?></h3>

		<?php if ($grid) : ?>
			<div class="grid-wrap">
				<?php foreach( $grid as $row ):
					$icon = $row['icon'];
					$content = $row['content'];
					$link = $row['link'];
					$button_url = $link['url'];
					$button_title = $link['title'];
					$button_target = $link['target'] ? $link['target'] : '_self'; ?>

					<div class="grid-item">
						<?php echo wp_get_attachment_image( $icon, 'full' ); ?>
						
						<div class="grid-content"><?php echo $content; ?></div>

						<?php if ($link) : ?>
							<a class="btn-link" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>"><?php echo $button_title; ?><i class="fa-solid fa-chevron-right"></i></a>
						<?php endif; ?>
					</div>

				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
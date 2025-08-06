<?php
	$layout_mode = get_field('layout_mode');
	$background_color = get_field('background_color');
	$heading = get_field('heading');
	$certificates = get_field('certificates');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'certificates-block ' . $layout_mode . ' ' . $background_color;

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<div class="cert-box">
			<div class="cert-heading">
				<h2><?php echo $heading; ?></h2>
			</div>
			<?php if ($certificates) : ?>
				<div class="cert-imgs">
					<?php foreach( $certificates as $row ):
						$image = $row['image'];
						$link = $row['link'];
						$open_new_tab = $row['open_new_tab'];
						$link_target = $open_new_tab ? '_blank' : '_self'; ?>

						<?php if ($link) : ?>
							<a class="cert-img" href="<?php echo $link; ?>" target="<?php echo $link_target; ?>"><?php echo wp_get_attachment_image($image, 'full'); ?></a>
						<?php else: ?>
							<div class="cert-img"><?php echo wp_get_attachment_image($image, 'full'); ?></div>
						<?php endif; ?>

					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
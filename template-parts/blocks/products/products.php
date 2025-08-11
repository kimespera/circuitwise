<?php
	$content = get_field('content');
	$products_list = get_field('products_list');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'products-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<?php echo $content; ?>
		<?php if ($products_list) : ?>
			<div class="product-list">
				<?php foreach( $products_list as $row ):
					$image = $row['image'];
					$title = $row['title']; ?>

					<div class="product-item">
						<?php if($image): ?>
							<div class="product-img"><?php echo wp_get_attachment_image( $image, 'full' ); ?></div>
						<?php endif; ?>

						<?php if($title): ?>
							<h6><?php echo $title; ?></h6>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
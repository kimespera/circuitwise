<?php
	$color_mode = get_field('color_mode');
	$image_position = get_field('image_position');
	$image_type = get_field('image_type');
	$image = get_field('image');
	$content = get_field('content');
	$button_list = get_field('button_list');
	$button = get_field('button');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'splitcontent-block ' . $color_mode . ' ' . $image_position . ' ' . $image_type;

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<?php
		if ($image_type == 'cover') {
			echo wp_get_attachment_image($image, 'full');
		}
	?>
	<div class="container splitcontent-box">
		<div class="split-col cont-col">
			<div class="wysiwyg-box"><?php echo $content; ?></div>
			<?php if ($button_list) : ?>
				<ul class="button-list">
					<?php foreach( $button_list as $row ):
						$button = $row['button']; ?>
						<?php if( $button ): 
							$button_url = $button['url'];
							$button_title = $button['title'];
							$button_target = $button['target'] ? $button['target'] : '_self'; ?>
							<li>
								<a class="button btn-white" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if( $button ): 
				$button_url = $button['url'];
				$button_title = $button['title'];
				$button_target = $button['target'] ? $button['target'] : '_self'; ?>
				<a class="button" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
			<?php endif; ?>
		</div>
		<div class="split-col img-col">
			<?php echo wp_get_attachment_image($image, 'full'); ?>
		</div>
	</div>
</div>
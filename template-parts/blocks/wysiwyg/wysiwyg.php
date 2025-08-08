<?php
	$wysiwyg = get_field('wysiwyg');
	$color_mode = get_field('color_mode');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'wysiwyg-block ' . $color_mode;

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<?php echo $wysiwyg; ?>
	</div>
</div>
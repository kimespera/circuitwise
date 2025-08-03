<?php
	$color_mode = get_field('color_mode');
	$top_description = get_field('top_description');
	$half_image_half_content = get_field('half_image_half_content');
	$icons = get_field('icons');
	$bottom_description = get_field('bottom_description');
	$link = get_field('link');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'iconlist-block ' . $color_mode;

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container iconlist-box">
		<div><?php $top_description; ?></div>
		<div class="half-imgcont">
			<div class="half-col"></div>
			<div class="half-col"></div>
		</div>
		<div class="icon-list"></div>
	</div>
</div>
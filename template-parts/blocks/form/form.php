<?php
	$content = get_field('content');
	$form_heading = get_field('form_heading');
	$form_shortcode = get_field('form_shortcode');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'form-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<div class="form-wrap">
			<div class="form-col form-content"><?php echo $content ?></div>
			<div class="form-col form-code">
				<h2><?php echo $form_heading; ?></h2>
				<?php echo do_shortcode($form_shortcode); ?>
			</div>
		</div>
	</div>
</div>
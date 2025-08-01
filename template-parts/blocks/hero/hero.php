<?php
	$heading = get_field('heading');
	$subheading = get_field('subheading');
	$button = get_field('button');
	$background_image = get_field('background_image');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'hero-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<?php echo wp_get_attachment_image($background_image, 'full'); ?>
	<div class="container hero-box">
		<h1><?php echo $heading; ?></h1>
		<h4><?php echo $subheading; ?></h4>
		<?php if( $button ): 
			$button_url = $button['url'];
			$button_title = $button['title'];
			$button_target = $button['target'] ? $button['target'] : '_self'; ?>
			<a class="button" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
		<?php endif; ?>
	</div>
</div>
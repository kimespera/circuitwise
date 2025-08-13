<?php
	$wysiwyg = get_field('wysiwyg');
	$color_mode = get_field('color_mode');
	$button_list = get_field('button_list');

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
		<?php if ($button_list) : ?>
			<div class="button-list">
				<?php foreach( $button_list as $row ):
					$button = $row['button']; ?>
					<?php if( $button ): 
						$button_url = $button['url'];
						$button_title = $button['title'];
						$button_target = $button['target'] ? $button['target'] : '_self'; ?>
						<a class="button btn-white" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
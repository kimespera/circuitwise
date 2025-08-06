<?php
	$color_mode = get_field('color_mode');
	$top_description = get_field('top_description');
	$half_image_half_content = get_field('half_image_half_content');
	$half_image = $half_image_half_content['image'];
	$half_content = $half_image_half_content['content'];
	$half_content_button = $half_image_half_content['button'];
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
	<div class="topdesc">
		<div class="container">
			<?php echo $top_description; ?>

			<?php if( $half_content ): ?>
				<div class="half-imgcont">
					<div class="half-col half-img">
						<?php echo wp_get_attachment_image($half_image, 'full'); ?>
					</div>
					<div class="half-col half-cont">
						<?php echo $half_content; ?>
						<?php if (!empty($half_content_button)) : ?>
							<?php
								$button_url    = $half_content_button['url'] ?? '';
								$button_title  = $half_content_button['title'] ?? '';
								$button_target = !empty($half_content_button['target']) ? $half_content_button['target'] : '_self';
							?>
							<a class="button" href="<?php echo esc_url($button_url); ?>" target="<?php echo esc_attr($button_target); ?>">
								<?php echo esc_html($button_title); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($icons) : ?>
				<div class="icon-list">
					<?php foreach( $icons as $row ):
						$icon = $row['icon'];
						$title = $row['title'];
						$description = $row['description']; ?>

						<div class="icon-item">
							<?php if($icon): ?>
								<div class="icon-img"><?php echo wp_get_attachment_image( $icon, 'full' ); ?></div>
							<?php endif; ?>

							<?php if($title): ?>
								<h6><?php echo $title; ?></h6>
							<?php endif; ?>

							<?php if($description): ?>
								<p><?php echo $description; ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if($bottom_description): ?>
		<div class="botdesc">
			<div class="container">
				<?php echo $bottom_description; ?>
				<?php if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self'; ?>
					<a class="btn-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><i class="fa-solid fa-chevron-right"></i></a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
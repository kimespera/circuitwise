<?php
	$heading = get_field('heading');
	$timeline_list = get_field('timeline_list');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'timeline-block';

	if (!empty($block['className'])) {
		$class_name .= ' ' . $block['className'];
	}

?>
<?php if ($anchor_id) : ?>
	<div id="<?php echo esc_attr($anchor_id); ?>"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($class_name); ?>">
	<div class="container">
		<h2><?php echo $heading; ?></h2>
		<?php if ($timeline_list) : ?>
			<div id="timeline-list" class="timeline-list">
				<?php foreach( $timeline_list as $row ):
					$year = $row['year'];
					$description = $row['description']; ?>

					<div class="timeline-item">
						<div class="item-line"></div>
						<div class="item-box">
							<div><b><?php echo $year; ?></b></div>
							<div><?php echo $description; ?></div>
						</div>
						<div class="item-box">
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
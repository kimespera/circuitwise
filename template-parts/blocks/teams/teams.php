<?php
	$heading = get_field('heading');
	$teams_list = get_field('teams_list');

	$anchor_id = $block['anchor'] ?? '';
	$class_name = 'teams-block';

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
		<?php if ($teams_list) : ?>
			<div class="teams-list">
				<?php foreach( $teams_list as $row ):
					$photo = $row['photo'];
					$name = $row['name'];
					$position = $row['position'];
					$linkedin_profile = $row['linkedin_profile']; ?>

					<div class="team-item">
						<?php if($photo): ?>
							<div class="team-photo"><?php echo wp_get_attachment_image( $photo, 'full' ); ?></div>
						<?php else : ?>
							<div class="team-photo"><img src="<?php echo get_template_directory_uri(); ?>/img/image-placeholder.jpg" alt="Placeholder"></div>
						<?php endif; ?>

						<?php if($name): ?>
							<h5><?php echo $name; ?></h5>
						<?php endif; ?>
						
						<?php if($position): ?>
							<p><?php echo $position; ?></p>
						<?php endif; ?>

						<?php if($linkedin_profile): ?>
							<a href="<?php echo $linkedin_profile; ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
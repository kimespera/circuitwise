<?php
	$footer_logo = get_field('footer_logo','option');
	$address = get_field('address','option');
	$phone_number = get_field('phone_number','option');
	$abn_number = get_field('abn_number','option');
	$linkedin = get_field('linkedin','option');
	$privacy_link = get_field('privacy_link','option');
	$quality_link = get_field('quality_link','option');
?>
	<footer class="footer">
		<div class="footer-navigation">
			<div class="footer-inner container">
				<div class="footer-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo wp_get_attachment_image($footer_logo, 'full'); ?>
					</a>
				</div>
				<div class="footer-details">
					<h6><?php bloginfo('name'); ?></h6>
					<?php if($address): ?>
						<p><?php echo $address; ?></p>
					<?php endif; ?>
					
					<?php if($phone_number): ?>
						<p class="phone-num"><b>Phone:</b> <?php echo $phone_number; ?></p>
					<?php endif; ?>

					<?php if($abn_number): ?>
						<p class="abn-num"><b>ABN:</b> <?php echo $abn_number; ?></p>
					<?php endif; ?>
				</div>
				<div class="footer-nav">
					<?php
						wp_nav_menu(array(
							'container' => 'nav',
							'menu' => '3',
							'menu_id' => 'footer-menu',
							'menu_class' => 'footer-menu'
						));
					?>
				</div>
				<div class="footer-social">
					<a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="footer-inner container">
				<div class="footer-col"></div>
				<div class="copyright"><?php echo date("Y"); ?> &copy; <?php bloginfo('name'); ?>. All rights reserved.</div>
				<div class="policy-links">
					<ul>
						<?php if($privacy_link): ?>
							<li>
								<a href="<?php echo $privacy_link; ?>">Privacy Policy</a>
							</li>
						<?php endif; ?>
						<?php if($quality_link): ?>
							<li>
								<a href="<?php echo $quality_link; ?>">Quality Policy</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>

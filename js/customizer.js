( function( $ ) {
	$('#main-menu').slicknav({
		label: '',
		prependTo:'#menu-burger',
		closeOnClick: true,
		allowParentLinks: true,
		closedSymbol: '',
		openedSymbol: '',
	});

	$('#logo-list').slick({
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000,
		slidesToShow: 5,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	function toggleActiveClass($field) {
		if ($field.val().trim() !== '') {
			$field.closest('.input-wrap').addClass('active');
		} else {
			$field.closest('.input-wrap').removeClass('active');
		}
	}

	$(document).on('focus', '.input-wrap textarea, .input-wrap input', function() {
		$(this).closest('.input-wrap').addClass('active');
	});

	$(document).on('blur', '.input-wrap textarea, .input-wrap input', function() {
		toggleActiveClass($(this));
	});

	$(document).on('click', '.input-wrap label', function() {
		const $input = $(this).siblings('input, textarea');
		if ($input.length) {
			$input.trigger('focus');
		}
	});

	const items = $('.resource-item');
	const itemsPerLoad = 3;
	let currentVisible = 9;

	// Initially hide all and show the first set
	items.hide().slice(0, currentVisible).show();

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
			// Load next batch
			currentVisible += itemsPerLoad;
			items.slice(0, currentVisible).fadeIn();
		}
	});

	$('.slider-resources').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		nextArrow: '<span class="nextArrow"><i class="fa-solid fa-chevron-right"></i></span>',
		prevArrow: '<span class="prevArrow"><i class="fa-solid fa-chevron-left"></i></span>',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 500,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	$('#timeline-list').slick({
		infinite: false,
		slidesToShow: 6,
		slidesToScroll: 1,
		nextArrow: '<span class="nextArrow"><i class="fa-solid fa-chevron-right"></i></span>',
		prevArrow: '<span class="prevArrow"><i class="fa-solid fa-chevron-left"></i></span>',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 5
				}
			},
			{
				breakpoint: 500,
				settings: {
					slidesToShow: 3
				}
			}
		]
	});

	function equalizeItemBoxHeights() {
		$('#timeline-list .timeline-item').each(function() {
			var tallest = 0;
			var boxes = $(this).find('.item-box');

			// Reset height first (important when recalculating)
			boxes.css('min-height', '');

			// Find tallest
			boxes.each(function() {
				var h = $(this).outerHeight();
				if (h > tallest) tallest = h;
			});

			// Apply height
			boxes.css('min-height', tallest + 'px');
		});
	}

	// Run on page load
	equalizeItemBoxHeights();

	// Run on resize
	$(window).on('resize', function() {
		equalizeItemBoxHeights();
	});

}( jQuery ) );

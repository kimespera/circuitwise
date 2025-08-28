( function( $ ) {
	$('#main-menu').slicknav({
		label: '',
		prependTo:'#menu-burger',
		closeOnClick: true,
		allowParentLinks: true,
		closedSymbol: '',
		openedSymbol: ''
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

	const $certs = $('.singlecol .cert-imgs');
	$certs.slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		nextArrow: '<span class="nextArrow"><i class="fa-solid fa-chevron-right"></i></span>',
		prevArrow: '<span class="prevArrow"><i class="fa-solid fa-chevron-left"></i></span>',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 500,
				settings: {
					slidesToShow: 2
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
					slidesToShow: 4
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 3
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

	const $items = $('.resource-item');
	const itemsPerLoad = 3;
	let currentVisible = 9;
	const threshold = 900;       // start loading when you're within 600px of the bottom
	let loading = false;
	let debounce;

	// init
	$items.hide().slice(0, currentVisible).show();

	function revealNext() {
		if (loading) return;
		if (currentVisible >= $items.length) {
		// all shown; stop listening
		$(window).off('scroll.infinite resize.infinite');
			return;
		}
		loading = true;

		const nextVisible = Math.min(currentVisible + itemsPerLoad, $items.length);
		$items.slice(currentVisible, nextVisible).fadeIn(180);
		currentVisible = nextVisible;

		loading = false;
	}

	function nearBottom() {
		return $(window).scrollTop() + $(window).height() >= $(document).height() - threshold;
	}

	function onScroll() {
		clearTimeout(debounce);
		debounce = setTimeout(function () {
		if (nearBottom()) revealNext();
		// If content still doesn't fill viewport, keep loading until it does or we run out
		while ($(document).height() <= $(window).height() + threshold && currentVisible < $items.length) {
			revealNext();
		}
		}, 80);
	}

	// bind + run once
	$(window).on('scroll.infinite resize.infinite', onScroll);
	onScroll(); // prime load in case page starts short

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
	equalizeItemBoxHeights();

	$(window).on('resize', function() {
		equalizeItemBoxHeights();
	});

	// Sticky header
	var header = $('#header');
	var stickyOffset = header.offset().top;

	$(window).on('scroll', function() {
		if ($(window).scrollTop() > stickyOffset) {
			header.addClass('sticky');
		} else {
			header.removeClass('sticky');
		}
	});

	function checkVisibility() {
		$('h2').each(function() {
			let top = $(this).offset().top;
			let bottom = top + $(this).outerHeight();
			let viewTop = $(window).scrollTop();
			let viewBottom = viewTop + $(window).height();

			if (bottom > viewTop && top < viewBottom) {
				$(this).addClass('visible'); // show when in view
			} else {
				$(this).removeClass('visible'); // hide when out of view
			}
		});
	}

	// Run on load + scroll
	checkVisibility();
	$(window).on('scroll resize', checkVisibility);

}( jQuery ) );

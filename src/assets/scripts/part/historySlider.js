import Swiper from "swiper";
import Autoplay from "swiper/modules/autoplay.mjs";

export const HISTORY_SLIDER_SELECTOR =
	".fd-history-slider-block__slider.swiper";

/**
 * Initialise Swiper on a single history slider block (timeline-style horizontal slider).
 * Autoplay starts only when the element is 300px into the viewport.
 * @param {HTMLElement} el - Container with class .fd-history-slider-block__slider.swiper
 * @returns {Swiper | null}
 */
export function initHistorySlider(el) {
	if (!el || el._fdHistorySwiper) return null;

	const swiper = new Swiper(el, {
		modules: [Autoplay],
		slidesPerView: 1.15,
		spaceBetween: 24,
		centeredSlides: false,
		grabCursor: true,
		speed: 25000,
		autoplay: {
			delay: 1,
			disableOnInteraction: false,
			reverseDirection: false,
		},
		breakpoints: {
			640: {
				slidesPerView: 1.5,
				spaceBetween: 28,
			},
			1024: {
				slidesPerView: 2,
				spaceBetween: 42,
			},
			1280: {
				slidesPerView: 3.2,
				spaceBetween: 72,
			},
		},
	});

	var AUTOPLAY_SPEED = 25000;
	var DRAG_SPEED = 150;

	// Reverse autoplay direction when reaching first/last slide
	swiper.on("reachEnd", function () {
		swiper.params.autoplay.reverseDirection = true;
	});
	swiper.on("reachBeginning", function () {
		swiper.params.autoplay.reverseDirection = false;
	});

	// Use fast speed during drag, restore slow speed for autoplay
	swiper.on("touchStart", function () {
		swiper.params.speed = DRAG_SPEED;
	});
	swiper.on("touchEnd", function () {
		setTimeout(function () {
			swiper.params.speed = AUTOPLAY_SPEED;
		}, DRAG_SPEED);
	});

	// Pause immediately, wait for viewport entry
	swiper.autoplay.stop();

	// Start autoplay when 300px of the slider enters the viewport
	var observer = new IntersectionObserver(
		function (entries) {
			if (entries[0].isIntersecting) {
				swiper.autoplay.start();
				observer.disconnect();
			}
		},
		{ rootMargin: "0px 0px -400px 0px" },
	);
	observer.observe(el);

	el._fdHistorySwiper = swiper;
	return swiper;
}

/**
 * Initialise all history sliders on the page.
 */
export default function initHistorySliders() {
	document.querySelectorAll(HISTORY_SLIDER_SELECTOR).forEach(initHistorySlider);
}

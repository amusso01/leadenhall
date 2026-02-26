import Swiper from "swiper";
import Autoplay from "swiper/modules/autoplay.mjs";

export const MARQUEE_SLIDER_SELECTOR = ".fd-marquee-block__slider.swiper";

/**
 * Initialise Swiper on a single marquee block (logo strip). Continuous infinite scroll.
 * @param {HTMLElement} el - Container with class .fd-marquee-block__slider.swiper
 * @returns {Swiper | null}
 */
export function initMarqueeSlider(el) {
	if (!el || el._fdMarqueeSwiper) return null;

	var swiper = new Swiper(el, {
		modules: [Autoplay],
		loop: true,
		loopAdditionalSlides: 10,
		speed: 12000,
		slidesPerView: "auto",
		spaceBetween: 48,
		autoplay: {
			delay: 1,
			disableOnInteraction: false,
		},
		breakpoints: {
			640: {
				spaceBetween: 56,
			},
			1024: {
				spaceBetween: 72,
			},
		},
	});

	el._fdMarqueeSwiper = swiper;
	return swiper;
}

/**
 * Initialise all marquee sliders on the page.
 */
export default function initMarqueeSliders() {
	document.querySelectorAll(MARQUEE_SLIDER_SELECTOR).forEach(initMarqueeSlider);
}

import Swiper from "swiper";
import Navigation from "swiper/modules/navigation.mjs";
import Pagination from "swiper/modules/pagination.mjs";

export const TESTIMONIAL_SLIDER_SELECTOR =
	".fd-testimonial-block__slider.swiper";

/**
 * Initialise Swiper on a single testimonial block slider.
 * @param {HTMLElement} el - Container with class .fd-testimonial-block__slider.swiper
 * @returns {Swiper | null}
 */
export function initTestimonialSlider(el) {
	if (!el || el._fdTestimonialSwiper) return null;

	var block = el.closest(".fd-testimonial-block");

	var swiper = new Swiper(el, {
		modules: [Navigation, Pagination],
		slidesPerView: 1,
		spaceBetween: 24,
		grabCursor: true,
		navigation: {
			prevEl: block.querySelector(".fd-testimonial-block__prev"),
			nextEl: block.querySelector(".fd-testimonial-block__next"),
		},
		pagination: {
			el: block.querySelector(".fd-testimonial-block__pagination"),
			clickable: true,
			type: "bullets",
		},
	});

	el._fdTestimonialSwiper = swiper;
	return swiper;
}

export default function initTestimonialSliders() {
	document
		.querySelectorAll(TESTIMONIAL_SLIDER_SELECTOR)
		.forEach(initTestimonialSlider);
}

import Swiper from "swiper";
import Navigation from "swiper/modules/navigation.mjs";

export const TEAM_SLIDER_SELECTOR = ".sectors-team__slider.swiper";

/**
 * Initialise Swiper on a single team slider.
 * @param {HTMLElement} el
 * @returns {Swiper | null}
 */
export function initTeamSlider(el) {
	if (!el || el._fdTeamSwiper) return null;

	var swiper = new Swiper(el, {
		modules: [Navigation],
		slidesPerView: 1.25,
		spaceBetween: 20,
		grabCursor: true,
		navigation: {
			prevEl: el.closest(".sectors-team").querySelector(".sectors-team__prev"),
			nextEl: el.closest(".sectors-team").querySelector(".sectors-team__next"),
		},
		breakpoints: {
			640: {
				slidesPerView: 2.25,
				spaceBetween: 24,
			},
			1024: {
				slidesPerView: 3.5,
				spaceBetween: 30,
			},
			1280: {
				slidesPerView: 4.5,
				spaceBetween: 40,
			},
		},
	});

	el._fdTeamSwiper = swiper;
	return swiper;
}

export default function initTeamSliders() {
	document.querySelectorAll(TEAM_SLIDER_SELECTOR).forEach(initTeamSlider);
}

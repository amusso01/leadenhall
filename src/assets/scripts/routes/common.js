import "arrive";
import smoothscroll from "smoothscroll-polyfill";
import hamburger from "../part/hamburger";
import navigation from "../part/navigation";
import { COUNT_UP_SELECTOR, initCountUpElement } from "../part/countUp";
import { GLOBAL_MAP_BLOCK_SELECTOR, initGlobalMapHitAreasForBlock } from "../part/globalMapHitArea";
import { HISTORY_SLIDER_SELECTOR, initHistorySlider } from "../part/historySlider";
import { MARQUEE_SLIDER_SELECTOR, initMarqueeSlider } from "../part/marqueeSlider";
import { TEAM_SLIDER_SELECTOR, initTeamSlider } from "../part/teamSlider";
import { TESTIMONIAL_SLIDER_SELECTOR, initTestimonialSlider } from "../part/testimonialSlider";
import { TEAMS_BLOCK_SELECTOR, initTeamsBlock } from "../part/teamsBlock";
import { ACCORDION_BLOCK_SELECTOR, initAccordionBlock } from "../part/accordionBlock";

export default {
	init() {
		// JavaScript to be fired on all pages

		// kick off the polyfill!
		smoothscroll.polyfill();

		// Always on page: direct init (no arrive)
		hamburger();
		navigation();

		// CountUp: run only when component is on the page
		document.arrive(COUNT_UP_SELECTOR, { existing: true }, (el) => {
			initCountUpElement(el);
		});

		// Global map: run only when component is on the page
		document.arrive(GLOBAL_MAP_BLOCK_SELECTOR, { existing: true }, (block) => {
			initGlobalMapHitAreasForBlock(block);
		});

		// History slider (timeline): run only when block is on the page
		document.arrive(HISTORY_SLIDER_SELECTOR, { existing: true }, (el) => {
			initHistorySlider(el);
		});

		// Marquee block (logo strip): run only when block is on the page
		document.arrive(MARQUEE_SLIDER_SELECTOR, { existing: true }, (el) => {
			initMarqueeSlider(el);
		});

		// Team slider: run only when block is on the page
		document.arrive(TEAM_SLIDER_SELECTOR, { existing: true }, (el) => {
			initTeamSlider(el);
		});

		// Testimonial block slider: run only when block is on the page
		document.arrive(TESTIMONIAL_SLIDER_SELECTOR, { existing: true }, (el) => {
			initTestimonialSlider(el);
		});

		// Teams block: run only when block is on the page
		document.arrive(TEAMS_BLOCK_SELECTOR, { existing: true }, (el) => {
			initTeamsBlock(el);
		});

		// Accordion block: run only when block is on the page
		document.arrive(ACCORDION_BLOCK_SELECTOR, { existing: true }, (el) => {
			initAccordionBlock(el);
		});
	},

	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};

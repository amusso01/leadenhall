import "arrive";
import smoothscroll from "smoothscroll-polyfill";
import hamburger from "../part/hamburger";
import navigation from "../part/navigation";
import { COUNT_UP_SELECTOR, initCountUpElement } from "../part/countUp";
import { GLOBAL_MAP_BLOCK_SELECTOR, initGlobalMapHitAreasForBlock } from "../part/globalMapHitArea";
import { HISTORY_SLIDER_SELECTOR, initHistorySlider } from "../part/historySlider";

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
	},

	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};

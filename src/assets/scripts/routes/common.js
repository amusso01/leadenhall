import smoothscroll from "smoothscroll-polyfill";
import hamburger from "../part/hamburger";
import navigation from "../part/navigation";
import initCountUp from "../part/countUp";

export default {
	init() {
		// JavaScript to be fired on all pages

		// kick off the polyfill!
		smoothscroll.polyfill();

		// Hamburger event listener
		hamburger();

		// Navigation event listener
		navigation();

		// CountUp: animate numbers when in view (.js-count-up[data-count-end])
		initCountUp();
	},

	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};

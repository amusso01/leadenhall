import smoothscroll from "smoothscroll-polyfill";
import hamburger from "../part/hamburger";
import navigation from "../part/navigation";
export default {
	init() {
		// JavaScript to be fired on all pages

		// kick off the polyfill!
		smoothscroll.polyfill();

		// Hamburger event listener
		hamburger();

		// Navigation event listener
		navigation();
	},

	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	},
};

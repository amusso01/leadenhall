import { CountUp } from "countup.js";

const COUNT_UP_SELECTOR = ".js-count-up[data-count-end]";
const DEFAULT_DURATION = 3.5;
const DEFAULT_DECIMALS = 0;

/**
 * Initialise CountUp on all elements with data-count-end.
 * Uses enableScrollSpy so each number animates when it scrolls into view.
 * Data attributes: data-count-end (number), data-count-suffix, data-count-decimals, data-count-duration (seconds, optional).
 */
export default function initCountUp() {
	const elements = document.querySelectorAll(COUNT_UP_SELECTOR);
	if (!elements.length) return;

	elements.forEach((el) => {
		const endVal = parseFloat(el.getAttribute("data-count-end"), 10);
		if (Number.isNaN(endVal)) return;

		const suffix = el.getAttribute("data-count-suffix") || "";
		const decimals = parseInt(el.getAttribute("data-count-decimals"), 10);
		const decimalPlaces = Number.isNaN(decimals) ? DEFAULT_DECIMALS : decimals;
		const durationAttr = parseFloat(el.getAttribute("data-count-duration"), 10);
		const duration = Number.isNaN(durationAttr) || durationAttr <= 0 ? DEFAULT_DURATION : durationAttr;

		const countUp = new CountUp(el, endVal, {
			startVal: 0,
			duration,
			decimalPlaces,
			suffix,
			useGrouping: false,
			enableScrollSpy: true,
			scrollSpyOnce: true,
		});

		if (countUp.error) {
			console.warn("CountUp init error:", countUp.error, el);
			return;
		}
		// With enableScrollSpy, do not call start() – CountUp starts when in view
	});
}

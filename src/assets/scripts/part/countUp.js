import { CountUp } from "countup.js";

export const COUNT_UP_SELECTOR = ".js-count-up[data-count-end]";
const DEFAULT_DURATION = 3.5;
const DEFAULT_DECIMALS = 0;

/**
 * Initialise CountUp on a single element (for use with arrive.js).
 * Uses enableScrollSpy so the number animates when it scrolls into view.
 * Data attributes: data-count-end (number), data-count-suffix, data-count-prefix,
 *   data-count-decimals, data-count-duration (seconds, optional),
 *   data-count-use-grouping (optional), data-count-separator, data-count-decimal.
 */
export function initCountUpElement(el) {
	const endVal = parseFloat(el.getAttribute("data-count-end"), 10);
	if (Number.isNaN(endVal)) return;

	const suffix = el.getAttribute("data-count-suffix") || "";
	const prefix = el.getAttribute("data-count-prefix") || "";
	const decimals = parseInt(el.getAttribute("data-count-decimals"), 10);
	const decimalPlaces = Number.isNaN(decimals) ? DEFAULT_DECIMALS : decimals;
	const durationAttr = parseFloat(el.getAttribute("data-count-duration"), 10);
	const duration = Number.isNaN(durationAttr) || durationAttr <= 0 ? DEFAULT_DURATION : durationAttr;
	const useGrouping = el.getAttribute("data-count-use-grouping") === "true" || el.getAttribute("data-count-use-grouping") === "1";
	const separator = el.getAttribute("data-count-separator") ?? ",";
	const decimal = el.getAttribute("data-count-decimal") ?? ".";

	const countUp = new CountUp(el, endVal, {
		startVal: 0,
		duration,
		decimalPlaces,
		suffix,
		prefix,
		useGrouping,
		separator,
		decimal,
		enableScrollSpy: true,
		scrollSpyOnce: true,
	});

	if (countUp.error) {
		console.warn("CountUp init error:", countUp.error, el);
		return;
	}
	// With enableScrollSpy, do not call start() – CountUp starts when in view
}

/**
 * Initialise CountUp on all elements with data-count-end (legacy / batch).
 */
export default function initCountUp() {
	const elements = document.querySelectorAll(COUNT_UP_SELECTOR);
	elements.forEach(initCountUpElement);
}

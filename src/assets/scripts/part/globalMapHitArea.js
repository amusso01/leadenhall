/**
 * Size each global map marker’s hit rect to the bounding box of its label + line + dot
 * so the hover area always covers the full label (no fixed width).
 */
const PADDING = 6; // extra units around the content so hit area is slightly larger
const MARKER_VISIBLE_CLASS = "fd-global-map-marker--visible";
const MARKER_AOS_OFFSET = 50; // trigger when top of marker is 150px inside viewport from bottom (scrolling down)

function getUnionBox(boxA, boxB) {
	if (!boxA)
		return { x: boxB.x, y: boxB.y, width: boxB.width, height: boxB.height };
	const minX = Math.min(boxA.x, boxB.x);
	const minY = Math.min(boxA.y, boxB.y);
	const maxX = Math.max(boxA.x + boxA.width, boxB.x + boxB.width);
	const maxY = Math.max(boxA.y + boxA.height, boxB.y + boxB.height);
	return { x: minX, y: minY, width: maxX - minX, height: maxY - minY };
}

function sizeMarkerHitArea(marker) {
	const hit = marker.querySelector(".fd-global-map-marker__hit");
	if (!hit) return;

	let box = null;
	for (let i = 0; i < marker.children.length; i++) {
		const child = marker.children[i];
		if (child === hit) continue;
		try {
			const childBox = child.getBBox();
			box = getUnionBox(box, childBox);
		} catch (_) {
			// getBBox can fail on some elements; skip
		}
	}
	if (!box) return;

	hit.setAttribute("x", box.x - PADDING);
	hit.setAttribute("y", box.y - PADDING);
	hit.setAttribute("width", box.width + PADDING * 2);
	hit.setAttribute("height", box.height + PADDING * 2);
}

export const GLOBAL_MAP_BLOCK_SELECTOR = ".fd-global-map-block";

/**
 * Fade-in markers on scroll via Intersection Observer (works on SVG; AOS does not).
 */
function initMarkerFadeIn(block) {
	const map = block.querySelector(".fd-global-map-block__map");
	if (!map) return;
	const markers = map.querySelectorAll(".fd-global-map-marker");
	if (!markers.length) return;

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add(MARKER_VISIBLE_CLASS);
				}
			});
		},
		{
			rootMargin: `0px 0px -${MARKER_AOS_OFFSET}px 0px`,
			threshold: 0,
		},
	);
	markers.forEach((marker) => observer.observe(marker));
}

/**
 * Size hit areas for a single global map block (for use with arrive.js).
 */
export function initGlobalMapHitAreasForBlock(block) {
	const map = block.querySelector(".fd-global-map-block__map");
	if (!map) return;
	const markers = map.querySelectorAll(".fd-global-map-marker");
	markers.forEach(sizeMarkerHitArea);
	initMarkerFadeIn(block);
}

export default function initGlobalMapHitAreas() {
	const blocks = document.querySelectorAll(GLOBAL_MAP_BLOCK_SELECTOR);
	blocks.forEach(initGlobalMapHitAreasForBlock);
}

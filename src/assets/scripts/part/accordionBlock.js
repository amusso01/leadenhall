import Accordion from "accordion-js";

export const ACCORDION_BLOCK_SELECTOR = ".accordion-block";

export function initAccordionBlock(block) {
  const container = block.querySelector(".accordion-container");
  if (!container) return;

  new Accordion(container, {
    duration: 300,
    showMultiple: false,
    openOnInit: [0],
  });
}

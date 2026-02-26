export const TEAMS_BLOCK_SELECTOR = ".fd-teams-block";

export function initTeamsBlock(block) {
  const sectorToggle = block.querySelector(".fd-teams-block__sector-toggle");
  const sectorDropdown = block.querySelector(".fd-teams-block__sector-dropdown");
  const sectorOptions = block.querySelectorAll(".fd-teams-block__sector-option");
  const searchInput = block.querySelector(".fd-teams-block__search-input");
  const cards = block.querySelectorAll(".fd-teams-block__card");
  const noResults = block.querySelector(".fd-teams-block__no-results");

  let activeSector = "";
  let searchQuery = "";

  // Sector dropdown toggle
  if (sectorToggle && sectorDropdown) {
    sectorToggle.addEventListener("click", () => {
      const isOpen = sectorToggle.getAttribute("aria-expanded") === "true";
      sectorToggle.setAttribute("aria-expanded", !isOpen);
      sectorDropdown.classList.toggle("fd-teams-block__sector-dropdown--open");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
      if (!sectorToggle.contains(e.target) && !sectorDropdown.contains(e.target)) {
        sectorToggle.setAttribute("aria-expanded", "false");
        sectorDropdown.classList.remove("fd-teams-block__sector-dropdown--open");
      }
    });
  }

  // Sector option click
  sectorOptions.forEach((option) => {
    option.addEventListener("click", () => {
      activeSector = option.dataset.sector;

      // Update active state
      sectorOptions.forEach((o) => o.classList.remove("fd-teams-block__sector-option--active"));
      option.classList.add("fd-teams-block__sector-option--active");

      // Update toggle label
      if (sectorToggle) {
        sectorToggle.querySelector("span").textContent = activeSector
          ? option.textContent.trim()
          : "Search by sectors";
      }

      // Close dropdown
      if (sectorToggle && sectorDropdown) {
        sectorToggle.setAttribute("aria-expanded", "false");
        sectorDropdown.classList.remove("fd-teams-block__sector-dropdown--open");
      }

      filterCards();
    });
  });

  // Search input
  if (searchInput) {
    searchInput.addEventListener("input", (e) => {
      searchQuery = e.target.value.toLowerCase().trim();
      filterCards();
    });
  }

  function filterCards() {
    let visibleCount = 0;

    cards.forEach((card) => {
      const cardSectors = card.dataset.sectors || "";
      const cardName = card.dataset.name || "";

      const matchesSector = !activeSector || cardSectors.split(" ").includes(activeSector);
      const matchesSearch = !searchQuery || cardName.includes(searchQuery);

      if (matchesSector && matchesSearch) {
        card.classList.remove("fd-teams-block__card--hidden");
        visibleCount++;
      } else {
        card.classList.add("fd-teams-block__card--hidden");
      }
    });

    if (noResults) {
      noResults.style.display = visibleCount === 0 ? "block" : "none";
    }
  }
}

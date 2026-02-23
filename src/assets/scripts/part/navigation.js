const NAV_BREAKPOINT = 1140;

export default function navigation() {
	const menuItems = document.querySelectorAll(".menu-item-has-children");
	const mediaQuery = window.matchMedia(`(max-width: ${NAV_BREAKPOINT - 1}px)`);
	let abortController = null;

	function setupDesktop(signal) {
		menuItems.forEach((item) => {
			item.addEventListener("click", (e) => {
				if (e.target.closest(".sub-menu")) return; // let submenu links navigate
				e.preventDefault();
			}, { signal });
			item.addEventListener("mouseenter", () => {
				item.querySelector(".sub-menu")?.classList.add("active");
			}, { signal });
		});
		menuItems.forEach((item) => {
			item.addEventListener("mouseleave", () => {
				item.querySelector(".sub-menu")?.classList.remove("active");
			}, { signal });
		});
	}

	function setupMobile(signal) {
		menuItems.forEach((item) => {
			const subMenu = item.querySelector(".sub-menu");
			let touched = false;
			const toggleSubMenu = (e) => {
				e.preventDefault();
				subMenu?.classList.toggle("active");
			};
			const isSubmenuClick = (e) => e.target.closest(".sub-menu");
			item.addEventListener("click", (e) => {
				if (isSubmenuClick(e)) return; // let submenu links navigate
				if (touched) {
					touched = false;
					e.preventDefault();
					return;
				}
				toggleSubMenu(e);
			}, { signal });
			item.addEventListener("touchend", (e) => {
				if (isSubmenuClick(e)) return; // let submenu links work
				touched = true;
				toggleSubMenu(e);
				setTimeout(() => { touched = false; }, 400);
			}, { signal });
		});

		const closeSubmenusOutside = (e) => {
			// Don't close when clicking the parent item or any link inside the submenu
			if (e.target.closest(".menu-item-has-children") || e.target.closest(".sub-menu")) return;
			document.querySelectorAll(".menu-item-has-children .sub-menu.active").forEach((sub) => {
				sub.classList.remove("active");
			});
		};
		document.addEventListener("click", closeSubmenusOutside, { signal });
		document.addEventListener("touchend", closeSubmenusOutside, { signal });
	}

	function setup() {
		abortController?.abort();
		abortController = new AbortController();
		const { signal } = abortController;

		if (mediaQuery.matches) {
			setupMobile(signal);
		} else {
			setupDesktop(signal);
		}
	}

	setup();
	mediaQuery.addEventListener("change", setup);
}

export default function hamburger() {
	const burger = document.getElementById("hamburger");
	const mainMenu = document.getElementById("menu_main");
	const primaryMenuContainer = document.querySelector(".primary-menu-container");
	const htmlElement = document.querySelector("html");
	const burgerInner = burger.querySelector(".hamburger-menu");

	burger.addEventListener("click", function () {
		primaryMenuContainer?.classList.toggle("active");
		mainMenu.classList.toggle("hidden_mobile");
		burgerInner.classList.toggle("animate");

		// prevent content scrolling
		htmlElement.classList.toggle("noscroll");
	});
}

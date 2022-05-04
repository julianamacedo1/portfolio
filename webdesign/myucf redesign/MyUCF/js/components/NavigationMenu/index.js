class NavigationMenu {
    static initialize() {
        const menu = document.querySelector(".tab-nav-container");
        const toggle = document.querySelector(".tab-nav-mobile-toggle");

        toggle.addEventListener("click", () => {
            if (menu.getAttribute("open") === "") {
                menu.classList.add("animate-close");
                menu.addEventListener("animationend", ({target}) => {
                    target.classList.remove("animate-close");
                    target.removeAttribute("open");
                }, {once: true});
            } else {
                menu.classList.add("animate-open");
                menu.addEventListener("animationend", ({target}) => {
                    target.classList.remove("animate-open");
                    target.setAttribute("open", "");
                }, {once: true});
            }
        })
    }
}

export default NavigationMenu;
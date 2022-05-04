import MultiViewSelector from "../MultiViewSelector/index.js";

class DropdownMenu extends MultiViewSelector {
    static allowActionOnSameSelector = true;

    static initialize() {
        const menuContainer = document.querySelector(`.dropdown-menu-container[componentid=${this.componentId}]`);
        const menuOptionsContainer = menuContainer.querySelector(".dropdown-menu-options-container");
        const menuValue = menuContainer.querySelector(".dropdown-menu-value");
        const menuOptions = [...menuContainer.querySelectorAll(".dropdown-menu-option")];

        menuOptionsContainer.style.setProperty("--height", `${menuOptionsContainer.scrollHeight}px`);
        menuContainer.addEventListener("click", () => this.openDropdownMenu(menuContainer, menuOptionsContainer));

        this.initializeComponent(menuOptions, {data: {menuContainer, menuOptionsContainer, menuValue}});
    }

    static openDropdownMenu(menu, menuOptionsContainer) {
        if (!menu || 
            !menuOptionsContainer || 
            menu.getAttribute("open") !== null ||
            menuOptionsContainer.classList.contains("animate-open") || 
            menuOptionsContainer.classList.contains("animate-close")
            ) 
            return;

        menuOptionsContainer.classList.add("animate-open");
        menuOptionsContainer.addEventListener("animationend", () => {
            menuOptionsContainer.classList.remove("animate-open");
            menu.setAttribute("open", "");
        }, {once: true});
    }

    static closeDropdownMenu(menu, menuOptionsContainer) {
        if (!menu || 
            !menuOptionsContainer ||
            menuOptionsContainer.classList.contains("animate-open") || 
            menuOptionsContainer.classList.contains("animate-close")
            ) 
            return;

        menuOptionsContainer.classList.add("animate-close");
        menuOptionsContainer.addEventListener("animationend", () => {
            menuOptionsContainer.classList.remove("animate-close");
            menu.removeAttribute("open");
        }, {once: true});
    }

    static selectorWasClicked({selector, params}) {
        if (!selector) return;

        const selectorValue = selector.innerText;

        const menuContainer = params.data.menuContainer;
        const menuOptionsContainer = params.data.menuOptionsContainer;
        const menuValue = params.data.menuValue;

        menuValue.textContent = selectorValue;
        this.closeDropdownMenu(menuContainer, menuOptionsContainer);
    }
}

export default DropdownMenu;
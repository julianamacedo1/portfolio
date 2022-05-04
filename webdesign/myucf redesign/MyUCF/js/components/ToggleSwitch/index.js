class ToggleSwitch {
    static componentId = null;

    static initializeComponent(params = {}) {
        const switchElement = document.querySelector(`.toggle-switch[componentid=${this.componentId}]`);
        if (!switchElement) return;

        const on = switchElement.getAttribute("on") === "";
        const data = {
            on,
        };

        switchElement.addEventListener("click", ({target}) => {
            this.handleSwitchClick(target, data);
            this.switchWasClicked({switchElement: target, data, params});
        });
    }

    static handleSwitchClick(switchElement, data) {
        if (!switchElement) return;

        const on = data.on;
        data.on = !data.on;

        if (on) {
            switchElement.removeAttribute("on");
            return;
        }

        switchElement.setAttribute("on", "");
    };

    static switchWasClicked() {}
}

export default ToggleSwitch;
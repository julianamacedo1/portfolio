import MultiViewSelectorDataWrapper from "../MultiViewSelectorDataWrapper/index.js";

class MultiViewSelector {
    static componentId = "";
    static allowActionOnSameSelector = false;

    static initializeComponent(selectors, params = {}) {
        if (!selectors) return;

        const data = new MultiViewSelectorDataWrapper();

        selectors.forEach((selector) => {
            const viewId = selector.getAttribute("forview");
            const view = document.querySelector(`[viewid=${viewId}]`);

            if (selector.getAttribute("selected") !== null) 
                data.activeViewId = viewId;

            if (view) {
                data.addSelectorViewLink(viewId, selector, view);
                selector.addEventListener("click", ({target}) => this.handleSelectorClick(data, target, params));
            }
        });

        return data;
    }

    static handleSelectorClick(data, selector, params = {}) {
        if (!selector) return;

        const newViewId = selector.getAttribute("forview");
        const oldViewId = data.activeViewId;

        if (!this.allowActionOnSameSelector && oldViewId === newViewId) return;

        data.viewFromId(oldViewId).classList.add("hidden");
        data.selectorFromId(oldViewId).removeAttribute("selected");

        data.viewFromId(newViewId).classList.remove("hidden");
        data.selectorFromId(newViewId).setAttribute("selected", "");

        data.activeViewId = newViewId;

        this.selectorWasClicked({data, newViewId, oldViewId, selector, params});
    }

    static selectorWasClicked(params) {}
}

export default MultiViewSelector;
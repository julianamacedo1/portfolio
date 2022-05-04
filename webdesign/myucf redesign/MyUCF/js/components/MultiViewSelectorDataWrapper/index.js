class MultiViewSelectorDataWrapper {
    selectorToViewMap;
    activeViewId;

    constructor(activeViewId = null) {
        this.selectorToViewMap = {};
        this.activeViewId = activeViewId;
    }
    
    addSelectorViewLink(id, selector, view) {
        if (this.selectorToViewMap[id] !== undefined) return;

        this.selectorToViewMap[id] = {
            selector,
            view,
        };
    }

    viewFromId(id) {
        return this.selectorToViewMap[id].view;
    }

    selectorFromId(id) {
        return this.selectorToViewMap[id].selector;
    }

    get activeViewId() {
        return this.activeViewId;
    }

    set activeViewId(id) {
        if (this.selectorToViewMap[id] === undefined) return;

        this.activeViewId = id;
    }
}

export default MultiViewSelectorDataWrapper;
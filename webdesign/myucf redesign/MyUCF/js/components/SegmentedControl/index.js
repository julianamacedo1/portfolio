import MultiViewSelector from "../MultiViewSelector/index.js";

class SegmentedControl extends MultiViewSelector {
    static initialize() {
        const segmentedControlContainer = document.querySelector(`.segmented-control-container[componentid=${this.componentId}]`);
        if (!segmentedControlContainer) return;

        const segmentedControlTabs = [...segmentedControlContainer.querySelectorAll(".segmented-control-tab")];

        this.initializeComponent(segmentedControlTabs);
    }
}

export default SegmentedControl;
/*
const segmentedControlTabs = [...document.querySelectorAll(".segmented-control-tab")];
const tabContentViews = [...document.querySelectorAll("[pageid]")];

function resetAllTabs() {
    segmentedControlTabs.forEach((tab) => {
        tab.removeAttribute("selected");
    })
}

function resetAllContentViews() {
    tabContentViews.forEach((view) => {
        view.classList.add("hidden");
    })
}

function getContentView(id) {
    for (let i = 0; i < tabContentViews.length; i++) {
        if (tabContentViews[i].getAttribute("pageid") === id) 
            return tabContentViews[i];
    }
}

segmentedControlTabs.forEach((tab) => {
    tab.addEventListener("click", ({target}) => {
        const pageid = target.getAttribute("forpage");
        const contentView = getContentView(pageid);

        resetAllTabs();
        resetAllContentViews();
        target.setAttribute("selected", "");
        contentView.classList.remove("hidden")
    });
});
*/

import PageController from "../../js/components/PageController/index.js";
import StudentInformationSegmentedControl from "./StudentInformationSegmentedControl/index.js";

PageController.initialize();
StudentInformationSegmentedControl.initialize();
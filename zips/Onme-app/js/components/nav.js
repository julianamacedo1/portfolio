function renderTopNavigationBar(params = {}) {
    const navigationBar = document.createElement("nav");
    const navigationBarContent = document.createElement("div");
    const navigationBarBackContainer = document.createElement("div");
    const navigationBarBackPageTitleAux = document.createElement("p");
    const navigationBarBackPageTitle = document.createElement("button");
    const navigationBarPageTitle = document.createElement("p");
    const navigationBarSectionContainers = [];
    const navigationBarActionContainers = [];
    const navigationBarActions = [];

    const navigationBarSections = ["left", "center", "right"];
    const navigationBarActionTypes = ["secondary", "primary"];

    for (let i = 0; i < navigationBarSections.length; i++) {
        navigationBarSectionContainers[i] = document.createElement("div");
        navigationBarSectionContainers[i].classList.add("top-nav-section", navigationBarSections[i]);
    }

    for (let i = 0; i < navigationBarActionTypes.length; i++) {
        navigationBarActionContainers[i] = document.createElement("div");
        navigationBarActionContainers[i].classList.add("top-nav-action-container", navigationBarActionTypes[i]);

        navigationBarActions[i] = document.createElement("button");
        navigationBarActions[i].classList.add("button", "top-nav-action");

        if (params.actions[navigationBarActionTypes[i]]) {
            switch (params.actions[navigationBarActionTypes[i]].category) {
                case "text":
                    navigationBarActions[i].classList.add("text-button");
                    navigationBarActions[i].textContent = params.actions[navigationBarActionTypes[i]].title;
                    break;
                default:
                    navigationBarActions[i].classList.add("icon-button", "monochrome", "round", params.actions[navigationBarActionTypes[i]].type);
            } 
            navigationBarActions[i].setAttribute("component-id", params.actions[navigationBarActionTypes[i]].id);
        } else
            navigationBarActions[i].classList.add("hidden");

        navigationBarActionContainers[i].appendChild(navigationBarActions[i]);
    }

    navigationBar.classList.add("top-nav");
    navigationBarContent.classList.add("top-nav-content");
    navigationBarBackContainer.classList.add("top-nav-back-container", "at-root");
    navigationBarBackPageTitleAux.classList.add("text", "top-nav-back-page-title", "aux");
    navigationBarBackPageTitle.classList.add("button", "text-button", "top-nav-back-page-title");
    navigationBarPageTitle.classList.add("text", "top-nav-page-title");

    navigationBarBackContainer.setAttribute("animation-style", params.animationStyle ? params.animationStyle : "stack");
    navigationBarPageTitle.textContent = params.title ? params.title : "Title";

    navigationBarBackContainer.append(navigationBarBackPageTitle, navigationBarBackPageTitleAux);
    navigationBarSectionContainers[0].append(navigationBarActionContainers[0], navigationBarBackContainer);
    navigationBarSectionContainers[1].appendChild(navigationBarPageTitle);
    navigationBarSectionContainers[2].appendChild(navigationBarActionContainers[1]);
    navigationBarContent.append(...navigationBarSectionContainers);
    navigationBar.appendChild(navigationBarContent);

    return navigationBar;
}
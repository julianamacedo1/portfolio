class NavigationStack {
    constructor() {
        this.parentView = {};
        this.activeView = {};
        this.navigationBar = {};
        this.viewStack = [];
    }

    previousView(offset = 0) {
        return this.viewStack[this.viewStack.length - (1 + offset)];
    }

    atRootView() {
        return this.viewStack.length === 1;
    }

    destroy() {
        this.viewStack.forEach(view => view.remove());
        this.parentView.view.remove();
    }
}

class NavigationController {
    constructor() {
        this.viewStack = [];
        this.templates = null;
        this.activeStack = null;
        this.masterView = null;
    }

    previousStack(offset = 0) {
        return this.viewStack[this.viewStack.length - (2 + offset)];
    }

    modalIsOpen() {
        return this.viewStack.length > 1;
    }
}

const navigation = new NavigationController();

function initNavigation() {
    const root = document.querySelector("#master [view-id=root]");
    const rootNavigationStack = createNewNavigationStack(root);
    const viewTemplates = document.getElementById("view-templates");

    navigation.viewStack.push(rootNavigationStack);
    navigation.activeStack = rootNavigationStack;
    navigation.masterView = document.getElementById("master");
    navigation.templates = viewTemplates ? viewTemplates : null;
}

function createNewNavigationStack(view) {
    const newStack = new NavigationStack();
    const isModalView = view.parentElement.classList.contains("modal");

    newStack.parentView = {
        view,
        viewId: view.getAttribute("view-id"),
    };

    const activeView = view.querySelector("[active=true]");
    newStack.activeView = {
        view: activeView,
        viewId: activeView.getAttribute("view-id"),
    }

    const navigationBar = view.querySelector(".top-nav");
    newStack.navigationBar = {
        secondaryActionContainer: navigationBar.querySelector(".top-nav-action-container.secondary"),
        backContainer: navigationBar.querySelector(".top-nav-back-container"),
        backTitleAux: navigationBar.querySelector(".top-nav-back-page-title.aux"),
        backTitle: navigationBar.querySelector(".top-nav-back-page-title"),
        currentTitle: navigationBar.querySelector(".top-nav-page-title"),
    };

    newStack.navigationBar.backContainer.addEventListener("click", ({target}) => {
        navigateBack(target.getAttribute("animation-style")); 
    }, false);

    if (isModalView) 
        navigationBar.querySelector(".top-nav-action-container.primary .top-nav-action").addEventListener("click", navigateBackModal, false);

    return newStack;
}

function navigateToView(viewId, action = null, animationStyle = "stack") {
    if (!navigation.templates.querySelector(`[view-id=${viewId}]`))
        return;

    const currentViewParent = navigation.activeStack.parentView.view;
    const currentViewParentLastChild = currentViewParent.lastElementChild;
    const currentView = navigation.activeStack.activeView.view;
    const nextView = navigation.templates.querySelector(`[view-id=${viewId}]`).cloneNode(true);

    const navSecondaryActionContainer = navigation.activeStack.navigationBar.secondaryActionContainer;
    const navBackContainer = navigation.activeStack.navigationBar.backContainer;
    const navBackTitleAux = navigation.activeStack.navigationBar.backTitleAux;
    const navBackTitle = navigation.activeStack.navigationBar.backTitle;
    const navCurrentTitle = navigation.activeStack.navigationBar.currentTitle;

    const stackBackgroundAnimationContainer = document.createElement("div");
    const stackAnimationContainer = document.createElement("div");

    const isModalView = currentViewParent.parentElement.classList.contains("modal");
    const lastScrollTop = currentView.scrollTop;

    navBackContainer.classList.remove("at-root");

    navBackTitleAux.textContent = navBackTitle.textContent;
    navBackTitle.textContent = currentView.getAttribute("view-title");
    navCurrentTitle.textContent = nextView.getAttribute("view-title");

    stackBackgroundAnimationContainer.classList.add("stack-animation-container", "background");
    stackAnimationContainer.classList.add("stack-animation-container");

    stackBackgroundAnimationContainer.appendChild(currentView);
    stackAnimationContainer.appendChild(nextView);

    currentViewParent.classList.add("in-transition");

    currentView.scrollTop = lastScrollTop;

    if (navigation.activeStack.viewStack.length === 0) {
        navSecondaryActionContainer.classList.add("animate-out");
        navBackContainer.classList.add("animate-in");
    }

    navBackTitleAux.classList.add("animate-in");
    navBackTitle.classList.add("animate-in");
    navCurrentTitle.classList.add("animate-in");

    stackBackgroundAnimationContainer.classList.add("animate-in" + (animationStyle === "slide" ? "-slide" : ""));
    stackAnimationContainer.classList.add("animate-in");

    if (!isModalView && currentViewParentLastChild.classList.contains("bottom-nav")) {
        currentViewParent.insertBefore(stackBackgroundAnimationContainer, currentViewParentLastChild);
        currentViewParent.insertBefore(stackAnimationContainer, currentViewParentLastChild);
    } else
        currentViewParent.append(stackBackgroundAnimationContainer, stackAnimationContainer);

    if (action) 
        action({
            newView: nextView, 
            isModalView, 
            previousView: currentView,
        });

    stackBackgroundAnimationContainer.addEventListener("animationend", () => {
        currentViewParent.classList.remove("in-transition");
        navSecondaryActionContainer.classList.remove("animate-out");
        navBackContainer.classList.remove("animate-in");
        navBackTitleAux.classList.remove("animate-in");
        navBackTitle.classList.remove("animate-in");
        navCurrentTitle.classList.remove("animate-in");

        navSecondaryActionContainer.classList.add("inactive");

        currentViewParent.removeChild(stackBackgroundAnimationContainer);
        currentViewParent.removeChild(stackAnimationContainer);

        if (!isModalView && currentViewParentLastChild.classList.contains("bottom-nav"))
            currentViewParent.insertBefore(nextView, currentViewParentLastChild);
        else    
            currentViewParent.appendChild(nextView);

        currentView.removeAttribute("active");
        nextView.setAttribute("active", true);

        currentView.scrollTop = lastScrollTop;

        navigation.activeStack.viewStack.push(currentView);
        navigation.activeStack.activeView = {
            view: nextView,
            viewId: nextView.getAttribute("view-id"),
        };

        stackBackgroundAnimationContainer.remove();
        stackAnimationContainer.remove();
    }, {once: true});
}

function navigateBack(animationStyle = "stack") {
    if (!navigation.activeStack.previousView())
        return;

    const currentViewParent = navigation.activeStack.parentView.view;
    const currentViewParentLastChild = currentViewParent.lastElementChild;
    const currentView = navigation.activeStack.activeView.view;
    const previousView = navigation.activeStack.previousView();

    const navSecondaryActionContainer = navigation.activeStack.navigationBar.secondaryActionContainer;
    const navBackContainer = navigation.activeStack.navigationBar.backContainer;
    const navBackTitleAux = navigation.activeStack.navigationBar.backTitleAux;
    const navBackTitle = navigation.activeStack.navigationBar.backTitle;
    const navCurrentTitle = navigation.activeStack.navigationBar.currentTitle;

    const stackBackgroundAnimationContainer = document.createElement("div");
    const stackAnimationContainer = document.createElement("div");

    const isModalView = currentViewParent.parentElement.classList.contains("modal");
    const lastScrollTop = previousView.scrollTop;

    navBackTitleAux.textContent = navigation.activeStack.previousView(1) ? navigation.activeStack.previousView(1).getAttribute("view-title") : "";
    navBackTitle.textContent = previousView.getAttribute("view-title");

    stackBackgroundAnimationContainer.classList.add("stack-animation-container", "background");
    stackAnimationContainer.classList.add("stack-animation-container");

    stackBackgroundAnimationContainer.appendChild(previousView);
    stackAnimationContainer.appendChild(currentView);

    currentViewParent.classList.add("in-transition");

    if (navigation.activeStack.viewStack.length <= 1) {
        navSecondaryActionContainer.classList.add("animate-in")
        navBackContainer.classList.add("animate-out");
    }

    navBackTitleAux.classList.add("animate-out");
    navBackTitle.classList.add("animate-out");
    navCurrentTitle.classList.add("animate-out");

    stackBackgroundAnimationContainer.classList.add("animate-out" + (animationStyle === "slide" ? "-slide" : ""));
    stackAnimationContainer.classList.add("animate-out");

    if (!isModalView && currentViewParentLastChild.classList.contains("bottom-nav")) {
        currentViewParent.insertBefore(stackBackgroundAnimationContainer, currentViewParentLastChild);
        currentViewParent.insertBefore(stackAnimationContainer, currentViewParentLastChild);
    } else
        currentViewParent.append(stackBackgroundAnimationContainer, stackAnimationContainer);

    stackBackgroundAnimationContainer.addEventListener("animationend", () => {
        currentViewParent.classList.remove("in-transition");
        navSecondaryActionContainer.classList.remove("animate-in");
        navBackContainer.classList.remove("animate-out");
        navBackTitleAux.classList.remove("animate-out");
        navBackTitle.classList.remove("animate-out");
        navCurrentTitle.classList.remove("animate-out");

        if (navigation.activeStack.atRootView()) {
            navSecondaryActionContainer.classList.remove("inactive");
            navBackContainer.classList.add("at-root");
        }

        navCurrentTitle.textContent = navBackTitle.textContent;
        navBackTitle.textContent = navBackTitleAux.textContent;

        currentViewParent.removeChild(stackBackgroundAnimationContainer);
        currentViewParent.removeChild(stackAnimationContainer);

        if (!isModalView && currentViewParentLastChild.classList.contains("bottom-nav"))
            currentViewParent.insertBefore(previousView, currentViewParentLastChild);
        else    
            currentViewParent.appendChild(previousView);

        previousView.scrollTop = lastScrollTop;

        currentView.removeAttribute("active");
        previousView.setAttribute("active", true);

        navigation.activeStack.viewStack.pop();
        navigation.activeStack.activeView = {
            view: previousView,
            viewId: previousView.getAttribute("view-id")
        };

        stackBackgroundAnimationContainer.remove();
        stackAnimationContainer.remove();
        currentView.remove();
    }, {once: true});
}

function navigateToViewModal(viewId, navigationBarParams = {}, action = null) {
    const modalIsOpen = navigation.modalIsOpen();

    const masterView = navigation.masterView;
    const currentView = navigation.activeStack.parentView.view;
    const newViewContent = navigation.templates.querySelector(`[view-id=${viewId}]`).cloneNode(true);

    if (!newViewContent) return;

    if (!navigationBarParams.title)
        navigationBarParams.title = newViewContent.getAttribute("view-title");

    const newView = document.createElement("div");
    const navigationBar = renderTopNavigationBar(navigationBarParams);

    newView.classList.add("view");
    newView.setAttribute("view-id", newViewContent.getAttribute("view-id") + "-modal");
    newView.append(navigationBar, newViewContent);

    const modalBackgroundDeepContainer = modalIsOpen ? navigation.previousStack().parentView.view.parentElement : null;
    const modalBackgroundContainer = modalIsOpen ? currentView.parentElement : document.createElement("div");
    const modalContainer = document.createElement("div");

    if (!modalIsOpen) {
        modalBackgroundContainer.classList.add("view-container", "modal-background");
        modalBackgroundContainer.appendChild(currentView);
    }

    modalContainer.classList.add("view-container", "modal");
    modalContainer.appendChild(newView);

    if (modalIsOpen)
        masterView.appendChild(modalContainer);
    else
        masterView.append(modalBackgroundContainer, modalContainer);


    if (modalIsOpen) modalBackgroundDeepContainer.classList.add("animate-in-deep");
    modalBackgroundContainer.classList.add(modalIsOpen ? "animate-in-background" : "animate-in");
    modalContainer.classList.add("animate-in");

    if (action) 
        action({
            newView, 
            isModalView: true, 
            previousView: navigation.activeStack.activeView.view,
        });

    modalBackgroundContainer.addEventListener("animationend", () => {
        if (modalIsOpen) {
            modalBackgroundDeepContainer.classList.remove("animate-in-deep");
            modalBackgroundContainer.classList.remove("animate-in-background");

            modalBackgroundDeepContainer.classList.add("deep");
            modalBackgroundContainer.classList.add("modal-background");
        } else 
            modalBackgroundContainer.classList.remove("animate-in");
            
        modalContainer.classList.remove("animate-in");

        const newStack = createNewNavigationStack(newView);
        navigation.viewStack.push(newStack);
        navigation.activeStack = newStack;
    }, { once: true });
}

function navigateBackModal() {
    if (!navigation.modalIsOpen()) return;

    const inDeepStack = (navigation.previousStack(1));
    const prevStack = navigation.previousStack();

    const masterView = navigation.masterView;
    const currentView = navigation.activeStack.parentView.view;
    const newView = prevStack.parentView.view;

    const modalBackgroundDeepContainer = inDeepStack ? navigation.previousStack(1).parentView.view.parentElement : null;
    const modalBackgroundContainer = newView.parentElement;
    const modalContainer = currentView.parentElement;

    if (inDeepStack) {
        modalBackgroundDeepContainer.classList.add("animate-out-deep");
        modalBackgroundContainer.classList.add("animate-out-background");
    } else 
        modalBackgroundContainer.classList.add("animate-out");
    
    modalContainer.classList.add("animate-out");

    modalBackgroundContainer.addEventListener("animationend", () => {
        if (inDeepStack) {
            modalBackgroundDeepContainer.classList.remove("animate-out-deep");
            modalBackgroundDeepContainer.classList.remove("deep");
            modalBackgroundContainer.classList.remove("animate-out-background");
        } else 
            modalBackgroundContainer.classList.remove("animate-out");

        modalContainer.classList.remove("animate-out");
        masterView.removeChild(modalContainer);

        if (inDeepStack) 
            modalBackgroundContainer.classList.remove("modal-background")
        else {
            masterView.removeChild(modalBackgroundContainer);
            masterView.appendChild(newView);
        }

        navigation.activeStack.destroy();

        navigation.viewStack.pop();
        navigation.activeStack = prevStack;

        if (!inDeepStack) modalBackgroundContainer.remove();
        modalContainer.remove();
    }, { once: true });
}

initNavigation();
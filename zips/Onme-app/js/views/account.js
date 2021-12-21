function initializeAccountView(view, previousView = null) {
    if (!view) return;

    const inFittingRoom = previousView.getAttribute("view-id") === "fittingroom";
    const avatarMeasurements = [...view.querySelectorAll("[measurement]")];
    const avatarCustomizeButton = view.querySelector("[component-id=avatar-customize-button]");
    const avatarData = getAppData("avatar");

    initializeAvatarMeasurements(avatarMeasurements, avatarData);

    avatarCustomizeButton.addEventListener("click", () => {
        const navigationBarParams = {
            title: "Shape",
            animationStyle: "slide",
            actions: {
                primary: {
                    title: "Cancel",
                    category: "text",
                },
            },
        };
        navigateToViewModal("avatar-somatotype", navigationBarParams, ({newView}) => {
            const params = getAppData("avatar");
            const action = inFittingRoom ? (newParams) => {
                const fittingRoomAvatar = previousView.querySelector(".avatar-body-container");
                initializeAvatar(fittingRoomAvatar, newParams);
                initializeAvatarMeasurements(avatarMeasurements, newParams);
            } : (newParams) => {
                initializeAvatarMeasurements(avatarMeasurements, newParams);
            }; 
            initializeAvatarSomatotypeView(newView, params, action);
        });
    });
}

function initializeAvatarMeasurements(components, params) {
    components.forEach((component) => {
        const value = params.measurements[component.getAttribute("measurement")];
        const rangeMin = parseFloat(component.getAttribute("measurement-min"));
        const rangeMax = parseFloat(component.getAttribute("measurement-max"));

        component.setAttribute("measurement-value", getActualMeasurementValue(value, rangeMin, rangeMax));
    });
}

function initializeAccountViewToggle() {
    const accountToggle = document.querySelector("[component-id=account-open-button]");
    accountToggle.addEventListener("click", () => {
        const navigationBarParams = {
            actions: {
                primary: {
                    category: "text",
                    title: "Done",
                    id: "account-exit-button",
                },
            },
        };

        navigateToViewModal("account", navigationBarParams, ({newView, previousView}) => {
            initializeAccountView(newView, previousView);
        });
    }, false);
}

initializeAccountViewToggle();

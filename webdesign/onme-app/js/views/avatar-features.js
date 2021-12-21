function initializeAvatarFeaturesView(view, params = {}, action = null) {
    if (!view) return;

    const avatar = view.querySelector(".avatar-body-container");
    const avatarBodySections = [...avatar.querySelectorAll(".avatar-body:not(.torso)")];
    const continueButton = view.querySelector("[component-id=continue-button]");

    initializeAvatar(avatar, params);
    initializeAvatarBodyCustomization([...avatarBodySections]);

    continueButton.addEventListener("click", () => {
        navigateToView("avatar-measurements", ({newView}) => {
            avatarBodySections.forEach((section) => {
                let sectionName = section.getAttribute("body-part-id");
                sectionName = sectionName.replace(/-([a-z])/g, (g) => { return g[1].toUpperCase(); });

                params.disabledBodyParts[sectionName] = (section.classList.contains("disabled"));
            });
            initializeAvatarMeasurementsView(newView, params, action);
        }, "slide");
    });
}
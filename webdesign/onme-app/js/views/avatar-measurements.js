function initializeAvatarMeasurementsView(view, params = {}, action = null) {
    if (!view) return;

    const avatar = view.querySelector(".avatar-body-container");
    const sliders = [...view.querySelectorAll(".avatar-measurement-slider")];
    const continueButton = view.querySelector("[component-id=continue-button]");

    initializeAvatar(avatar, params);

    sliders.forEach((slider) => {
        const measurement = slider.getAttribute("measurement-id").toLowerCase();
        slider.value = params.measurements[measurement];

        const valueDisplayText = view.querySelector(`[for-measurement=${slider.getAttribute("measurement-id")}]`);
        handleAvatarMeasurementSliderInput(slider, valueDisplayText);

        slider.addEventListener("input", ({target}) => {
            const valueDisplayText = view.querySelector(`[for-measurement=${target.getAttribute("measurement-id")}]`);
            handleAvatarMeasurementSliderInput(target, valueDisplayText);
        });
    });

    continueButton.addEventListener("click", () => {
        navigateToView("avatar-skin-tone", ({newView, isModalView}) => {
            sliders.forEach((slider) => {
                const measurement = slider.getAttribute("measurement-id");
                params.measurements[measurement.toLowerCase()] = slider.value;
            });
            params.skinTone = params.skinTone == 0 ? 3 : params.skinTone;
            initializeAvatarSkinColorView(newView, params, isModalView, action);
        }, "slide");
    });
}
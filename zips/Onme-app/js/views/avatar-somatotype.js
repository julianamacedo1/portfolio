function initializeAvatarSomatotypeView(view, params, action = null) {
    if (!view) return;

    const segmentedControl = view.querySelector(".segmented-control-container");
    const segmentedControlTabs = [...view.querySelectorAll(".segmented-control-tab-title")];
    const somatotypes = [...view.querySelectorAll(".somatotype-container")];
    const somatotypeImages = [...view.querySelectorAll(".avatar-full-body")];

    const getSelectedGender = () => segmentedControl.querySelector(`.segmented-control-tab-title:nth-of-type(${segmentedControl.getAttribute("active-tab")})`).getAttribute("tab-name");

    segmentedControl.setAttribute("active-tab", params.preferences.includes("masculine") ? "1" : "2");
    updateSomatotypeImages(somatotypeImages, getSelectedGender(), params.skinTone);

    segmentedControlTabs.forEach((tab) => {
        tab.addEventListener("click", ({target}) => {
           if (target.classList.contains("active")) return;
           
           segmentedControl.setAttribute("active-tab", segmentedControlTabs.indexOf(target) + 1);
           updateSomatotypeImages(somatotypeImages, target.getAttribute("tab-name"), params.skinTone);
        });
    });

    somatotypes.forEach((somatotype) => {
        const build = somatotype.getAttribute("somatotype");

        somatotype.addEventListener("click", () => {
            navigateToView("avatar-features", ({newView}) => {
                params.preferences = [getSelectedGender(), build];
                initializeAvatarFeaturesView(newView, params, action);
            }, "slide");
        });
    });
}

function updateSomatotypeImages(somatotypeImages, gender, skinTone) {
    somatotypeImages.forEach((image) => {
        image.classList.remove("masculine", "feminine");
        image.classList.add(gender);
        image.setAttribute("skin-tone", skinTone)
    });
}

const initialAvatarParams = {
    preferences: ["masculine", "mesomorph"],
    disabledBodyParts: {},
    measurements: {},
    skinTone: 0,
};

initializeAvatarSomatotypeView(document.querySelector("[view-id=root] [view-id=avatar-somatotype]"), initialAvatarParams);
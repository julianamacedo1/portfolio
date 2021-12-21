function initializeAvatar(component, params = {}) {
    if (!component) return;

    const torso = component.querySelector(".torso");
    const leftArm = component.querySelector(".arm.left");
    const rightArm = component.querySelector(".arm.right");
    const leftLeg = component.querySelector(".leg.left");
    const rightLeg = component.querySelector(".leg.right");

    const bodyParts = {torso, leftArm, rightArm, leftLeg, rightLeg};
    const keys = Object.keys(bodyParts);

    component.setAttribute("skin-tone", params.skinTone);
    component.classList.remove("masculine", "feminine", "ectomorph", "mesomorrph", "endomorph");
    component.classList.add(...params.preferences);

    for (let i = 0, length = keys.length; i < length; i++) {
        bodyParts[keys[i]].classList.remove("disabled");
        if (params.disabledBodyParts[keys[i]]) bodyParts[keys[i]].classList.add("disabled");
    }
}

function initializeAvatarBodyCustomization(components) {
    if (!components) return;

    components.forEach(
        (section) => {
            section.addEventListener("click", (event) => {
                event.target.classList.toggle("disabled");
            });
        }
    );
}
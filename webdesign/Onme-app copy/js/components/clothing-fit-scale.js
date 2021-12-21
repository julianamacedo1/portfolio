function initializeClothingFitScale(component) {
    if (!component || !component.classList.contains("clothing-fit-scale"))
        return;

    const offset = parseFloat(component.getAttribute("fit-offset"));
    const componentWidth = 16;
    const ratio = offset / 100.0;

    component.style.setProperty("--fit-offset", `calc(${50 * ratio}% - ${(componentWidth / 2) * ratio}px)`);
}
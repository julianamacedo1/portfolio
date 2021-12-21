function handleAvatarMeasurementSliderInput(component, valueDisplayComponent) {
    if (!component) return;

    const value = component.value
    const sliderMin = parseFloat(component.getAttribute("slider-min"));
    const sliderMax = parseFloat(component.getAttribute("slider-max"));

    valueDisplayComponent.textContent = getActualMeasurementValue(value, sliderMin, sliderMax);
}
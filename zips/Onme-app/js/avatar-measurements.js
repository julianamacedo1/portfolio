function getActualMeasurementValue(value, min, max) {
    const range = max - min;
    const ratio = value / 100.0;
    const actualValue = min + (range * ratio);

    return Math.round(actualValue * 10) / 10;
}
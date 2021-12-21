// Viewport fix for mobile browsers
// VHC -> Viewport Height minus Browser Chrome (UI)

function setVHC() {
    const vhc = document.documentElement.clientHeight * 0.01;
    const vhcd = window.innerHeight * 0.01;

    document.documentElement.style.setProperty("--vhc", `${vhc}px`);
    document.documentElement.style.setProperty("--vhcd", `${vhcd}px`);
}

window.addEventListener("resize", setVHC, false);
setVHC();
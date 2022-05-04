class Viewport {
    static initialize() {
        const vhc = document.documentElement.clientHeight * 0.01;
        const vhcd = window.innerHeight * 0.01;
    
        document.documentElement.style.setProperty("--vhc", `${vhc}px`);
        document.documentElement.style.setProperty("--vhcd", `${vhcd}px`);
    
        window.addEventListener("resize", this.initialize);
    }
}

export default Viewport;
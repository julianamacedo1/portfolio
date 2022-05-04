import Viewport from "../Viewport/index.js";
import NavigationMenu from "../NavigationMenu/index.js";
//import Cookies from "../Cookies/index.js";

class PageController {
    static initialize() {
        /*
        const root = document.documentElement;
        const preferences = Cookies.get("_usr_pref");
        const appearance = preferences ? JSON.parse(Cookies.get("_usr_pref")).appearance : "default";

        root.setAttribute("appearance", appearance);
        */

        Viewport.initialize();
        NavigationMenu.initialize();
    }
}

export default PageController;
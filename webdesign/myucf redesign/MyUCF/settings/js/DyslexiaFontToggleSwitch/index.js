import ToggleSwitch from "../../../js/components/ToggleSwitch/index.js";
import Cookies from "../../../js/apis/Cookies/index.js";

class DyslexiaFontToggleSwitch extends ToggleSwitch {
    static componentId = "dyslexia-font-switch";
    static valueWhenOn = "dyslexic";
    static valueWhenOff = "default";
    static preferencesCookieName = "_usr_pref";

    static initialize() {
        this.initializeComponent();
    }

    static switchWasClicked({switchElement, data}) {
        if (!switchElement) return;

        const on = data.on;
        const root = document.documentElement;
        const switchValue = on ? this.valueWhenOn : this.valueWhenOff;

        root.setAttribute("font", switchValue);

        const preferences = Cookies.getAsJSON(this.preferencesCookieName);
        preferences.font = switchValue;

        Cookies.setAsJSON(this.preferencesCookieName, preferences);
    }
}

export default DyslexiaFontToggleSwitch;
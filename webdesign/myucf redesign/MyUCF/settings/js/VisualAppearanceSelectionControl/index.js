import SingleSelectControl from "../../../js/components/SingleSelectControl/index.js";
import Cookies from "../../../js/apis/Cookies/index.js";

class VisualAppearanceSelectionControl extends SingleSelectControl {
    static componentId = "visual-appearance-selection-control";
    static preferencesCookieName = "_usr_pref";

    static initialize() {
        this.initializeComponent();
    }

    static optionWasClicked({data}) {
        const selectedOption = data.selectedOption;
        const root = document.documentElement;

        root.setAttribute("appearance", selectedOption);

        const preferences = Cookies.getAsJSON(this.preferencesCookieName);
        preferences.appearance = selectedOption;

        Cookies.setAsJSON(this.preferencesCookieName, preferences);
    }
}

export default VisualAppearanceSelectionControl;
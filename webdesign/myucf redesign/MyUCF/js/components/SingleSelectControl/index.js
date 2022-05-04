class SingleSelectControl {
    static componentId = null;

    static initializeComponent(params = {}) {
        const singleSelectControlContainer = document.querySelector(`.single-select-control-container[componentid=${this.componentId}]`);
        if (!singleSelectControlContainer) return;

        const optionElements = [...singleSelectControlContainer.querySelectorAll(".single-select-control-option")];
        const data = {
            selectedOption: null,
            options: {},
        };

        optionElements.forEach((option) => {
            const optionId = option.getAttribute("optionid");
            const isSelected = option.getAttribute("selected") !== null;

            data.options[optionId] = option;
            if (!data.selectedOption && isSelected) data.selectedOption = optionId;

            option.addEventListener("click", ({target}) => {
                this.handleOptionClick(target, data);
                this.optionWasClicked({data, params});
            });
        });
    }

    static handleOptionClick(newOption, data) {
        if (!newOption) return;

        const currentOption = data.options[data.selectedOption];    
        const newOptionId = newOption.getAttribute("optionid");
        
        currentOption.removeAttribute("selected");
        newOption.setAttribute("selected", "");

        data.selectedOption = newOptionId;
    }

    static optionWasClicked() {}
}

export default SingleSelectControl;
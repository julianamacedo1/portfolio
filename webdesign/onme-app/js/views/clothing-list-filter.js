function initializeClothingListFilterView(view, filters, clothingCategoryContent, filterButton) {
    if (!view) return;

    const viewTitle = view.querySelector(".top-nav-page-title");
    const filterTopics = [...view.querySelectorAll(".filter-topic")];
    const resetButton = view.querySelector("[component-id=filter-reset-button]");
    const viewTitleAttribute = view.querySelector("[active=true]").getAttribute("view-title");

    updateFilterText(viewTitle, filterButton, filters, viewTitleAttribute);
    updateFilterTopics(filterTopics, filters);
    resetButton.disabled = (filters.length === 0);

    resetButton.addEventListener("click", () => {
        while (filters.length > 0) filters.pop();

        updateFilterText(viewTitle, filterButton, filters, viewTitleAttribute);
        updateFilterTopics(filterTopics, filters);
        resetButton.disabled = true;

        filterClothing(clothingCategoryContent, filters);
    })

    filterTopics.forEach((el) => {
        el.addEventListener("click", ({target}) => {
            const category = target.getAttribute("filter-category");
            const topic = target.getAttribute("filter-topic");

            if (filterIncludes(filters, topic)) {
                filters.splice(filterIndexOf(filters, topic), 1);
                target.classList.remove("selected");
            } else {
                filters.push({
                    category,
                    topic,
                });
                target.classList.add("selected");
            }

            updateFilterText(viewTitle, filterButton, filters, viewTitleAttribute);
            resetButton.disabled = (filters.length === 0);

            filterClothing(clothingCategoryContent, filters);
        });
    })
}

function updateFilterTopics(filterTopics, filters) {
    filterTopics.forEach((el) => {
        const topic = el.getAttribute("filter-topic");

        if (filterIncludes(filters, topic)) 
            el.classList.add("selected");
        else    
            el.classList.remove("selected");
    });
}

function updateFilterText(viewTitle, filterButton, filters, viewTitleAttribute) {
    viewTitle.textContent = filters.length > 0 ? viewTitleAttribute + ` (${filters.length})` : viewTitleAttribute;
    filterButton.textContent = viewTitle.textContent;
}

function filterIncludes(filters, topic) {
    for (let i = 0, length = filters.length; i < length; i++)
        if (filters[i].topic === topic) return true;

    return false;
}

function filterIndexOf(filters, topic) {
    for (let i = 0, length = filters.length; i < length; i++)
        if (filters[i].topic === topic) return i;

    return -1;
}

function filterClothing(clothingCategoryContent, filters) {
    const filterMap = {
        "Gender Preference": "gender",
        "Brand": "brand",
        "Fit": "fit",
    };
    const filterKeys = Object.keys(filterMap);

    const clothingCategories = [...clothingCategoryContent.children];
    const clothingArticles = [...clothingCategoryContent.querySelectorAll(".clothing-article")];

    const filteredClothingCategories = filters.filter(el => el.category === "Category");
    const otherFilters = {};

    for (let i = 0, length = filterKeys.length; i < length; i++)
        otherFilters[filterKeys[i]] = filters.filter(el => el.category === filterKeys[i]);


    for (let i = 0, length = clothingArticles.length; i < length; i++) {
        let meetsFilters = true;

        clothingArticles[i].classList.remove("hidden");

        for (let j = 0, length2 = filterKeys.length; j < length2; j++)
            if (otherFilters[filterKeys[j]].length > 0 && !filterIncludes(otherFilters[filterKeys[j]], clothingArticles[i].getAttribute("clothing-" + filterMap[filterKeys[j]]))) {
                meetsFilters = false;
                break;
            }

        if (!meetsFilters) clothingArticles[i].classList.add("hidden");
    }

    for (let i = 0, length = clothingCategories.length; i < length; i++) {
        const articles = clothingArticles.filter(el => el.getAttribute("clothing-category") === clothingCategories[i].getAttribute("clothing-category"));
        let noVisibleArticles = true;

        clothingCategories[i].classList.remove("hidden");

        for (let j = 0, numArticles = articles.length; j < numArticles; j++) 
            if (!articles[j].classList.contains("hidden")) {
                noVisibleArticles = false;
                break;
            }

        if (noVisibleArticles || (filteredClothingCategories.length > 0 && !filterIncludes(filteredClothingCategories, clothingCategories[i].getAttribute("clothing-category"))))
            clothingCategories[i].classList.add("hidden");
    }
}
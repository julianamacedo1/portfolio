function initializeClothingListView() {
    const articles = [...document.querySelectorAll("[view-id=root] .clothing-article")];
    const favoriteButtons = [...document.querySelectorAll("[view-id=root] [component-id=favorite-button]")];
    const filterButton = document.querySelector("[component-id=clothing-list-filter-button]");

    const filters = [];

    articles.forEach(
        (article) => {
            article.addEventListener("click", 
                ({target}) => {
                    if (target.getAttribute("component-id") !== "clothing-article") return;

                    navigateToView("clothing-details", 
                        ({newView}) => {
                            initializeClothingDetailsView(newView, {
                                id: target.getAttribute("clothing-id"),
                                category: target.getAttribute("clothing-category"),
                                name: target.getAttribute("clothing-name"),
                                brand: target.getAttribute("clothing-brand"),
                                fit: target.getAttribute("clothing-fit"),
                                description: target.getAttribute("clothing-description"),
                                price: target.getAttribute("clothing-price"),
                                fitOffset: target.getAttribute("clothing-fit-offset"),
                                hyperlink: target.getAttribute("clothing-hyperlink"),
                                imagePath: target.getAttribute("clothing-image-path"),
                                sisterFavoriteButton: target.querySelector("[component-id=favorite-button]"),
                                favorited: (target.querySelector("[component-id=favorite-button]").classList.contains("filled")),
                            });
                        }
                    );
                }
            );   
        }
    );
    

    favoriteButtons.forEach((favoriteButton) => {
        favoriteButton.addEventListener("click", ({target}) => {
            handleFavoriteButtonClick(target, []);
        }, false);
    });

    if (filterButton)
        filterButton.addEventListener("click", () => {
            navigateToViewModal("clothing-list-filter", {
                title: "Filter",
                actions: {
                    primary: {
                        category: "text",
                        title: "Done",
                        id: "filter-close-button",
                    },
                    secondary: {
                        category: "text",
                        title: "Reset",
                        id: "filter-reset-button",
                    },
                },
            },
            ({newView}) => {
                const clothingCategoryContent = document.querySelector("[view-id=root] .clothing-category-container");
                initializeClothingListFilterView(newView, filters, clothingCategoryContent, filterButton);
            }  
        );
    });
}

initializeClothingListView();
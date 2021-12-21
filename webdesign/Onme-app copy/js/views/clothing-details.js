function initializeClothingDetailsView(view, params = {}) {
    if (!view || params === {}) return;

    const clothingImage = view.querySelector(".clothing-article-image");
    const clothingName = view.querySelector(".clothing-article-name");
    const clothingBrand = view.querySelector(".clothing-article-brand");
    const clothingFit = view.querySelector(".clothing-article-fit");
    const clothingPrice = view.querySelector(".clothing-article-price");
    const clothingSize = view.querySelector(".clothing-size-recommendation");
    const clothingDescription = view.querySelector(".clothing-article-description");
    const hyperlinkToBrandWebsite = view.querySelector(".link[component-id=brand-hyperlink]");
    const clothingFitScale = view.querySelector(".clothing-fit-scale");
    const addToFittingRoomButton = view.querySelector(".button[component-id=add-fitting-room-toggle]");
    const favoriteButton = view.querySelector("[component-id=favorite-toggle]");
    const sisterFavoriteButton = params.sisterFavoriteButton;

    clothingName.textContent = params.name;
    clothingBrand.textContent = params.brand;
    clothingFit.textContent = params.fit;
    clothingPrice.textContent = params.price;
    clothingSize.setAttribute("clothing-size", ["Shirts", "Skirts", "Dresses"].includes(params.category) ? "M" : "35");
    clothingDescription.textContent = params.description;

    if (params.favorited) favoriteButton.classList.add("filled");

    clothingImage.src = "assets/images/clothing/" + params.imagePath;
    clothingFitScale.setAttribute("fit-offset", params.fitOffset);
    hyperlinkToBrandWebsite.setAttribute("href", params.hyperlink);
    favoriteButton.setAttribute("for-clothing", params.id);

    initializeClothingFitScale(clothingFitScale);

    favoriteButton.addEventListener("click", ({target}) => {
        handleFavoriteButtonClick(target, [sisterFavoriteButton]);
    }, false);

    addToFittingRoomButton.addEventListener("click", ({target}) => {
        target.classList.toggle("understated");
        target.textContent = target.getAttribute("title-" + (target.classList.contains("understated") ? "clicked" : "default"));
    }, false);
}
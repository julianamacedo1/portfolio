function handleFavoriteButtonClick(component, sisterComponents = []) {
    if (!component) return;

    const favoritedArticles = getAppData("favorites");
    const clothingId = component.getAttribute("for-clothing");

    if (favoritedArticles.includes(clothingId)) {
        component.classList.remove("filled");
        sisterComponents.forEach((sisterComponent) => {
            sisterComponent.classList.remove("filled");
        });
        favoritedArticles.splice(favoritedArticles.indexOf(clothingId), 1);
    } else {
        component.classList.add("filled");
        sisterComponents.forEach((sisterComponent) => {
            sisterComponent.classList.add("filled");
        });
        favoritedArticles.push(clothingId);
    }

    setAppData("favorites", favoritedArticles, 1);
}
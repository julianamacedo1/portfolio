function intializeFittingRoomView(view) {
    if (!view) return;

    const editAvatarButton = document.querySelector("[component-id=edit-avatar-button]");
    const avatar = view.querySelector(".avatar-body-container");
    const fittingroomDrawer = view.querySelector(".fittingroom-drawer-container");
    const fittingroomDrawerToggle = fittingroomDrawer.querySelector(".fittingroom-drawer-expand-toggle");
    const clothingArticles = [...fittingroomDrawer.querySelectorAll(".fittingroom-drawer-clothing-article")];

    const simulatedArticles = {
        top: null,
        bottom: null,
    }

    fittingroomDrawerToggle.addEventListener("click", () => {
        fittingroomDrawer.classList.toggle("expanded");
    })

    clothingArticles.forEach((article) => {
        article.addEventListener("click", ({target}) => {
            const category = target.getAttribute("clothing-category");
            const name = target.getAttribute("clothing-name");

            if (simulatedArticles[category]) {
                avatar.classList.remove(simulatedArticles[category].name);
                if (simulatedArticles[category].name !== name) simulatedArticles[category].article.classList.remove("selected");
            }

            if (!simulatedArticles[category] || simulatedArticles[category].name !== name) {
                avatar.classList.add(name);

                simulatedArticles[category] = {
                    article: target,
                    name
                };
            } else 
                simulatedArticles[category] = null;

            target.classList.toggle("selected");
        });
    });

    editAvatarButton.addEventListener("click", () => {
        const navigationBarParams = {
            title: "Shape",
            animationStyle: "slide",
            actions: {
                primary: {
                    title: "Cancel",
                    category: "text",
                },
            },
        };
        navigateToViewModal("avatar-somatotype", navigationBarParams, ({newView}) => {
            const params = getAppData("avatar");
            const action = (avatarParams) => {
                initializeAvatar(avatar, avatarParams);
            };
            initializeAvatarSomatotypeView(newView, params, action);
        });
    });
}

intializeFittingRoomView(document.querySelector("[view-id=root] [active=true]"));
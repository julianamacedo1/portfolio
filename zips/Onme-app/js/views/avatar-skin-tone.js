function initializeAvatarSkinColorView(view, params, isModalView = false, action = null) {
    if (!view) return;

    const avatar = view.querySelector(".avatar-body-container");
    const skinToneButtons = [...view.querySelectorAll("[component-id=avatar-skin-tone-button]")];
    const doneButton = view.querySelector("[component-id=done-button");

    initializeAvatar(avatar, params);

    skinToneButtons.forEach((button) => {
        button.addEventListener("click", ({target}) => {
            avatar.setAttribute("skin-tone", target.getAttribute("skin-tone"));
        });
    });

    doneButton.addEventListener("click", () => {
        params.skinTone = avatar.getAttribute("skin-tone");
        setAppData("avatar", params);

        if (action) action(params);

        if (isModalView)
            navigateBackModal();
        else
            location.href = "fittingroom.php";
    });
}
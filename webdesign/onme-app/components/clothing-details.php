<?php 
    function renderClothingDetailsView() { ?>
        <div class="view with-floating-control" view-id="clothing-details" view-title="Details" active="true">
            <div class="safe-area-view">
                <div class="layout-container">
                    <div class="clothing-article-image-container">
                        <img class="image clothing-article-image">
                    </div>
                    <div class="layout-container no-gap">
                        <p class="text clothing-article-brand extra-margin-vertical">Brand</p>
                        <div class="layout-container two-column max-content-right large-gap center-contents-vertical">
                            <div class="layout-container extra-small-gap">
                                <h1 class="header small clothing-article-name emphasized">Name</h1>
                                <p class="text clothing-article-fit">Fit</p>
                                <p class="text clothing-article-price">0.00</p>
                            </div>
                            <div class="clothing-size-recommendation" clothing-size="M"></div>
                        </div>
                        <hr class="separator">
                        <p class="text clothing-article-description">Description</p>
                        <hr class="separator">
                        <p class="text clothing-fit-scale-title">How does this usually fit?</p>
                        <div class="clothing-fit-scale" fit-offset="0">
                            <p class="text clothing-fit-scale-label left">Runs Small</p>
                            <p class="text clothing-fit-scale-label center">Just Right</p>
                            <p class="text clothing-fit-scale-label right">Runs Large</p>
                        </div>
                        <hr class="separator">
                        <a class="link" href="#" target="_blank" component-id="brand-hyperlink">View on Brand Website</a>
                        <hr class="separator">
                    </div>  
                </div>
            </div>
            <div class="floating-control-container bottom">
                <button class="button understated icon-button heart clothing-favorite" component-id="favorite-toggle" for-clothing="0"></button>
                <button class="button" component-state="default" component-id="add-fitting-room-toggle" title-default="Try On in Fitting Room" title-clicked="Remove from Fitting Room">Try On in Fitting Room</button>
            </div>
        </div>
    <?php }
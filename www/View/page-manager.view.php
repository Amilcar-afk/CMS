<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">SITE MAP</h1>
            <nav>
                <button class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="pages-container"><span class="material-icons-round">view_quilt</span>My pages</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">dynamic_feed</span>Navigations</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="categories-container"><span class="material-icons-round">tag</span>Categories</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="add-code-container"><span class="material-icons-round">code</span>Add code</button>
            </nav>
        </div>
        <section class="collapse-parent">
            <div id="pages-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">MY PAGES</h1>
                    <br>
                    <p>Here you can modify the sitemap of your website with navigations, the visibility of the different pages as well as their metadatas.</p>
                </header>

                <!--Add page-->
                <article>
                    <button class="cta-button cta-button--submit" data-wc-target="new-pages-elements">
                        New page
                    </button>
                    <div id="new-pages-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="page-manager-container">

                    </div>
                </article>

                <!--Public-->
                <article>
                    <header class="main-nav-choice selected" data-wc-target="public-pages-elements">
                        <h2>Public</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="public-pages-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="page-manager-container" style="opacity: 1">

                        <div class="col-6 col-md-12 col-sm-12">
                            <article class="module-list">
                                <h3 class="highlight background-second-color color-white text-center fs-36 medium">Lorem ipsum dolor sit amet consectetur.</h3>
                            </article>
                            <article class="module-list">
                                <h4 class="color-main-color text-center fs-26 bold">Lorem ipsum dolor sit amet consectetur.</h4>
                            </article>
                        </div>

                        <div class="col-6 col-md-12 col-sm-12">
                            <article class="module-list background-main-color">
                                <h2 class="color-white text-center fs-48 bold">Lorem ipsum dolor sit amet consectetur.</h2>
                            </article>
                        </div>

                    </div>
                </article>

                <!--Draft-->
                <article>
                    <header class="main-nav-choice" data-wc-target="draft-pages-elements">
                        <h2>Darft</h2>
                        <span class="material-icons-round">more_horiz</span>
                    </header>
                    <div id="draft-pages-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="text-elements-container">

                        <div class="col-6 col-md-12 col-sm-12">
                            <article class="module-list">
                                <h3 class="highlight background-second-color color-white text-center fs-36 medium">Lorem ipsum dolor sit amet consectetur.</h3>
                            </article>
                            <article class="module-list">
                                <h4 class="color-main-color text-center fs-26 bold">Lorem ipsum dolor sit amet consectetur.</h4>
                            </article>
                        </div>

                        <div class="col-6 col-md-12 col-sm-12">
                            <article class="module-list background-main-color">
                                <h2 class="color-white text-center fs-48 bold">Lorem ipsum dolor sit amet consectetur.</h2>
                            </article>
                        </div>

                    </div>
                </article>

            </div>
            <div id="navigations-container" class="collapse" data-group-collapse="section-container">
                <header>
                    <h1 class="title title--black">NAVIGATIONS</h1>
                </header>

                <article>

                </article>
            </div>
            <div id="categories-container" class="collapse" data-group-collapse="section-container">
                <header>
                    <h1 class="title title--black">CATEGORIES</h1>
                </header>

                <article>

                </article>
            </div>
            <div id="add-code-container" class="collapse" data-group-collapse="section-container">
                <header>
                    <h1 class="title title--black">ADD CODE</h1>
                    <p>You can add some code in the head and in the footer. This can be useful if you want to use for example external trackers for your website.</p>
                </header>

                <article>
                    <div>
                        <div class="input-container">
                            <h2>Header</h2>
                            <textarea class="input" placeholder="<head> add code here... </head>" rows="16"></textarea>
                        </div>
                        <div class="input-container">
                            <h2>Footer</h2>
                            <textarea class="input" placeholder="<footer> add code here... </footer>" rows="16"></textarea>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </section>
</section>

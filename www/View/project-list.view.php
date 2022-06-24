<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">COMMUNICATION</h1>
            <nav>
                <a href="/conversations" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="conversations-container"><span class="material-icons-round">forum</span>My conversations</a>
                <a href="/meetings" class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">today</span>Meetings</a>
                <a href="/slots" class="cta-button cta-button--menu main-nav-choice" data-wc-target="categories-container"><span class="material-icons-round">edit_calendar</span>Slots</a>
                <a href="/projects" class="cta-button cta-button--menu main-nav-choice" data-wc-target="add-code-container"><span class="material-icons-round">inventory_2</span>Projects</a>
            </nav>
        </div>
        <section class="collapse-parent">
            <div id="projects-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">Projects</h1>
                </header>

                <!--Add project-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-project">
                        New project
                    </button>
                    <div id="new-project-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="project-manager-container">
                    </div>
                </article>
            </div>
        </section>
    </section>
</section>
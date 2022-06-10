<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">COMMUNICATION</h1>
            <nav>
                <a href="/conversations" class="cta-button cta-button--menu main-nav-choice" data-wc-target="conversations-container"><span class="material-icons-round">forum</span>My conversations</a>
                <a href="/meetings" class="cta-button cta-button--menu main-nav-choice" data-wc-target="meetings-container"><span class="material-icons-round">today</span>Meetings</a>
                <a href="/slots" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="slots-container"><span class="material-icons-round">edit_calendar</span>Slots</a>
                <a href="/projects" class="cta-button cta-button--menu main-nav-choice" data-wc-target="projects-container"><span class="material-icons-round">inventory_2</span>Projects</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="slots-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">SLOTS</h1>
                </header>

                <!--Add slot-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-slot">
                        New slot
                    </button>
                    <div id="new-slot-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="slot-manager-container">
                    </div>
                </article>

                <article>
                    <div id="slots-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="slot-manager-container" style="opacity: 1">
                        <table>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </article>

            </div>

        </section>
    </section>

    <!-- add slot form -->
    <section id="container-new-slot" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-slot" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-slot"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW SLOT</h1>
                </header>

                <article>
                </article>

            </div>

        </section>
    </section>

</section>

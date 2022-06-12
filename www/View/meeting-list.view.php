<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">COMMUNICATION</h1>
            <nav>
                <a href="/conversations" class="cta-button cta-button--menu main-nav-choice" data-wc-target="conversations-container"><span class="material-icons-round">forum</span>My conversations</a>
                <a href="/meetings" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="meetings-container"><span class="material-icons-round">today</span>Meetings</a>
                <a href="/slots" class="cta-button cta-button--menu main-nav-choice" data-wc-target="slots-container"><span class="material-icons-round">edit_calendar</span>Slots</a>
                <a href="/projects" class="cta-button cta-button--menu main-nav-choice" data-wc-target="projects-container"><span class="material-icons-round">inventory_2</span>Projects</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="meetings-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">MY MEETINGS</h1>
                </header>

                <!--Add meeting-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-meeting">
                        New meeting
                    </button>
                    <div id="new-meeting-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="meeting-manager-container">
                    </div>
                </article>
                <article>
                    <div class=" col-6 col-offset-3 background-background-color p-3 " id="calendar"></div>
                    <!-- <div id="meetings-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="meeting-manager-container" style="opacity: 1">
                        <table>
                            <tbody>
                            </tbody>
                        </table>
                    </div> -->
                </article>
            </div>
        </section>
    </section>

    <!-- add meeting form -->
    <section id="container-new-meeting" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-meeting" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-meeting"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW MEETING</h1>
                </header>

                <article>
                </article>

            </div>

        </section>
    </section>

</section>

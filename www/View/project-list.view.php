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
                    <button onclick="OpenModal()" class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-project">
                        New project
                    </button>
                    <div id="new-project-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="project-manager-container">
                    </div>
                </article>

                <!-- create new project popup -->
                <div class="overlay" id="overlay">
                    <div id="modal-element" class="popup container-main-content">
                        <div onclick="CloseModal()" class="CloseIcon">&#10006;</div>
                        <h3>Popup Content</h3>
                    </div>
                </div>

            </div>
        </section>
    </section>
</section>

<style>
    html,
    body {
        height: 100%;
    }
    .overlay {
        position: absolute;
        display: none;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 2;
    }

    .popup {
        position: relative;
        width: 50%;
        height: 50%;
        top: 25%;
        left: 25%;
        text-align: center;
        background: white;
    }

    .popup h3 {
        font-size: 15px;
        height: 50px;
        line-height: 50px;
        color: black;
    }
    .CloseIcon{
        cursor: pointer;
        text-align: end;
        margin-right: 20px;
    }

    .popup {
        opacity: 1;
    }

</style>
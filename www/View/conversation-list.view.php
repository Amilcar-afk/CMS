<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">COMMUNICATION</h1>
            <nav>
                <a href="/conversations" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="conversations-container"><span class="material-icons-round">forum</span>My conversations</a>
                <a href="/meetings" class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">today</span>Meetings</a>
                <a href="/slots" class="cta-button cta-button--menu main-nav-choice" data-wc-target="categories-container"><span class="material-icons-round">edit_calendar</span>Slots</a>
                <a href="/projects" class="cta-button cta-button--menu main-nav-choice" data-wc-target="add-code-container"><span class="material-icons-round">inventory_2</span>Projects</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="conversations-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">CONVERSATIONS</h1>
                </header>

                <!--Add conversation-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-conversation">
                        New conversation
                    </button>
                    <div id="new-conversation-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="conversation-manager-container">
                    </div>
                </article>

                <article>
                    <div id="conversations-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="conversation-manager-container" style="opacity: 1">
                        <table>
                            <tbody>
                            <?php foreach ($conversations as $conversation):?>
                                <tr class="table-line">
                                    <td>
                                        <h4></h4>
                                    </td>
                                    <td>
                                        <button class="cta-button cta-button-a" data-a-target="container-setting-conversation-<?=$conversation->getId() ?>"><span class="material-icons-round">build</span></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                </article>

            </div>

        </section>
    </section>

    <!-- add conversation form -->
    <section id="container-new-conversation" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-conversation" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-conversation"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW CONVERSATION</h1>
                </header>

                <article>
                    <?php  $this->includePartial("form", $conversation->getFormNewCategorie()) ?>
                </article>

            </div>

        </section>
    </section>

</section>

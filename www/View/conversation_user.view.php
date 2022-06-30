<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
        <style>
            <?php include "../style/dist/css/main.css" ?>
        </style>
            <h1 class="title title--main-color place-menu">COMMUNICATION</h1>
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

                <article>
                    <div id="conversation-founded" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="conversation-manager-container" style="opacity: 1">

                    <?= $user->getFirstname() ?>
                    <?= $user->getLastname() ?>
                    <?= $user->getMail() ?>

                    <input type="hidden" id="userId" value="<?= $user->getId() ?>" >
                    <textarea id='sendTextarea' style='width:100%' name='chat'></textarea>
                    <button id='sendButton' style='width:100%'>Envoyer</button>

                    </div>
                </article>
            </div>
        </section>
    </section>
</section>

<section id="back-office-container">
    <section class="container-main-content container-main-content--menu container-main-content--menu--conversation">
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

            <div id="conversations-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black"><?= $user->getFirstname() ." ". $user->getLastname() ?></h1>
                    <a href="/conversations" class="cta-button cta-button--icon"><span class="material-icons-round">close</span></a>
                </header>

                <div class="col-12 conversation" id="messageDiv">
                    <div id="chatDiv">
                        <?php $currentDate = "" ?>
                        <?php foreach($conversation as $message): ?>
                            <?php if($currentDate != $message->getDate()): ?>
                                <?php $currentDate = $message->getDate() ?>
                                <div class="date-container">
                                    <hr>
                                    <span class="date-container__date"><?= date_format(date_create($currentDate), 'l jS F Y') ?></span>
                                    <hr>
                                </div>
                            <?php endif; ?>
                            <article class="message <?= ($message->getUser_key() != $_SESSION['Auth']->id )? "": "message--mind" ?>">
                                <p><?= $message->getContent()?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" id="conversationId" value="<?= $idConversation ?>" >
                    <input type="hidden" id="userId" value="<?= $user->getId() ?>" >
                    <input type="hidden" id="seen" value="<?= $seen ?>" >
                    <input type="hidden" id="myId" value="<?= $_SESSION['Auth']->id ?>" >
                    <input type="hidden" id="conversationUser" value="<?= $conversation_user?>" >
                    <footer class="input-container">
                        <input id='sendTextarea' class="input" type="text" name='chat' placeholder="Your message">
                        <button id='sendButton' class="cta-button cta-button--icon"><span class="material-icons-round">send</span></button>
                    </footer>
                </div>

            </div>
        </section>
    </section>
</section>

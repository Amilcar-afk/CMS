 <section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">COMMUNICATION</h1>
            <nav>
                <a href="/conversations" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="conversations-container"><span class="material-icons-round">forum</span>Conversations</a>
                <a href="/meetings" class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">today</span>Meetings</a>
                <?php if(isset($_SESSION['Auth']) && $_SESSION['Auth']->rank == 'admin'): ?>
                    <a href="/slots" class="cta-button cta-button--menu main-nav-choice" data-wc-target="categories-container"><span class="material-icons-round">edit_calendar</span>Slots</a>
                <?php endif; ?>
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
                    <div class="input-container">
                        <input class="select input"  placeholder="New conversation"  id="select">
                    </div>
                    <div id="new-conversation-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="conversation-manager-container">
                    </div>
                </article>
                <article id="conversations-elements" >
                    <?php if(isset($conversations)): ?>
                        <?php foreach (array_reverse($conversations)  as $conversation):?>
                            <header class="main-nav-choice mb-3">
                                <div>
                                    <h2 id="conversation_title">
                                        <?php foreach ($conversation->users() as $user): ?>
                                            <?php if($user->getId() != $_SESSION['Auth']->id):  ?>
                                                <a href="conversations/user-conversations/<?=$conversation->getId()?>">
                                                    <?= $user->getFirstname() . ' ' . $user->getLastname() ?>
                                                    <input type="hidden" id="user" value="<?= $user->getId() ?>" >
                                                </a>
                                            <?php endif;  ?>

                                         <?php endforeach;?>
                                    </h2>
                                    <?php if(!empty($conversation->lastMessage() )):  ?>
                                        <?php foreach ($userConversation->getUser_Conversation($conversation->getId()) as $user_conv): ?>

                                            <input type="hidden" id="userConversationId" value="<?= $user_conv->getId() ?>" >
                                            <input type="hidden" id="seenValue" value="<?= $user_conv->getSeen()?>" >
                                            <input type="hidden" id="myId" value="<?= $_SESSION['Auth']->id?>" >


                                            <?php if($user_conv->getSeen() == 1 ):  ?>
                                                <div><?= $conversation->lastMessage()->getContent();?></div>
                                            <?php else: ?>
                                                <div style="opacity: 0.6;"><?= $conversation->lastMessage()->getContent();?></div>
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                    <?php endif; ?>
                                </div>
                                <span class="material-icons-round">more_horiz</span>
                            </header>
                        <?php endforeach;?>
                    <?php endif; ?>
                </article>
                <article id="conversation-founded" >
                </article>
                <!-- <div id="chat-conversations-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="conversation-manager-container" style="opacity: 1">
                </div> -->
               
                </div>
        </section>
    </section>

</section>

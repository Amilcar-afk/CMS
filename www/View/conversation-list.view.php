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

            <div id="conversations-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">CONVERSATIONS</h1>
                </header>

                <!--Add conversation-->
                <article>
                    <input class="select"  placeholder="search conversation"  id="select">



                    <div id="new-conversation-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="conversation-manager-container">
                    </div>
                </article>

                <?php if(isset($conversations )): ?>

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

                <?php else: ?>

                <article>
                    <div id="empty-conversations-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="conversation-manager-container" style="opacity: 1">
                        <h1 class="col-offset-5">Aucune conversations</h1>
                    </div>
                    <div id="conversation-founded" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="conversation-manager-container" style="opacity: 1">
                    </div>
                    <div id="chat-conversations-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="conversation-manager-container" style="opacity: 1">
                        <form>
                            <textarea name="chat"></textarea>
                            <button>Envoyer</button>
                        </form>
                    </div>
                </article>
                <?php endif?>
            </div>
        </section>
    </section>
</section>

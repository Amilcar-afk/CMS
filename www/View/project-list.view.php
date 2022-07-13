<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">COMMUNICATION</h1>
            <nav>
                <a href="/conversations" class="cta-button cta-button--menu main-nav-choice" data-wc-target="conversations-container"><span class="material-icons-round">forum</span>My conversations</a>
                <a href="/meetings" class="cta-button cta-button--menu main-nav-choice" data-wc-target="navigations-container"><span class="material-icons-round">today</span>Meetings</a>
                <a href="/slots" class="cta-button cta-button--menu main-nav-choice" data-wc-target="projects-container"><span class="material-icons-round">edit_calendar</span>Slots</a>
                <a href="/projects" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="add-code-container"><span class="material-icons-round">inventory_2</span>Projects</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="projects-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">PROJECTS</h1>
                </header>

                <!--Add project-->
                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-project">
                        New project
                    </button>
                    <div id="new-projects-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="project-manager-container">
                    </div>
                </article>

                <article>
                    <div id="projects-elements" class="container-main-content container-main-content--list collapse--open row" data-group-collapse="project-manager-container" style="opacity: 1">
                        <table class="table">
                            <tbody>
                            <?php foreach ($projects as $project):?>
                                <tr class="table-line">
                                    <td>
                                        <h4><?= ucfirst($project->getTitle()) ?></h4>
                                        <label class="sticker"><span class="material-icons-round">dynamic_feed</span><?= $project->getDescription()?></label>
                                    </td>
                                    <td>
                                        <?php if($_SESSION['Auth']->rank === "admin") :?><button class="cta-button cta-button-a" data-a-target="container-setting-project-<?=$project->getId() ?>"><span class="material-icons-round">build</span></button>
                                        <button class="cta-button cta-button-a cta-button-delete-project" data-project-id="<?= $project->getId() ?>"><span class="material-icons-round">delete</span></button><?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php if (!isset($projects[0])):?>
                            <p class="title title--small">No project</p>
                        <?php endif;?>
                    </div>
                </article>

            </div>

        </section>
    </section>

    <?php foreach ($projects as $key => $project):?>
        <!-- update project form -->
        <section id="container-setting-project-<?=$project->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-setting-project-<?=$project->getId() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-project-<?=$project->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">

            </div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($project->getTitle()) ?></h1>
                    </header>

                    <article>
                        <?php  $this->includePartial("form", $project->getFormProject($project->usersNotInProject(),$project->usersInProject() , 'Update')) ?>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

    <!-- add project form -->
    <section id="container-new-project" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-project" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-project"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW PROJECTS</h1>
                </header>

                <article>
                    <?php  $this->includePartial("form", $projectEmpty->getFormProject($usersProject)) ?>
                </article>
            </div>
        </section>
    </section>
</section>
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

            <div id="steps-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">Steps</h1>
                </header>

                <article>
                    <button class="cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-step">
                        New steps
                    </button>
                    <div id="new-steps-elements" class="container-main-content container-main-content--list collapse row" data-group-collapse="step-manager-container">
                    </div>
                </article>

                <?php foreach ($project->getSteps() as $key => $singleStep):?>
                    <article>
                        <header class="main-nav-choice <?= ($key === 0)?'selected':'' ?>" data-wc-target="step-<?= $singleStep->getId() ?>-element">
                            <h2><?=date_format($singleStep->getDate(), "Y-m-d") . ' ' . $singleStep->getTitle() ?></h2>
                            <span class="material-icons-round">more_horiz</span>
                        </header>
                        <div id="step-<?= $singleStep->getId() ?>-element" class="container-main-content container-main-content--menu-content <?= ($key === 0)?'collapse--open':'collapse' ?> row" data-group-collapse="steps-container" <?= ($key === 0)?'style="opacity: 1"':'' ?>>
                            <section id="container-list-fonts" class="section-config-blocks">
                                <?php if($_SESSION['Auth']->rank === "admin") :?><button class="cta-button cta-button-a cta-button--submit mb-3" data-a-target="container-setting-step-<?=$singleStep->getId() ?>">Update</button>
                                <button class="cta-button cta-button-a cta-button-delete-step cta-button--delete mb-3" data-project-id="<?= $singleStep->getId() ?>">Delete</button><?php endif;?>
                                <article>
                                    <p><?= $singleStep->getDescription() ?></p>
                                </article>
                            </section>

                        </div>
                    </article>
                <?php endforeach;?>
                <?php if (!isset($project->getSteps()[0])):?>
                    <p class="title title--small">No step</p>
                <?php endif;?>

            </div>
        </section>
    </section>

    <!-- add step form -->
    <section id="container-new-step" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-new-step" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-step"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">NEW STEP</h1>
                </header>

                <article data-project-id="<?= $step->getProjectKey() ?>">
                    <?php  $this->includePartial("form", $step->getFormStep()) ?>
                </article>
            </div>
        </section>
    </section>

    <?php foreach ($project->getSteps() as $key => $singleStep):?>
        <!-- update step form -->
        <section id="container-setting-step-<?=$singleStep->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-setting-step-<?=$singleStep->getId() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-setting-step-<?=$singleStep->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">

            </div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($singleStep->getTitle()) ?></h1>
                    </header>

                    <article data-project-id="<?= $step->getProjectKey() ?>">
                        <?php  $this->includePartial("form", $singleStep->getFormStep('Update')) ?>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

</section>
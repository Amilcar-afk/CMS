<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">CALENDAR</h1>
            <nav>
                <button class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="meets-container"><span class="material-icons-round">text_fields</span>My meets</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="slots-container"><span class="material-icons-round">play_circle_filled</span>My slots</button>
            </nav>
        </div>
        <section class="collapse-parent">
            <div style="height: 300px;" id="meets-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1" >
                <header>
                    <h1 class="title title--black">Inserer votre rendez-vous</h1>
                </header>

                <?php  $this->includePartial("form", $rdv->getFormRegister()) ?>

            </div>
            <div id="slots-container" class="collapse" data-group-collapse="section-container">
                <header>
                    <h1 class="title title--black">My slots</h1>
                </header>

                <article>

                </article>
            </div>
        </section>
    </section>
</section>

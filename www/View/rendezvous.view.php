<section class="container-main-content container-main-content--menu">
    <div class="menu-container">
        <h1 class="title title--main-color">CALENDAR</h1>
        <nav>
            <button class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="meets-container"><span class="material-icons-round">text_fields</span>My meets</button>
            <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="slots-container"><span class="material-icons-round">play_circle_filled</span>My slots</button>
        </nav>
    </div>
    <section class="collapse-parent">
        <div id="meets-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
            <header>
                <h1 class="title title--black">My meets</h1>
            </header>

            <article>
                <div class="col-12 row gris-background article-card row">
                    <div class="main-color-background col-12 article-card col-offset-5">
                        <h1 class=" article-card ">rdvs List</h1>
                    </div>
                    <style>
                        table, th, td {
                            border: 1px solid black;
                        }
                    </style>
                    <div class="main-color-background article-card col-6 col-offset-3 mt-2 row">
                        <table class="second-color-background-default article-card col-12" >
                            <tr>
                                <th>debut du rdv</th>
                                <th>fin du rdv</th>
                                <th colspan="2" class="text-center">reserver</th>
                            </tr>
                            <tbody>
                            <?php foreach ($allRdvs as $rdv): ?>
                                <tr>
                                    <td><?= $rdv['start'] ;?></td>
                                    <td><?= $rdv['end'];?></td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="/public_rdvs_reserver/<?=$rdv['id']?>">
                                            <button>RESERVER</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </article>

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

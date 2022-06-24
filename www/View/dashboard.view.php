<section id="back-office-container">
    <header class="content-header">
        <h1 class="title title--main-color place-menu">DASHBOARD</h1>
    </header>

    <section class="container-main-content container-main-content--padding container-main-content--dashboard" >
        <div class="row">
            <div class="col-4 col-md-4 col-sm-4">
                <section class="card card--bottom  card--background-main-color">
                    <header>
                        <h4>6</h4>
                        <h3>New users of the month</h3>
                    </header>
                </section>
            </div>
            <div class="col-4 col-md-12 col-sm-12">
                <section id="per-country-container" class="card card--background-main-color">
                    <button class="main-nav-choice" data-wc-target="range-per-country">
                        <span class="material-icons-round">more_vert</span>
                    </button>

                    <!--<canvas id="chart-per-country" class="collapse--open" data-group-collapse="per-country-container" style="opacity: 1"></canvas>-->

                    <div id="range-per-country" class="collapse" data-group-collapse="per-country-container">
                        <div class="input-container">
                            <label for="SincePerCountry">Since</label>
                            <input id="SincePerCountry" name="SincePerCountry" type="date" class="input">
                        </div>
                        <div class="input-container">
                            <label for="toPerCountry">To</label>
                            <input id="toPerCountry" name="toPerCountry" type="date" class="input">
                        </div>
                        <button class="main-nav-choice cta-button cta-button-a cta-button--submit selected" data-wc-target="chart-per-country">Submit</button>
                    </div>
                    <div id="regions_div" style="width: 100%; height: 100%;"></div>
                    <header>
                        <h3>Per country</h3>
                    </header>
                    
                </section>
            </div>

            <div class="col-2 col-md-4 col-sm-4">
                <section class="card card--bottom card--background-main-color">
                    <header>
                        <h4>2</h4>
                        <h3>Messages</h3>
                    </header>
                </section>
            </div>

            <div class="col-2 col-md-4 col-sm-4">
                <section class="card card--bottom card--background-main-color">
                    <header>
                        <span class="material-icons-round">edit</span>
                        <h3>Newsletter</h3>
                    </header>
                </section>
            </div>

            <div class="col-4 col-md-12 col-sm-12">
                <section id="per-page-container" class="card card--bigcard card--background-color">
                    <header>
                        <h3>Page ranking</h3>
                        <button class="main-nav-choice" data-wc-target="range-per-page">
                            <span class="material-icons-round">more_vert</span>
                        </button>
                    </header>

                    <div id="chart-per-page" class="collapse--open" data-group-collapse="per-page-container" style="opacity: 1">
                        <table class="table table--lite">
                            <tbody>
                            <tr>
                                <td>home</td>
                                <td>vue 24</td>
                            </tr>
                            <tr>
                                <td>contact</td>
                                <td>vue 21</td>
                            </tr>
                            <tr>
                                <td>projet</td>
                                <td>vue 17</td>
                            </tr>
                            <tr>
                                <td>avis</td>
                                <td>vue 17</td>
                            </tr>
                            <tr>
                                <td>logout</td>
                                <td>vue 12</td>
                            </tr>
                            <tr>
                                <td>login</td>
                                <td>vue 24</td>
                            </tr>
                            <tr>
                                <td>avis</td>
                                <td>vue 17</td>
                            </tr>
                            <tr>
                                <td>logout</td>
                                <td>vue 12</td>
                            </tr>
                            <tr>
                                <td>login</td>
                                <td>vue 24</td>
                            </tr>
                            <tr>
                                <td>avis</td>
                                <td>vue 17</td>
                            </tr>
                            <tr>
                                <td>logout</td>
                                <td>vue 12</td>
                            </tr>
                            <tr>
                                <td>login</td>
                                <td>vue 24</td>
                            </tr>
                            <tr>
                                <td>avis</td>
                                <td>vue 17</td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="cta-button--text-no-background">
                            Show More
                        </button>
                    </div>

                    <div id="range-per-page" class="collapse" data-group-collapse="per-page-container">
                        <div class="input-container">
                            <label for="SincePerPage">Since</label>
                            <input id="SincePerPage" name="SincePerPage" type="date" class="input">
                        </div>
                        <div class="input-container">
                            <label for="toPerPage">To</label>
                            <input id="toPerPage" name="toPerPage" type="date" class="input">
                        </div>
                        <button class="main-nav-choice cta-button cta-button-a cta-button--submit selected" data-wc-target="chart-per-page">Submit</button>
                    </div>

                </section>
            </div>

            <div class="col-4 col-md-12 col-sm-12">
                <section id="per-device-container" class="card card--bigcard card--background-color">
                    <header>
                        <h3>Per device</h3>
                        <button class="main-nav-choice" data-wc-target="range-per-device">
                            <span class="material-icons-round">more_vert</span>
                        </button>
                    </header>

                    <canvas id="chart-per-device" class="collapse--open" data-group-collapse="per-device-container" style="opacity: 1"></canvas>

                    <div id="range-per-device" class="collapse" data-group-collapse="per-device-container">
                        <div class="input-container">
                            <label for="SincePerDevice">Since</label>
                            <input id="SincePerDevice" name="SincePerDevice" type="date" class="input">
                        </div>
                        <div class="input-container">
                            <label for="toPerDevice">To</label>
                            <input id="toPerDevice" name="toPerDevice" type="date" class="input">
                        </div>
                        <button class="main-nav-choice cta-button cta-button-a cta-button--submit selected" data-wc-target="chart-per-device">Submit</button>
                    </div>
                </section>
            </div>

            <div class="col-4 col-md-12 col-sm-12">
                <section class="card card--bigcard card--sessionweek-only card--background-color">
                    <header>
                        <h3>Per week</h3>
                    </header>
                    <canvas id="chartBar"></canvas>
                </section>

                <section class="card card--smallcard card--background-color">
                    <?php if(sizeof($reseauxSocs) < 5): ?>
                        <div class="edge cta-button-a" data-a-target="container-rs">
                            <span class="material-icons-round">add</span>
                        </div>
                    <?php endif;?>
                    <?php foreach ($reseauxSocs as $reseauxSoc):?>
                        <div id="container-rs-<?= $reseauxSoc->getId() ?>" class="edge-container cta-button-a" data-a-target="container-settings-rs-<?= $reseauxSoc->getId() ?>">
                            <div class="edge"><img src='../style/images/<?= $reseauxSoc->getType() ?>.png' /></div>
                            <p>1</p>
                        </div>
                    <?php endforeach;?>
                </section>
            </div>

        </div>
    </section>

    <?php foreach ($reseauxSocs as $reseauxSoc):?>
        <!-- update reseaux Soc form -->
        <section id="container-settings-rs-<?= $reseauxSoc->getId() ?>" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-rs-<?= $reseauxSoc->getType() ?>" class="cta-button cta-button--icon cta-button-a" data-a-target="container-settings-rs-<?= $reseauxSoc->getId() ?>"><span class="material-icons-round">close</span></button>
            <div class="menu-container">

            </div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black"><?= ucfirst($reseauxSoc->getType()) ?></h1>
                    </header>

                    <article>
                        <?php  $this->includePartial("form", $reseauxSoc->getFormNewReseauxSoc()) ?>
                        <button class="mt-5 cta-button cta-button--delete col-12 cta-button-delete-reseaux-soc" data-reseaux-soc-id="<?= $reseauxSoc->getId() ?>">Delete</button>
                    </article>

                </div>

            </section>
        </section>
    <?php endforeach;?>

    <!-- reseaux soc list -->
    <section id="container-rs" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-rs" class="cta-button cta-button--icon cta-button-a" data-a-target="container-rs"><span class="material-icons-round">close</span></button>
        <div class="menu-container">

        </div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">ADD SOCIAL MEDIA</h1>
                </header>

                <!--Titles-->
                <article>
                    <?php  $this->includePartial("form", $emptyReseauxSoc->getFormNewReseauxSoc()) ?>
                </article>

            </div>

        </section>
    </section>

</section>

<script type="text/javascript">
      google.charts.load('current', {'packages':['geochart']});
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['Germany', 200],
          ['United States', 300],
          ['Brazil', 400],
          ['Canada', 500],
          ['France', 600],
          ['RU', 700]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
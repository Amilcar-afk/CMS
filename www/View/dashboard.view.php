<section id="back-office-container">
    <header class="content-header">
        <h1 class="title title--main-color place-menu">DASHBOARD</h1>
    </header>

    <section class="container-main-content container-main-content--padding container-main-content--dashboard" >
        <div class="row">
            <div class="col-4 col-md-4 col-sm-4">
                <section class="card card--bottom  card--background-main-color">
                    <header>
                        <h4><?= $numberOfUsers ?></h4>
                        <h3>New users of the month</h3>
                    </header>
                </section>
            </div>

            <div class="col-4 col-md-12 col-sm-12">
                <section id="per-country-container" class="card card--background-main-color">
                    <button class="main-nav-choice" data-wc-target="range-per-country">
                        <span class="material-icons-round">more_vert</span>
                    </button>

                    <div id="range-per-country" class="collapse" data-group-collapse="per-country-container" style="width: 100%;">
                        <div class="input-container">
                            <label for="SincePerCountry">Since</label>
                            <input id="SincePerCountry" name="SincePerCountry" type="date" class="input" value="<?= $sincePerCountry ?>">
                        </div>
                        <div class="input-container">
                            <label for="toPerCountry">To</label>
                            <input id="toPerCountry" name="toPerCountry" type="date" class="input" value="<?= $toPerCountry ?>">
                        </div>

                        <button class="cta-button cta-button-a cta-button--submit cta-button--range selected" data-wc-target="chart-per-country">Submit</button>
                    </div>

                    <div id="chart-per-country" data-group-collapse="per-country-container"></div>

                    <header>
                        <h3>Per country</h3>
                    </header>
                    
                </section>
            </div>

            <div class="col-2 col-md-4 col-sm-4">
                <a href="/conversations">
                    <section class="card card--bottom card--background-main-color">
                        <header>
                            <h4><?= $conversations ?></h4>
                            <h3>Messages</h3>
                        </header>
                    </section>
                </a>
            </div>

            <div class="col-2 col-md-4 col-sm-4">
                <a href="/newsletters">
                    <section class="card card--bottom card--background-main-color">
                        <header>
                            <span class="material-icons-round">edit</span>
                            <h3>Newsletter</h3>
                        </header>
                    </section>
                </a>
            </div>

            <div class="col-4 col-md-12 col-sm-12">
                <section id="per-page-container" class="card card--bigcard card--background-color">
                    <header>
                        <h3>Page ranking</h3>
                        <button class="main-nav-choice" data-wc-target="range-per-page">
                            <span class="material-icons-round">more_vert</span>
                        </button>
                    </header>

                    <div id="range-per-page" class="collapse" data-group-collapse="per-page-container" style="width: 100%;">
                        <div class="input-container">
                            <label for="SincePerPage">Since</label>
                            <input id="SincePerPage" name="SincePerPage" type="date" class="input" value="<?= $sincePerPage ?>">
                        </div>
                        <div class="input-container">
                            <label for="toPerPage">To</label>
                            <input id="toPerPage" name="toPerPage" type="date" class="input" value="<?= $toPerPage ?>">
                        </div>
                        <button class="cta-button cta-button-a cta-button--submit cta-button--range selected" data-wc-target="chart-per-page">Submit</button>
                    </div>
                    
                    <div id="chart-per-page" data-group-collapse="per-page-container">
                        <table class="table table--lite">
                            <tbody>
                            <?php if(is_array($viewPerPages) || is_object($viewPerPages)): ?>
                                <?php foreach ($viewPerPages as $view): ?>
                                    <tr>
                                        <td><?php print_r($view['title']) ?></td>
                                        <td>vue : <?php print_r($view['number']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
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

                    <div id="range-per-device" class="collapse" data-group-collapse="per-device-container" style="width: 100%;">
                        <div class="input-container">
                            <label for="SincePerDevice">Since</label>
                            <input id="SincePerDevice" name="SincePerDevice" type="date" class="input" value="<?= $sincePerDevice ?>">
                        </div>
                        <div class="input-container">
                            <label for="toPerDevice">To</label>
                            <input id="toPerDevice" name="toPerDevice" type="date" class="input" value="<?= $toPerDevice ?>">
                        </div>

                        <button class="cta-button cta-button-a cta-button--submit cta-button--range selected" data-wc-target="chart-per-device">Submit</button>
                    </div>
                    
                    <div id="chart-per-device" ></div>

                </section>
            </div>
            

            <div class="col-4 col-md-12 col-sm-12">
                <section class="card card--bigcard card--sessionweek-only card--background-color">
                    <header>
                        <h3>Per week</h3>
                        <div id="navigation-container" class="navigation-container">
                            <button id="SincePerWeek" class="main-nav-choice cta-button--range" data-before="<?= date('Y-m-d', strtotime($perWeekDate. ' - 7 days')) ?>">
                                <span class="material-icons-round">navigate_before</span>
                            </button>

                            <p id="currentPerWeek" data-current="<?= $perWeekDate ?>"><?= $monthName; ?></p>

                            <button id="toPerWeek" class="main-nav-choice cta-button--range" data-next="<?= date('Y-m-d', strtotime($perWeekDate. ' + 7 days')) ?>">
                                <span class="material-icons-round">navigate_next</span>
                            </button>
                        </div>
                    </header>
                    <div id="chart-per-week"></div>
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
                            <p><?= $reseauxSoc->getStats() ?></p>
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



<script>
    
google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable(
            <?php  print_r(json_encode($chartMapData)); ?>
        );

        var options = {
            colorAxis: {
                colors: [secondColor, thirdColor]
            },
            legend: 'none',
            
        };

        var chart = new google.visualization.GeoChart(document.getElementById('chart-per-country'));

        chart.draw(data, options);
      }


</script>



<script>

google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(
            <?php  print_r(json_encode($chartDeviceData)); ?>
        );
        
        var options = {
            
          pieHole: 0.6,
          width: '100%',
          height: '100%',
          colors: [mainColor, secondColor, thirdColor],
          pieSliceText: "none",
          legend: {
              position : 'bottom',
              alignment: 'center',
            }
            
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart-per-device'));

        chart.draw(data, options);
      }

</script>


<script>

google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable(
            <?php  print_r(json_encode($chartWeekData)); ?>
        );


        var options = {
          
          legend: { position: 'none' },
          colors: [mainColor],
          hAxis: {textStyle: {
            color: 'black', 
            fontSize: 16,
            fontWidth: 'bold'
            }},
            vAxis: {
                textPosition: 'none',
            },
          axes: {
            x: {
              0: { side: 'bottom', label: ''} // Top x-axis.
            },
          },
          bar: { groupWidth: "80%" },
          backgroundColor: '#E4E4E4'
        };

        var chart = new google.charts.Bar(document.getElementById('chart-per-week'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };



		
</script>





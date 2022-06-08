<section id="back-office-container">
    <header class="content-header">
        <h1 class="title title--main-color place-menu">DASHBOARD</h1>
    </header>

    <section class="container-main-content container-main-content--padding container-main-content--dashboard" >
        <div class="row">


            <div class="col-4 col-md-6 col-sm-6">
                <section class="card card--bottom  card--background-main-color">
                    <header>
                        <h4>6</h4>
                        <h3>New users</h3>

                        <?php

                            //print_r($data);
                            
                            
                            
                            // var_dump($test['page-ranking']);
                            foreach ($test['per-device'] as $row) {
                                echo $row;
                            }

                        ?>

                    </header>
                </section>
            </div>

            <div class="col-4 col-md-6 col-sm-6">
                <section class="card card--background-main-color">
                    <button>
                        <i class="material-icons-round">more_vert</i>
                    </button>
                    <div id="chartdiv"></div>
                    <header>
                        <h3>Sessions per country</h3>
                    </header>
                </section>
            </div>

            <div class="col-2 col-md-6 col-sm-6">
                <section class="card card--bottom card--background-main-color">
                    <header>
                        <h4>2</h4>
                        <h3>Messages</h3>
                    </header>
                </section>
            </div>

            <div class="col-2 col-md-6 col-sm-6">
                <section class="card card--bottom card--background-main-color">
                    <header>
                        <i class="material-icons-round material-icons--big-icon">edit</i>
                        <h3>Newsletter</h3>
                    </header>
                </section>
            </div>

            <div class="col-4 col-md-6 col-sm-12">
                <section class="card card--bigcard card--background-color">
                    <header>
                        <h3>Page ranking</h3>
                        <button>
                            <i class="material-icons-round">more_vert</i>
                        </button>
                    </header>
                    <div class="table-container">
                        <table>
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
                        <button class="cta-button cta-button--text-no-background">
                            Show More
                        </button>
                    </div>
                </section>
            </div>

            <div class="col-4 col-md-6 col-sm-12">
                <section class="card card--bigcard card--background-color">
                    <header>
                        <h3>Session per device</h3>
                    </header>
                    <canvas id="chartDonut"></canvas>
                </section>
            </div>

            <div class="col-4 col-md-6 col-sm-12">
                <section class="card card--bigcard card--sessionweek-only card--background-color">
                    <header>
                        <h3>Session week</h3>
                        <button>
                            <i class="material-icons-round">chevron_left</i>
                            <i class="material-icons-round">chevron_right</i>
                        </button>
                    </header>
                    <canvas id="chartBar"></canvas>
                </section>

                <section class="card card--smallcard card--background-color">
                    <div class="edge"><i class="material-icons-round">add</i></div>
                    <div class="edge-container">
                        <div class="edge"><img src='../style/images/linkedin.png' /></div>
                        <p>1</p>
                    </div>
                    <div class="edge-container">
                        <div class="edge"><img src='../style/images/twitter.png' /></div>
                        <p>0</p>
                    </div>
                    <div class="edge-container">
                        <div class="edge"><img src='../style/images/youtube.png' /></div>
                        <p>2</p>
                    </div>
                    <div class="edge-container">
                        <div class="edge"><img src='../style/images/tiktok.png' /></div>
                        <p>23</p>
                    </div>
                </section>
            </div>

        </div>
    </section>

</section>

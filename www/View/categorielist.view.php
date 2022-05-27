<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">Categories</h1>
            <nav>
                <button class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="meets-container"><span class="material-icons-round">text_fields</span>Categories</button>
                <button class="cta-button cta-button--menu main-nav-choice" data-wc-target="slots-container"><span class="material-icons-round">play_circle_filled</span>My slots</button>
            </nav>
        </div>

        <section class="collapse-parent">
            <div id="meets-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">La list des Categories</h1>
                </header>
                <article>
            <div class="col-12 row gris-background article-card row">
                <div class="main-color-background col-12 article-card col-offset-5">
                </div>
                <style>
                    table, th, td {
                        border: 1px solid black;
                    }
                </style>
                <div class="main-color-background article-card col-6 col-offset-3 mt-2 row">
                    <table class="second-color-background-default article-card col-12" >
                        <tr>
                            <th>Type</th>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                        <tbody>
                        <?php foreach ($categories as $categorie): ?>
                            <tr>
                                <td><?= $categorie->type;?></td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="/categorie/compose/<?=$categorie->id?>">
                                        <button>modifier</button>
                                    </a>
                                    <a class="btn btn-warning" href="/categorie/delete/<?=$categorie->id?>" 
                                    onclick="return confirm('Etes vous sûr de supprimer cette categorie')"
                                    >
                                        <button>supprimer</button>
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
       
        </section>
    </section>
</section>

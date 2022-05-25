

<main>
    <section class="container-main-content container-main-content--setup" >
    <article>
                <div class="col-12 row gris-background article-card row">
                    <div class="main-color-background col-12 article-card col-offset-5">
                        <h1 class=" article-card ">La list des Categories</h1>
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
                                        <a class="btn btn-warning" href="/categorie/delete/<?=$categorie->id?>">
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
        
    </section>
</main>
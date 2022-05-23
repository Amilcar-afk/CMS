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
                    <?php if($rdv['status'] == 1):; ?>
                        <tr>
                                <td><?= $rdv['start'] ;?></td>
                                <td><?= $rdv['end'];?></td>
                            <td class="text-center">
                                <a class="btn btn-warning" href="/public_rdvs_reserver/<?=$rdv['id']?>">
                                    <button>RESERVER</button>
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

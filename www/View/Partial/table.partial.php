<table class="<?=$config[0]["table"]["class"]?>" id="<?=$config[0]["table"]["id"]?>">
    <caption><?=$config[0]["title"]?></caption>
    <thead>
        <tr>
            <?php for ($i = 0; $i < count($config[0]["colTitle"]); $i++):?>
                <th>
                    <?=$config[0]["colTitle"][$i]?>
                </th>
            <?php endfor;?>
        </tr>
    </thead>
    <tbody>
    
        <?php foreach($config[1] as $key=>$infos):?>
            <tr>
                <td>
                    <?=$infos->id?>
                </td>
                <td>
                    <?=$infos->lastname?>
                </td>
                <td>
                    <?=$infos->firstname?>
                </td>
                <td>
                    <?=$infos->mail?>
                </td>
                <td>
                    <?=$infos->date_creation?>
                </td>
                <td>
                    <?=$infos->date_update?>
                </td>
                <td>
                    <?="Validé"?>
                </td>
                <td>
                    <?=$infos->rank?>
                </td>
                <td>
                    <?="<button>Supprimer</button>"?>
                </td>
                <td>
                    <?="<button>Modifier</button>"?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>


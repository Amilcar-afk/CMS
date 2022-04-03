<?php //var_dump($config[1][0]); ?>
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
        <?php foreach($config[1] as $key=>$user):?>
            <tr>
                <td>
                    <?=$user["id"]?>
                </td>
                <td>
                    <?=$user["lastname"]?>
                </td>
                <td>
                    <?=$user["firstname"]?>
                </td>
                <td>
                    <?=$user["email"]?>
                </td>
                <td>
                    <?=$user["creationDate"]?>
                </td>
                <td>
                    <?=$user["updateDate"]?>
                </td>
                <td>
                    <?="Validé"?>
                </td>
                <td>
                    <?=$user["rank"]?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
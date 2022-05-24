<?php foreach ($config["inputs"] as $name=>$input):?>
<form method="<?= $config["config"]["method"]??"POST" ?>" action="<?= $config["config"]["action"]??"" ?>">

        <input name="<?=$name?>"
        id="<?=$input["id"]?>"
        type="<?=$input["type"]?>"
        class="<?=$input["class"]?>"

        <?php if(isset($input["value"])): ?>
            value="<?=$input["value"]?>"
        <?php endif ?>
        <?php if(isset($input["placeholder"])): ?>
            placeholder="<?=$input["placeholder"]?>"
        <?php endif ?>
        <?= (!empty($input["required"]))?'required="required"':'' ?>
        >
        <br>
        <?php endforeach;?>

        <?php if(isset($config["select"])): ?>
            <select 
                id="<?=$config["select"]["title"]['id']?>"
                type="<?=$config["select"]["title"]["type"]?>"
                class="<?=$config["select"]["title"]["class"]?>"
                name="<?=$config["select"]["title"]["name"]?>"
            >
            <?php foreach ($config["select"]["title"]["option"] as $option):  ?>
                <option value="<?= $option ?>" > <?= $option ?></option>
            <?php endforeach; ?>
            </select>
        <?php endif ?>

        
        <br>

        <?php if(isset($config["textarea"])): ?>
            <textarea
                type="<?=$config["textarea"]["description"]["type"] ?>"
                placeholder="<?=$config["textarea"]["description"]["placeholder"] ?>"
                id="<?=$config["textarea"]["description"]["type"] ?>"
                name="<?=$config["textarea"]["description"]["name"] ?>"
                class="<?=$config["textarea"]["description"]["class"] ?>"
                min="<?=$config["textarea"]["description"]["min"] ?>"
                max="<?=$config["textarea"]["description"]["max"] ?>"
                error="<?=$config["textarea"]["description"]["error"] ?>"
            >
            <?=$config["textarea"]["description"]["value"] ?>
            </textarea>
        <?php endif ?>

        <br>
        <input type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>"> 
        
    </br>
</form>


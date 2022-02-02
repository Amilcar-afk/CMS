Création du formulaire
    
<?php foreach ($config["inputs"] as $name=>$input):?>
<form method="<?= $config["config"]["method"]??"POST" ?>" action="<?= $config["config"]["action"]??"" ?>">
        
        <input name="<?=$name?>"
        id="<?=$input["id"]?>"
        type="<?=$input["type"]?>"
        class="<?=$input["class"]?>"
        placeholder="<?=$input["placeholder"]?>"
        <?= (!empty($input["required"]))?'required="required"':'' ?>
        >
        <br>
        <?php endforeach;?>
        <input type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>"> 
    </br>
</form>


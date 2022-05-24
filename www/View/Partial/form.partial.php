<form method="<?= $config["config"]["method"]??"POST" ?>"
      action="<?= $config["config"]["action"]??"" ?>"
    <?= (!empty($config["enctype"]))?'enctype="'.$config["enctype"].'"':'' ?>>
    <?php foreach ($config["inputs"] as $name=>$input):?>
        <?php if ($input["type"] == "radio" || $input["type"] == "checkbox"):?>
            <p><?=$input["question"]?></p>
            <?php foreach ($input["choice"] as $nameChoice=>$choice):?>
                <div class="input-container">
                    <input name="<?=$name?>"
                           id="<?=$choice["id"]?>"
                           type="<?=$input["type"]?>"
                           class="<?=$choice["class"]?>"
                           value="<?=$choice["value"]?>"
                        <?= (!empty($choice["selected"]))?'checked="checked"':'' ?>
                        <?= (!empty($choice["required"]))?'required="required"':'' ?>
                    >
                    <label for="<?=$choice["id"]?>" ><?=$nameChoice?></label>
                </div>
            <?php endforeach;?>
            <br>
        <?php elseif ($input["type"] == "select"):?>
            <div class="input-container">
                <p><?=$input["question"]?></p>

                <select name="<?= $name ?>">
                    <?= (!empty($input["question"]))?'<option hidden>'.$input["question"].'</option>':'' ?>
                    <?= (!empty($choice["required"]))?'required="required"':'' ?>
                    <?php foreach ($input["choice"] as $nameChoice=>$choice):?>
                        <option  value="<?= $choice['value'] ?>"
                                 id="<?= $choice['id'] ?>"
                                 class="<?= $choice['class'] ?>">
                            <?= $nameChoice ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
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
    </br>
</form>
        <?php elseif ($input["type"] == "textarea"):?>
            <div class="input-container">
                <label for="<?=$name?>"><?=$name?></label>
                <textarea name="<?= $name ?>"
                          placeholder="<?= $input["placeholder"] ?>"
                          rows="<?= $input["rows"] ?>"
                          cols="<?= $input["cols"] ?>"
                          id="<?= $input["id"] ?>"
                          class="<?= $input["class"] ?>"
                          minlenght="<?= $input["min"] ?>"
                          maxlenght="<?= $input["max"] ?>"
                        <?= (!empty($input["required"]))?'required="required"':'' ?>
                ><?= $input["value"] ?>
                </textarea>
            </div>

        <?php else:?>
            <div class="input-container">
                <label for="<?=$name?>"><?=$input["label"]?></label>
                <input name="<?=$name?>"
                       id="<?=$input["id"]?>"
                       type="<?=$input["type"]?>"
                       class="<?=$input["class"]?>"
                       placeholder="<?=$input["placeholder"]?>"
                    <?= (!empty($input["accept"]))?'accept="'.$input["accept"].'"':'' ?>
                    <?= (!empty($input["required"]))?'required="required"':'' ?>
                >
            </div>

        <?php endif;?>

    <?php endforeach;?>

    <input class="cta-button cta-button--submit col-12" type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>">
</form>

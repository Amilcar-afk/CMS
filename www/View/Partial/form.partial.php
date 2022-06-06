<form method="<?= $config["config"]["method"]??"POST" ?>"
      action="<?= $config["config"]["action"]??"" ?>"
    <?= (isset($config["enctype"]))?'enctype="'.$config["enctype"].'"':'' ?>>
    <?php foreach ($config["inputs"] as $name=>$input):?>

        <div class="input-container">
            <?php if ($input["type"] == "radio" || $input["type"] == "checkbox"):?>
                <p><?=$input["question"]?></p>
                <?php foreach ($input["choices"] as $choice):?>
                    <input name="<?=$name?>"
                           id="<?=$name?>"
                           type="<?=$input["type"]?>"
                           class="<?=$choice["class"]?>"
                           value="<?=$choice["value"]?>"
                        <?= (isset($choice["selected"]))?'checked="checked"':'' ?>
                        <?= (isset($choice["required"]))?'required="required"':'' ?>
                    >
                    <label for="<?=$name?>" ><?=$choice["label"]?></label>
                <?php endforeach;?>

            <?php elseif ($input["type"] == "select"):?>
                <label><?=$input["question"]?></label>
                <select name="<?= $name ?>">
                    <?= (isset($input["question"]))?'<option hidden>'.$input["question"].'</option>':'' ?>
                    <?= (isset($choice["required"]))?'required="required"':'' ?>
                    <?php foreach ($input["choices"] as $choice):?>
                        <option  value="<?= $choice['value'] ?>"
                                 class="<?= $choice['class'] ?>">
                            <?= $choice['label'] ?>
                        </option>
                    <?php endforeach;?>
                </select>

            <?php elseif ($input["type"] == "textarea"):?>
                <label for="<?=$name?>"><?=$input["question"]?></label>
                <textarea name="<?= $name ?>"
                          rows="<?= $input["rows"] ?>"
                          cols="<?= $input["cols"] ?>"
                          id="<?= $name ?>"
                          class="<?= $input["class"] ?>"
                          <?= (isset($input["placeholder"]))?'placeholder="'.$input["placeholder"].'"':'' ?>
                          <?= (isset($input["min"]))?'minlenght="'. $input["min"] .'"':'' ?>
                          <?= (isset($input["max"]))?'maxlenght="'. $input["max"] .'"':'' ?>
                          <?= (isset($input["required"]))?'required="required"':'' ?>
                ><?= (isset($input["value"]))? $input["value"] :'' ?></textarea>
            <?php else:?>
                <label for="<?=$name?>"><?=$input["question"]?></label>
                <input name="<?=$name?>"
                       id="<?=$name?>"
                       type="<?=$input["type"]?>"
                       class="<?=$input["class"]?>"

                    <?= (isset($input["placeholder"]))?'placeholder="'.$input["placeholder"].'"':'' ?>
                    <?= (isset($input["value"]))?'value="'.$input["value"].'"':'' ?>
                    <?= (isset($input["accept"]))?'accept="'.$input["accept"].'"':'' ?>
                    <?= (isset($input["required"]))?'required="required"':'' ?>
                >
            <?php endif;?>
            <p class="input--error"><?= (isset($input["error"]))?$input["error"]:'' ?></p>
        </div>
    <?php endforeach;?>
    <input class="cta-button cta-button--submit col-12" type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>">
</form>

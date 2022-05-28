<form method="<?= $config["config"]["method"]??"POST" ?>"
      action="<?= $config["config"]["action"]??"" ?>"
    <?= (isset($config["enctype"]))?'enctype="'.$config["enctype"].'"':'' ?>>
    <?php foreach ($config["inputs"] as $name=>$input):?>


        <?php if ($input["type"] == "radio" || $input["type"] == "checkbox"):?>
            <p><?=$input["question"]?></p>
            <?php foreach ($input["choices"] as $choice):?>
                <div class="input-container">
                    <input name="<?=$name?>"
                           id="<?=$name?>"
                           type="<?=$input["type"]?>"
                           class="<?=$choice["class"]?>"
                           value="<?=$choice["value"]?>"
                        <?= (isset($choice["selected"]))?'checked="checked"':'' ?>
                        <?= (isset($choice["required"]))?'required="required"':'' ?>
                    >
                    <label for="<?=$name?>" ><?=$choice["label"]?></label>
                </div>
            <?php endforeach;?>
            <br>

        <?php elseif ($input["type"] == "select"):?>
            <div class="input-container">
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
            </div>
        <?php elseif ($input["type"] == "textarea"):?>
            <div class="input-container">
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
            </div>
        <?php else:?>
            <div class="input-container">
                <label for="<?=$name?>"><?=$input["question"]?></label>
                <input name="<?=$name?>"
                       id="<?=$name?>"
                       type="<?=$input["type"]?>"
                       class="<?=$input["class"]?>"
                    <?= (isset($input["placeholder"]))?'placeholder="'.$input["placeholder"].'"':'' ?>
                    <?= (isset($input["value"]))?'accept="'.$input["value"].'"':'' ?>
                    <?= (isset($input["accept"]))?'accept="'.$input["accept"].'"':'' ?>
                    <?= (isset($input["required"]))?'required="required"':'' ?>
                >
            </div>
        <?php endif;?>
    <?php endforeach;?>
    <input class="cta-button cta-button--submit col-12" type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>">
</form>

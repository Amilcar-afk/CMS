
<form <?= (isset($config["config"]["id"]))?'id="'.$config["config"]["id"].'"':'' ?> method="<?= $config["config"]["method"]??"POST" ?>"
    <?= (isset($config["action"]))?'action="'.$config["config"]["action"].'"':'' ?>
    <?= (isset($config["config"]["class"]))?'class="'.$config["config"]["class"].'"':'' ?>
    <?= (isset($config["enctype"]))?'enctype="'.$config["enctype"].'"':'' ?>>
    <?php foreach ($config["inputs"] as $name=>$input):?>

        <div  <?= (isset($input["type"]) && $input["type"] == "hidden")?'':'class="input-container"' ?>>
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
                <select id="<?= $input["id"] ?>" name="<?= $name ?>" class="<?=$input["class"]?>">
                    <?= (isset($input["question"]) && !isset($input["value"]))?'<option hidden>'.$input["question"].'</option>':'' ?>
                    <?= (isset($choice["required"]))?'required="required"':'' ?>
                    <?php foreach ($input["choices"] as $choice):?>
                        <option  value="<?= $choice['value'] ?>"
                                 class="<?= $choice['class'] ?>"
                                <?= (isset($input["value"]) && $input["value"] == $choice['value'])?'checked="checked"':'' ?>>
                            <?= $choice['label'] ?>
                        </option>
                    <?php endforeach;?>
                </select>
                <?= (isset($input["div"]))?'<div id="' . $input["div"] .'"></div>':'' ?>

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
                <?php if (isset($input["question"])):?>
                    <label for="<?=$name?>"><?=$input["question"]?></label>
                <?php endif;?>
                <input name="<?=$name?>"
                       id="<?=$name?>"
                       type="<?=$input["type"]?>"
                    <?= (isset($input["class"]))?'class="'.$input["class"].'"':'' ?>
                    <?= (isset($input["placeholder"]))?'placeholder="'.$input["placeholder"].'"':'' ?>
                    <?= (isset($input["value"]))?'value="'.$input["value"].'"':'' ?>
                    <?= (isset($input["accept"]))?'accept="'.$input["accept"].'"':'' ?>
                    <?= (isset($input["required"]))?'required="required"':'' ?>
                    <?= (isset($input["onkeyup"]))?'onkeyup="searchUser()"':'' ?>
                >
            <?php endif;?>
            <?= (isset($input["divSearch"]))?'<div class="div-search" id="divSearchUsers"></div>"':'' ?>
            <p class="input--error"><?= (isset($input["error"]))?$input["error"]:'' ?></p>
        </div>
    <?php endforeach;?>
    <?php if (isset($config["config"]["action"])):?>
        <input class="cta-button cta-button--submit col-12" type="submit" value="<?= $config["config"]["submit"]??"Submit" ?>">
    <?php endif;?>
    <?php if (isset($config["config"]["forgotPwd"])):?>
        <br>
        <a href="/pwdforgotten"" style="text-align: center">have you forgotten your password ?</a>
    <?php endif;?>
</form>
<?php if (isset($config["config"]["cta"])):?>
    <button <?=(isset($config["config"]["idButton"]))? 'id="'. $config["config"]["idButton"] . '"': ''?> class="cta-button cta-button--submit col-12 <?= $config["config"]["cta"]??"" ?>"><?= $config["config"]["submit"]??"Submit" ?></button>
<?php endif;?>

<?php if(isset($newFontId)):?>
<script>let newFontId = <?= $newFontId ?>;</script>
<?php endif;?>
<script>
    let fonts = [
    <?php foreach ($fonts as $font):?>
         '<?= $font->getValue() ?>',
    <?php endforeach;?>
    ];

    let mainColor = <?= (isset($mainColor[0]))? '"'.$mainColor[0]->getValue().'"' :'#396075' ?>;
    let secondColor = <?= (isset($secondColor[0]) )? '"'.$secondColor[0]->getValue().'"' :'#55A6D3' ?>;
    let thirdColor = <?= (isset($thirdColor[0]) )? '"'.$thirdColor[0]->getValue().'"' :'#b2def7' ?>;

</script>
<style>
    <?php foreach ($fonts as $font):?>
    @font-face {
        font-family: '<?= $font->getValue()?>';
        font-style: normal;
        font-weight: normal;
        src: local('<?= $font->getValue()?>'), url('<?= $font->getPath()?>') format('truetype');
    }
    <?php endforeach;?>

    :root {
    --main-color: <?= (isset($mainColor[0]))? $mainColor[0]->getValue() :'#396075' ?>;
    --second-color: <?= (isset($secondColor[0]) )? $secondColor[0]->getValue() :'#55A6D3' ?>;
    --third-color: <?= (isset($thirdColor[0]) )? $thirdColor[0]->getValue() :'#55A6D3' ?>;

    --main-color-rgb: 57,96,117;
    --second-color-rgb: 85,166,211;
    --third-color-rgb: 155,188,255;

    --background-color: <?= (isset($backgroundColor[0]) )? $backgroundColor[0]->getValue() :'white' ?>;
    --text-color: <?= (isset($textColor[0]) )? $textColor[0]->getValue() :'black' ?>;

    <?= (isset($radius[0]) && $radius[0]->getValue() == 'right_angle' )? '--radius: 5px; --radius-none: 0px' : '' ?>
    }
</style>
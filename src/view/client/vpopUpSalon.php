<?php
    $title = 'Beauty Styling';
    $bodyClass = "fade-in";
    $img = PUBLIC_ROOT .'assets/img/photos-salon/' . $salon->getPhoto_salon();
    $style="background: url($img) no-repeat center fixed; background-size: cover";
    ob_start();
    include './view/include/incHead.php';
    $head = ob_get_clean();
    $menuBar = "";
    $modal = "";
    ob_start();
    include './view/include/incScriptSrcClient.php';
    $script = ob_get_clean();
    ob_start();
    include './view/include/incFooterPopUp.php';
    $footer = ob_get_clean();
    ?>
<?php ob_start();?>
<div class="container">
    <div>
        <p><h1 class="h4 animate-bounce text-primary">Welcome to Beauty Styling salon: <?=$salon->getNom_salon()?>!!</h1></p>
        <p class="fs-5 text-primary"><?=$salon->getAd1()?> <?=$salon->getAd2()?> <?=$salon->getCp_salon()?> <?=$salon->getNom_ville()?></p>
    </div>
    <div class="d-flex">
        <p class="mx-2 text-primary"><?=$salon->getUrl_salon()?></p>
        <p class="mx-2 text-primary">TEL: 0<?=$salon->getTel_salon()?></p>
    </div> 
</div>
</body>
</html>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>
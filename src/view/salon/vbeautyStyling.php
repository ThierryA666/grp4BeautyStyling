<?php
    $title = 'Beauty Styling';
    $bodyClass="bodybg";
    $style = '';
    ob_start();
    include './view/include/incHead.php';
    $head = ob_get_clean();
    ob_start();
    include './view/include/incMenuBarSalon.php';
    $menuBar = ob_get_clean();
    $modal = "";
    ob_start();
    include './view/include/incScriptSrcSalon.php';
    $script = ob_get_clean();
    ob_start();
    include './view/include/incFooterSalon.php';
    $footer = ob_get_clean();
?>
<?php ob_start(); ?>   
<main>
    <div class="container row mx-auto">
        <div class="col-md-6 mx-auto" id="illustTop">
            <img class="img-fluid" src="<?=PUBLIC_ROOT.'assets/img/illustTop.png'?>">
        </div>
        <div class="col-md-6 mx-auto">
            <h1 class="fs-1" style="font-family: 'DM Serif Display', serif; color:#FF5B76">Choisissez Beauty Styling !</h1>
      </div>
    </div>    
</main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>

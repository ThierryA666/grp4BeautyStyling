<?php
    $title = 'Login Errueus';
    $bodyClass="";
    $style = '';
    ob_start();
    include './view/include/incHead.php';
    $head = ob_get_clean();
    ob_start();
    include './view/include/incMenuBarSalonBfLogin.php';
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
    <div>
      <p class="fs-5 text-dangert text-center"><?=$message?></p>
      <p class="fs-5 text-center"><a href="<?=APP_ROOT.'/salon/login'?>">retour à la page log-in</a></p>
    </div>
  </main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>  

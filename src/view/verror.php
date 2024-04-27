<?php
  namespace  beautyStyling;
  $title = "Page d'erreur";
  $bodyClass="adminbg";
  $style = '';
  ob_start();
  include './view/include/IncHead.php';
  $head = ob_get_clean();
  ob_start();
  include './view/include/incMenuBarSalon.php';
  $menuBar = ob_get_clean();
  $modal = "";
  $footer = "";
  ob_start();
  include './view/include/incScriptSrcSalon.php';
  $script = ob_get_clean();
  $modal = '';
  $footer = '';
  //called when server error
  $display = 'd-none';
  $show = false;
  if (isset($_SERVER['HTTP_REFERER'])) {
      $display = '';
      $show = true;
      $url = $_SERVER['HTTP_REFERER'];
  }
?>
<?php ob_start();?>
<div class="error-container">
    <div>
        <h1><?=$show ? 'Erreur processing your request' : 'Erreur 500'?></h1>
        <p><?=$show ? 'OOOuuuuppsss something went wrong.' : 'Désolé, le service est temporairement interrompu, veuillez reéssayer plus tard.'?></p>
        <p class="<?=$display?>"><a href="<?=$url?>">reéssayer la page</a></p>
    </div>
</div>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>
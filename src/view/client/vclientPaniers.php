<?php
  $title = 'clientPaniers';
  ob_start();
  include './view/include/IncHead.php';
  $head = ob_get_clean();
  $bodyClass="bodybg";
  ob_start();
  include './view/include/incMenuBarClient.php';
  $menuBar = ob_get_clean();
  ob_start();
  include './view/include/incModal.php';
  $modal = ob_get_clean();
  ob_start();
  ob_start();
  include './view/include/incFooterClient.php';
  $footer = ob_get_clean();
  include './view/include/incScriptSrcClient.php';
  $script = ob_get_clean();
?>
<?php ob_start(); ?>
<main>
  <section id="search"><!--Recherche par salons ou par dates-->
    <div class="container bgbs col-md-11 mx-auto">
      <div class="row my-1 justify-content-between d-block">
        <form id="formSearch" name="search" method="post" action="<?=APP_ROOT.'/paniers'?>">
          <div class="d-inline">
            <h1 class="h4 text-dark text-start mx-auto">Mes réservations</h1>
            <p class="fw-bold <?=(isset($msgUtilisateur['msgShow'])?$msgUtilisateur['style'] :'d-none')?>"><?=isset($msgUtilisateur['message'])?$msgUtilisateur['message']:null?></p>
            <label for="salons" class="mx-1">Sélectionnez un salon et/ou 2 dates:</label>
            <select id="salons" name="salons" class="mx-1">
              <option value="showAll">--**Montrez tous les salons**--</option>
              <?php foreach ($clientSalons as $key => $salon) { ?>
              <option id="salon<?=$key?>" value="salon<?=$key?>" <?=(isset($salonSelected) && $salonSelected === $salon) ? 'selected' : ''?>><?=$salon->getNom_salon()?></option>
              <?php } ?>
            </select>
          </div>
          <div class="d-inline">
              <label for="dateAfter" class="mx-1">Après le :</label>
              <input type="date" id="dateAfter" name="dateAfter" class="rounded-2" value="<?=isset($_POST['dateAfter'])?$_POST['dateAfter']:null?>">
          </div>
          <div class="d-inline">
              <label for="dateBefore" class="mx-1">Avant le :</label>
              <input type="date" id="dateBefore" name="dateBefore" min="1" max="5" class="mx-1 rounded-2" value="<?=isset($_POST['dateBefore'])?$_POST['dateBefore']:null?>">
          <div class="d-inline">
              <button id="search" name="search" value="search" class="btn bsbtn1 btn-outline-primary" type="submit"><i class="bi bi-search"></i>&nbsp;&nbsp;Trouvez moi</button>
          </div>
        </form>
      </div>
    </section>
    <section id="clientPaniers"><!--On montre les paniers du clients-->
      <div class="input container col-md-11 mx-auto rounded-2 p-3" id="input">
        <div class="col-md-10 mx-auto rounded-2 bgbs">
          <form id="formPaniers" class=" mx-auto p-3" name="Panier" method="post" action="#">
            <div id="title" class="grid-container bandeau boldfonts align-items-center p-3 col-sm">
              <div class="grid-item" ><span class="p-1">Nom:</span></div>
              <div class="grid-item"><span class="p-1">Salon:</span></div>
              <div class="grid-item"><span class="p-1">RDV le :</span></div>
              <div class="grid-item"><span class="p-1">à :</span></div>
              <div class="grid-item"><span class="p-1"></span></div>
              <div class="grid-item"><span class="p-1"></span></div>
            </div>
            <?php foreach ($rndvs as $key => $rndv) { ?>
            <div id="detail<?=$key?>" class="grid-container bg-light border border-primary justify-content-between align-items-center border p-3 col-sm rounded-2">
              <div class="grid-item"><span class="p-1 fw-bold" ><?=$rndv->getNom_rndv()?></span></div>
              <div class="grid-item"><span class="p-1"><a href="#" id="popUpSalon" name="popUpSalon<?=$rndv->getId_salon()->getId_salon()?>" value="<?=$rndv->getId_salon()->getId_salon()?>"><?=$rndv->getId_salon()->getNom_salon()?></a></span></div>
              <div class="grid-item"><span class="p-1"><?=$rndv->getD_rndv()->format('d-m-Y')?></span></div>
              <div class="grid-item"><span class="p-1"><?=$rndv->getH_rndv()->format('H:i:s')?></span></div>
              <div class="grid-item transition ease-in-out"><button id="btGoToDetail<?=$key?>" class="bsIconButtonPencil " type="submit" formmethod="post" formaction="<?=APP_ROOT.'/panierDetail'?>" name="detail" value="detail<?=$rndv->getId_rndv()?>"><i class="bi-pencil p-1"></i></button></div>
              <div class="grid-item"><i class="bi-trash p-1"></i></div>
            </div>
            <?php } ?>
            <div class="align-item-center text-center p-3">  
              <button id="goToReservation" class="btn bsbtn1 btn-outline-primary" type="submit" formmethod="post" formaction="../webapp/calendrier.php"><i class="bi bi-scissors"></i>&nbsp;&nbsp;Réservations</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>


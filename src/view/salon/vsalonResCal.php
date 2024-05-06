<?php
  $title = 'salonCalendrier';
  ob_start();
  include './view/include/IncHead.php';
  $head = ob_get_clean();
  $bodyClass="bodybg";
  $img = PUBLIC_ROOT .'assets/img/photos-salon/' . (isset($salonSelected)?$salonSelected->getPhoto_salon():'');
  $style=isset($salonSelected)?"background: url($img) no-repeat center fixed; background-size: cover":"";
  ob_start();
  include './view/include/incMenuBarAdmin.php';
  $menuBar = ob_get_clean();
  ob_start();
  include './view/include/incModal.php';
  $modal = ob_get_clean();
  ob_start();
  ob_start();
  include './view/include/incFooterAdmin.php';
  $footer = ob_get_clean();
  include './view/include/incScriptSrcAdmin.php';
  $script = ob_get_clean();
?>
<?php ob_start(); ?>
<main>
  <section id="calendrier">
    <div class="container bgbs col-md-12 mx-auto d-block" style="height:600px">
      <form id="formSalon" name="search" method="post" action="<?=APP_ROOT.'/salonreserveappt'?>">
        <div class="my-1 justify-content-between d-flex">
          <div class="d-inline">
            <h1 class="h4 text-dark text-start mx-auto">Salon Booking:</h1>
          </div>
        </div>
        <div class="container col-md-6 d-inline justify-content-center align-items-center">
              <p class="fw-bold <?=(isset($msgUtilisateur['msgShow'])?$msgUtilisateur['style'] :'d-none')?>"><?=isset($msgUtilisateur['message'])?$msgUtilisateur['message']:null?></p>
              <label for="salons" class="mx-1">Sélectionnez un salon:</label>
              <select id="salons" name="salons" class="mx-1 form-control-select rounded-2" required>
                <option value="salon0">--**Montrez tous les salons**--</option>
                <?php foreach ($salons as $key => $salon) { ?>
                <option id="salon<?=$key?>" value="salon<?=$salon->getId_salon()?>" <?=(isset($salonSelected) && $salonSelected->getId_salon() === $salon->getId_salon()) ? 'selected' : ''?>><?=$salon->getNom_salon()?></option>
                <?php } ?>
              </select>
        </div>
        <div class="container col-md-6 d-inline justify-content-center align-items-center">
              <p class="fw-bold <?=(isset($msgUtilisateur['msgShow'])?$msgUtilisateur['style'] :'d-none')?>"><?=isset($msgUtilisateur['message'])?$msgUtilisateur['message']:null?></p>
              <label for="prestations" class="mx-1">Sélectionnez une prestation:</label>
              <select id="prestations" name="prestations" class="mx-1 form-control-select rounded-2" required>
                <option value="presta0">--**Aucune prestation**--</option>
                <?php if (!empty($prestations)) { foreach ($prestations as $key => $prestation) { ?>
                <option id="presta<?=$key?>" value="presta<?=$prestation->getIdPresta()->getIdPresta()?>" <?=(isset($prestaSelected) && $prestaSelected->getIdPresta() === $prestation->getIdPresta()->getIdPresta()) ? 'selected' : ''?>><?=$prestation->getIdPresta()->getNomPresta()?></option>
                <?php }} ?>
              </select>
        </div>
      </form>
      <form id=formRdv" name="rdv" method="post" action="<?=APP_ROOT.'/salonreserveappt'?>">
        <input type="hidden" name="salonRdv" value="<?=$salonSelected?$salonSelected->getId_salon():''?>">
        <input type="hidden" name="prestationRdv" value="<?=$prestaSelected?$prestaSelected->getIdPresta():''?>">
        <div class="col-md-11 my-1 justify-content-start d-block">
          <div class="container col-md-7 d-inline-flex mx-auto justify-content-start">
              <div class="datepicker form-control-date d-block" id="datepicker">
                <label for="alternate">Sélectionnez une date:</label>
                <input type="text" name="apptDate" id="alternate" class="rounded-2" required size="30">
              </div>
          </div>
          <div class="container col-md-4 mx-auto d-inline-flex justify-content-start">
            <div class="col-md-11 grid-margin stretch-card">
              <div class="clearfix">
                <div class="input-group clockpicker pull-center" data-autoclose="true">
                <label for="time" class="mx-1">Sélectionnez une heure:</label>
                  <input type="text" id="time" name="apptTime" class="rounded-2" min="09:00" max="19:00" step="00:30" value="<?=(new DateTime())->format('H:i')?>" required size="10">
                  <span class="input-group-addon">
                    <span><i id="timeButton" class="bi bi-watch"></i></span>
                  </span>
                </div>
                <div>Il est: <span id="timeDisplay"></span></div>
                <div class="col-md-7 my-1 justify-content-between">
                  <label for="confirm" class="mx-1">Confirmer le RDV:</label>
                  <button id="confirm" name="confirm" value="confirm" class="btn bsbtn1 btn-outline-primary form-control" type="submit"><i class="bi bi-pin"></i>&nbsp;&nbsp;Confirmer</button>
                </div>
              </div>
              <div class="<?=$display?>">
                <p class="h5">Votre rendez-vous au salon: <?=$salonRdv?$salonRdv->getNom_salon():''?></p> 
                <p class="h5">pour: <?=$prestaRdv?$prestaRdv->getNomPresta():''?></p> 
                <p class="h5">date/heure: <?=$apptDate . ' à ' . $apptTime . ','?></p> 
                <p class="h5">On vous attend avec impatience!</p> 
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
  </section>
</main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>
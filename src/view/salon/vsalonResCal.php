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
    <div class="container bgbs col-md-12 mx-auto d-block">
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
      <form id=formListRdv" name="rdv" method="post" action="<?=APP_ROOT.'/salonreserveappt'?>">
        <input type="hidden" name="salonRdv" value="<?=$salonSelected?$salonSelected->getId_salon():''?>">
        <input type="hidden" name="prestationRdv" value="<?=$prestaSelected?$prestaSelected->getIdPresta():''?>">
        <div class="col-md-12 my-1 justify-content-start d-block">
          <div class="container col-md-5 d-inline-flex mx-auto justify-content-start">
              <div class="datepicker form-control-date d-block p-3" id="datepicker" date="<?=$apptDate?>">
                <label for="alternate">Sélectionnez une date:</label>
                <input type="text" name="apptDate" id="alternate" class="rounded-2" required size="30">
              </div>
          </div>
          <div class="container col-md-6 mx-auto d-inline-flex justify-content-start">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="clearfix">
                <div class="input-group clockpicker pull-right" data-autoclose="true">
                <label for="time" class="mx-1">Sélectionnez une heure:</label>
                  <input type="text" id="time" name="apptTime" class="rounded-2" min="09:00" max="19:00" step="00:30" value="<?=(new DateTime())->format('H:i')?>" required size="10">
                  <span class="input-group-addon">
                    <span><i id="timeButton" class="bi bi-watch rounded-2"></i></span>
                  </span>
                  <div>Il est: <span id="timeDisplay"></span></div>
                </div>
              </div>
              <div class="col-md-12 mx-auto d-flex justify-content-start">
                <div class="col-md-5 justify-content-start">
                  <label for="listRdv" class="mx-1">Lister les RDV:</label>
                  <button id="listRdv" name="listRdv" value="listRdv" class="btn bsbtn1 btn-outline-primary form-control" type="submit"><i class="bi bi-list-task"></i>&nbsp;&nbsp;Lister les rdv</button>
                </div>
              </div>
              <div class="<?=$display?>">
                <p class="h5">Liste des rdv du salon: <?=$salonRdv?$salonRdv->getNom_salon():''?> le <?=$apptDate?></p> 
              </div>
              <div id="title" class="<?=$display?> small-grid-container bandeau boldfonts align-items-center p-1 col-sm-12">
                <div class="grid-item" ><span class="p-1">#</span></div>
                <div class="grid-item" ><span class="p-1">Nom</span></div>
                <div class="grid-item" ><span class="p-1">Heure</span></div>
                <div class="grid-item" ><span class="p-1">Client</span></div>
              </div>
              <?php foreach ($rndvs as $key=>$rndv) { ?>
              <div class="small-grid-container bg-light border border-primary justify-content-between align-items-center border p-1 col-sm rounded-2">
                <div class="grid-item" ><span class="p-1"><?=$key + 1?></span></div>
                <div class="grid-item" ><span class="p-1"><?=$rndv->getNom_rndv()?></span></div>
                <div class="grid-item" ><span class="p-1"><?=$rndv->getH_rndv()->format('H:i')?></span></div>  
                <div class="grid-item" ><span class="p-1"><?=$rndv->getId_client()->getNomClient()?></span></div>  
              </div>
              <?php } ?>
            </div>

          </div>
        </div>
      </form>
    </div>
  </section>
</main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>
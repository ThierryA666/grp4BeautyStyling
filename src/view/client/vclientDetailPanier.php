<?php
    $title = 'clientPanierDetail';
    ob_start();
    include './view/include/IncHead.php';
    $head = ob_get_clean();
    $bodyClass="bodybg";
    $img = PUBLIC_ROOT .'assets/img/photos-salon/' . $reservation->getId_salon()->getPhoto_salon();
    $style="background: url($img) no-repeat center fixed; background-size: cover";
    ob_start();
    include './view/include/incMenuBarClient.php';
    $menuBar = ob_get_clean();
    ob_start();
    include './view/include/incModal.php';
    $modal = ob_get_clean();
    ob_start();
    include './view/include/incFooterClient.php';
    $footer = ob_get_clean();
    ob_start();
    include './view/include/incScriptSrcClient.php';
    $script = ob_get_clean();
?>
<?php ob_start(); ?> 
<main>
  <section><!--Dialogue panier supprimer/retour Liste-->
    <div class="container mx-auto grow">
      <div class="my-3 col-md-11 mx-auto">
        <div class="d-inline-flex">
          <div>
            <h1 id="titleDetailPanier" class="h4 text-dark text-center d-inline mx-auto">Détail de ma réservation <?=$reservationDetail->getIdRDV()->getNom_rndv()?>
            , chez <a href="#" id="popUpSalon" name="popUpSalon<?=$reservationDetail->getIdRDV()->getId_salon()->getId_salon()?>" value="<?=$reservationDetail->getIdRDV()->getId_salon()->getId_salon()?>"><?=$reservationDetail->getIdRDV()->getId_salon()->getNom_salon()?></a></h1>
          </div>
          <div>
            <form id="reservationSupp" name="suppPanier" method="post" action="<?=APP_ROOT.'/panierDetail/suppression'?>" class="d-inline">
              <input type="hidden" id="reservation" name="reservation" value="<?=$reservationDetail->getIdRDV()->getId_rndv()?>">
              <button type="submit" id="suppReservation" name="suppReservation" data-toggle="modal" data-target="#dialogConfirm" data-reservation="<?=$reservationDetail->getIdRDV()->getNom_rndv()?>" data-id="<?=$reservationDetail->getIdRDV()->getId_rndv()?>" class="d-inline-flex bsbtn2 btn mx-5 rounded-2"><i class="bi bi-trash-fill"></i>&nbsp;Supprimer la réservation</button>
            </form>
          </div>
          <div>
            <form method="post" name="toListe" action="<?=APP_ROOT.'/paniers'?>" class="d-inline">
              <button type="submit" id="backToList" class="d-inline-flex bsbtn2 btn mx-5 rounded-2"><i class="bi bi-view-list"></i>&nbsp;Retour à la liste</button>
            </form>
          </div>
        </div>
        <p class="fw-bold <?=isset($msgUtilisateur['msgShow'])?$msggUtilisateur['style']:'d-none'?>"><?=isset($msgUtilisateur['message'])?$msgUtilisateur['message']:null?></p>
      </div>
    </div>
  </section>
  <section><!--Detail du panier-->
    <div class="container-fluid input col-md-11 mx-auto rounded-2 p-3" id="input">
      <div class="p-2 col-md-11 bgbs mx-auto rounded-2">
      <?php foreach ($reservationDetails as $key => $reservationDetail) {?>
        <form id="formDetailPanier<?=$reservationDetail->getIdRDV()->getId_rndv()?>" class="p-3" name="detailPanier" method="post" action="#">
          <div id="det" class="grid-container justify-content-between p-3 col-sm border bg-light border-primary rounded-2 m-1">
            <div class="grid-item col-form-label col-form-label-sm">
              Prestation:<br><span name="prestation" class="p-1 fw-bold"><?=$reservationDetail->getIdPresta()->getNomPresta()?></span>
            </div>
            <div class="grid-item col-form-label col-form-label-sm">
              Prix:<br><span name="prix" class="p-1"><?=($offrirs[$key] ? (($offrirs[$key]->getPrix_prest_salon() == 0) ? $reservationDetail->getIdPresta()->getPrixIndPrestaEuro() : $offrirs[$key]->getPrix_prest_salon()) : $reservationDetail->getIdPresta()->getPrixIndPrestaEuro())?>€</span>
            </div>
            <div class="grid-item col-form-label col-form-label-sm">
              Quantité:</label>
                <input type="number" size="2" name="qte" value="<?=$reservationDetail->getQte()?>" min="1" class="rounded-2 text-center">
            </div>
            <div class="grid-item col-form-label col-form-label-sm">
              Date-heure:</label><br><span name="rdv" class="p-1"><?=$reservationDetail->getIdRDV()->getD_rndv()->format('d-m-Y') . ' ' . $reservationDetail->getIdRDV()->getH_rndv()->format('H:i:s')?></span>
            </div>
            <div class="grid-item col-form-label col-form-label-sm">
              Option:</label><br><span name="option" class="p-1 text-primary"><?=$reservationDetail->getIdEmploye()->getNomEmploye()?></span>
            </div>
            <div class="grid-item col-form-label col-form-label-sm">
              Total:</label><br><span name="total" class="p-1"><?=$reservationDetail->getQte() * ($offrirs[$key] ? (($offrirs[$key]->getPrix_prest_salon() == 0) ? $reservationDetail->getIdPresta()->getPrixIndPrestaEuro() : $offrirs[$key]->getPrix_prest_salon()) : $reservationDetail->getIdPresta()->getPrixIndPrestaEuro())?>€</span>
            </div>
            <div class="grid-item col-form-label col-form-label-sm">
              Modifier la ligne</label><br>
                <button name="modifLigne" class="bsIconButtonPencil " type="submit" value="<?=$reservationDetail->getnumligne()?>"><i id="p17" class="bi bi-pencil p-1 col-sm animation-slide-up"></i></button>
                <input type="hidden" name="idRndv" value="<?=$reservationDetail->getIdRDV()->getId_rndv()?>">
                <input type="hidden" name="idPresta" value="<?=$reservationDetail->getIdPresta()->getIdPresta()?>">
                <input type="hidden" name="numLigne" value="<?=$reservationDetail->getnumligne()?>">
            </div>
            <div class="grid-item col-form-label col-form-label-sm">
              Supprimer la ligne</label><br><i class="bi-trash p-1 col-sm"></i>
            </div>
          </div>
        </form>
          <?php }?>
          <div class="boldfonts d-flex justify-content-end text-decoration-underline">
            <p class="text-start">Total du panier: <?=$totalPanier?>€</p>
          </div>
          <div class="d-flex justify-content-between col-md-12">
            <form>
              <button type="submit" id="buttonAdd" class="bsbtn1 btn mx-auto rounded-2"><i class="bi bi-bag-plus"></i>&nbsp;Ajouter une ligne</button>
            </form>  
            <form>
              <button type="submit" id="buttonCal" formmethod="get" formaction="../webapp/calendrier.php" class="bsbtn1 btn mx-auto rounded-2"><i class="bi bi-scissors"></i>&nbsp;Réservation</button>
            </form>
          </div>
      </div>
    </div>
  </section>
</main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>
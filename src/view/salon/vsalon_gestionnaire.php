<?php
    $title = 'Gestionnaire salon';
    $bodyClass="";
    $style = '';
    ob_start();
    include './view/include/incHead.php';
    $head = ob_get_clean();
    ob_start();
    include './view/include/incMenuBarSalonAfLogin.php';
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
      <div class="mt-2">
        <h1 class="fs-3 text-center" style="font-family: 'DM Serif Display', serif">- Bonjour <?=$salon->getNom_salon()?> ! -</h1>
      </div>
      <div class="container mt-5 d-flex">
        <div class="col-md-8">
        <form method="post" action="<?=APP_ROOT.'/salon/gestionnaire'?>" class="container-fluid row border border-success-subtle">
        <input type="hidden" name="id_salon" value="<?= $id_salon ?>">
          <div class="container-fluid mt-2 " style="background-color: #A0ECBA;">
            <p class="text-md-center fs-3">Liste de prestation</p>
          </div>

        <?php foreach($prestations as $prestation): ?>
          <div class="d-flex">
              <div class="form-check col-md-6 d-flex">
                <?php
                // chercher offrirs qui correspondent
                $checked = false;
                foreach ($offrirs as $offrir) {
                    if ($offrir->getIdPresta()->getIdPresta() === $prestation->getIdPresta()) {
                        $checked = true;
                        break;
                    }
                }
                ?>  
                <input class="form-check-input fs-4" type="checkbox" <?= $checked ? 'checked' : '' ?> value="<?= $prestation->getIdPresta() ?>"  name="chk[]" id="chk_<?= $prestation->getIdPresta() ?>">
                <label class="form-check-label fs-4" for="chk_<?= $prestation->getIdPresta() ?>">
                    <?= $prestation->getNomPresta() ?>
                </label>
              </div>
              <div class="col-md-2"> 
                  <?php
                  // chercher offrirs qui correspondent
                  $found = false;
                  foreach ($offrirs as $offrir) {
                      if ($offrir->getIdPresta()->getIdPresta() === $prestation->getIdPresta()) {
                          $found = true;
                          ?>
                          <input type="text" class="form-control" name="prixPresta[<?= $prestation->getIdPresta() ?>]" style="text-align:right" value="<?= sprintf("%.2f", $offrir->getPrix_prest_salon()) ?>" >
                          <?php break;
                      }
                  }
                  // if not found
                  if (!$found) { ?>
                      <input type="text" class="form-control" name="prixPresta[<?= $prestation->getIdPresta() ?>]" style="text-align:right" value="" >
                  <?php } ?>
              </div>
              <div class="col-md-2"> 
                  <p>€ (T.T.C.)</p>
              </div>
          </div>
    <?php endforeach; ?>

          <div class="col-12 my-3 d-flex justify-content-end">
              <button type="submit" class="btn text-white mx-5" style="background-color: #FF5B76;" name="savePresta">Enregistrer</button>
          </div> 
        </form>
        <div>
          <p class="fs-4 text-center"><?=$message?></p>
        </div>
      </div>


        <div class="col-md-4 d-flex align-items-center">
          <div class="col-md-12 d-flex justify-content-end">
            <a href="#"><button id="insSalon" type="submit" class="btn fs-3" style="background-color: #FF5B76; color: white;">Voir le calendrier <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
              </svg></button></a>  
        </div>       
        </div>
      </div>
    </main>
  <?php $content = ob_get_clean();?>
  <?php require ('./view/base.php');?>


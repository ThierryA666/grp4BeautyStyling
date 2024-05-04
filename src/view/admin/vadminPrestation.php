<?php
    $title = 'adminPrestation';
    ob_start();
    include './view/include/IncHead.php';
    $head = ob_get_clean();
    $bodyClass="adminbg";
    $style="";
    ob_start();
    include './view/include/incMenuBarAdmin.php';
    $menuBar = ob_get_clean();
    ob_start();
    include './view/include/incModal.php';
    $modal = ob_get_clean();
    ob_start();
    include './view/include/incFooterAdmin.php';
    $footer = ob_get_clean();
    ob_start();
    include './view/include/incScriptSrcAdmin.php';
    $script = ob_get_clean();
?>
<?php ob_start(); ?>
<main>
  <section>
  <div class="container-fluid" > 
      <h1 class="h4 text-dark text-center my-5">Gestion prestation</h1>
      <div class="input col-md-10 mx-auto rounded-4" id="input">
          <!--TODO formulaire-->
          <div class="col-md-8 mx-auto">
            <form id="formPresta" class="p-3" method="post" action="#">
            <div>    
              <div>
                  <label for="inputName" class="col-form-label col-form-label-sm">Nom* :</label>
                  <input type="text" size="48" class="form-control form-control-sm rounded-2" maxlength="128" id="inputName" name="name" autocomplete="on" placeholder="le nom de la prestation" <?=$disabled ? 'disabled' : ''?> value="<?=$prestation->getNomPresta()?>"></input>
              </div>
              <div>
                <label for="inputDuration" class="col-form-label col-form-label-sm">Durée en heure:min* :</label>
                <input type="text" size="5" class="form-control form-control-sm rounded-2" maxlength="5" min="<?=$min?>" max="<?=$max?>" id="inputDuration" name="duration" placeholder="la durée de la prestation hh:mm" value="<?=$prestation->getDureePrestaHM()?>"></input>
              </div>
              <div>
                <label for="inputDescription" class="col-form-label col-form-label-sm">Description :</label>
                <input type="text" size="64" class="form-control form-control-sm rounded-2" maxlength="256" id="inputDescription" name="description" placeholder="description de la prestation" value="<?=$prestation->getDescPresta() ? $prestation->getDescPresta() : ''?>"></input>
              </div>
              <div>
                <label for="inputPrice" class="col-form-label col-form-label-sm">Prix* (indicatif) en €:</label>
                <input type="text" size="6" class="form-control form-control-sm rounded-2 p-2" maxlength="<?=$maxLength?>" min="<?=$min?>" max="<?=$maxPrice?>" id="inputPrice" step="any" name="price"  placeholder="le prix de la prestation en €" value="<?=$prestation->getPrixIndPrestaEuro()?>"></input>
              </div>
              <div>
                <label for="inputCreationDate" class="col-form-label col-form-label-sm">Date de création</label>
                <input type="Date" class="form-control form-control-sm rounded-2 p-2" id="inputCreationDate" name="creationDate" disabled value="<?=$prestation->getCreationDate() ? $prestation->getCreationDate()->format('Y-m-d') : ''?>"></input>
              </div>
              <div class="<?=$display?>">
                <label for="inputModifDate" class="col-form-label col-form-label-sm ">Date de modification</label>
                <input type="Date" class="form-control form-control-sm rounded-2 p-2" id="inputModifDate" name="modifDate" <?=$disabled ? 'disabled' : ''?> value="<?=$prestation->getModifDate() ? $prestation->getModifDate()->format('Y-m-d') : '' ?>"></input>
              </div>
              <div class="row d-flex  justify-content-end">
                <div class="col <?=$afficher?>">
                  <button type="submit" id="<?=$buttonID?>" name="<?=$buttonLabel?>" formmethod="post" formaction="<?=($buttonLabel === 'Créer')? APP_ROOT.'/prestation/ajout': APP_ROOT.'/prestation/edition'?>" class="bsbtn2 btn d-flex m-5 mx-auto justify-content-end"  value="<?=$buttonLabel?>"><?=$buttonLabel?></button>
                </div>
                <div class="col <?=$afficher2?>">
                  <button type="submit" id="goBackList" name="goBackList" formethod="post" formaction="<?=APP_ROOT.'/prestations'?>" class="bsbtn2 btn d-flex m-5 mx-auto" value="goBackList">Retour à la liste</button>
                </div>
              </div>
            </form>
            <form id="suppPresta" method="post" action="<?=APP_ROOT.'/prestation/suppression'?>">
              <div class="col <?=$afficher3?>">
                <button type="submit" id="buttonSupp" name="Supprimer" class="bsbtn2 btn d-flex m-5 mx-auto" data-toggle="modal" data-target="#dialogConfirm" data-prestation="<?=$prestation->getNomPresta()?>" data-id="<?=$prestation->getIdPresta()?>" value="Supprimer">Supprimer</button> 
                <input type="hidden" name="keyPresta">
              </div>
            </form>
            <div>
              </p><h2 class="h5 <?=$msgUtilisateur['msgShow'] ? $msgUtilisateur['style'] : 'd-none'?>"><?=$msgUtilisateur['message']?></h2></p>
            </div>
          </div>
      </div>
    </div>
  </div>
  </section>

</main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>

<?php
    $title = 'Profile de votre salon';
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
      <div>
        <P class="fs-3 text-center" style="font-family: 'DM Serif Display', serif">- Infos de votre salon -</P>
      </div>
      <div>
        <P class="fs-3 text-center" style="font-family: 'DM Serif Display', serif">Bonjour <?=$salon->getNom_salon()?> !</P>
      </div>
      <div>
        <p class="fs-5 text-center"><?=$message?></p>
      </div>
      <div class="container mt-5">
        <form id="myForm" method="POST" action="<?=APP_ROOT.'/salon/profile'?>" class="row g-3 s-2 m-n" enctype="multipart/form-data" style="background-color: #A0ECBA;">
        <input type="hidden" name="id_salon" value="<?=$salon->getId_salon()?>">
          <div class="col-md-3">
            <label for="modifName" class="form-label">Nom</label>
            <p id="errMNom" class="text-warning d-none">error message</p>
            <input type="name" class="form-control" id="modifName" name="nom" value="<?=$salon->getNom_res()?>" disabled>
          </div>

          <div class="col-md-3">
            <label for="modifFirstName" class="form-label">Prénom</label>
            <p id="errMPrenom" class="text-warning d-none">error message</p>
            <input type="name" class="form-control" id="modifFirstName" name="prenom" value="<?=$salon->getPrenom_res()?>"  disabled>
          </div>

          <div class="col-md-6">
            <label for="modifAddress1" class="form-label">Aderesse</label>
            <p id="errMAd" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="modifAddress1" name="ad1" value="<?=$salon->getAd1()?>" disabled>
          </div>

          <div class="col-md-6">
            <label for="modifEmail" class="form-label">E-mail</label>
            <p id="errMEmail" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="modifEmail" name="email" value="<?=$salon->getEmail_salon()?>"  disabled >
          </div>

          <div class="col-md-6">
            <label for="modiftAddress2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="modifAddress2" name="ad2" value="<?=$salon->getAd2()?>" placeholder="" disabled>
          </div>

          <div class="col-md-6">
            <label for="modifTel" class="form-label">Téléphone</label>
            <p id="errMTel" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="modifTel" name="tel"  value="<?='0'.$salon->getTel_salon()?>" disabled>
          </div>
         
          <div class="col-md-2">
            <label for="modifZip" class="form-label">Code postal</label>
            <p id="errMZip" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="modifZip" name="zip" value="<?=$salon->getCp_salon()?>" placeholder="" disabled>
          </div>

          <div class="col-md-3">
            <label for="modifCity" class="form-label">Ville</label>
            <p id="errMVille" class="text-warning d-none">error message</p>
            <select class="form-select" id="modifCity" aria-label="Floating label select example" name="ville">
              <option value="<?=$salon->getNom_ville()?>"><?=$salon->getNom_ville()?></option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="modifSalon" class="form-label">Nom de salon</label>
            <input type="text" class="form-control" id="modifSalon" name="nom_salon" value="<?=$salon->getNom_salon()?>" readonly>
          </div>

          <div class="col-md-6">
            <label for="modifURL" class="form-label">URL ou Page Facebook / Instagram de salon </label>
            <input type="text" class="form-control" id="modifURL" name="url" value="<?=$salon->getUrl_salon()?>" disabled>
          </div>

          <div class="col-md-3">
            <label for="modifPhoto" class="form-label">Photo de profil</label>
            <input type="file" class="form-control" name="photo" id="modifPhoto" disabled>
          </div>
          
          <div id="registeredPhoto" class="col-md-3">
            <img src="/assets/img/photos-salon/<?=$salon->getPhoto_salon()?>" width="250">
          </div>

          <div class="col-md-3">
            <label for="password" class="form-label">Mot de passe (8 caractères minimum)</label>
            <input type="password" class="form-control" name="pw" id="modifPW"  minlength="8" maxlength="12" value="<?=$salon->getPw_salon()?>" disabled>
            <p id="errMPW" class="text-warning d-none">error message</p>
            <label for="checkbox" class="form-label">Afficher le mot de passe </label>
            <input type="checkbox" id="chk">
          </div>
        
          <div class="col-12 mb-6 d-flex justify-content-md-end">
            <button type="submit" class="btn text-white mx-5 mb-3 fs-4" style="background-color: #FF5B76;" id="btnModif" name="modif" onclick="recordButtonClick('modif')">Modifier</button>
            <button type="submit" class="btn text-white mx-5 mb-3 fs-4" style="background-color: #FF5B76;" id="btnEnregist" name="update" onclick="recordButtonClick('update')" disabled>Enregistrer</button>
            <input type="hidden" id="clickedButton" name="clickedButton" value="">
          </div>

          </div>

        </form>
      </div>   
    </main>
  <?php $content = ob_get_clean();?>
  <?php require ('./view/base.php');?>    

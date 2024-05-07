<?php
    $title = 'Inscrire mon salon';
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
      <div class="">
        <P class="fs-3 text-center" style="font-family: 'DM Serif Display', serif">- Formulaire d’inscription -</P>
      </div>
      <div class="container mt-5">
        <form method="POST" action="<?=APP_ROOT.'/salon/application'?>" class="row g-3 s-2 m-n" enctype="multipart/form-data" style="background-color: #A0ECBA;" id="salonapp">
          <div class="col-md-3">
            <label for="inputName" class="form-label">Nom*</label>
            <p id="errNom" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputName" name="nom" placeholder="">
          </div>

          <div class="col-md-3">
            <label for="inputFirstName" class="form-label">Prénom*</label>
            <p id="errPrenom" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputFirstName" name="prenom" placeholder="">
          </div>

          <div class="col-md-6">
            <label for="inputAddress" class="form-label">Aderesse*</label>
            <p id="errAd" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputAddress" placeholder="Numéro, Voie" name="ad1">
          </div>

          <div class="col-md-6">
            <label for="inputEmail" class="form-label">E-mail*</label>
            <p id="errEmail" class="text-warning d-none">error message</p>
            <input type="email" class="form-control" id="inputEmail" placeholder="name@mail.com" name="email">
          </div>

          <div class="col-md-6">
            <label for="inputAddress2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="" name="ad2">
          </div>
          
          <div class="col-md-2">
            <label for="inpuTCodeInt" class="form-label">Code international*</label>
            <input type="tel" class="form-control" id="inputCodeInt" minlength="1" maxlength="5" name="codeInt" placeholder="+33" value="+33">
          </div>

          <div class="col-md-4">
            <label for="inpuTel" class="form-label">Téléphone*</label>
            <p id="errTel" class="text-warning d-none">error message</p>
            <input type="tel" class="form-control" id="inputTel" minlength="10" maxlength="12" name="tel" placeholder="ex: 0123456789">
          </div>
         
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Code postal*</label>
            <p id="errZip" class="text-warning d-none">error message</p>
            <input type="number" class="form-control" id="inputZip" minlength="5"  maxlength="5" name="zip" placeholder="00000">
          </div>

          <div class="col-md-3">
            <label for="inputCity" class="form-label">Ville*</label>
            <p id="errVille" class="text-warning d-none">error message</p>
            <select class="form-select" id="inputCity" aria-label="Floating label select example" name="ville">
              <!-- <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>   -->
            </select>
          </div>

          <div class="col-md-6">
            <label for="salonName" class="form-label">Nom de salon*</label>
            <p id="errNomSalon" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputSalon" name="salonName" placeholder="">
          </div>

          <div class="col-md-6">
            <label for="inputURL" class="form-label">URL ou Page Facebook / Instagram de salon (facultatif)</label>
            <input type="url" class="form-control" id="inputURL" value="http://www." name="url">
          </div>

          <div class="col-md-3">
            <label for="photoUL" class="form-label">Photo de profil (facultatif) </label>
            <input type="file" class="form-control" id="photoUL" name="photo">
          </div>

          <div class="col-md-4">
            <label for="inputPW" class="form-label">Mot de passe minimum 8 carctères*</label>
            <p id="errPW1" class="text-warning d-none">error message</p>
            <input type="password" class="form-control" id="inputPW1"  minlength="8"  maxlength="15" name="pw" placeholder="">
            <label for="checkbox" class="form-label">Afficher le mot de passe </label>
            
            <input type="checkbox" id="chk1">
          </div>

          <div class="col-md-4">
            <label for="inputPW" class="form-label"> Mot de passe (pour confirmer)</label>
            <p id="errPW2" class="text-warning d-none">error message</p>
            <input type="password" class="form-control" id="inputPW2" minlength="8" maxlength="15" name="pw2" >
            <label for="checkbox" class="form-label">Afficher le mot de passe </label>
            <input type="checkbox" id="chk2">
          </div>

          <div class="col-12 mb-3 d-flex justify-content-end">
            <button id="inscriptionBtn" type="submit" class="btn text-white mx-5 fs-4" style="background-color: #FF5B76;">Inscrire</button>
          </div>

          <div class="fs-3 mt-5 text-center text-success"><?=$message ?></div>

        </form>
      </div>   
    </main>
  <?php $content = ob_get_clean();?>
  <?php require ('./view/base.php');?>

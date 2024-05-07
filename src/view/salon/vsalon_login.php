<?php
    $title = 'Log in pour prestataires - Beauty styling';
    $bodyClass="";
    $style = '';
    ob_start();
    include './view/include/incHead.php';
    $head = ob_get_clean();
    ob_start();
    include './view/include/incMenuBarSalonLogin.php';
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
      <div class="d-block">
        <div class="my-3">
         <h1 class="fs-3 text-center" style="font-family: 'DM Serif Display', serif">- Page log-in pour prestataires -</h1>
        </div>

        <div class="container row-md d-md-flex justify-content-center">
         <form method='POST' action="<?=APP_ROOT.'/salon/logincntrl'?>" class="px-4 py-3 col-md-6 my-3" id="loginPrestataire" style="background-color: #A0ECBA;">
            <div>
              <label for="exampleDropdownFormEmail1" class="form-label  col-md-4">E-mail</label>
              <input type="email" class="form-control col-md-4" name="emailSalon" id="exampleDropdownFormEmail1" placeholder="email@example.com">
            </div>
            <div class="mb-3">
              <label for="exampleDropdownFormPassword1" class="form-label col-md-4">Mot de passe</label>
              <input type="password" name="pwSalon" class="form-control col-md-4" placeholder="Mot de passe">
            </div>
            <!-- <div class="mb-3">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="dropdownCheck">
                <label class="form-check-label" for="dropdownCheck">  Se souvenir du nom d'utilisateur </label>
              </div>
            </div> -->
            <div class="d-md-flex justify-content-end">
              <button type="submit" class="btn text-white" style="background-color: #FF5B76;" name="login">log-in</button>
            </div>

          </form>
        </div>
        <div>
            <p class="fs-6 text-center">Vous n'avez pas de compte ? <span><a class="text-decoration-none text-reset" href="salon_top.php">Inscrivez-vous</a></span> dès aujourd'hui.</p>
        </div>
        <!-- <div>
          <p class="fs-6 text-center"><a class="text-decoration-none text-reset" href="#">Vous avez oublié le mot de passe ? </a></p>
      </div> -->
      </div>
    </main>
  <?php $content = ob_get_clean();?>
  <?php require ('./view/base.php');?>


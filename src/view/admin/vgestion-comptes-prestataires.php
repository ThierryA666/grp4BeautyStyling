<?php
    $title = 'adminPrestationList';
    ob_start();
    include './view/include/IncHead.php';
    $head = ob_get_clean();
    $bodyClass="";
    $style="";
    ob_start();
    include './view/include/incMenuBarAdmin.php';
    $menuBar = ob_get_clean();
    $modal = "";
    ob_start();
    include './view/include/incFooterAdmin.php';
    $footer = ob_get_clean();
    ob_start();
    include './view/include/incScriptSrcAdmin.php';
    $script = ob_get_clean();
?>
<?php ob_start(); ?>
<main>
      <div class="mt-2 text-md-center">
        <P class="fs-3" style="font-family: 'DM Serif Display', serif"> Gestion de comptes prestataires </P>
      </div>
      <div class="container row mt-5 d-flex mx-auto">
        <div class="col-md-12 d-flex justify-content-center mx-auto">
          <form method="POST" action="<?=APP_ROOT.'/salons'?>" name="searchForm"  class="container-fluid row border border-success-subtle" >

            <div class="container-fluid mt-2 " style="background-color: #A0ECBA;">
              <p class="text-md-center fs-3">Liste des comptes prestataires</p>
            </div>

            <div class="col-md-12 d-flex">
              <div class="col-md-3 my-3 d-flex">
                <a href ="<?=APP_ROOT.'/salon/application'?>" type="button" class="btn text-white mx-5" style="background-color: #FF5B76;">Ajouter un compte</a>
              </div> 
              <div class="col-md-9 my-3 d-flex">
                
                  <input type="text" class="form-control" id="inputKeyword" name="keyWord" placeholder="Entrez nom de salon ou numéro de téléphone">
                  <button id="btnSearchSalonAccount" type="submit" class="btn text-white mx-5" style="background-color: #FF5B76;"> Rechecher </button>
             
              </div> 
            
            </div>

            <div class="col-md-12 d-flex">
              <table class="table caption-top">
                <caption>Liste de comptes prestataires</caption>
                <thead>
                  <tr>
                    <!-- <th scope="col"><input class="form-check-input" type="checkbox" value="selectAll" disabled></th> -->
                    <th scope="col">Nom de salon </th>
                    <th scope="col">Nom de responsable</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="listSalonAccount">
                  <?php
                  foreach ($salons as $salon ){ ?>
                  <tr>
                    <!-- <th scope="row"><input class="form-check-input" type="checkbox" value="select"></th> -->
                    <td id="nameSalon"><?=$salon->getNom_salon()?></td>
                    <td id="nameRep"><?=$salon->getNom_res()?><?=" ".$salon->getPrenom_res()?></td>
                    <td id="telSalon"><?="0".$salon->getTel_salon()?></td>
                    <td id="emailSalon"><?=$salon->getEmail_salon()?></td>
                    <td><button type="button" class="btn"><a href="<?=APP_ROOT.'/salon/profile?id_salon='.$salon->getId_salon()?>"><i class="bi bi-pencil" style="color:blue;"></i></a></button> / 
                    <button type="button" class="btn"><a href="<?=APP_ROOT.'/salons/delete?id_salon='.$salon->getId_salon() ?>"><i class="bi bi-trash3" style="color: red"></i></a></button></td>
 
                  <?php
                  } ?>
                  
                  
                </tbody>
              </table>
            </div>           
          </form>    
        </div>
      </div>
    </main>
    <?php $content = ob_get_clean();?>
    <?php require ('./view/base.php');?>


<?php
    $title = 'adminPrestationList';
    $bodyClass="adminbg";
    ob_start();
    include './view/include/incMenuBarAdmin.php';
    $menuBar = ob_get_clean();
    ob_start();
    include './view/include/incModal.php';
    $modal = ob_get_clean();
?>
<?php ob_start(); ?>
<main> 
    <section id="listePresta"><!--Affichage des prestations-->
        <div class="container"> <h1 class="h4 text-dark text-center my-5">Liste des prestations</h1>
            <div class="input container col-md-11 mx-auto rounded-2 p-3">
                <div>
                    </p><h2 class="h5 <?=$msgUtilisateur['msgShow'] ? $msgUtilisateur['style'] : 'd-none'?>"><?=$msgUtilisateur['message']?></h2></p>
                </div>
                <form id="formCreate" name="createPrestation" method="post" action="<?=APP_ROOT.'/prestation/ajout'?>">
                    <button type="submit" id="buttonGoToCreate" class="bsbtn2 btn d-flex mx-auto rounded-2 p-2" value="createPrestation">Créer une prestation</button>
                </form>
                <div id="title" class="grid-container bandeau boldfonts align-items-center p-3 col-sm">
                    <div class="grid-item" ><span class="p-1">Intitulé</span></div>
                    <div class="grid-item" ><span class="p-1">Description</span></div>
                    <div class="grid-item" ><span class="p-1">Prix Indicatif €</span></div>
                    <div class="grid-item" ><span class="p-1">Création date</span></div>
                    <div class="grid-item" ><span class="p-1">Modif date</span></div>
                    <div class="grid-item"><span class="p-1"></span></div>
                    <div class="grid-item"><span class="p-1"></span></div>
                </div>
                <?php foreach ($prestaList as $key => $prestation) {?>
                <form id="actionPresta" name="actionPresta" action="<?=APP_ROOT.'/prestations'?>" method="post"></form>
                <div id="det<?=$key?>" class="grid-container bg-light border border-primary justify-content-between align-items-center border p-3 col-sm rounded-2">
                    <div class="grid-item" ><span class="p-1"><?=$prestation->getNomPresta()?></span></div>
                    <div class="grid-item" ><span class="p-1"><?=$prestation->getDescPresta()?></span></div>
                    <div class="grid-item" ><span class="p-1"><?=$prestation->getPrixIndPrestaEuro()?>€</span></div>
                    <div class="grid-item" ><span class="p-1"><?=$prestation->getCreationDate()->format('d-m-Y')?></span></div>
                    <div class="grid-item" ><span class="p-1"><?=$prestation->getModifDate() ? $prestation->getModifDate()->format('d-m-Y') : ''?></span></div>
                    <div class="grid-item">
                        <form id="actionPresta<?=$key?>" name="actionPresta" action="<?=APP_ROOT.'/prestation/edition'?>" method="post">
                            <button type="submit" id="modif<?=$key?>" class="bsIconButtonPencil"><i id="mod<?=$key?>" class="bi-pencil m-2 p-3"></i></button>
                            <input type="hidden" name="key" value="modifPresta<?=$prestation->getIdPresta()?>">
                        </form>
                    </div>
                    <div class="grid-item">
                        <form id="formSupp<?=$key?>" name="formSupp" action="<?=APP_ROOT.'/prestations/suppression'?>" method="post">
                            <button type="submit" id="supp<?=$key?>" name="suppPresta" value="<?=$key?>" class="bsIconButtonTrash" data-toggle="modal" data-target="#dialogConfirm"><i id="supp<?=$key?>" class="bi-trash m-2 p-3" data-prestation="<?=$prestation->getNomPresta()?>" data-id="<?=$key?>"></i></button>
                            <input type="hidden" name="key" value="<?=$key?>">
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php $content = ob_get_clean();?>
<?php require ('./view/baseAdmin.php');?>
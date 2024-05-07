<?php
    $title = 'Beauty Styling';
    $bodyClass="";
    $style = '';
    ob_start();
    include './view/include/incHead.php';
    $head = ob_get_clean();
    ob_start();
    include './view/include/incMenuBarSalon.php';
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
        <di class="container row mx-auto">
            <div class="col-md-6 mx-auto" id="illustTop">
                <img class="img-fluid" src="/assets/img/illustTop.png">
            </div>
            <div class="col-md-6 mx-auto">
                <h1 class="fs-1" style="font-family: 'DM Serif Display', serif; color:#FF5B76">Découvrez et réservez le salon qui vous correspond !</h1>    
                <form method="POST" action="<?=APP_ROOT.'/'?>" name="searchForm" id="searchForm">
                    <div class="m-3">
                        <label for="nameInput"   class="form-label">Nom de salon</label>
                        <input name="nameInput" id="nameInput" type="text" class="form-control"  placeholder="Veuillez saisir une partie ou la totalité du nom du salon.">
                    </div>
                    <div class="m-3">
                        <label for="dateInput" class="form-label">Séléctionez une date</label>
                        <input id ="dateInput" type="date" class="form-control"  placeholder="date">
                    </div>
                    <div class="m-3">
                        <label for="prestation" class="form-label">Préstation</label>
                        <select name="prestation" class="form-control" id="prestation" placeholder="Prestation">
                            <option name ="all" value="">--Tous les prestations--</option>
                            <?php foreach ($prestations as $prestation){ ?>
                            <option name ="prest" value="<?=$prestation->getIdPresta()?>"><?=$prestation->getNomPresta()?></option>
                            <?php
                              }?>
                       
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button name="search" id="cestParti" type="submit" class="btn fs-3" style="background-color: #FF5B76; color: white;">C'EST PARTI !</button>      
                    </div>
                </form>
                <div id="searchResult" class="col-md-6 mx-auto m-3">
           
            <?php foreach ($salons as $salon) { ?>
                <div class="m-3">
                    <p class="fs-4"><?=$salon->getNom_salon()?></p>
                    <p class="fs-5"><?=$salon->getAd1()?> <?=$salon->getAd2()?> <?=$salon->getCp_salon()?> <?=$salon->getNom_ville()?></p>
                    <div class="d-flex">
                        <p class="mx-2"><?=$salon->getUrl_salon()?></p>
                        <p class="mx-2">TEL: 0<?=$salon->getTel_salon()?></p>
                        <img class="mx-2" width="100" src="/assets/img/photos-salon/<?=$salon->getPhoto_salon()?>">
                    </div>              
                </div> 
            <?php } ?>
        </div>
            
        </div>    
    </main>
<?php $content = ob_get_clean();?>
<?php require ('./view/base.php');?>
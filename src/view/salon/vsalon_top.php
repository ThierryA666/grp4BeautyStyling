<?php
    $title = 'Top page pour salons';
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
        <di class="container-fluid row mx-auto">
            <div class="col-md-8 mx-auto d-block">
                <div class="mt-5">
                    <h1 class="fs-2" style="font-family: 'DM Serif Display', serif; color:#FF5B76">La meilleure solution 
                        pour développer votre salon ! </h1> 
                </div>
                <div class="container px-4 py-5" id="icon-grid">
                    <h2 class="pb-2 border-bottom fs-4" style="font-family: roboto;">Les outils dont vous avez besoin</h2>
                    
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4 py-5">
                          
                        <div class="col d-flex align-items-start">
                          <div>
                            <h2 class="fw-bold mb-0 fs-5 text-body-emphasis">  <i class="fa-regular fa-calendar-check"></i> Réservation en ligne</h2>
                            <p>Paragraph of text beneath the heading to explain the heading.</p>
                          </div>
                        </div>

                        <div class="col d-flex align-items-start">
                          <div>
                            <h3 class="fw-bold mb-0 fs-5 text-body-emphasis">  <i class="fa-solid fa-calendar-days"></i> Calendrier en ligne</h3>
                            <p>Paragraph of text beneath the heading to explain the heading.</p>
                          </div>
                        </div>
                        <div class="col d-flex align-items-start">
                          <div>
                            <h3 class="fw-bold mb-0 fs-5 text-body-emphasis">  <i class="fa-solid fa-mobile-screen"></i> SMS de rappel de RDV</h3>
                            <p>Paragraph of text beneath the heading to explain the heading.</p>
                          </div>
                        </div>
                          
                    </div>
                </div>
                
                <div class="col-12 d-flex justify-content-center">
                    <a href="<?=APP_ROOT.'/salon/application'?>"><button id="insSalon" type="submit" class="btn btn-lg fs-2" style="background-color: #FF5B76; color: white;">Inscrire mon salon <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                      </svg></button></a>  
                </div>        
            </div>
            <div class="col-md-4 mx-auto d-flex align-items-center" id="illustTopSalon2">
                <img class="img-fluid" src="/assets/img/illustSalon.png"> 
            </div>
            <div id="illustTopSalon" class="mt-4 col-md-12 d-flex mx-auto justify-content-around">
              <img src="/assets/img/salonillust2.png" height="150">
              <img class="align-items-center" src="/assets/img/onlinebooking.jpg" height="150">
              <img src="/assets/img/haircolor.png" height="150">             
            </div>

          

        </div>    
    </main>
  <?php $content = ob_get_clean();?>
  <?php require ('./view/base.php');?>

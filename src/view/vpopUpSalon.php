<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../assets/css/ta-style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../../assets/img/logo-beautystyling.jpg" rel="icon">
    <title>Mon Salon</title>
</head>
<body class="fade-in" style="background: url('../../assets/img/photos-salon/<?=$salon->getPhoto_salon()?>') no-repeat center fixed;background-size: cover;">
<div class="container">
    <div>
        <p><h1 class="h4 animate-bounce text-primary">Welcome to Beauty Styling salon: <?=$salon->getNom_salon()?>!!</h1></p>
        <p class="fs-5 text-primary"><?=$salon->getAd1()?> <?=$salon->getAd2()?> <?=$salon->getCp_salon()?> <?=$salon->getNom_ville()?></p>
    </div>
    <div class="d-flex">
        <p class="mx-2 text-primary"><?=$salon->getUrl_salon()?></p>
        <p class="mx-2 text-primary">TEL: 0<?=$salon->getTel_salon()?></p>
    </div> 
</div>
<footer class="fixed-bottom d-flex justify-content-end p-3">
    <div>
        <button type=button" class="btn bsbtn1 btn-outline-primary" id="closePopup">Fermer</button>
    </div>
</footer>
    <script type="module" src="../../assets/js/ta-clientPaniersPHP.js"></script>
</body>
</html>
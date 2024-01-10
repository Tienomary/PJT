<!doctype html>
<?php 
if(isset($match['params']['id'])){
  $id = $match['params']['id']; 
  $annonce = new pjt\Annonce($id, $bdd);
}else{
  header('Location: ./');
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $appName ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="./"><?= $appName ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./">Accueil</a>
                </li>
            </ul>
            <a class="btn btn-primary" href="./espacemembre/">Profil</a>
            </div>
        </div>
      </nav>
      <div class="container">
      <?php 
      if(isset($_SESSION['id']) && $annonce->posterid == $_SESSION['id']){ //je suis sur mon annonce
        ?>
        
        <?php
      }else{ //visiteur sur l'annonce
        ?>
        <div class="col-lg-8 col-xs-12 mt-3" style="margin-left: auto; margin-right: auto;">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <img src="./uploads/<?= $annonce->image ?>" width="80%"  style="margin-left: auto; margin-right: auto;">
                </div>
                <div class="col-lg-6 col-xs-12">
                    <h2><?= $annonce->nom ?> <span class="badge text-bg-success"><?= $annonce->tagname ?></span></h2>
                    <br>
                    <figcaption class="blockquote-footer">
                      Posté le : <?= $annonce->dateofcreation ?> à <?= $annonce->hourofcreation ?>
                    </figcaption>
                    <p><?= $annonce->description ?></p>
                </div>
                <p style="margin-bottom: 0;"><b>Prix : </b> <?= $annonce->prix ?>€/jour </p>
                <p><b>Localisation : </b><?= $annonce->getCreatorCodePostal() ?></p>
                <a class="btn btn-primary" href="#">Je réserve</a>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
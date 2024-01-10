<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $appName ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&family=Rubik:ital,wght@0,300;0,500;1,300&display=swap" rel="stylesheet">
  </head>
  <body>
  <style>
    body {
      scroll-behavior: smooth;
      font-family: 'Roboto', sans-serif;
    }
    .myheader{
      width: 100%;
      height: 500px;
      background: linear-gradient(#09498d, #789ae2, #FFF);
    }
    .myheader h1{
      position: relative;
      top: 30%;
      color: white;
      font-family: 'Roboto', sans-serif;
      line-height: 30px;
    }
    .myheader h1 span{
      font-size: 25px;
    }
    .mypresentation{
      padding-top: 60px;
      padding-bottom: 60px;
    }
    .divider{
      border-bottom: 1px solid black;
      width: 20%;
      height: 1px;
      margin: 0;
      padding: 0;
    }
    .annonces{
      width: 100%;
      padding-top: 40px;
      padding-bottom: 40px;
      background: linear-gradient(#fff, rgb(159, 209, 99), rgb(129,188,59));
    }
  </style>
  <div class="myheader">
    <nav class="navbar navbar-expand-lg bg-transparent-tertiary text-white " style="color: white;">
      <div class="container-fluid">
        <a class="navbar-brand" href="/"  style="color: white;"><?= $appName ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"  style="color: white;">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#annonces"  style="color: white;">Annonces</a>
            </li>
          </ul>
          <a class="btn btn-primary" href="./espacemembre">Profil</a>
        </div>
      </div>
    </nav>
    <h1 class='text-center align-middle'>
      <?= $appName ?><br>
      <span>Louez intelligemment, vivez durablement </span>
    </h1>
  </div>
  <div class="mypresentation">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-xs-12">
          <img src="./logo.png" width="80%">
        </div>
        <div class="col-md-9 col-xs-12"><br>
          <h2 style="margin: 0; padding: 0;">Notre histoire : </h2> 
          <p style="font-size: 20px; text-align: justify; margin-top: 10px;">Bienvenue sur LocalRent - la plateforme de location entre particuliers qui allie praticité, économie et respect de l'environnement. Louez des objets de qualité directement auprès de votre communauté, réduisez votre empreinte carbone et contribuez à un mode de vie plus durable. Découvrez le pouvoir du partage sur LocalRent - louez intelligemment, vivez durablement.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="annonces" id="annonces">
    <div class="container"><br>
      <h2 style="color: black;">Regardez les dernières annonces publiées : </h2>
      <?php 
      if(isset($_GET['tags'])){
      ?>
      <a class="badge text-bg-danger" href="./#annonces" style="text-decoration: none;">Supprimer le tag</a>
      <?php
      }
      foreach($bdd->queryReturn('SELECT * FROM tags') as $tag){
        if(isset($_GET['tags']) && $_GET['tags'] == $tag->id){
        
        }else{
      ?>
        <a class="badge text-bg-primary" href="./?tags=<?= $tag->id ?>#annonces" style="text-decoration: none">
          <?= $tag->name ?>
        </a>
      <?php } } ?>
      <div class="row">
        <?php 
        if(isset($_GET['tags'])){
          $req = $bdd->queryReturn('SELECT * FROM articles WHERE tagid = ?', array($_GET['tags']));
        }else{
          $req = $bdd->queryReturn('SELECT * FROM articles');
        }
        foreach($req as $article){ 
        ?>
        <div class="col-lg-7 col-md-7 col-xs-12" style="padding: 10px; margin-left: auto; margin-right: auto; ">
          
          <div class="card mb-3" style="max-width: 540px; background-color: rgba(255, 255, 255, 0.127); border: 0px; box-shadow: 10px 5px 5px rgba(0, 0, 0, 0.2); margin-left: auto; margin-right: auto;">
              <div class="row g-0">
                  <div class="col-md-4">
                  <img src="./uploads/<?= $article->image ?>" class="img-fluid rounded-start" alt="..." width="100%">
                  </div>
                  <div class="col-md-8">
                  <div class="card-body"  style="background-color: transparent;">
                    <h5 class="card-title"><?= $article->name ?></h5>
                    <p class="card-text"><?= substr($article->description,0, 50) ?>...</p>
                    <a href="./product-<?= $article->id ?>" class="btn btn-primary">Voir +</a>
                  </div>
                  </div>
              </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
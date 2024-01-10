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
      if(isset($_GET['s'])){
      ?>
      <div class="alert alert-success mt-3">
        <?= $_GET['s'] ?>
      </div>
      <?php
      }
      ?>
      <?php 
      if(!isset($_GET['book'])){
        if(isset($_SESSION['id']) && $annonce->posterid == $_SESSION['id']){ //je suis sur mon annonce
          if(isset($_GET['del'])){
            $annonce->deleteMyAnnonce();
            header('Location: ./espacemembre/?s=Votre annonce a bien été supprimée !');
          }
          ?>
          <div class="row mt-3">
            <div class="col-lg-6 col-xs-12">
              <div class="card">
                <div class="card-body">
                  <!-- formulaire -->
                  <form method="POST" action="/updatetheproduct?id=<?= $id ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titleInput" class="form-label">Titre de l'annonce</label>
                        <input type="text" class="form-control" id="titleInput" placeholder="Entrez le titre ici" name="titre"  value="<?= $annonce->nom ?>">
                    </div>
                    <div class="mt-3">
                        <label for="priceInput" class="form-label">Prix : <span id="priceOutput"></span> (euros/jour)</label>
                        <input type="number" class="form-control" id="priceInput" step="0.01" placeholder="Entrez le prix par jour" name="price" value="<?= $annonce->prix ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descriptionInput" class="form-label">Description de l'annonce (250 mots max)</label>
                        <textarea class="form-control" id="descriptionInput" rows="6" placeholder="Décrivez votre annonce ici" name="description"><?= $annonce->description ?></textarea>
                    </div>
                    <select class="form-select" aria-label="Default select example" name="tag">
                        <option>Choisissez un mot clé</option>
                        <?php
                        foreach($bdd->queryReturn('SELECT * FROM tags') as $tag){
                        ?>
                        <option value="<?= $tag->id ?>" <?php if($tag->id == $annonce->tagid): echo 'selected'; endif; ?>><?= $tag->name ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-success" style="width: 100%;">Mettre à jour !</button>
                  </form>
                  <button class="btn btn-danger mt-3" style="width: 100%;" data-bs-toggle="modal" data-bs-target="#exampleModal">Supprimer l'annonce</button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Êtes vosu sur de vouloir supprimer votre annonce ?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                          <a type="button" class="btn btn-primary" href="./product-<?= $id ?>?del=1">Oui</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xs-12">
              <div class="card">
                <div class="card-body">
                  <!-- reservations -->
                  <h2 class="text-center">Les réservations</h2>
                </div>
              </div>
            </div>
          </div>
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
                  <a class="btn btn-primary" href="./product-<?= $id ?>?book=1">Je réserve</a>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
      }else{
        ?>
        <div class="col-lg-8 col-xs-12 mt-3" style="margin-left: auto; margin-right: auto;">
          <div class="card">
            <div class="card-body">
              <?php 
              if(isset($_SESSION['id'])){

              }else{
              ?>
              <div class="alert alert-danger">
                Il semblerait que vous ne soyez pas connecté, nous vous invitons à vous connecter : <a  href="./espacemembre/">ICI</a>
              </div>
              <?php
              }
              ?>
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
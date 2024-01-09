<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer une annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
          <a class="navbar-brand" href="../"><?= $appName ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../">Accueil</a>
              </li>
          </ul>
          <a class="btn btn-primary" href="./">Profil</a>
          </div>
      </div>
    </nav>
    <?php 
    if(!isset($_SESSION['id'])){
        header('Location: ../');
    }
    ?>
    <div class="container align-center">
        <div class="row">
            <div class='col-md-9 col-xs-12' style="margin-left: auto; margin-right: auto;">
                <?php 
                if(isset($_GET['e'])):
                ?>
                <div class="alert alert-danger"><?= $_GET['e'] ?></div>
                <?php
                endif;
                ?>
                <style>
                    /* Vos styles CSS */
                    .container {
                        margin-top: 50px;
                    }
                    .image-placeholder {
                        width: 100%;
                        height: 200px;
                        border: 2px dashed #007bff;
                        border-radius: 5px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: #007bff;
                        font-size: 16px;
                    }
                    .uploaded-image {
                        max-width: 100%;
                        max-height: 200px;
                        border-radius: 5px;
                        object-fit: contain;
                    }
                    .tags-select-container {
                        width: 50%;
                        margin-bottom: 1em;
                    }
                </style>
                <form method="POST" action="/createtheproduct" enctype="multipart/form-data">
                    <div class="row align-items-start">
                        <div class="col-md-3 text-center">
                            <figure class="figure">
                                <figcaption class="figure-caption">
                                    <label for="fileInput" class="upload-button btn btn-primary">Cliquez pour ajouter une image</label>
                                </figcaption>
                            </figure>
                            <input type="file" name="fileToUpload" id="fileInput" accept="image/*" style="display: none;" >
                            <noscript><input type="submit" value="Ajouter l'Image"></noscript>

                            <div class="mt-3">
                                <label for="priceInput" class="form-label">Prix : <span id="priceOutput"></span> (euros/jour)</label>
                                <input type="number" class="form-control" id="priceInput" step="0.01" placeholder="Entrez le prix par jour" name="price">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Titre de l'annonce</label>
                                <input type="text" class="form-control" id="titleInput" placeholder="Entrez le titre ici" name="titre">
                            </div>
                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Description de l'annonce (250 mots max)</label>
                                <textarea class="form-control" id="descriptionInput" rows="6" placeholder="Décrivez votre annonce ici" name="description"></textarea>
                            </div>
                            <select class="form-select" aria-label="Default select example" name="tag">
                                <option selected>Choisissez un mot clé</option>
                                <?php
                                foreach($bdd->queryReturn('SELECT * FROM tags') as $tag){
                                ?>
                                <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success" style="width: 100%;">Mettre en ligne !</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
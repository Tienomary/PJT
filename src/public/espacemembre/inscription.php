<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace Membre</title>
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
    if(isset($_SESSION['id'])){
        header('Location: ../');
    }
    ?>
    <div class="container align-center">
        <div class="row">
            <div class='col-lg-6 col-md-9 col-xs-12' style="margin-left: auto; margin-right: auto;">
                <?php 
                if(isset($_GET['e'])):
                ?>
                <div class="alert alert-danger"><?= $_GET['e'] ?></div>
                <?php
                endif;
                ?>
                <h2>Inscription</h2>
                <form action="/inscription" method="POST" >
                    <div class="mb-3">
                        <label for="mail" class="form-label">Adresse email</label>
                        <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mail" name="password" aria-describedby="emailHelp" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prenom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="codepostal" class="form-label">Code Postal</label>
                                <input type="text" class="form-control" id="codepostal" name="codepostal" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="phonenumber" class="form-label">Numéro de tel :</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
                            </div>
                        </div>
                    </div>
                    <a href="./" class="btn btn-warning">Retour</a>
                    <button type="submit" class="btn btn-success">Je m'inscris</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
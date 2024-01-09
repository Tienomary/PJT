<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $appName ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <style>
      .sidebar {
          min-height: 100vh; 
          padding-top: 1rem;
          background-color: #f8f9fa; 
      }
      .sidebar .nav-link.active {
          color: #0069d9;
      }
      .sidebar .nav-link {
          color: #333;
      }
    </style>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar" style="padding-right: 0; ">
          <div class="sidebar-sticky"  style="position: fixed;">
            <h3><?= $appName ?></h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($_GET['tags'])): echo 'active'; endif; ?>" href="#">
                      Tag 1
                    </a>
                </li>
            </ul>
        </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10" style="padding-left:0; padding-right: 0;">
          <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: 90%;">
                  <form class="d-flex" role="search" style="width: 100%;">
                    <input class="form-control me-2" type="search" placeholder="Rechercher un produit" aria-label="Rechercher un produit">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                  </form>
                </ul>
                <a class="btn btn-primary" href="./espacemembre">Profil</a>
              </div>
            </div>
          </nav>
          <div class="container" style="padding-top: 20px;">
            <h2>Regardes les dernières annonces publiées sur notre site <?= $appName ?></h2>
            <div class="row">
                <?php for($i=0; $i<20; $i++){ ?>
              <div class="col-lg-4 col-md-6 col-xs-12" style="padding: 10px;">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
                <?php } ?>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
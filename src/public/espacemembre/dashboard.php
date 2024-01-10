<?php 
if(isset($_SESSION['id'])):
$user = new pjt\user($_SESSION['id'], $bdd);
$prenom = 'etienne';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <p class="card-text">
                        Prénom : <?= $user->getUserFirstName() ?><br>
                        Nom : <?= $user->getUserLastName() ?> <br>
                        Code Postal : <?= $user->getUserCodePostal() ?> <br>
                        Numéro de tel : <?= $user->getUserPhoneNumber() ?> <br>
                        Adresse mail : <?= $user->getUserEmail() ?> <br>
                    </p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editprofil">Éditer mon profil</button>
                    <!-- Modal edition profil -->
                    <div class="modal fade" id="editprofil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Édition profil</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/profilupdate" method="POST" >
                                        <div class="mb-3">
                                            <label for="mail" class="form-label">Adresse email</label>
                                            <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" value="<?= $user->getUserEmail() ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="prenom" class="form-label">Prenom</label>
                                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $user->getUserFirstName() ?>">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $user->getUserLastName() ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="codepostal" class="form-label">Code Postal</label>
                                                    <input type="text" class="form-control" id="codepostal" name="codepostal" value="<?= $user->getUserCodePostal() ?>">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="phonenumber" class="form-label">Numéro de tel :</label>
                                                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= $user->getUserPhoneNumber() ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Mettre à jour mes informations</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="./createproduct" class="btn btn-outline-success" style="margin-top: 10px; width: 100%;">Créer une annonce</a>
        </div>
        <div class="col-lg-9 col-xs-12" style="padding: 10px;">
            <h1>Bienvenue sur votre espace <b><?= $user->getUserFirstName() ?></b> ! </h1>
            <?php 
            if(isset($_GET['s'])):
            ?>
            <div class="alert alert-success">
                <?= $_GET['s'] ?>
            </div>
            <?php
            endif;
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php
                        $myAnnonceNumber = $bdd->queryCount("SELECT * FROM articles WHERE posterid = ?", array($_SESSION['id']));
                        if($myAnnonceNumber == 0){
                            echo ('<h5>Il semblerait que vous n\'avez pas posté d\'annonce. Postez-en une en cliquant <b><a href="./createproduct">ICI</a></b> </h5>');
                        }else{
                            $reqs = $bdd->queryReturn("SELECT * FROM articles WHERE posterid = ?", array($_SESSION['id']));
                            foreach($reqs as $req){
                                ?>
                                <div class="col-xs-12 col-md-6">
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="../uploads/<?= $req->image ?>" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                            <div class="card-body">
                                            <h5 class="card-title"><?= $req->name ?></h5>
                                            <p class="card-text"><?= substr($req->description,0, 20) ?>...</p>
                                            <a href="../product-<?= $req->id ?>" class="btn btn-primary">Voir +</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
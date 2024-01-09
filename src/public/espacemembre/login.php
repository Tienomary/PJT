<div class="container align-center">
    <div class="row mt-2">
        <div class='col-lg-6 col-md-9 col-xs-12' style="margin-left: auto; margin-right: auto;">
        <h2>Connexion</h2>
        <?php 
        if(isset($_GET['e'])){
            ?>
            <div class="alert alert-danger" role="alert">
              <?= $_GET['e'] ?>
            </div>
            <?php
        }
        if(isset($_GET['s'])){
            ?>
            <div class="alert alert-success" role="alert">
              <?= $_GET['s'] ?>
            </div>
            <?php
        }
        ?>
        <form action="/connexion" method="POST"> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="adressemail">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
            <a href="./inscription" class="btn btn-success">Inscription</a>
        </form>
        </div>
    </div>
</div>
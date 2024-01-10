<?php
require './config.php';
require './vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/espacemembre/', './espacemembre/index');
$router->map('GET', '/espacemembre/inscription', './espacemembre/inscription');
$router->map('GET', '/product-[i:id]', 'product');
$router->map('GET', '/espacemembre/deconnexion', './espacemembre/deconnexion');
$router->map('GET', '/espacemembre/createproduct', './espacemembre/createproduct');

$router->map('POST', '/connexion', 'connexion');
$router->map('POST', '/inscription', 'inscription');
$router->map('POST', '/profilupdate', 'profilupdate');
$router->map('POST', '/createtheproduct', 'createtheproduct');
$router->map('POST', '/updatetheproduct', 'updatetheproduct');
$router->map('POST', '/book', 'book');


$match = $router->match();

switch ($match['target']){
    case 'connexion':
        $var = $_POST; 
        if(isset($var['adressemail']) && !empty($var['adressemail']) && isset($var['password']) && !empty($var['password'])){
            $req = $bdd->queryCount("SELECT * FROM users WHERE email = ?", array($var['adressemail']));
            if($req != 0){
                $getInfo = $bdd->queryReturn('SELECT * FROM users WHERE email = ?', array($var['adressemail']));
                if($getInfo[0]->password == $var['password']){
                    //connected
                    $_SESSION['id'] = $getInfo[0]->id;
                    header('Location: ./espacemembre/');
                }else{
                    header('Location: ./espacemembre/?e=L\'adresse email ou le mot de passe est faux.');
                }
            }else{
                header('Location: ./espacemembre/?e=L\'adresse email ou le mot de passe est faux.');
            }
        }else{
            header('Location: ./espacemembre/?e=Veuillez remplir tous les champs du formulaire.');
        }
        echo ('ok');
        break;
    case 'profilupdate':
        $var = $_POST;
        $user = new pjt\user($_SESSION['id'], $bdd);
        if(isset($var['mail']) && !empty($var['mail'])){
            if($var['mail'] != $user->getUserEmail()){
                $req = $bdd->queryCount("SELECT * FROM users WHERE email = ?", array($var['mail']));
                if($req == 0){
                    $varma = htmlspecialchars($var['mail']);
                    $user->updateUserInformation('email', $varma);
                }
            }
        }
        if(isset($var['prenom']) && !empty($var['prenom'])){
            if($var['prenom'] != $user->getUserFirstName()){
                $var['prenom'] = htmlspecialchars($var['prenom']);
                $user->updateUserInformation('firstname', $var['prenom']);
            }
        }
        if(isset($var['nom']) && !empty($var['nom'])){
            if($var['nom'] != $user->getUserLastName()){
                $var['nom'] = htmlspecialchars($var['nom']);
                $user->updateUserInformation('lastname', $var['nom']);
            }
        }
        if(isset($var['codepostal']) && !empty($var['codepostal'])){
            if($var['codepostal'] != $user->getUserCodePostal()){
                $var['codepostal'] = htmlspecialchars($var['codepostal']);
                $user->updateUserInformation('codepostal', $var['codepostal']);
            }
        }
        if(isset($var['phonenumber']) && !empty($var['phonenumber'])){
            if($var['phonenumber'] != $user->getUserPhoneNumber()){
                $var['phonenumber'] = htmlspecialchars($var['phonenumber']);
                $user->updateUserInformation('phonenumber', $var['phonenumber']);
            }
        }
        header('Location: ./espacemembre/?s=Vous avez bien mis à jour votre profil.');
        break;
    case 'inscription':
        $var = $_POST;

        if(isset($var['mail']) && !empty($var['mail'])){
            $mail = htmlspecialchars($var['mail']);
        }
        if(isset($var['prenom']) && !empty($var['prenom'])){
            $prenom = htmlspecialchars($var['prenom']);
        }
        if(isset($var['nom']) && !empty($var['nom'])){
            $nom = htmlspecialchars($var['nom']);
        }
        if(isset($var['codepostal']) && !empty($var['codepostal'])){
            $codepostal = htmlspecialchars($var['codepostal']);
        }
        if(isset($var['phonenumber']) && !empty($var['phonenumber'])){
            $phonenumber = htmlspecialchars($var['phonenumber']);
        }
        if(isset($var['password']) && !empty($var['password'])){
            $pwd = htmlspecialchars($var['password']);
        }
        if(isset($mail) && isset($prenom) && isset($nom) && isset($codepostal) && isset($phonenumber) && isset($pwd)){
            $req = $bdd->queryCount("SELECT * FROM users WHERE email = ?", array($mail));
            if($req == 0){  
                $bdd->queryExec("INSERT INTO users(firstname, lastname, email, password, codepostal, phonenumber) VALUES (?,?,?,?,?,?)",array($prenom, $nom, $mail, $pwd, $codepostal,$phonenumber));
                header('Location: ./espacemembre?s=Votre compte a bien été créée.');
            }else{
                header('Location: ./espacemembre/inscription?e=Cette adresse email est déjà utilisée.');
            }
        }else{
            header('Location: ./espacemembre/inscription?e=Veuillez remplir tous les champs du formulaire.');
        }
        break;
    case 'createtheproduct':
        $var = $_POST;
        $target_dir = "./uploads/";
        if(($_FILES['fileToUpload']['size']) != 0){
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $name = uniqid() .basename($_FILES["fileToUpload"]["name"]);
    
            $target_file = $target_dir . $name;
            echo( $target_file);
            $uploadOk = 1;
    
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                header('Location: ./espacemembre/createproduct?e=Il y a eu une erreur avec l\'upload de votre image...');
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    if(isset($var['price']) && !empty($var['price'])){
                        $price = htmlspecialchars($var['price']);
                    }
                    if(isset($var['titre']) && !empty($var['titre'])){
                        $titre = htmlspecialchars($var['titre']);
                    }
                    if(isset($var['description']) && !empty($var['description'])){
                        $description = htmlspecialchars($var['description']);
                    }
                    if(isset($var['tag']) && !empty($var['tag']) && $var['tag'] != 0){
                        $tag = htmlspecialchars($var['tag']);
                    }
                    if(isset($price) && isset($titre) && isset($description) && isset($tag)){
                        $bdd->queryExec("INSERT INTO articles(name, description, image, posterid, price, datetime, tagid) VALUES (?,?,?,?,?,NOW(),?)", array($titre,$description,$name,$_SESSION['id'],$price,$tag));
                        header('Location: ./espacemembre?s=Annonce mise en ligne !');
                    }else{
                        header('Location: ./espacemembre/createproduct?e=Veuillez remplir tous les champs du formulaire.');
                    }
                } 
            }
        }else{
            header('Location: ./espacemembre/createproduct?e=Veuillez mettre une image à votre annonce.');
        }
        break;
    case 'updatetheproduct':
        $var = $_POST;
        $id=$_GET['id'];
        $annonce = new pjt\annonce($id, $bdd);

        if(isset($var['titre']) && !empty($var['titre'])){
            if($var['titre'] != $annonce->nom){
                $var['titre'] = htmlspecialchars($var['titre']);
                $annonce->updateAnnonceInformation('name', $var['titre']);
            }
        }

        if(isset($var['price']) && !empty($var['price'])){
            if($var['price'] != $annonce->prix){
                $var['price'] = htmlspecialchars($var['price']);
                $annonce->updateAnnonceInformation('price', $var['price']);
            }
        }

        if(isset($var['description']) && !empty($var['description'])){
            if($var['description'] != $annonce->description){
                $var['description'] = htmlspecialchars($var['description']);
                $annonce->updateAnnonceInformation('description', $var['description']);
            }
        }

        if(isset($var['tag']) && !empty($var['tag'])){
            if($var['tag'] != $annonce->tagid){
                $var['tag'] = htmlspecialchars($var['tag']);
                $annonce->updateAnnonceInformation('tagid', $var['tag']);
            }
        }
        header('Location: ./product-'.$id.'?s=Votre annonce à bien été modifiée');
    break;
    case 'book':
        $var = $_POST;
        if (isset($var['selectedDates'])) {
            $selectedDates = explode(',', $_POST['selectedDates']);
            $selectedDatesVerify = array();
            foreach($selectedDates as $date){
                if(!in_array($date, $selectedDatesVerify)){
                    $selectedDatesVerify[sizeof($selectedDatesVerify)] = $date;
                }
            }
            foreach($selectedDatesVerify as $date){
                $bdd->queryExec("INSERT INTO reservations(idarticle, iduser, date) VALUES (?,?,?)", array($_GET['id'], $_SESSION['id'], $date));
            }
            header('Location: ./product-'.$_GET['id'].'?s=Vous avez bien reservé votre location !');
            var_dump($selectedDatesVerify);
        }
        break;
    default: 
        require "./{$match['target']}.php";
        break;

}

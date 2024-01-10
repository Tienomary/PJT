<?php 

namespace pjt;
class Annonce{

    private $id;
    private $bdd;

    public $nom;
    public $description;
    public $posterid;
    public $image;
    public $prix;
    public $dateofcreation;
    public $hourofcreation;
    public $tagname;


    public function __construct($id, $bdd){
        $this->id = $id;
        $this->bdd = $bdd;

        $this->nom = $this->getAnnonceName();
        $this->description = $this->getAnnonceDescription();
        $this->posterid = $this->getAnnoncePosterId();
        $this->image = $this->getAnnonceImage();
        $this->prix = $this->getAnnoncePrice();
        $this->dateofcreation = $this->getAnnonceDateofcreation();
        $this->hourofcreation = $this->getAnnonceHoursfcreation();
        $this->tagname = $this->getAnnonceTagName();
    }

    public function getAnnonceName(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return $req[0]->name;
    }

    public function getAnnoncePosterId(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return $req[0]->posterid;
    }

    public function getAnnonceDescription(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return $req[0]->description;
    }

    public function getAnnonceImage(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return $req[0]->image;
    }

    public function getAnnoncePrice(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return $req[0]->price;
    }

    public function getAnnonceDateofcreation(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return date('d-m-Y', strtotime($req[0]->datetime));
    }

    public function getAnnonceHoursfcreation(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return date('H:i', strtotime($req[0]->datetime));
    }

    public function getAnnonceTagName(){
        $req = $this->bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        $tagid = $req[0]->tagid;
        return $this->bdd->queryReturn('SELECT * FROM tags WHERE id = ?', array($tagid))[0]->name;
    }

    public function getCreatorCodePostal(){
        $user = new user($this->posterid, $this->bdd);
        return $user->getUserCodePostal();
    }


}

?>
<?php 

namespace pjt;
class Annonce{

    private $id;
    private $bdd;

    public $nom;

    public function __construct($id, $bdd){
        $this->id = $id;
        $this->bdd = $bdd;

        $this->nom = $this->getAnnonceName();
    }

    public function getAnnonceName(){
        $req = $bdd->queryReturn("SELECT * FROM articles WHERE id = ?", array($this->id));
        return $req[0]->name;
    }


}

?>
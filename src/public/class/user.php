<?php
namespace pjt;
class user{
    private $id;
    private $bdd;
    
    public function __construct($id, $bdd){
        $this->id = $id;
        $this->bdd = $bdd;
    }
    /**
     * update l'info du user
     */
    public function updateUserInformation($column, $value){
        $req = $this->bdd->queryExec("UPDATE users SET $column = ? WHERE id = ?", array($value,$this->id));
        if($req){
            return true;
        }else{
            return false;
        }
    }

    // getters

    /**
     * renvoie le prenom du user
    **/
    public function getUserFirstName(){
        $req = $this->bdd->queryReturn("SELECT * FROM users WHERE id = ?", array($this->id));
        return $req[0]->firstname;
    }
    /**
     * renvoie le nom du user
    **/
    public function getUserLastName(){
        $req = $this->bdd->queryReturn("SELECT * FROM users WHERE id = ?", array($this->id));
        return $req[0]->lastname;
    }
    /**
     * renvoie le mail du user
    **/
    public function getUserEmail(){
        $req = $this->bdd->queryReturn("SELECT * FROM users WHERE id = ?", array($this->id));
        return $req[0]->email;
    }
    /**
     * renvoie le mail du user
    **/
    public function getUserPhoneNumber(){
        $req = $this->bdd->queryReturn("SELECT * FROM users WHERE id = ?", array($this->id));
        return $req[0]->phonenumber;
    }
    /**
     * renvoie le password du user
    **/
    public function getUserPassword(){
        $req = $this->bdd->queryReturn("SELECT * FROM users WHERE id = ?", array($this->id));
        return $req[0]->password;
    }
    /**
     * renvoie le codepostal du user
    **/
    public function getUserCodePostal(){
        $req = $this->bdd->queryReturn("SELECT * FROM users WHERE id = ?", array($this->id));
        return $req[0]->codepostal;
    }
}

?>
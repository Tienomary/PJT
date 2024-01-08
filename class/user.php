<?php
namespace pjt;
class user{
    private $id;
    private $bdd;

    public function __construct($id, $bdd){
        $this->id = $id;
        $this->bdd = $bdd;
        $this->listOfEditableColumn = ['firstname', 'lastname', 'email', 'password', 'department', 'phonenumber'];
    }
    /**
     * update l'info du user
     */
    public function updateUserInformation($column, $value){
        if(in_array($column, $this->listOfEditableColumn)){
            $req = $this->bdd->queryExec("UPDATE users SET $column = ? WHERE id = ?", array($value,$this->id));
            if($req){
                return true;
            }else{
                return false;
            }
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
    public function getUserPassword(){
        $req = $this->bdd->queryReturn("SELECT * FROM users WHERE id = ?", array($this->id));
        return $req[0]->password;
    }
}

?>
<?php
namespace pjt;
use \PDO;

class database{
    
    private $db_name;
    private $db_user;
    private $db_host;
    private $db_pass;
    private $pdo;

    public function __construct($db_name,$db_user, $db_pass, $db_host){
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_host = $db_host;
        $this->db_pass = $db_pass;
    }

    private function getPDO(){
        if($this->pdo == null){
            $pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host.'', $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo=$pdo;
        }
        return $this->pdo;
    }
    /**
     * fetch la requete sql et renvoie un tableau
     */
    public function queryReturn($statement, $info=array()){
        $req = $this->getPDO()->prepare($statement);
        $req->execute($info);
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return($data);
    }
    /**
     * exe la requête sql donnée 
     */
    public function queryExec($statement, $info=array()){
        $req = $this->getPDO()->prepare($statement);
        $req->execute($info);
        return (True);
    }
    /**
     * renvoie le nombre de lignes trouvés dans la table 
     */
    public function queryCount($statement, $info=array()){
        $req = $this->getPDO()->prepare($statement);
        $req->execute($info);
        return count($req->fetchAll(PDO::FETCH_OBJ));
    }

}
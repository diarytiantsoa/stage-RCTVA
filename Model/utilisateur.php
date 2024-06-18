<?php
require_once("DbManager.php");

class Utilisateur extends RctvaMan {
    private $NIF;
    private $email;
    private $mdp;

    //Methodes Set
    public function setNIF($string){
        $this->NIF = $string;
    }
    public function setemail($string){
        $this->email = $string;
    }
    public function setMdp($string){
        $this->mdp = $string;
    }
  
    public function getNIF() {
        return $this->NIF;
    }

    public function getemail() {
        return $this->email;
    }

    public function getMdp() {
        return $this->mdp;
    }
    public function ajout_Utilisateur(){
        return $this->setUtilisateur($this->getNIF(),$this->getemail(), $this->getMdp());
    }

}
?>

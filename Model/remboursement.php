<?php
require_once("DbManager.php");

class remboursement extends RctvaMan {
    private $numDemande;
    private $NIF;
    private $Montant;
    private $Delai;

    //Methodes Set
    public function setNum($string){
        $this->numDemande = $string;
    }
    public function setNIF($string){
        $this->NIF = $string;
    }
    public function setMontant($int){
        $this->Montant = $int;
    }
    public function setDate($date){
        $this->Date = $date;
    }
    public function setDelai($date){
        $this->Delai = $date;
    }

    //Methodes Get
    public function getNum(){
        return $this->numDemande;
    }
    public function getNIF(){
        return $this->NIF;
    }
    public function getMontant(){
        return $this->Montant;
    }
    public function getDate(){
        return $this->Date;
    }
    public function getDelai(){
        return $this->Delai;
    }
    
    
    public function insertionDemande(){
        return $this->setDemande($this->getNum(),$this->getNIF(),$this->getMontant(),$this->getDate(),$this->getDelai());
    }

 
}
?>

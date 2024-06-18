<?php
require_once("DbManager.php");

class pieces extends RctvaMan {

    private $NIF;
    private $facture;
    private $annexe;
    private $teleDec;
   
    // Méthodes Set
    public function setNIF($NIF){
        $this->NIF = $NIF;
    }

    public function setfac($facture){
        $this->facture = $facture;
    }

    public function setAnnexe($annexe){
        $this->annexe = $annexe;
    }
   
    public function setTeleDec($teleDec){
        $this->teleDec = $teleDec;
    }

    public function getNIF(){
        return $this->NIF;
    }
    public function getfact(){
        return $this->facture;
    }

    public function getAnnexe(){
        return $this->annexe;
    }

    public function getTeleDec(){
        return $this->teleDec;
    }    

    public function ajout_piece(){
        return $this->setpiece( $this->getAnnexe(),$this->getfact(), $this->getTeleDec(),$this->getNIF());
    }
    
}
?>



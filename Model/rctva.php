<?php
require_once("DbManager.php");

class Rctva extends RctvaMan {

    private $NIF;
    private $raison_sociale;
    private $CA_Taxable;
    private $credit;
    private $RIB;
    //Methodes Set
    public function setNIF($string){
        $this->NIF = $string;
    }
    public function setRaiS($string){
        $this->raison_sociale = $string;
    }
    public function setCA($int){
        $this->CA_Taxable = $int;
    }
    public function setCredit($int){
        $this->credit = $int;
    }

    public function setRIB($string){
        $this->RIB = $string;
    }

    //Methodes Get
    public function getNIF(){
        return $this->NIF;
    }
    public function getRaiS(){
        return $this->raison_sociale;
    }
    public function getCA(){
        return $this->CA_Taxable;
    }
    public function getCredit(){
        return $this->credit;
    }
    public function getRIB(){
        return $this->RIB;
    }
    
    
    public function insertion(){
        return $this->setContribuable($this->getNIF(),$this->getRaiS(),$this->getCA(),$this->getCredit(),$this->getRIB());
    }  
    public function LastIndex(){
        return $this->getLastIndexFromDatabase();
    }
}

?>

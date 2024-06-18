<?php
require_once("DbManager.php");

class facture extends RcTVAMan {

    private $NIF;
    private $NIFcon;
    private $raison_sociale;
    private $montantHT;
    private $TVA;
    private $dateFact;
   
    // Méthodes Set
    public function setNIF($NIF){
        $this->NIF = $NIF;
    }
    public function setNIFcon($NIFcon){
        $this->NIFcon = $NIFcon;
    }

    public function setraison_sociale($raison_sociale){
        $this->raison_sociale = $raison_sociale;
    }

    public function setMT($montantHT){
        $this->montantHT = $montantHT;
    }
   
    public function setTVA($TVA){
        $this->TVA = $TVA;
    }

    public function setDateFact($dateFact) {
        if (is_array($dateFact)) {
            $formattedDates = [];
            foreach ($dateFact as $date) {
                $formattedDate = date('Y-m-d', strtotime($date));
                $formattedDates[] = $formattedDate;
            }
            $formattedDate = implode(',', $formattedDates);
        } else {
            $formattedDate = date('Y-m-d', strtotime($dateFact));
        }
    
        if ($formattedDate !== '1970-01-01') {
            $this->dateFact = $formattedDate;
        } else {
            echo "Erreur de formatage";
        }
    }
        
    

    // Méthodes Get
    public function getNIF(){
        return $this->NIF;
    }

    public function getNIFcon(){
        return $this->NIFcon;
    }

    public function getraison_sociale(){
        return $this->raison_sociale;
    }

    public function getMT(){
        return $this->montantHT;
    }

    public function getTVA(){
        return $this->TVA;
    }


    public function getDateFact(){
        return $this->dateFact;
    }

    public function ajout_fact(){
        return $this->setfacture($this->getNIF(),$this->getNIFcon(), $this->getraison_sociale(), $this->getMT(), $this->getTVA(),$this->getDateFact());
    }
    
}
?>

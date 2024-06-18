<?php
require_once("../Model/rctva.php");
require_once("../Model/remboursement.php");
require_once("../Model/DbManager.php");

class Home{
    private $remboursement;
    private $rctva;
    private $rctvaMan;

    public function __construct() {
        $this->remboursement= new remboursement();
        $this->rctva = new Rctva();
        $this->rctvaMan = new RctvaMan();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['NIF'])&& isset($_POST['raison_sociale'])&& isset($_POST['CA_Taxable'])&& isset($_POST['credit'])) {
            $this->insertion(); 
            $lastIndex=$this->rctva->LastIndex();   
            $index=$this->genererNumeroDemande($lastIndex);
            $this->insertionDemande($index);
            $nif = urlencode($this->rctva->getNIF());
            $numDemande = urlencode($index);
            header("Location: facture.php?nif=$nif&index=$index");
            
    
        }
         else {
            // 
        }
    }           
    
    private function genererNumeroDemande($index) 
    {
        $index++;
        $indexFormatte = sprintf("%02d", $index);  
        return "D-" . $indexFormatte;
      
    }

    private function insertion() {
        $this->rctva->setNIF($_POST['NIF']);
        $this->rctva->setRais($_POST['raison_sociale']);
        $this->rctva->setCA($_POST['CA_Taxable']);
        $this->rctva->setCredit($_POST['credit']);
        $this->rctva->setRIB($_POST['RIB']);
        $result = $this->rctva->insertion();

        if ($result >= 1) {
            echo '<script>
            document.querySelector(".modal-body").innerHTML = " Votre formulaire a été soumis";
            $("#myModal").modal("show");
                </script>';

        } else {
            echo "<script>alert('Erro ao gravar registro!, verifique se o livro não está duplicado');history.back()</script>";
        }
    }
    private function insertionDemande($index) {
        $dateActuelle = new DateTime();
        $date = $dateActuelle->format('Y-m-d');
        $this->remboursement->setNIF($_POST['NIF']);
        $this->remboursement->setNum($index);
        $this->remboursement->setMontant($_POST['credit']);
        $this->remboursement->setDate($date);        
        $this->remboursement->setDelai($_POST['delai']);
        $result = $this->remboursement->insertionDemande();

        if ($result >= 1) {
            echo '<script>
            document.querySelector(".modal-body").innerHTML = " Votre formulaire a été soumis";
            $("#myModal").modal("show");
                </script>';

        } else {
            echo "<script>alert('Erro ao gravar registro!, verifique se o livro não está duplicado');history.back()</script>";
        }
    }

}

new Home();
?>

<?php
require_once("../Model/facture.php");
require_once("../Model/DbManager.php");

class Home{
    private $rctvaMan;
    private $facture;

    public function __construct() {
        $this->rctvaMan = new RctvaMan();
        $this->facture = new facture();
        
        $nif = isset($_GET['nif']) ? urldecode($_GET['nif']) : '';
        $numDemande = isset($_GET['index']) ? urldecode($_GET['index']) : '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nbrFact']) ) {
            
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nbrFact= isset($_POST['nbrFact']);
        
            $this->ajout_fact($nif);
            header("Location:piece_jointe.php?nif=$nif&index=$numDemande&nbrFact=$nbrFact");

        }
    }

    private function ajout_fact($nif) {
       
    $dateFact = $_POST['dateFact']; 
        $this->facture->setNIF($_POST['NIF']);
        $this->facture->setNIFcon($nif);
        $this->facture->setraison_sociale($_POST['raison_sociale']);
        $this->facture->setMT($_POST['montantHT']);
        $this->facture->setTVA($_POST['TVA']);
        $this->facture->setDateFact($dateFact);
        $result = $this->facture->ajout_fact();
        
    
        if ($result >= 1) {
            echo '<script>
            document.querySelector(".modal-body").innerHTML = "Votre formulaire a été soumis";
            $("#myModal").modal("show");
                </script>';
                
        } else {
            // Gérer le cas où l'ajout de la facture a échoué
        }
    }
    
    private function deletarLivro($id) {
        if ($this->banco->deleteLivro($id) == true) {
            echo "<script>alert('Registro deletado com sucesso!');document.location='../view/index.php'</script>";
        } else {
            echo "<script>alert('Erro ao deletar registro!');history.back()</script>";
        }
    }
}

new Home();
?>

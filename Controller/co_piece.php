<?php
require_once("../Model/pieces_jointes.php");
require_once("../Model/DbManager.php");

class Home{
    private $piece;
    private $rctvaMan;

    public function __construct() {
        $this->piece = new pieces();
        $this->rctvaMan = new rctvaMan();
       
        $nbrFact = isset($_GET['nbrFact']) ? urldecode($_GET['nbrFact']) : '';
        $nif = isset($_GET['nif']) ? urldecode($_GET['nif']) : '';
        $numDemande = isset($_GET['index']) ? urldecode($_GET['index']) : '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ajout_piece($nif);
            
            header("Location:previsualisation.php?nif=$nif&index=$numDemande");
        }else {
            // Gérer d'autres actions, par exemple, afficher la liste des livres
        }
    }

    private function ajout_piece($nif) {       
            
            $annexe=$_FILES['annexe']['name'];
            $annexe_type=$_FILES['annexe']['type'];
            $annexe_size=$_FILES['annexe']['size'];
            $annexe_tem_loc=$_FILES['annexe']['tmp_name'];
            $annexe_store="../annexe/".$annexe;

            $facture=$_FILES['facture']['name'];
            $facture_type=$_FILES['facture']['type'];
            $facture_size=$_FILES['facture']['size'];
            $facture_tem_loc=$_FILES['facture']['tmp_name'];
            $facture_store="../facture/".$facture;


            $teleDec=$_FILES['teleDec']['name'];
            $teleDec_type=$_FILES['teleDec']['type'];
            $teleDec_size=$_FILES['teleDec']['size'];
            $teleDec_tem_loc=$_FILES['teleDec']['tmp_name'];
            $teleDec_store="../teledeclaration/".$teleDec;
            
            move_uploaded_file($annexe_tem_loc,$annexe_store);
            move_uploaded_file($facture_tem_loc,$facture_store);
            move_uploaded_file($teleDec_tem_loc,$teleDec_store);
            

            $this->piece->setAnnexe($annexe);
            $this->piece->setfac($facture);
            $this->piece->setTeleDec($teleDec);
            $this->piece->setNIF($nif);
            $result = $this->piece->ajout_piece();
            
        
        if ($result >= 1) {
            echo '<script>
            document.querySelector(".modal-body").innerHTML = "Votre formulaire a été soumis";
            $("#myModal").modal("show");
                </script>';
                 
        } else { 
            echo '<script>
            alert"Erreur";
                </script>';
           
               }
    }
    
    
    
}

new Home();
?>

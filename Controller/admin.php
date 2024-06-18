<?php
require_once('../config.php');
require_once('../Model/DbManager.php');

class Admin {
    private $lister;

    public function __construct() {
        $this->lister = new RctvaMan();
      
        $nifToDisplay = htmlspecialchars($_GET['NIF']);
        $numDemande = htmlspecialchars($_GET['numDemande']);
        $this->afficherDemande($nifToDisplay);
        echo "<hr>"; 
        $this->afficherPiece($nifToDisplay);
        echo "<hr>"; 
        $this->afficherFacture($nifToDisplay);   
        if (isset($_POST['accorder']) || isset($_POST['refuser'])) {
            $action = isset($_POST['accorder']) ? 'accorder' : 'refuser';
            $this->envoyerEmail($action,$nifToDisplay,$numDemande);
        }
    }
    

    private function afficherDemande($nifToDisplay) {
        $contribuables = $this->lister->getContribuableByNIF($nifToDisplay);
        $roww = $this->lister->getDemande($nifToDisplay);

        if ($contribuables) {
            foreach ($roww as $val) {
                echo "
                <div class='row'>
                    <div class='col-md-6'>
                        <label for='delai'  class='form-label'>Délai de remboursement demandé:</label>
                        <input type='text' name='delai' value='" . $val['delai'] . "' class='form-control' disabled>
                    </div>
                    <div class='col-md-6'>
                        <label for='NIF' class='form-label' disabled>Numéro de la demande déposée</label>
                        <input type='text' name='NIF' value='" . $val['numDemande'] . "' class='form-control' disabled>
                    </div>
                </div>";
                break;
            }
    
            foreach ($contribuables as $value) {        
                echo "
                <div class='row'>
                    <div class='col-md-6'>
                        <label for='NIF' class='form-label' disabled>NIF (Numéro d'Identité Fiscal)</label>
                        <input type='text' name='NIF' value='" . $value['NIF'] . "' class='form-control' disabled>
                    </div>
                    <div class='col-md-6'>
                        <label for='raisonSociale'  class='form-label'>Raison sociale</label>
                        <input type='text' name='raison_sociale' value='" . $value['raison_sociale'] . "' class='form-control' disabled>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='col-md-6'>
                        <label for='CA' class='form-label' >Chiffre d'affaires Taxable</label>
                        <div class='input-group mb-2'>
                            <span class='input-group-text'>Ariary</span>
                            <input type='text' name='CA_Taxable' value='" . $value['CA_Taxable'] . "' class='form-control' aria-label='Amount (to the nearest dollar)' disabled>
                            <span class='input-group-text'>.00</span>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <label for='credit' class='form-label'>Montant demandé en remboursement</label>
                        <div class='input-group mb-2'>
                            <span class='input-group-text'>Ariary</span>
                            <input name='credit' type='text' value='" . $value['credit'] . "' class='form-control' aria-label='Amount (to the nearest dollar)' disabled>
                            <span class='input-group-text'>.00</span>
                        </div>
                    </div>
                </div>";
            }
                        
            echo "</tbody></table>";
        } else {
            echo "Aucun contribuable trouvé pour le NIF sélectionné.";
        }
    }

    private function afficherPiece($nifToDisplay) {
        $pieces = $this->lister->getPiece($nifToDisplay);
        if ($pieces) {
            echo "
            <div class='col-12'>
                <h1>Liste des pièces justificatives</h1>
            </div>
            <table class='table'>  
                <thead class='table-dark'>      
                    <tr>
                        <th scope='col' style='width: 20%;'>Facture</th>
                        <th scope='col' style='width: 20%;'>Action</th>
                        <th scope='col' style='width: 20%;'>Annexe</th>
                        <th scope='col' style='width: 20%;'>Action</th>
                        <th scope='col' style='width: 20%;'>Télédeclaration</th>
                        <th scope='col' style='width: 20%;'>Action</th>
                    </tr>
                </thead>
                <tbody id='tableBody'>";

                foreach($pieces as $value){
                    $roww = $this->lister->getPiece($value['NIF']);
                    foreach($roww as $val)
                    $facture_path = "../facture/" . $val['facture'];
                
                    $teleDec_path = "../teledeclaration/" . $val['teledeclaration'];
                    $annexe_path = "../annexe/" . $val['annexe'];
                   
                    echo"<td>" . $val['facture'] ;
                    echo"<td>" . " <a href='" . $facture_path . "' class='' download><img src='../Assets/telecharger.png' width='40px;'></button></td>";
                    echo"<td>" . $val['teledeclaration'] ;
                    echo"<td>" . " <a href='" . $teleDec_path . "' class=''> <img src='../Assets/telecharger.png' width='40px;'></button></td>";
                    echo"<td>" . $val['annexe'] ; 
                    echo"<td>" . "<a href='" . $annexe_path . "' class=''> <img src='../Assets/telecharger.png' width='40px;'></button></td>";      
                               
                    echo"</tr>";
                
                }
            echo "</tbody></table>";
        } else {
            echo "Aucune pièce trouvée pour le NIF sélectionné.";
        }
    }
    public function afficherFacture($nifToDisplay){
        $facture = $this->lister->getFacture($nifToDisplay);
        
        echo "
            <div class='col-12'>
                <h1>Liste des factures</h1>
            </div>
            <table class='table'>  
                <thead class='table-dark'>      
                    <tr>
                        <th scope='col' style='width: 20%;'>NIF Fournisseur</th>
                        <th scope='col' style='width: 20%;'>Raison sociale</th>
                        <th scope='col' style='width: 20%;'>Date</th>
                        <th scope='col' style='width: 20%;'>Montant Hors Taxe</th>
                        <th scope='col' style='width: 20%;'>TVA</th>
                        
                    </tr>
                </thead>
                <tbody id='tableBody'>";

                foreach($facture as $facture){

                    echo"<td>" . $facture['NIF'] ;
                    echo"<td>" . $facture['raison_sociale'] ;
                    echo"<td>" . $facture['montantHT'] ;
                    echo"<td>" .  $facture['TVA'];      
                    echo"<td>". $facture['dateFact'];    
                    echo"</tr>";
                
                }
            echo "</tbody></table>";
            echo "
            <div class='row'>
                <div class='col-md-6'>
                    <form method='post'>
                        <input type='hidden' name='accorder' value='accorder'>
                        <button type='submit' class='btn btn-success' id='accorderBtn'>Accorder</button>
                    </form>
                </div>
                <div class='col-md-6'>
                    <form method='post'>
                        <input type='hidden' name='refuser' value='refuser'>
                        <button type='submit' class='btn btn-danger' id='refuserBtn'>Refuser</button>
                    </form>
                </div>
            </div>";
 
    }

    public function envoyerEmail($action,$nifToDisplay,$numDemande){
        
do {
    
    if ($action === 'accorder') {   
    $email = $this->lister->getMail($nifToDisplay); 
    $to=$email['email'];
    echo $to;
    $subject = "Réponse à votre demande de remboursement de crédit TVA au sein de la DGI.";
    

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: andrianalyfanny@gmail.com\r\n";  
    $message ="Madame,Monsieur,";
    $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message .= "Félicitation! Votre demande de remboursement de crédit TVA a été acceptée. Un virement sera effectué sur votre compte ultérieurement";
    
    
    if (mail($to, $subject, $message, $headers)) {
        echo"<script> window.location.href = '../View/listeDemande.php'; </script>";
        $this->lister->changeaccord($numDemande);         
        break;
        
    } else {
        echo 'Erreur envoi';
    }
    exit(0);
    }else if ($action === 'refuser') {

            $email = $this->lister->getMail($nifToDisplay); 
            $to=$email['email'];
            $subject = "Réponse à votre demande de remboursement de crédit TVA au sein de la DGI.";
            
        
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "From: andrianalyfanny@gmail.com\r\n";  
            $message ="Madame,Monsieur,";
            // Ajout du texte du message
            $message .= "Désolé! Votre demande de remboursement de crédit TVA a été refusée.";
            
           
            if (mail($to, $subject, $message, $headers)) {
                echo"<script> window.location.href = '../View/listeDemande.php'; </script>";
                $this->lister->changeaccordRefus($numDemande);         
            break;
                    
            } else {
                echo 'Erreur envoi';
            }
            exit(0);
    }
} while (true);
}
} 
?>

<?php
require_once("../config.php");

require_once('../Model/DbManager.php');
class previsualisation{

    private $lister;

    public function __construct(){
        $this->lister = new RctvaMan();

        $nif = isset($_GET['nif']) ? $_GET['nif'] : null;
        $index = isset($_GET['index']) ? $_GET['index'] : null;

        $this->afficherDemande($nif,$index);
        $this->afficherPiece($nif);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])) {
            $this->Mail($nif,$index);
            echo"<script> window.location.href = '../View/home.php'; </script>";
        }
        else if(isset($_POST['annuler'])){
            $this->lister->deleteContribuable($nif);
            echo"<script> window.location.href = '../View/home.php';+ </script>";
        }

    }

    private function afficherDemande($nif,$index){
        $row = $this->lister->getContribuableByNIF($nif); 
        $roww = $this->lister->getDemande($nif);
        foreach ($roww as $val){
        echo"
        <div class='row'>
        <div class='col-md-6'>
            <label for='NIF' class='form-label' disabled>Numéro de la demande déposée </label>
            <input type='text' name='NIF' value='".$index."' class='form-control' disabled>
        </div>
        <div class='col-md-6'>
                <label for='delai'  class='form-label'>Délai de remboursement demandé: </label>
                <input type='text' name='delai'value='".$val['delai']."' class='form-control' disabled>
        </div>
        </div>";
        }
        foreach ($row as $value){ 
        
    
            echo "
            <div class='row'>
                <div class='col-md-6'>
                    <label for='NIF' class='form-label' disabled>NIF (Numéro d'Identité Fiscal)</label>
                    <input type='text' name='NIF' value='".$value['NIF']."' class='form-control' disabled>
                </div>
                <div class='col-md-6'>
                    <label for='raisonSociale'  class='form-label'>Raison sociale</label>
                    <input type='text'name='raison_sociale'value='".$value['raison_sociale']."' class='form-control' disabled>
                </div>
            </div>
            
            <div class='row'>
                <div class='col-md-6'>
                    <label for='CA' class='form-label' >Chiffre d'affaires Taxable</label>
                    <div class='input-group mb-3'>
                        <span class='input-group-text'>Ariary</span>
                        <input type='text' name='CA_Taxable' value='".$value['CA_Taxable']."'class='form-control' aria-label='Amount (to the nearest dollar)' disabled>
                        <span class='input-group-text'>.00</span>
                    </div>
                </div>
                <div class='col-md-6'>
                    <label for='credit' class='form-label'>Montant demandé en remboursement</label>
                    <div class='input-group mb-3'>
                        <span class='input-group-text'>Ariary</span>
                        <input name='credit' type='text' value='".$value['credit']."'class='form-control' aria-label='Amount (to the nearest dollar)' disabled>
                        <span class='input-group-text'>.00</span>
                    </div>
                </div>
            ";
            }
        }
    
    private function afficherPiece($nif){
        $row = $this->lister->getPiece($nif);
        foreach($row as $value){
            echo" 
            <br>
            <div class='col-12'>
                <h1>Liste des pieces justificatives</h1>
            </div>
            <br>
            <table class='table'>  
                <thead class='table-dark'>      
                    <tr>
                        <th scope='col' style='width: 35%;'>Facture</th>
                        <th scope='col' style='width: 35%;'>Annexe</th>
                        <th scope='col' style='width: 35%;'>teledeclaration</th>
                    </tr>
                </thead>
                <tbody id='tableBody'>
                    <form action='' method='post' enctype='multipart/form-data'>
                        <tr>";
            echo"<td>".$value['facture']."</td>";
            echo"<td>".$value['annexe']."</td>";
            echo"<td>".$value['teledeclaration']."</td>";
            echo"</tr>";
            echo"    </form>
                    </tbody>
                 </table>
            </div>
                  ";
        }
    }

    private function Mail($nif,$index){    

header('Content-Type: text/html; charset=utf-8');

require_once("../Assets/fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16); 
$imagePath = "../Assets/logo_mfbdgi (1).jpg";
$pdf->Image($imagePath, $pdf->GetPageWidth() - 40, 10, 20,25);

$pdf->SetFont('Arial', '', 12); 
$pdf->Cell(0, 8, "REPOBLIKAN'I MADAGASIKARA", 0, 1, 'C');
$pdf->Cell(0, 8, "Fitiavana-Tanindrazana-Fandrosoana", 0, 1, 'C');

$row = $this->lister->getContribuableByNIF($nif); 
foreach ($row as $value){ 
        
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 11, "Demande N-" . $index, 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(90, 10, "", 0, 1);
$pdf->Cell(90, 10, "", 0, 1);
$pdf->Cell(90, 10, "NIF:      " . $nif, 0, 1);
$pdf->Cell(90, 10, "Raison sociale:      " . $value['raison_sociale'], 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 10, utf8_decode("Montant du crédit demandé en remboursement:      ") . $value['credit']."   Ariary", 0, 1);

}
$roww = $this->lister->getDemande($nif);
        foreach ($roww as $val){

        $pdf->Cell(90, 10, utf8_decode("Délai de remboursement demandé:      ") . $val['delai'], 0, 1);
        }

$pdf->Cell(90, 10,utf8_decode( "Votre demande de remboursement de crédit TVA a bien été reçue."), 0, 1);
$pdf->Cell(90, 10,utf8_decode( "Nous vous communiquerons une réponse très prochainement"), 0, 1);

$filePath = "../" . "Recu_N-" . $index . ".pdf";
$pdf->Output($filePath, 'F');

$boundary = uniqid('np');

do {
    
    $email = $this->lister->getMail($nif); 
    $to=$email['email'];
    $subject = "Confirmation de dépôt de demande de remboursement.";
    

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: multipart/mixed; boundary=$boundary\r\n";
    $headers .= "From: andrianalyfanny@gmail.com\r\n";  
    $message ="Madame,Monsieur,";
    // Ajout du texte du message
    $message .= "\r\n--$boundary\r\n";
    $message .= "Content-Type: text/plain; charset=utf-8\r\n";
    $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message .= "Votre demande de remboursement de crédit TVA a bien été reçue. Nous vous communiquerons une réponse très prochainement.\r\n";
    $message .= "--$boundary\r\n";
    
    // Ajout de la pièce jointe 
    $message .= "Content-Type: application/pdf; name=\"" . basename($filePath) . "\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"" . basename($filePath) . "\"\r\n\r\n";
    $message .= chunk_split(base64_encode(file_get_contents($filePath)));
    $message .= "--$boundary--";
  
    if (mail($to, $subject, $message, $headers)) {
        
       // echo '<script>window.location.href = "../View/home.php";</script>';
        break;
        
    } else {
        echo 'Erreur envoi';
    }
    exit(0);

} while (true);

    }
}


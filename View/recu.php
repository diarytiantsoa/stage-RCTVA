<?php
$num = "D-03";
$NIF = "30001356";
$rs = "E/se A";
$credit = "25000";
$delai = "11/12/2023";

require_once("../Assets/fpdf/fpdf.php");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16); 
$imagePath = "../Assets/logo_mfbdgi (1).jpg";
$pdf->Image($imagePath, $pdf->GetPageWidth() - 40, 10, 20,25);

$pdf->SetFont('Arial', '', 12); 
$pdf->Cell(0, 8, "REPOBLIKAN'I MADAGASIKARA", 0, 1, 'C');
$pdf->Cell(0, 8, "Fitiavana-Tanindrazana-Fandrosoana", 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 11, "Demande N-" . $num, 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(90, 10, "", 0, 1);
$pdf->Cell(90, 10, "", 0, 1);
$pdf->Cell(90, 10, "NIF:      " . $NIF, 0, 1);
$pdf->Cell(90, 10, "Raison sociale:      " . $rs, 0, 1);
$pdf->Cell(90, 10, utf8_decode("Montant du crédit demandé en remboursement:      ") . $credit, 0, 1);
$pdf->Cell(90, 10, utf8_decode("Délai de remboursement demandé:      " ). $delai, 0, 1);
$pdf->Cell(90, 10, utf8_decode("Votre demande a bien été reçue. Nous vous communiquerons une réponse très prochainement"), 0, 1);

$filePath = "../" . "Recu_N-" . $num . ".pdf";
$pdf->Output($filePath, 'F');

$boundary = uniqid('np');

do {
    $to = "fannynomenjanahary2@gmail.com";
    $subject = utf8_decode("Confirmation de dépôt de demande de remboursement.");
    

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: multipart/mixed; boundary=$boundary\r\n";
    $headers .= "From: andrianalyfanny@gmail.com\r\n";  
    
    // Ajout du texte du message
    $message .= "\r\n--$boundary\r\n";
    $message .= "Content-Type: text/plain; charset=utf-8\r\n";
    $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $message .= utf8_decode("Votre demande a bien été reçue. Nous vous communiquerons une réponse très prochainement.\r\n");
    $message .= "--$boundary\r\n";
    
    // Ajout de la pièce jointe 
    $message .= "Content-Type: application/pdf; name=\"" . basename($filePath) . "\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; filename=\"" . basename($filePath) . "\"\r\n\r\n";
    $message .= chunk_split(base64_encode(file_get_contents($filePath)));
    $message .= "--$boundary--";

    if (mail($to, $subject, $message, $headers)) {
        echo 'Envoyé';
    } else {
        echo 'Erreur envoi';
    }
    exit(0);

} while (true);

?>

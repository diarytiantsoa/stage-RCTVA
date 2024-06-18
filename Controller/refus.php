<?php
require_once('../Model/DbManager.php');

class refus {
    private $lister;

    public function __construct() {
        $this->lister = new RctvaMan();
        $this->afficherDemande();
    }

    private function afficherDemande() {
        error_reporting(0);
        
        
        $remboursements = $this->lister->getR() ;
        $raisonSociale = $this->lister->getContribuable();
        echo "
        <table class='table'>  
            <thead class='table-dark'>      
                <tr>
                    <th scope='col'>Date de depôt de la demande</th>
                    <th scope='col'>Numero demande</th>
                    <th scope='col'>NIF</th>
                    <th scope='col'>Raison Sociale</th>
                    <th scope='col'>Credit demande</th>
                </tr>
            </thead>
            <tbody id='tableBody'>";

        foreach ($remboursements as $remboursement) {
            echo "<tr>";
             echo "<td>" . (isset($remboursement['date']) ? $remboursement['date'] : 'N/A') . "</td>";
            echo "<td>" . (isset($remboursement['numDemande']) ? $remboursement['numDemande'] : 'N/A') . "</td>";
            echo "<td>" . (isset($remboursement['NIF']) ? $remboursement['NIF'] : 'N/A') . "</td>";
            $rs = 'N/A';
            foreach ($raisonSociale as $contribuable) {
                if ($contribuable['NIF'] === $remboursement['NIF']) {
                    $rs = isset($contribuable['raison_sociale']) ? $contribuable['raison_sociale'] : 'N/A';
                    break; 
                }
            }

            echo "<td>" . $rs . "</td>";
            echo "<td>" . (isset($remboursement['Montant']) ? $remboursement['Montant'] : 'N/A') . "</td>";
            
     echo "</tr>";
        }

        echo "</tbody></table>";
    

}
}
?>

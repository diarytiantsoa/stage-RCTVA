<?php
require_once("../config.php");
class RctvaMan{

    protected $mysqli;

    public function __construct(){
        $this->connexion();
    }

    private function connexion(){
        $this->mysqli = new mysqli(BD_SERVEUR, BD_USER , BD_MDP, BD_TABLE);
    }

//USER
    public function setUtilisateur($NIF,$email,$mdp){
        $stmt = $this->mysqli->prepare("INSERT INTO utilisateur (`NIF`, `email`, `mdp`) VALUES (?,?,?)");
        $stmt->bind_param("sss",$NIF,$email,$mdp);
         if( $stmt->execute() == TRUE){
            return true ;
        }else{
            return false;
        }

    }

    public function getUserByUsername($NIF) {
        $stmt = $this->mysqli->prepare("SELECT NIF,email,mdp FROM utilisateur WHERE NIF=? ");
        $stmt->bind_param("s",$NIF);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user;
    } 

    public function getMail($NIF) {
        $stmt = $this->mysqli->prepare("SELECT email FROM utilisateur WHERE NIF=? ");
        $stmt->bind_param("s",$NIF);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user;
    } 

//ADMIN

public function getAdmin($num_mat) {
    $stmt = $this->mysqli->prepare("SELECT mdp FROM admin WHERE num_mat=? ");
    $stmt->bind_param("s",$num_mat);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user;
} 


//CONTRIBUABLE
    
    public function setContribuable($NIF,$raison_sociale,$CA_Taxable,$credit,$RIB){
        $stmt = $this->mysqli->prepare("INSERT INTO contribuable (`NIF`, `raison_sociale`, `CA_Taxable`, `credit`, `RIB`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssiis",$NIF,$raison_sociale,$CA_Taxable,$credit,$RIB);
         if( $stmt->execute() == TRUE){
            return true ;
        }else{
            return false;
        }

    }

    public function getContribuableByNIF($nif){
        $result = $this->mysqli->query("SELECT * FROM contribuable where NIF='$nif'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }
    public function getContribuable(){
        $result = $this->mysqli->query("SELECT NIF,raison_sociale,credit FROM contribuable ");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }

    public function deleteContribuable($NIF){
        $stmt = $this->mysqli->prepare("DELETE FROM `contribuable` WHERE `nif` = ?");
        $stmt->bind_param("s", $NIF);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    //DEMANDE
    public function setDemande($numDemande,$NIF,$Montant,$date,$delai){
        $stmt = $this->mysqli->prepare("INSERT INTO remboursement (`date`,`numDemande`, `Montant`, `NIF`, `delai`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssiss",$date,$numDemande,$Montant,$NIF,$delai);
         if( $stmt->execute() == TRUE){
            return true ;
        }else{
            return false;
        }

    }

    public function getDemande($nif){
        $result = $this->mysqli->query("SELECT * FROM remboursement where NIF='$nif'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }
    //DEMANDE ACCORDEE
    public function changeaccord($numDemande) {
        if ($numDemande !== null) {
            
            $accord="vrai";
            $stmt = $this->mysqli->prepare("UPDATE remboursement SET accord = ? WHERE numDemande = ?");
            
            if ($stmt) {
                $stmt->bind_param('si',$accord,$numDemande);
                $stmt->execute();
                
                header("Location: View/accorder.php");
                exit();
            } else {
                echo "Erreur lors de la préparation de la requête : " . $this->mysqli->error;
            }
        }
    }
    public function changeaccordRefus($numDemande) {
        if ($numDemande !== null) {
            
            $accord="faux";
            $stmt = $this->mysqli->prepare("UPDATE remboursement SET accord = ? WHERE numDemande = ?");
            
            if ($stmt) {
                $stmt->bind_param('si',$accord,$numDemande);
                $stmt->execute();
                
                header("Location: View/accorder.php");
                exit();
            } else {
                echo "Erreur lors de la préparation de la requête : " . $this->mysqli->error;
            }
        }
    }
   
    
    public function getRemboursement(){
        $accord= "encours";
        $result = $this->mysqli->query("SELECT * FROM remboursement where accord='$accord'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    } 
    public function getA(){
        $accord= "vrai";
        $result = $this->mysqli->query("SELECT * FROM remboursement where accord='$accord'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }
    public function getR(){
        $accord= "faux";
        $result = $this->mysqli->query("SELECT * FROM remboursement where accord='$accord'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }



    public function getLastIndexFromDatabase() { 
        $result = $this->mysqli->query("SELECT MAX(SUBSTRING_INDEX(numDemande, '-', -1)) AS maxIndex FROM remboursement");
        $index;
        while ($row = mysqli_fetch_assoc($result)) {
            $indexCurrent = $row['maxIndex'];
        }
        $index= $indexCurrent;
        echo "$index";
    
        return $index;
       
    }


    //FACTURE
    public function setfacture($NIF, $NIFcon, $raison_sociale, $montantHT, $TVA, $dateFact) {
    
    $count = count($NIF);
    $datesArray = explode(',', $dateFact);
    $stmt = $this->mysqli->prepare("INSERT INTO facture (`NIF`,`NIFcon`, `raison_sociale`, `montantHT`, `TVA`, `dateFact`) VALUES (?, ?, ?, ?, ?, ?)");

    for ($i = 0; $i < $count; $i++) {
        
        $currentNIF = isset($NIF[$i]) ? $NIF[$i] : null;
        $currentRS = isset($raison_sociale[$i]) ? $raison_sociale[$i] : null;
        $currentHT = isset($montantHT[$i]) ? $montantHT[$i] : null;
        $currentTVA = isset($TVA[$i]) ? $TVA[$i] : null;
        $date = isset($datesArray[$i]) ? trim($datesArray[$i]) : null;
        
        if ($stmt) {
            $stmt->bind_param("sssiis", $currentNIF, $NIFcon, $currentRS, $currentHT, $currentTVA, $date);
            $stmt->execute();
        } else {
            echo "Erreur de préparation de la requête";
        }
    }

    $stmt->close();

    return true;
}

public function getFacture($NIF){
    $array = array();
    $stmt = $this->mysqli->prepare("SELECT * FROM facture WHERE NIFcon = ?");
    $stmt->bind_param("s", $NIF);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $array[] = $row;
    }

    $stmt->close();
    return $array;
}



    
//PIECE_JOINTE


    public function setpiece( $annexe, $facture, $teleDec,$NIF){
        $stmt = $this->mysqli->prepare("INSERT INTO pieces_jointes (`annexe`, `facture`, `teledeclaration`, `NIF`) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $annexe, $facture, $teleDec,$NIF);

        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }


    public function getPiece($nif){
        $result = $this->mysqli->query("SELECT * FROM pieces_jointes where NIF='$nif'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }
    public function getPieces($nif){
        $result = $this->mysqli->query("SELECT facture,annexe,teledeclaration FROM pieces_jointes where NIF='$nif'");
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $array[] = $row;
        }
        return $array;

    }
    
}
?>

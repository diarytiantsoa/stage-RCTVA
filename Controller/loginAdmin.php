<?php
include_once '../Model/DbManager.php';
include_once '../Model/utilisateur.php';
?>

<?php
class adminController {
    private $dbManager;
    private $utilisateur;

    public function __construct() {   
 
        $this->dbManager = new RctvaMan();
   
    }
 
   
 
    public function loginAdmin($NIF) {
      $admin = $this->dbManager->getAdmin($NIF);

      if(!$admin){
        echo "<div id='myModal1' class='modal'>
        <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title'>Direction Générale des Impôts</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <p>Votre Numéro matricule est incorrecte !</p>
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            </div>
          </div>
        </div>
      </div>";

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal1 = new bootstrap.Modal(document.getElementById('myModal1'));
                myModal1.show();
                setTimeout(function() {
                    myModal1.hide();
                }, 10000);
            });
        </script>";

      }
      else{
          header('Location:../View/ListeDemande.php');       
      }


    }
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

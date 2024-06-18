<?php
include_once '../Model/DbManager.php';
include_once '../Model/utilisateur.php';
?>

<?php
class UtilisateurController {
    private $dbManager;
    private $utilisateur;

    public function __construct() {   
        $this->utilisateur= new Utilisateur(); 
        $this->dbManager = new RctvaMan();
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['NIFSign'])&& isset($_POST['emailSign'])&& isset($_POST['mdpSign'])) {
         if ($this->insertion() ){
           echo "<div id='myModal1' class='modal'>
          <div class='modal-dialog modal-dialog-centered'>
          <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title'>Direction Générale des Impôts</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body'>
                <p>Votre compte e-remboursement a été créé avec succes!</p>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'><script>:window.location.href = '../View/login.php</script>Close</button>
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
                      ';
                      ;
                  }, 5000);
              });
          </script>";
  }
        }
       else {
  
      }
  
    }
 
    private function insertion() {
      $this->utilisateur->setNIF($_POST['NIFSign']);
      $this->utilisateur->setemail($_POST['emailSign']);
      $this->utilisateur->setMdp($_POST['mdpSign']);
      $result = $this->utilisateur->ajout_Utilisateur();

      if ($result >= 1) {
        echo "<div id='myModal1' class='modal'>
        <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title'>Direction Générale des Impôts</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <p>Votre compte e-remboursement a été créé avec succes!</p>
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
                    window.location.href = '../View/login.php';
           
                }, 5000);
            });
            
        </script>";

      } else {
          echo "<script>alert('Erro ao gravar registro!, verifique se o livro não está duplicado');history.back()</script>";
      }
  }
 
    public function login($NIF, $mdp,$email) {
      $user = $this->dbManager->getUserByUsername($NIF);

      if(!$user){
        echo "<div id='myModal1' class='modal'>
        <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title'>Direction Générale des Impôts</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <p>Votre NIF est incorrect !</p>
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
      else if($email != $user['email']){
        echo "<div id='myModal' class='modal'>
          <div class='modal-dialog modal-dialog-centered'>
          <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title'>Direction Générale des Impôts</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body'>
                <p>Votre email est incorrect !</p>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
              </div>
            </div>
          </div>
        </div>";

          echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                  myModal.show();
                  setTimeout(function() {
                      myModal.hide();
                  }, 10000);
              });
          </script>";

      }
      else{
        if($mdp == $user['mdp']){
          header('Location:../View/home.php');
        }else {
          echo "<div id='myModal' class='modal'>
          <div class='modal-dialog modal-dialog-centered'>
          <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title'>Direction Générale des Impôts</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body'>
                <p>Votre mot de passe est incorrect !</p>
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
              </div>
            </div>
          </div>
        </div>";

          echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                  myModal.show();
                  setTimeout(function() {
                      myModal.hide();
                  }, 10000);
              });
          </script>";

        }
      }


    }
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

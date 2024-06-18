<?php
include_once("header.php");
include_once("menu/menu5.php");

?>

<div class="main">
<?php  
require_once("../Controller/previsualisation.php");
?>
    <br><br>
    <h1>Recapitulatif de votre demande de remboursement de TVA</h1>
    <p class="lead">Année: 2023 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Période: <?php echo "Septembre" ?></p>
    <br>
    
    <?php new previsualisation();    ?>
   
<form action="" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Direction Générale des Impôts</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Votre demande  de remboursement de crédit de TVA a bien été soumise.
        Vous allez recevoir un mail de confirmation
      </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
    </div>

  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Direction Générale des Impôts</h1>
        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous annuler votre demande de remboursement de crédit TVA?
      </div>
     <div class="modal-footer">
     <div class="modal-footer">
  <button type="submit" name="annuler" class="btn btn-secondary" data-bs-dismiss="modal" >Oui</button>
  <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Non</button>
</div>

    </div>
  </div>
</div>
    </div>

       <div class="center"> 
       <button type="submit"  name="valider" data-bs-toggle="modal" data-bs-target="#exampleModal" id="validerDemande"  class="btn btn-success">
        Valider la demande</button>
        </form>
       <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1" id="validerDemande">Annuler la demande</button>    
      </div>

    </form>
</div>
<?php
include_once("footer.php");
?>
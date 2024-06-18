<?php 
    include_once("header.php");
    include_once("menu/menu2.php");
    
?>

        
<div class="main">
<?php  
require_once("../Controller/home.php");
?>
<form action="" method="post">
    <h1>Formulaire de demande de remboursement de credit de TVA</h1>
    <p class="lead">Année: 2023 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Période: <?php echo "Septembre" ?></p>
    <div class="col-md-6">
        <?php
            $dateActuelle = new DateTime();
            $dateFormatMySQL = $dateActuelle->format('Y-m-d');
        ?>
        <script>
        function verifierLongueurNIF() {
            var nifValue = document.getElementById('NIF').value;

            if (nifValue.length < 10) {
                document.getElementById('messageErreurNIF').innerHTML = 'Le NIF doit contenir au moins 10 caractères.';
            } else {
                document.getElementById('messageErreurNIF').innerHTML = '';
            }
        }
    </script>
            <label for="delai"  class="form-label">Date de dépôt de la demande:     <b><?php echo"$dateFormatMySQL"; ?></b></label>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="NIF" class="form-label"> Votre NIF (Numéro d'Identité Fiscal)</label>
            <input type="text" name="NIF" style="" class="form-control" id="NIF" oninput="verifierLongueurNIF()" required>
            <span id="messageErreurNIF" style="color: red;"></span>
        </div>
        <div class="col-md-6">
            <label for="raisonSociale"  class="form-label"> Votre Raison sociale</label>
            <input type="text"name="raison_sociale" class="form-control"  required>
        </div>
    </div>
            
    <div class="row">
        <div class="col-md-6">
            <label for="CA" class="form-label" >Chiffre d'affaires Taxable</label>
            <div class="input-group mb-3">
                <span class="input-group-text">Ariary</span>
                <input type="text" name="CA_Taxable" class="form-control" aria-label="Amount (to the nearest dollar)"  required>
                <span class="input-group-text">.00</span>
            </div>
        </div>
        <div class="col-md-6">
            <script>
        function verifierMT() {
            var credit = document.getElementById('credit').value;
         
            if (credit< 20000000) {
                document.getElementById('MT').innerHTML = ':Le montant ne doit pas etre moins de 20.000.000 Ariary';
            } else {
                document.getElementById('MT').innerHTML = '';
            }
        }
    </script>
        
            <label for="credit" class="form-label">Montant demandé en remboursement<span id="MT" style="color:red;font-size:12px;"></span></label>
            <div class="input-group mb-3">
                <span class="input-group-text">Ariary</span>
                <input id="credit" name="credit" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" oninput="verifierMT()" required>
                <span class="input-group-text">.00</span>
            </div>
        </div>
    </div>
    
    <div class="row">
    <div class="col-md-6">
            <label for="delai"  class="form-label">Votre RIB (Relevé d'Identité Bancaire): </label>
            <input type="text" name="RIB" class="form-control" id="inputAddress"  required>
        </div>
    <div class="col-md-6">
    
  

<label for="delai" class="form-label">Délai de remboursement demandé: <span style="color:#6F6F6F;font-size:12px;">Le délai ne doit pas être moins de 60 jours</span></label>
    <input type="date" name="delai" class="form-control" id="inputAddress" required>
    
    <script>
        document.getElementById('inputAddress').addEventListener('change', function() {
            var selectedDate = new Date(this.value);
            var today = new Date();
            var timeDiff = selectedDate - today;
            var daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));

            if (daysDiff < 60) {
                alert("Le délai ne doit pas être moins de 60 jours.");
            }
        });
    </script>
      </div>
</div>
    <br>
    <div class="col-12">
  
      
    
  
  <button type="submit"  class="btn btn-primary" >Envoyer</button>
    </div>
    </form>
</div>
<?php
include_once("footer.php");
?>
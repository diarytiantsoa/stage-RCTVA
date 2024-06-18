<?php 
include_once("header.php");
include_once("menu/menu3.php");
require_once("../Controller/facture.php");
?>

<div class="main">    
    <h1>Facture </h1>
    <p class="lead">Année: 2023 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Période: <?php echo "Septembre"; ?></p>  
    <p class="fs-5">Entrez le nombre de facture a declarer</p>
       <div class="input">
        <form action="" method="post">
            <div class="input-group mb-3">
                    <input type="text"  name="nbrFact" style="width:50%" class="form-control" placeholder="Exemple: 3" aria-label="Recipient's username" aria-describedby="button-addon2" enable>
                    <button class="btn btn-outline-secondary" type="submit" id="btnFact">Valider</button>
                    <span id="text"></span>
            </div>
        </form>
        </div>
        <br>
            <table class="table" id="factureTable">  
                <thead class="table-dark">      
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 20%;">NIF des fournisseurs</th>
                        <th scope="col" style="width: 20%;">Raison Sociale</th>
                        <th scope="col" style="width: 20%;">Montant Hors Taxe</th>
                        <th scope="col" style="width: 20%;">Montant TVA</th>
                        <th scope="col" style="width: 20%;">Date</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                <form action="" method="post">
                <script>
                    function calculerTVA(index) {
                        var montantHT = document.getElementById('montantHT_' + index).value;
                        var tva = (montantHT * 0.2).toFixed(2);

                        document.getElementById('TVA_' + index).value = tva;
                    } 

                function verifierLongueurNIF(index) {
                    var nifValue = document.getElementById('NIF_' + index).value;
                    if (nifValue.length < 10) {
                        document.getElementById('messageErreurNIF_' + index).innerHTML = 'Le NIF doit contenir au moins 10 caractères.';
                    } else {
                        document.getElementById('messageErreurNIF_' + index).innerHTML = '';
                    }
                }
                </script>
     
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nbrFact']) ) {

                        $inputValue = $_POST['nbrFact'];
                        for ($i = 1; $i <= $inputValue; $i++) {
                            echo '<tr>';
                            echo '<th scope="row">' . $i . '</th>';
                            echo '<td> <input type="text" id="NIF_' . $i . '" name="NIF[]" class="form-control" style="width: 50%;" oninput="verifierLongueurNIF(' . $i . ')"> <span id="messageErreurNIF_' . $i . '" style="color: red;" ></span></td>';
                            echo '<td> <input type="text" name="raison_sociale[]" class="form-control" style="width: 50%;"></td>';
                            echo '<td> <input type="text" id="montantHT_' . $i . '" name="montantHT[]" class="form-control" style="width: 50%;" oninput="calculerTVA(' . $i . ')"></td>';
                            echo '<td> <input type="text" id="TVA_' . $i . '" name="TVA[]" class="form-control" style="width: 50%;" readonly></td>';
                            echo '<td> <input type="date" name="dateFact[]" class="form-control" style="width: 50%;"></td>';         
                            echo '</tr>';
                        }
                }
                ?>
            </tbody>    
        </table>
        <div class="ajout">
            <button id="ajoutbutton" class="btn btn-success" type="submit">Envoyer</button>
        </div>
        </form>

    </div>
</div>
<?php
 include("footer.php")
?>

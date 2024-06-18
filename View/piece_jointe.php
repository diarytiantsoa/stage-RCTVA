<?php 
include_once("header.php");
include_once("menu/menu4.php");

require_once("../Controller/co_piece.php");
?>

<div class="main">
    <h1>PIECES JUSTIFICATIVES </h1>
        <p class="lead">Année: 2023 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Période: <?php echo "Septembre"; ?></p>
        <br>

<style>
    .file-input-label {
        font-size: 0;
        color: transparent;
    }
</style> 
<?php
$nbrFact = isset($_GET['nbrFact']) ? urldecode($_GET['nbrFact']) : '';
       for ($i = 1; $i <= $nbrFact; $i++) {
                            echo '<label for="facture" class="file-input-label">Facture:'.$i.'</label>';
                            echo '<div class="input-group mb-3">';
                            echo '   <input type="file"  class="form-control" id="facture_'.$i.'" name="facture">';
                            echo 'div';
                        }
?>
        <table class="table">  
            <thead class="table-dark">      
                <tr>
                    <th scope="col" style="width: 10%;">Votre NIF</th>
                    <th scope="col" style="width: 20%;">Facture</th>
                    <th scope="col" style="width: 20%;">Annexe</th>
                    <th scope="col" style="width: 20%;">Déclaration TVA</th>
                </tr>
            </thead>
            <tbody id="tableBody">   
               <form action="" method="post" enctype="multipart/form-data">
                    <tr>
                        <td>
                            <?php 
                              
                                $nif = isset($_GET['nif']) ? urldecode($_GET['nif']) : ''; echo "$nif"
                            ?>
                        </td>
                        <td> 
                            <label for="facture" class="file-input-label">Facture:</label>
                            <div class="input-group mb-3">
                                <input type="file"  class="form-control" id="facture" name="facture">
                            </div>
                        </td>
                        <td> 
                            <label for="annexe" class="file-input-label">Annexe:</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="annexe" name="annexe">
                            </div>
                        </td>
                        <td> 
                            <label for="teleDecdeclaration" class="file-input-label">teleDec:</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="teleDec" name="teleDec">
                            </div>
                        </td>
                    </tr>
            </tbody>
        </table>
                        <div class="ajout">
                            <input class="btn btn-success" type="submit" id="upload" name="submit" value="Joindre les fichiers">
                        </div>
                </form> 
</div>

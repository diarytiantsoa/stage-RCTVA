<?php
include_once("menu/menu_Admin.php");
include_once("../Controller/administrateur.php");
include_once("../Model/DbManager.php");

?>

<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Assets/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../Assets/js/bootstrap.min.js"></script>
        <title>e-Remboursement</title>
<body>
    <div class="main">
        <p class="lead"><B>Année: 2023 </p>  
        <p class="lead"><B>Liste des demandes de remboursement de credit de TVA <b>en cours </p>   
        <?php
            new administrateur();
        ?>
    </div>




</body>
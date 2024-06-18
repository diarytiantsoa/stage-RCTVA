
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Assets/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../Assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../Assets/style.css" />
        <title>e-Remboursement</title>

</head>
<?php
include_once("../Controller/utilisateur.php");
$controller = new UtilisateurController();

if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['email'])) {
    $NIF = $_POST['NIF'];
    $mdp = $_POST['mdp'];

    $controller = new UtilisateurController();
    $controller->login($NIF, $mdp);
}
include("menu_index.php");
?>
<body>
    <style>
        body{
            background-color:#0A864B;
        }
        .form-control {
        margin-left:0%;
        margin-left:0%;
        width: 95%;
        max-width:100%;
        color: transparent;
        border-radius:0px !important;
        border-top: 1px solid #fff;
        border-right: 1px solid #fff;
        border-left: 1px solid #fff;
        border-bottom: 0.5px solid #676767;
        padding-top:0px !important;

        }    
        .button{
            background-color:#0C2218 ;
            color:white;
            border-radius:15%;
        }
        .btn-primary{
            margin-left:20%;
            margin-top:7%;
            background-color:#0C2218 ;
            border: 1px solid white;
            color:white;
            width:60%;
            height:50px;
        
        }
        .btn.btn-primary:hover{
        background-color:#fff!important;
        border-color:#0C2218 ;
        color: #0C2218
    }
    </style>
    <script>
 function aggrandir(){
  var inputEmail= document.getElementById('email');
  var inputNIF= document.getElementById('NIF');
  var inputMdp= document.getElementById('mdp');
  inputEmail.style.fontSize= "15px";
  inputNIF.style.fontSize= "15px";
  inputMdp.style.fontSize= "15px";
 }
    </script>

<div class="login1">
    <div class="side1">
        <div class="picturebox1"></div>
            <p class="fs-3" style="margin-top:10%;margin-left:0%; text-transform:none;">Créer un compte e-remboursement</p>
    
            <form action="" method="post">          
                    <label for="email" class="label">Adresse EMAIL</label>
                    <input id="email" type="tel"style="padding-left:0px !important;height:30px;font-size:11px" placeholder="Votre adresse e-mail" name="emailSign" class="form-control"   onFocus="aggrandir();">

                    <label for="NIF" class="label"style="margin-top:10px">Numéro d'Identité Fiscal</label>
                    <input id="NIF" type="tel"style="padding-left:0px !important;height:30px;font-size:11px" placeholder="Votre Numéro d'Identité Fiscal" name="NIFSign" class="form-control" onFocus="aggrandir();" >
                
                    <label for="inputPassword5"  class="label"style="margin-top:10px">Mot de passe </label>
                    <input id="mdp" type="password" style="padding-left:0px !important;height:30px;font-size:11px" id="mdp" placeholder="Votre mot de passe" name="mdpSign"  class="form-control" aria-describedby="passwordHelpBlock" onFocus="aggrandir();" required>
        
                    <div id="passwordHelpBlock" class="form-text">
                        <input type="submit"  class="btn btn-primary" value="Créer ">
                    </div>
            </form>
    </div>    
</div>

</body>
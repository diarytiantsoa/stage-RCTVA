
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
include_once("../Controller/loginAdmin.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mat = $_POST['num_mat'];
    $mdp = $_POST['mdp'];

    $controller = new adminController();
    $controller->loginAdmin($mat);
}
include("menu_index.php");
?>
<style>
        
 .btn-primary{
    --bs-btn-border-color: #fff!important;
    --bs-btn-hover-color: #0C2218!important;
    --bs-btn-hover-bg: #fff!important;
    --bs-btn-hover-border-color: #0C2218!important;

 --bs-btn-active-color: #0C2218!important;
    --bs-btn-active-bg: #fff!important;
    --bs-btn-active-border-color: #fff!important;
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
  var inputMat= document.getElementById('Mat');
  var inputMdp= document.getElementById('mdp');
  inputMat.style.fontSize= "15px";
  inputMdp.style.fontSize= "15px";
 }
    </script>

    <div class="main_index">
        
    <div class="login">
        <div class="side"><img src="../Assets/Mobile login (2).gif" alt="gif"></div>
        <div class="side1">
            <div class="picturebox1"></div>
            <p class="fs-3" style="margin-top:10%;margin-left:0%; text-transform:none;">Connectez-vous à votre compte</p>
            <form action="" method="post">          
                    <label for="mat" class="label"style="margin-top:10px">Numéro Matricule</label>
                    <input type="tel"style="padding-left:0px !important;height:30px;font-size:11px " placeholder="Votre Numéro Matricule" id="num_mat" name="num_mat" class="form-control" onFocus="aggrandir();" autofill="on" autocomplete="on">
                
                <label for="inputPassword5" class="label"style="margin-top:10px">Mot de passe </label>
                
                <input type="password" style="padding-left:0px !important;height:30px;font-size:11px" placeholder="Votre mot de passe" id="mdp" name="mdp"  class="form-control" aria-describedby="passwordHelpBlock" required>
                <div id="passwordHelpBlock" class="form-text">
                </div>
                <input type="submit"  class="btn btn-primary" value="Se connecter">
                
            </form>
        </div>
    </div>
   </div>
   <?php
include_once("footer.php");
?>
</body>

</html>

<?php 
include('header.php');
include('menu/menu.php');

?>
<script>
    function navbar(){
        var nav=document.getElementById("span1");
        nav.style.color="#fff";


    }
        
</script>
<style>
    .main{
        margin-top:60px;
        margin-left:180px;
        margin-right:180px;
        position: inherit;

    }

    .container-img{
        margin-left: 0%;
            position: relative;
            height: 50vh;

    }
     .container-img  img {
    
            height:100%;
            width:100%;
            position: absolute;
            top: -10px;
            left: 0;
            transition: z-index 5s ;
        }

        .active {
            z-index: 1;
        }
     .overlay {
        
    padding-left:135px !important;
    position: absolute;
    top: -10px;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: 3;
}
.text1{
    color:aliceblue;
    font-size:25px;
}

.text2{
    color:aliceblue;
    font-size:25px;
    background-color:#198754;
    padding-left:5px;
    padding-right:5px;
    padding-top:2px;
    padding-bottom:2px;
}

.div-container {  
  align-items:center;
  display: flex;
  justify-content: space-between; 
  margin-top:50px;
  margin-bottom:150px;
}

.div-item {
  background-color:#ffff;
  padding-bottom:20px;
  width: calc(15% - 10px); 
  height: 120px; 
  border: 2px solid #198754; 
  border-radius:100%;
  box-sizing: border-box;
  margin-bottom: 10px; 
  color:#198754;
  font-weight:bold;
  font-size:15px;
  font-family: Poppins light;

}
.div-item img{
    padding-top:25px;
    padding-left:35px;
}
.div-item:nth-child(4) img {
    padding-top: 20px;
    padding-left: 42px;
}
.div-item:nth-child(3) img {
    padding-top: 25px;
    padding-left: 40px;
}

.div-item:nth-child(2) img {
    padding-top: 25px;
    padding-left: 40px;
}


.content {
  margin-top:50px;
  text-align: center;
  margin-left:5px!important;
}

.content p {
  margin: 0; 
}

</style>  

<div class="container-img">

<div class="overlay ">
    <br><br><br><br><br>
    <span class="text2">e-remboursement</span>
    <span class="text1"><br>Portail pour l'envoi  éléctronique des demandes de remboursement de crédit de TVA <br>de la Direction Générale des Impôts de Madagascar</span>
</div>    
    <img style="object-fit: cover;" src="../Assets/background-home1.jpg" width="100%" style="margin-top:-50px;" alt="">
    <img style="object-fit: cover;" src="../Assets/background-home2.jpg" width="100%" style="margin-top:-50px;" alt="">
    <img style="object-fit: cover;" src="../Assets/background-home3.jpg" width="100%" style="margin-top:-50px;" alt="">


<script>
             
    var image_slide = document.querySelectorAll(".container-img img");
    var index = 0;

    function s() {
        for (var i = 0; i < image_slide.length; i++) {
            image_slide[i].classList.remove('active');
        }
        image_slide[index].classList.add('active');
        
        index = (index + 1) % image_slide.length;
   
     }

    setInterval(s, 4000);

</script>
</div>
</div>
<div class="main">

    <span style="font-family:Arial;font-size: 20px;color:#0A864B">Le mot du Directeur Général des Impôts</span>    
    <br>
    <span style="color:#0A864B;"><u>____      </u></span>
<span style="font-family:Poppins thin;font-size:15px;color:#6F6F6F;margin-left:10px;"><b>   Bienvenue sur le nouveau portail fiscal de la Direction Générale des Impôts.</b></span>
<br><br>
<div class="contexte">
<span style="font-family:Poppins;color:#6F6F6F;font-size:15px;">  « Dans le cadre de sa stratégie de dématérialisation de ses services et pour améliorer sa qualité de service auprès des contribuables, la Direction Générale des Impôts de la République de Madagascar a mis en place un portail pour l'envoi électronique des demandes de remboursement de TVA : eRemboursement . <br><br>

Il vous est désormais possible d’effectuer vos obligations fiscales sans vous déplacer, à partir de votre ordinateur ou de votre smartphone.
»
</span>
</div>
<div class="dg">
    <img src="../Assets/directeur2.svg" alt="">
    <div class="titre-3"><b>Monsieur Germain</b> <br>
    Directeur Général des impôts de Madagascar
    <div class="picturebox2"></div>
    </div>
</div>
<br><br><br><br><br>
<h1 style="font-size:18px;color:#6F6F6F">Comment ça marche ?</h1>
<h1 style="font-size:20px;">Les étapes à suivre pour déposer votre demande</h1>
<div class="div-container">
    <div class="div-item">
        <img src="../Assets/formulaire-de-signature (1).png" alt="">
        <div class="content">Formulaire
            <br><span style="color:#6F6F6F">Transmettez en ligne votre formulaire</span>
        </div>
       </div>
    <div class="div-item">
        <img src="../Assets/billets-dargent.png" alt="">
        <div class="content">Facture
        <br><span style="color:#6F6F6F">Saisissez les factures </span>
        </div>
       
    </div>
    <div class="div-item">
        <img src="../Assets/piece-jointe (1).png" alt="">
        <div class="content">Pièces-jointes
        <br><span style="color:#6F6F6F">Joindre les documents nécéssaires</span>
        </div>
</div>
    <div class="div-item">
        <img src="../Assets/chercher.png" alt="">
        <div class="content" style="margnin-left:-50px">Prévisualisation
        <br><span style="color:#6F6F6F">Prévisualiser votre demande</span>
        </div>
    </div>
  </div>
    
  
    <a href="formulaireAssuj.php">
        <button type="button" class="btn btn-success" style="width:300px; height:80px;"><img src="../Assets/diagonal_248450-removebg-preview-removebg-preview.png" alt="" width="20px">   Démarrer  </button></td>
    </a>
</div>
<?php
include_once("footer.php");
?>
<?php
    include("header.php");
?>

<body>
    <style>
        p{
            font-weight:900;
            color:transparent;
            font-size:0px;
        }

        p span{
            display:inline-block;
            position:relative;
            overflow:hidden;
            font-size: clamp(20px,8vw,45px);
        }

        p span::after{
            content:"";
            display:block;
            position:absolute;
            width:100%;
            height: 100%;
            top:0;
            left:0;
            transform:translateX(-10%);
            background: crimson;

        }

        p:nth-child(1){
            font-weight:300;
            animation:txt-appearance  0s 1s forwards;
        }
        p:nth-child(2){
            font-weight:300;
            animation:txt-appearance  0s 1.25s forwards;
        }
        p:nth-child(1) span::after{
            background:salmon;
            animation: slide-in 0.75s ease-out forwards,
            slide-out 0.75s 1s ease-out forwards;
        }
        p:nth-child(2) span::after{
            background:royalblue;
            animation: slide-in 0.75s 0.3 ease-out forwards,
            slide-out 0.75s 1.3s ease-out forwards;
        }

        @keyframes slide-in {
            100%{
                 transform:translateX(0%);
                
            }
        }
        @keyframes slide-out {
            100%{
                 transform:translateX(100%);
                
            }
        }
        @keyframes txt-appearance {
            100%{
                 color:#222;
                
            }

        }
        
    </style>
<div class="index">
    <div class="side">
        <p>
            <span>
               BIENVENUE hfbhdfhbsdfbds
            </span>
        </p>
        <p>
            <span>
                SUR LE PORTAIL uuuuuuuuu
            </span>
        </p>
    
    
    </div>    
    <div class="side">Youuu</div>
</div>
</body>
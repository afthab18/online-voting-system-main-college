
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
.btn-special-2 {
    padding: 12px 24px;
    background-color: white;
    color: hsl(243, 80%, 62%);
    border-radius: 6px;
    border: 2px hsl(243, 80%, 62%) solid;
    transition: transform 250ms ease-in-out;
}

.btn-special-2:hover {
    transform: scale(1.10);
}

.btn-special-2:active {
    transform: scale(.9);
}
#footersection{
    margin-top:80px;
}
.h2_3{
    margin-top:30px;
}

    </style>
</head>
<body>
   
              
              
            </div>
          </nav>
        </header>
      
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               
            <a href="vote_cp.php"><button style="margin-top:40px;width:5.5cm;" class="btn-special-2">Chair Person</button></a>
            </div>
            <div class="col-md-12">
            <a href="vote_vcp.php"><button style="margin-top:60px;width:5.5cm;" class="btn-special-2">Vice Chair Person</button></a>
            </div>
            <div class="col-md-12">
            <a href="vote_s.php"><button style="margin-top:60px;width:5.5cm; " class="btn-special-2">Secretery</button></a>
            </div>
               <div class="col-md-12">
            <a href="vote_as.php"><button style="margin-top:60px;width:5.5cm; " class="btn-special-2">Arts Club Secretery</button></a>
            </div>
               <div class="col-md-12">
            <a href="vote_ss.php"><button style="margin-top:60px;width:5.5cm; " class="btn-special-2">Sports Secretery</button></a>
            </div>
        </div>
    </div>

    
</body>
</html>
<?php
include("footer.html");
?>
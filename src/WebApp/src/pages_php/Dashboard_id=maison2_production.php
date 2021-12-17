
<?php
session_start();
if(isset($_SESSION['id'])){
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New Vibe</title>
    <link rel="icon" href="../images/NewVibe_logo.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <style media="screen">
  body{
    background-color: #DDD;
  }

  nav div ul li {
    color: #EEE;
  }

  nav div div li{
    padding-left: 50px;
    font-size: 20px;
  }

  .navbar-brand{
    font-size: 30px;
  }

  #perc_don,#perc_conso,#perc_prod,#perc_rec{
    font-size: 50px;
  }

  .slide_right {
      animation-name: slide_right;
      -webkit-animation-name: slide_right;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
    }

  .slide_left{
        animation-name: slide_left;
        -webkit-animation-name: slide_left;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        visibility: visible;
  }

    @keyframes slide_right {
      0% {
        opacity: 0;
        transform: translateX(30%);
      }
      100% {
        opacity: 1;
        transform: translateX(0%);
      }
    }
    @-webkit-keyframes slide_right {
      0% {
        opacity: 0;
        -webkit-transform: translateX(30%);
      }
      100% {
        opacity: 1;
        -webkit-transform: translateX(0%);
      }
    }

    @keyframes slide_left {
      0% {
        opacity: 0;
        transform: translateX(-30%);
      }
      100% {
        opacity: 1;
        transform: translateX(0%);
      }
    }

    @-webkit-keyframes slide_left {
      0% {
        opacity: 0;
        -webkit-transform: translateX(-30%);
      }
      100% {
        opacity: 1;
        -webkit-transform: translateX(0%);
      }
    }

  </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <img src="../images/logo.png" width="40" height="40" alt="">
      <a class="navbar-brand" href="#">LISENVALLEY</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="justify-content-center">
          <ul class="navbar-nav unstyled">
            <li class="nav-item ">
              <a class="nav-link" href="Dashboard_id=maison2.php">DASHBOARD </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Dashboard_id=maison2_consommation.php">CONSOMMATION </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="Dashboard_id=maison2_production.php">PRODUCTION <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">DONNATION</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">RECEPTION</a>
            </li>
        </div>
        <div class="justify-content-end navbar-collapse text-light " style="list-style: none;">
          <img src="../images/home.png" style="margin:auto;margin-right:10px;" width="20" height="20" alt="">
          <li class="nav-item">
            <a style="font-size: 20px;">
              <?php
              if ($_SESSION['id'] !== "") {
                $user = $_SESSION['id'];
                echo "  $user ";
              }
              ?></a>
          </li>
          <li>
          <a href="../fonctions_php/logout.php">
          <img src="../images/logout.png" style="margin:auto;margin-left:15px;" width="20" height="20" alt="">
          </a>
          </li>
        </div>
        </ul>
      </div>
    </nav>


<div class="container">


<canvas id="line-chart_1" width="800" height="450"></canvas>
</div>

<script type="text/javascript">
<?php

$servername = "localhost";

// REPLACE with your Database name
$dbname = "new_vibe_db";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$req1 = "SELECT * FROM production_log;";

$row_production_log=[];

if ($result1 = $conn->query($req1)) {
    while ($row = $result1->fetch_assoc()) {
        array_push($row_production_log,$row);

    }
    $result1->free();
}




$conn->close();
?>

var prods = <?php echo json_encode($row_production_log); ?>;
console.log(prods);

var prod_maison1 = [];
var prod_maison2 = [];

prods.forEach((k, i) => {
  if (prods[i].id_maison==1) {
    prod_maison1.push(prods[i].prod);
  }else {
    prod_maison2.push(prods[i].prod);
  }
});

var label_1=[];

for (i in prod_maison2){
  label_1.push("");
}

console.log("production maison 1 :")
console.log(prod_maison1);
console.log("production maison 2 :")
console.log(prod_maison2);

function open(id) {
  document.getElementById('services').hidden=true;
  document.getElementById('chart-line_1').hidden=true;
  document.getElementById(id).hidden=false;
}

new Chart(document.getElementById("line-chart_1"), {
type: 'line',
data: {
  labels: label_1,
  datasets: [{
      data: prod_maison2,
      label: "Production maison 2",
      borderColor: "#28A745",
      fill: false
    }
  ]
},
options: {
  title: {
    display: true,
    text: 'Production'
  }
}
});

</script>


  </body>
</html>
<?php }else {
header("Location:login.php");
} ?>

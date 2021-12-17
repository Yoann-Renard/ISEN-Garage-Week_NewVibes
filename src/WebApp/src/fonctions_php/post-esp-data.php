<?php
$servername = "localhost";
$dbname = "new_vibe_db";
$username = "root";
$password = "";

$api_key_value = "NewVibe";

$api_key= $etat = $prod = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $prod = test_input($_POST["prod"]);
        $maison_id = test_input($_POST["id_maison"]);
        $conso = test_input($_POST["conso"]);
        $batt = test_input($_POST["batterie"]);

        // Connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Connection vérif
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $req2 ="INSERT INTO production_log (prod,id_maison)
        VALUES ('" . $prod . "','" . $maison_id . "')";

        $req3 ="INSERT INTO consommations_log (conso,id_maison)
        VALUES ('" . $conso . "','" . $maison_id . "')";

        $req4 ="INSERT INTO batterie_log (energie)
        VALUES ('" . $batt . "')";

        // On lance les reqs
        if (!empty($prod)) {
          $conn->query($req2);
        }


          $conn->query($req3);
        

        if (!empty($batt)) {
          $conn->query($req4);
        }



        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

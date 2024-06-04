<?php
//connexion à la bdd
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "qcmaker";
    $conn = mysqli_connect($servername, $dbusername,$dbpassword,$dbname);

    // si les informations qui sont rentrés ne correspondent pas: echec de connexion
    if (!$conn) {
        die("Connexion échouée: " . mysqli_connect_error());
    }
?>
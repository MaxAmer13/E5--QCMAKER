<?php
try {
    session_start();
    include_once('config.php');

    // Assuming you're getting these values from your frontend form
    $description = $_POST['description'];
    $theme = $_POST['theme'];
    $type = $_POST['TypeQ'];
    $responses = $_POST['responses'];
    $points = $_POST['points'];
    $idQuizz = $_SESSION['idQuizz'];
    $idadmin = $_SESSION['id_admin'];

    // Prepare the SQL statement for inserting question
    $sqlQ = "INSERT INTO question(nom, theme, type_question, id_admin) VALUES ('".$description."', '".$theme."', '".$type."', ".$idadmin.")";

    // Execute the query
    $resultQ = mysqli_query($conn, $sqlQ);

    // Get the last inserted question ID
    $questionId = mysqli_insert_id($conn);

    $sqlP = "INSERT INTO associer(id_quizz, id_question, points) VALUES (".$idQuizz.",".$questionId.",".$points.")";

    $resultP = mysqli_query($conn,$sqlP);

    $i = 1;
    // Loop through each response and insert into the database
    foreach ($responses as $response) {
        $reponse = $response['reponse'];
        $bonnereponse = $response['bonnereponse'];

        // Prepare the SQL statement for inserting responses
        $sqlR = "INSERT INTO reponse(id_question,id_reponse, description, bonnereponse) VALUES (".$questionId.",".$i.", '".$reponse."', '".$bonnereponse."')";

        // Execute the query
        $resultR = mysqli_query($conn, $sqlR);

        //incremente i pour l'ajouter dans idreponse
        $i++;
    }
    // Close the connection
    mysqli_close($conn);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

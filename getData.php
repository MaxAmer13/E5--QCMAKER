<?php
    try{
        include_once('config.php');

        $sql = "SELECT * FROM quizz";


        $result = mysqli_query($conn, $sql);

        $lignes = array();

        while($ligne =$result->fetch_assoc()) {
            $lignes[] = $ligne;
        };



        echo json_encode($lignes);
        mysqli_close($conn);
    }
    catch(Exception $e){
        echo $e->getMessage();  
    }
    
?>
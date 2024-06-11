<?php
    try{
        include_once('config.php');

        $sqlA = "INSERT INTO reponse(id_question,id_reponse,description,bonnereponse)
                VALUES ";




        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    catch(Exception $e){
        echo $e->getMessage();  
    }
    
?>
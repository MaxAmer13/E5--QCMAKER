<?php 
	session_start(); 
    if(!isset($_SESSION['code'])){
        header('location:test.php');
    }
?>


<!DOCTYPE html>
<HTML lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="style.css" rel="stylesheet"/>
        <title>POC QCMAKER</title>
    </head>
    <body>
        <div class="container">
        <div class="header">
            <div class="logo">QCMAKER</div>
        </div>
        
        <?php
            include_once('config.php');
            $note = 0;
            foreach($_POST as $cle=>$val){

                        $req = "SELECT * FROM reponse r 
                            INNER JOIN question q 
                            ON r.id_question=q.id_question 
                            INNER JOIN associer a 
                            ON a.id_question = q.id_question 
                            WHERE r.id_reponse = $val AND bonnereponse = 1 AND r.id_question= $cle";
                    
                        
                    

                    $res = mysqli_query($conn, $req);
                    
                    if(mysqli_num_rows($res)>0){
                        while ($ligne = $res->fetch_assoc()) {
                            $note += $ligne['points'];
                        }                    
                    
                }
            }
        ?>
        <div class="login-box">
            <p class="note"><b> Ta note est <span class="valueNote"><?=$note?>/20</span></b></p>
        </div>


        <script src="poc.js"></script>
    </body>
</html>
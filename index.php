<?php 
	session_start(); 

	// vérification de l'envoi du formulaire
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// récupération des données du formulaire
		$codeSubmit = $_POST['code'];
        $pseudo = $_POST['pseudo'];

		include_once('config.php');

		// requête pour vérifier les informations de connexion dans la base de données
		$sql = "SELECT * from instance WHERE code='".$codeSubmit."'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);

		// vérification des résultats de la requête
		if($count == 1) {
            $sqlCli = "INSERT INTO client(nomclient) VALUES ('".$pseudo."')";
            $resultCli = mysqli_query($conn, $sqlCli);

            // $sqlGive ="INSERT INTO donner(id_quizz,code,id_question,id_reponse,id_client)"

			$_SESSION['code'] = $codeSubmit;
			header("Location: quizz.php");
			exit();
		} else {
			echo "code incorrecte";
		}
		mysqli_close($conn);
	}
?>


<html>
    <head>
        <link href="style.css" rel="stylesheet"/>
        <title>QcMaker</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="logo">QCMAKER</div>
                <div class="menu">
                    <a href="index.php">Home</a>
                    <a href="loginadmin.php">Admin</a>
                </div>
            </div>
            <div class="login-box">
                <h2>QCM</h2>
                <form action="" method="post">
                    <div class="user-box">
                            <input type="text" name="pseudo" required>
                        <label>Pseudonyme</label>
                    </div>
                    <div class="user-box">
                            <input type="text" name="code" required>
                        <label>Code du QCM</label>
                    </div>
                    <input type="submit" value="Envoyer"/>
                </form>
            </div>
        </div>
    </body>
</html>
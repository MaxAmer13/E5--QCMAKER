<?php 
	session_start(); 

	// vérification de l'envoi du formulaire
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// récupération des données du formulaire
		$nomq = htmlentities($_POST['nomq']);
        $themeq = htmlentities($_POST['themeq']);
        $idadmin = htmlentities($_SESSION['id_admin']);

		include_once('config.php');

		// insertion du quizz dans la bdd
		$sql = "INSERT INTO quizz(nomq, Objectifq,datecreation,id_admin) VALUES('".$nomq."','".$themeq."',NOW(),'".$idadmin."')";
		$result = mysqli_query($conn, $sql);
        $_SESSION['idQuizz'] = mysqli_insert_id($conn);
        header("Location: questions.php");

		mysqli_close($conn);
	}
?>

<html>
    <head>
        <link href="style.css" rel="stylesheet"/>
        <title>QcMaker</title>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="logo">QCMAKER</div>
                <div class="menu">
                    <a href="AllQuizz.php">Home</a>
                    <a href="createqcm.php">CréationQCM</a>
                    <a href="deconnexion.php">Se deconnecter</a>
                </div>
            </div>
            <div class="login-box">
                <h2>Création QCM</h2>
                <form method="post">
                    <div class="user-box">
                        <input type="text" name="nomq" required="">
                    <label>Nom du QCM</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="themeq" required="">
                    <label>Thème du QCM</label>
                    </div>
                    <div>
                        <input type='submit' class="form-btn" value="Créer" />
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
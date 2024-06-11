<?php 
	session_start(); 

	// vérification de l'envoi du formulaire
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// récupération des données du formulaire
		$email = $_POST['email'];
        $mdp = $_POST['mdp'];

		include_once('config.php');

		// requête pour vérifier les informations de connexion dans la base de données
		$sql = "SELECT * from admin WHERE email='".$email."' AND mdp='".$mdp."'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);

		// vérification des résultats de la requête
		if($count == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id_admin'] = $row['id_admin'];
			header("Location: AllQuizz.php");
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
                <h2>Admin</h2>
                <form method="post" action="">
                    <div class="user-box">
                        <input type="text" name="email" required="">
                    <label>Email</label>
                    </div>
                    <div class="user-box">
                        <input type="password" name="mdp" required="">
                    <label>Mot de passe</label>
                    </div>
                    <input type="submit" value="Envoyer"/>
                </form>
            </div>
        </div>
    </body>
</html>
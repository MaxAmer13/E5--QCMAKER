<html>
    <head>
        <link href="style.css" rel="stylesheet"/>
        <title>QcMaker</title>
    </head>
    <body>
        <?php
            session_start(); 
            include_once("config.php"); 
            $code = $_SESSION['code'];
        ?>

    
        <div class="container">
            <div class="header">
                <div class="logo">QCMAKER</div>
            </div>
            <div class='quizz-box'>
                <h2>QCM</h2>
                <h3>Les fruits</h3>
                <form action="reponse.php" method="POST">
                <?php 
                            // Use prepared statements to prevent SQL injection
                            $req = "SELECT q.id_question, q.nom
                                    FROM instance i
                                    INNER JOIN associer a ON a.id_quizz = i.id_quizz
                                    INNER JOIN question q ON a.id_question = q.id_question
                                    WHERE i.code = ?";

                            $stmt = $conn->prepare($req);
                            $stmt->bind_param("s", $code);  // Assuming $code is a string
                            $stmt->execute();
                            $result = $stmt->get_result();

                            echo "<ol>";

                            while ($ligne = $result->fetch_assoc()) {
                                $question = $ligne['id_question'];
                                ?>
                                <li><h3 class="question"><?= htmlspecialchars($ligne['nom']); ?></h3>

                                <?php 
                                // Fetching answers for the current question
                                $req2 = "SELECT  DISTINCT r.id_reponse, r.description
                                        FROM instance i
                                        INNER JOIN donner d ON i.code = d.code
                                        INNER JOIN reponse r ON d.id_reponse = r.id_reponse
                                        INNER JOIN question q ON r.id_question = q.id_question
                                        WHERE i.code = ? AND q.id_question = ?";

                                $stmt2 = $conn->prepare($req2);
                                $stmt2->bind_param("si", $code, $question);  // Assuming $code is a string and $question is an integer
                                $stmt2->execute();
                                $res2 = $stmt2->get_result();

                                while ($ligne2 = $res2->fetch_assoc()) {
                                    ?>
                                    <input type="radio" name="<?= htmlspecialchars($question) ?>" value="<?= htmlspecialchars($ligne2['id_reponse']) ?>" required>
                                    <?= htmlspecialchars($ligne2['description']) ?>
                                    </br>
                                    <?php
                                }
                                echo "</li>";
                            }
                            echo "</ol>";

                            // Close statements and connection
                            $stmt->close();
                            $stmt2->close();
                            $conn->close();
                            ?>

                            <input type="submit" value="Envoyer">
                </form>

            </div>
        </div>
    </body>
</html>

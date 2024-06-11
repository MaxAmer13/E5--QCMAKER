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
            <div class='quizz1-box'>
                <h2>QCM</h2>
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
                                        INNER JOIN quizz qz ON i.id_quizz = qz.id_quizz
                                        INNER JOIN associer a ON qz.id_quizz = a.id_quizz
                                        INNER JOIN question qu ON qu.id_question = a.id_question
                                        INNER JOIN reponse r ON r.id_question=qu.id_question
                                        WHERE i.code = ? AND qu.id_question = ?";

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

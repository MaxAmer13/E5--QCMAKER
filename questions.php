<!DOCTYPE html>
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
        </div>  
        <form id="qcreator">
            <div class="quizz-container">
                <div class="quizz-box">
                    <h2>Création Question</h2>
                    <div id="questions">
                        <div class="user-box">
                            <input type="text" name="desc" required="" placeholder="Question">
                        </div>
                        <div class="user-box">
                            <input type="text" name="theme" required="" placeholder='Thème de la question'>
                        </div>
                        <div class="user-box">
                            <input type="number" name="points" required placeholder="Points de la question" min='0' max='20'/>
                        </div>
                        <select name="type">
                            <option value="" >Choisir un type de question</option>
                            <option value="Vrai ou Faux" >Vrai ou Faux</option>
                            <option value="Choix Multiple">Choix Multiple</option>
                        </select>
                        <div id="Good">
                            <div class="user-box">
                                <input type="text" name="reponse0" required="" placeholder="Réponse">
                            </div>
                            <input type="checkbox" name="bonnereponse0"/>
                        </div>
                    </div>
                    <button class="question" onclick='addresp()'>Ajouter une réponse</button>
                </div>
                <!-- Add more quizz-box elements here if needed -->
            </div>
            <button class="question" onclick='addquestion()'>Ajouter une question</button>
            <button value="Créer" onclick='handleSubmit()'>Créer</button>
            <!-- <input type="submit" value="créer"/> -->
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>

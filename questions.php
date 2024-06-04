<html>
    <head>
        <link href="style.css" rel="stylesheet"/>
        <title>QcMaker</title>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="logo">QCMAKER</div>
            </div>
            <div class="login-box">
                <h2>Création QCM</h2>
                <form>
                    <div class="user-box">
                        <input type="text" name="" required="">
                    <label>Question</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="" required="">
                    <label>Thème de la question</label>
                    </div>
                    <select>
                        <option value="" >Choisir un type de question</option>
                        <option value="1" name="Vrai ou Faux">Vrai ou Faux</option>
                        <option value="2" name="Question a choix multiple">Choix Multiple</option>
                    </select>
                    <div id="Good">
                        <div class="user-box">
                            <input type="text" name="" required="">
                        <label>Reponse</label>
                        </div>
                        <input type="checkbox"/>
                    </div>
                    <div id="Good">
                        <div class="user-box">
                            <input type="text" name="" required="">
                        <label>Reponse</label>
                        </div>
                        <input type="checkbox">
                    </div>
                    <button class="question">Ajouter une réponse</button>
                    </br>
                    <button class="question">Ajouter une question</button>
                    <input type="submit" value="Créer"/>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
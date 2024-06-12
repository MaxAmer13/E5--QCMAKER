let listeCode = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9'];
// const codeSubmit = document.getElementById('quizz');
function generateCode(idQuizz){
    let Code = "";
    for(let i = 0; i<8;i++){
        let random = Math.ceil(Math.random() * 35);
        let letter = listeCode[random];
        Code = Code + letter;
    }
    insertCode(Code,idQuizz);
    document.getElementsByClassName(idQuizz)[0].value = Code;
}

function insertCode(code,idQuizz){
    $.ajax({
        url : "http://localhost/POC/insertCode.php",
        type: "post",
        data:{
            "code": code,
            "idQuizz": idQuizz
        },
        success: function (result, statut){

        },
        error: function(error){
            console.error("un problème est survenu" + error);
        }
    })
}

addEventListener("DOMContentLoaded", function(){getData()});


function getData(){
    $.ajax({
        url : "http://localhost/qcmaker/getData.php",
        type: "get",
        success: function (result, statut){
            console.log(result);
            let obj = JSON.parse(result);
            printAllQuizz(obj);
        },
        error: function(error){
            console.error("un problème est survenu" + error);
        }
    })
}

function printAllQuizz(data){
    for(const[key,value] of Object.entries(data)){
        console.log(`key : ${key} value : ${value} `);
        let form = document.getElementsByClassName('form')[0];
        let card = document.createElement('DIV');
        card.className = "Tournament";
        form.appendChild(card);

        let title = document.createElement('H1');
        title.className = "subtitle";
        title.innerHTML = value.nomq;
        let theme = document.createElement('LABEL');
        theme.innerHTML = value.Objectifq;
        let genererc = document.createElement('INPUT');
        genererc.setAttribute('type','text')
        genererc.className =  value.id_quizz;
        let buttonc = document.createElement('BUTTON');
        buttonc.innerHTML = "Générer le code";
        buttonc.className = "form-btn";
        buttonc.addEventListener("click",function(){generateCode(value.id_quizz)});

        card.appendChild(title);
        card.appendChild(theme);
        card.appendChild(genererc);
        card.appendChild(buttonc);

    }
}

let questionCounter = 0;

function addresponse(quizId, id){
    let Rcreator = document.getElementById(quizId);

    let placement = document.createElement('DIV');
    placement.id = "Good";

    let writingr = document.createElement('DIV');
    writingr.classList = "user-box";

    let response = document.createElement('INPUT');
    response.setAttribute('TYPE','TEXT');
    response.setAttribute('placeholder','Réponse');
    response.setAttribute('name','reponse' + id);

    let GoodResponse = document.createElement('INPUT');
    GoodResponse.setAttribute('TYPE','CHECKBOX');
    response.setAttribute('name','bonnereponse' + id);

    Rcreator.appendChild(placement);
    placement.appendChild(writingr);
    writingr.appendChild(response);

    placement.appendChild(GoodResponse);
}

function addresp(){
    let Rcreator = document.getElementById('questions');

    let placement = document.createElement('DIV');
    placement.id = "Good";

    let writingr = document.createElement('DIV');
    writingr.classList = "user-box";

    let response = document.createElement('INPUT');
    response.setAttribute('TYPE','TEXT');
    response.setAttribute('placeholder','Réponse');
    response.setAttribute('name','reponse0');

    let GoodResponse = document.createElement('INPUT');
    GoodResponse.setAttribute('TYPE','CHECKBOX');
    GoodResponse.setAttribute('name','bonnereponse0');

    Rcreator.appendChild(placement);
    placement.appendChild(writingr);
    writingr.appendChild(response);

    placement.appendChild(GoodResponse);
}


function addquestion(){
    let Qcreator = document.getElementsByClassName('quizz-container')[0];
    questionCounter++;
    let quizId = "questions" + questionCounter;

    let otherq = document.createElement('div');
    otherq.classList = "quizz-box";

    let title = document.createElement("h2");
    title.innerHTML = "Création Question";

    let question = document.createElement('div');
    question.classList = "user-box";

    let descQ = document.createElement('INPUT');
    descQ.setAttribute("TYPE",'TEXT');
    descQ.setAttribute("placeholder",'Question');
    descQ.setAttribute('name','desc');

    Qcreator.appendChild(otherq);
    otherq.append(title);
    otherq.appendChild(question);
    question.appendChild(descQ);

    let theme = document.createElement('div');
    theme.classList = "user-box";

    let descT = document.createElement('INPUT');
    descT.setAttribute("TYPE",'TEXT');
    descT.setAttribute("placeholder",'Thème de la question');
    descT.setAttribute('name','theme')

    otherq.appendChild(theme);
    theme.appendChild(descT);

    let points= document.createElement('div');
    points.classList = "user-box";

    let descP = document.createElement('INPUT');
    descP.setAttribute("TYPE","NUMBER");
    descP.setAttribute('placeholder','points de la question');
    descP.setAttribute("MIN","0");
    descP.setAttribute("MAX","20");
    descP.setAttribute('name','points');

    otherq.appendChild(points);
    points.appendChild(descP);

    let typeQ = document.createElement('SELECT');
    let optionD = document.createElement('OPTION');
    optionD.innerHTML = "Choisir un type de question";
    typeQ.setAttribute('name','type');

    let option1 = document.createElement('OPTION')
    option1.innerHTML = "Vrai ou Faux";

    let option2 = document.createElement('OPTION')
    option2.innerHTML = "Choix multiple";

    otherq.appendChild(typeQ);
    typeQ.appendChild(optionD);
    typeQ.appendChild(option1);
    typeQ.appendChild(option2);

    let Rcreator = document.createElement('DIV');
    Rcreator.id = quizId;
    otherq.appendChild(Rcreator);

    let placement1 = document.createElement('DIV');
    placement1.id = "Good";
    let writingr1 = document.createElement('DIV');
    writingr1.classList = "user-box";

    let response1 = document.createElement('INPUT');
    response1.setAttribute('TYPE','TEXT');
    response1.setAttribute('placeholder','Reponse');
    response1.setAttribute('name','reponse' + questionCounter);

    let GoodResponse1 = document.createElement('INPUT');
    GoodResponse1.setAttribute('TYPE','CHECKBOX');
    GoodResponse1.setAttribute('name','bonnereponse' + questionCounter);

    let placement2 = document.createElement('DIV');
    placement2.id = "Good";
    let writingr2 = document.createElement('DIV');
    writingr2.classList = "user-box";

    let response2 = document.createElement('INPUT');
    response2.setAttribute('TYPE','TEXT');
    response2.setAttribute('placeholder','Reponse');
    response2.setAttribute('name','reponse' + questionCounter);

    let GoodResponse2 = document.createElement('INPUT');
    GoodResponse2.setAttribute('TYPE','CHECKBOX');
    GoodResponse2.setAttribute('name','bonnereponse' + questionCounter);
    Rcreator.appendChild(placement1);
    placement1.appendChild(writingr1);
    writingr1.appendChild(response1);

    placement1.appendChild(GoodResponse1);

    Rcreator.appendChild(placement2);
    placement2.appendChild(writingr2);
    writingr2.appendChild(response2);

    placement2.appendChild(GoodResponse2);

    let buttonRep = document.createElement("BUTTON");
    buttonRep.innerHTML = "Ajouter une réponse";
    buttonRep.classList = "question";
    buttonRep.addEventListener("click",function(){addresponse(quizId, questionCounter)});
    otherq.appendChild(buttonRep);
}

function insertQuestion(description, theme, type, responses, points) {
    $.ajax({
        url: "http://localhost/qcmaker/insertQuestions.php",
        type: "post",
        data: {
            "description": description,
            "theme": theme,
            "TypeQ": type,
            "responses": responses,
            "points": points
        },
        success: function(result, statut) {
            console.log(result);
            window.location.href = "http://localhost/qcmaker/AllQuizz.php";
        },
        error: function(error) {
            console.error("un problème est survenu" + error);
        }
    });
}


function handleSubmit() {
    for(let v =0; v<document.getElementsByClassName('quizz-box').length;v++){
    
        let description = document.getElementsByName('desc')[v].value;
        let theme = document.getElementsByName('theme')[v].value;
        let type = document.getElementsByName('type')[v].value;
        let points = document.getElementsByName('points')[v].value;
        let responses = [];

        for(let i=0;i<document.getElementsByName('reponse' + v).length;i++){
            let response = {
                reponse: document.getElementsByName('reponse' + v)[i].value,
                bonnereponse: document.getElementsByName('bonnereponse' + v)[i].checked ? 1 : 0
            };
            responses.push(response);
        };
        console.log(responses);

        insertQuestion(description, theme, type, responses,points);
    }
}


function DumpBdd(){
    $.ajax({
        url: "https://gomfolio.alwaysdata.net/qcmaker/dump.php",
        type: "post",
        success: function(result, statut) {
        },
        error: function(error) {
            console.error("un problème est survenu" + error);
        }
    });
}

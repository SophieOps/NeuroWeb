//fichier Javascript

document.getElementById("score").innerHTML = "0/20";
document.getElementById("a1").innerHTML = "Ceci est le texte de la question 1 et de l'affirmation 1.";
document.getElementById("a2").innerHTML = "Ceci est le texte de la question 1 et de l'affirmation 2.";
document.getElementById("a3").innerHTML = "Ceci est le texte de la question 1 et de l'affirmation 3.";

var answera1 = false;
var answera2 = false;
var answera3 = false;

var radioa1true = document.gatElementById("test1true");
radio3true.addEventListener('click', function(){answera1 = true;})
var radioa1false = document.gatElementById("test1false");
radio3true.addEventListener('click', function(){answera1 = true;})


var btnVerify = document.getElementById('btnVerify'),
        enable = getComputedStyle(btnVerify).class;
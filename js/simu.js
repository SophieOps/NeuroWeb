//fichier Javascript

document.getElementById("score").innerHTML = "0/20";
document.getElementById("a1").innerHTML = "Ceci est le texte de la question 1 et de l'affirmation 1.";
document.getElementById("a2").innerHTML = "Ceci est le texte de la question 1 et de l'affirmation 2.";
document.getElementById("a3").innerHTML = "Ceci est le texte de la question 1 et de l'affirmation 3.";

var answera1 = false;
var answera2 = false;
var answera3 = false;

var radioa1true = document.getElementById("test1true");
radioa1true.addEventListener('click', function(){answera1 = true; with3answers();})
var radioa1false = document.getElementById("test1false");
radioa1true.addEventListener('click', function(){answera1 = true; with3answers();})

var radioa2true = document.getElementById("test2true");
radioa2true.addEventListener('click', function(){answera2 = true; with3answers();})
var radioa2false = document.getElementById("test2false");
radioa2true.addEventListener('click', function(){answera2 = true; with3answers();})

var radioa3true = document.getElementById("test3true");
radioa3true.addEventListener('click', function(){answera3 = true; with3answers();})
var radio3afalse = document.getElementById("test3false");
radioa3true.addEventListener('click', function(){answera3 = true; with3answers();})

function with3answers(){
	if (answera3 && answera2 && answera1)
	{
		var btnVerify = document.getElementById('btnVerify'),
	        classe = getComputedStyle(btnVerify).class;
	    var classes = classe.split(' ');
	    lg = classes.length;
	    if ( classes[lg-1] == 'disabled')
	    {
	    	classes[lg-1] = 'eneble';
	    	classe = '';
		    for (i = 0; i < lg; i++) { 
		    	classe += classes[i];
		    }
		    document.getElementById("btnVerify").className = classe;
		}
		//document.getElementById("MyElement").className = document.getElementById("MyElement").className.replace( /(?:^|\s)MyClass(?!\S)/g , '' )
		/*An explanation of this regex is as follows:
		(?:^|\s) # match the start of the string, or any single whitespace character
		MyClass  # the literal text for the classname to remove
		(?!\S)   # negative lookahead to verify the above is the whole classname
        		 # ensures there is no non-space character following
        		 # (i.e. must be end of string or a space)*/
	}
}


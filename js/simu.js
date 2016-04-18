//fichier Javascript

var answera1 = false;
var answera2 = false;
var answera3 = false;

var radioa1true = document.getElementById("test1true");
radioa1true.addEventListener('click', function(){answera1 = true; with3answers();})
var radioa1false = document.getElementById("test1false");
radioa1false.addEventListener('click', function(){answera1 = true; with3answers();})

var radioa2true = document.getElementById("test2true");
radioa2true.addEventListener('click', function(){answera2 = true; with3answers();})
var radioa2false = document.getElementById("test2false");
radioa2false.addEventListener('click', function(){answera2 = true; with3answers();})

var radioa3true = document.getElementById("test3true");
radioa3true.addEventListener('click', function(){answera3 = true; with3answers();})
var radioa3false = document.getElementById("test3false");
radioa3false.addEventListener('click', function(){answera3 = true; with3answers();})

function with3answers(){
	if (answera3 && answera2 && answera1)
	{
		//alert("Toutes les questions ont une réponse.");
		var classBtnVerif = document.getElementById("btnVerify").className;
		//alert("La classe actuelle du bouton est : "+document.getElementById("btnVerify").className);

	    var splitclassBtnVerif = classBtnVerif.split(' ');
	    lg = splitclassBtnVerif.length;
	    if ( splitclassBtnVerif[lg-1] == 'disabled')
	    {
	    	splitclassBtnVerif[lg-1] = 'eneble';
	    	classBtnVerif = '';
		    for (i = 0; i < lg; i++) { 
		    	classBtnVerif += splitclassBtnVerif[i] + " ";
		    }
		    document.getElementById("btnVerify").className = classBtnVerif;
		    document.getElementById("btnVerify1").className = classBtnVerif;
		}
	    /*var newclasse = classe.replace(/(?:^|\s)disabled(?!\S)/g , 'enable');
		alert("l'ancienne classe est : "+classe+" et la nouvelle classe est : "+newclasse);
		document.getElementById("btnVerify").className = newclasse;*/
		/*An explanation of this regex is as follows:
		(?:^|\s) # match the start of the string, or any single whitespace character
		MyClass  # the literal text for the classname to remove
		(?!\S)   # negative lookahead to verify the above is the whole classname
        		 # ensures there is no non-space character following
        		 # (i.e. must be end of string or a space)*/
        //document.getElementById("btnVerify").classList.add('enable');
        //document.getElementById("btnVerify").classList.remove('disabled');
        //var newclasse = getComputedStyle(document.getElementById("btnVerify")).class; //class ou className
        //alert("la nouvelle classe est : "+document.getElementById("btnVerify").className);
	}
/*
var btnVerif = document.getElementById("test3false");
btnVerif.addEventListener('click', function(){;})


	function showElem() {
    document.getElementById("myImg").style.visibility = "visible"; 
	}*/
}


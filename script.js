function ajaxRequest(){
	var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"]; //activeX versions to check for in IE
	if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
		for (var i=0; i<activexmodes.length; i++){
		   try{
				return new ActiveXObject(activexmodes[i]);
		   }
		   catch(e){
				//suppress error
		   }
		}
	}
	else if (window.XMLHttpRequest){ // if Mozilla, Safari etc
		return new XMLHttpRequest();
	}else{
		return false;
	}
}

window.onload = function() { 
	window.editor = CodeMirror.fromTextArea(document.getElementById("less"), {
		lineNumbers: true,
		matchBrackets: true,
		theme: "lesser-dark",
		mode: "text/x-less"
	});
	window.editor2 = CodeMirror.fromTextArea(document.getElementById("scss"), {
		lineNumbers: true,
		matchBrackets: true,
		theme: "lesser-dark",
		mode: "text/x-scss"
	});
	window.editor.on("change", function(){requestSCSS()});
	requestSCSS();
/* 	var txts = document.getElementsByTagName('TEXTAREA');
	for(var i = 0, l = txts.length; i < l; i++) {
		if(txts[i].getAttribute("name")) { 
			
			txts[i].onkeyup = requestSCSS;
			txts[i].onblur = requestSCSS;
		}
	}  */
} 

function requestSCSS(){
	var mypostrequest=new ajaxRequest();
	mypostrequest.onreadystatechange=function(){
		if (mypostrequest.readyState==4){
			if (mypostrequest.status==200 || window.location.href.indexOf("http")==-1){
				document.getElementById("scss").innerHTML=mypostrequest.responseText;
				window.editor2.getDoc().setValue(mypostrequest.responseText);
			}
			else{
				alert("An error has occured making the request");
			}
		}
	}
	var lessvalue=encodeURIComponent(window.editor.getDoc().getValue());
	var parameters="less="+lessvalue+"&ajax=1";
	mypostrequest.open("POST", "convert.php", true);
	mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	mypostrequest.send(parameters);
} 
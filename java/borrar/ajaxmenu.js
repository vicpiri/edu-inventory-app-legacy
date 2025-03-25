// Java Document
var oldObject=null;
var oldFamilia=null;
var oldParent=null;

function toggleClamShellMenu(objectID, familia) {

	if (familia == 0){
		if (oldParent){
			oldParent.style.display='none';
		}
		oldParent = document.getElementById(objectID);
	}
	
//	alert(objectID+" "+familia+" "+oldFamilia);
	
	if ((oldObject) && (oldFamilia) && (oldFamilia == familia)){
		oldObject.style.display='none';
	}
	
	var object = document.getElementById(objectID);
	if (object.style.display =='block'){
		object.style.display='none';
	}else{
		object.style.display='block';
	}
	oldObject = object;
	oldFamilia = familia;
	return;
}
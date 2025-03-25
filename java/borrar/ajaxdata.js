// Java Document
function prepData(requestedData) {
	fetchData('ajax/dataPage.php',requestedData,'contentE');
}
function filterData(pageRequest,objectID){
	var object = document.getElementById(objectID);
	//alert(pageRequest.responseText);
	if (pageRequest.readyState == 4)	{
		if (pageRequest.status==200){
			object.innerHTML = pageRequest.responseText ;
			//alert("focus");
			setTimeout("setFocus()",100);
		}else if (pageRequest.status == 404) object.innerHTML = 'Lo sentimos, pero la informaci&oacute;n no est&aacute; disponible.';
		else{
			object.innerHTML = 'Ha ocurrido un problema.';
			alert("Se ha producido un problema en filterData.");
		}
	}
	else return;
}
function filterDataLista(pageRequest,objectID){
	
	if (pageRequest.readyState == 4)	{
		
		if (pageRequest.status==200){	
		
		/*if (pageRequest.responseText != ''){
			alert(pageRequest.responseXML);
				var arrSecondaryData = pageRequest.responseText.split(',');
				for (i = 0; i < arrSecondaryData.length; i++){
					if (arrSecondaryData[i] != ''){
						object.options[object.options.length] = new Option(arrSecondaryData[i],arrSecondaryData[i++]);
					}
				}
		}*/
			 xmlDoc=pageRequest.responseXML;
			 
			 var object = document.getElementById(objectID);
			 object.options.lenght = 0;
			 
			 //alert(xmlDoc);
			 alert(xmlDoc.getElementsByTagName("id_area")[0].childNodes[0]);
			 
			 for (i = 0; i < 3; i++){
				object.options[object.options.length] = new Option(xmlDoc.getElementsByTagName("nombre")[0].childNodes[0].nodeValue , xmlDoc.getElementsByTagName("id_area")[0].childNodes[0].nodeValue);
			 }
		}
		 
		 
	}
}
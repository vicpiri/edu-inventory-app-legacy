function fetchData(url,dataToSend,objectID){
	var pageRequest = false
	if (window.XMLHttpRequest) {
		pageRequest = new XMLHttpRequest()
	}
	else if (window.ActiveXObject){ 
		try {
			pageRequest = new ActiveXObject("Msxml2.XMLHTTP")
		} 
		catch (e) {
			try{
				pageRequest = new ActiveXObject("Microsoft.XMLHTTP")
			}
			catch (e){}
		}
	}
	else return false
	pageRequest.onreadystatechange=function() {	
		filterData(pageRequest,objectID)
	}
	if (dataToSend) {		
		var sendData = 'sendData=' + dataToSend;
		pageRequest.open('POST',url,true);
    	pageRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   		pageRequest.send(sendData);
	}
	else {
		pageRequest.open('GET',url,true)
		pageRequest.send(null)	
	}
}

function procesarFormulario(url, dataToSend){
	
	var pageRequest = false
	var objectID = 'contentE'
	
	
	
	if (window.XMLHttpRequest) {
		pageRequest = new XMLHttpRequest()
	}
	else if (window.ActiveXObject){ 
		try {
			pageRequest = new ActiveXObject("Msxml2.XMLHTTP")
		} 
		catch (e) {
			try{
				pageRequest = new ActiveXObject("Microsoft.XMLHTTP")
			}
			catch (e){}
		}
	}
	else return false
	pageRequest.onreadystatechange=function() {	
		filterData(pageRequest,objectID)
	}
	//alert(dataToSend);
	
	if (dataToSend) {
		
		//alert("post");
		var sendData = dataToSend;
		pageRequest.open('POST',url,true);
    	pageRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   		pageRequest.send(sendData);
	}
	else {
		//alert("get");
		pageRequest.open('GET',url,true)
		pageRequest.send(null)	
	}
}

function procesarFormularioID(url, dataToSend, objectID){
	
	var pageRequest = false
	
	//alert(dataToSend);
	
	if (window.XMLHttpRequest) {
		pageRequest = new XMLHttpRequest()
	}
	else if (window.ActiveXObject){ 
		try {
			pageRequest = new ActiveXObject("Msxml2.XMLHTTP")
		} 
		catch (e) {
			try{
				pageRequest = new ActiveXObject("Microsoft.XMLHTTP")
			}
			catch (e){}
		}
	}
	else return false
	pageRequest.onreadystatechange=function() {	
		filterData(pageRequest,objectID)
	}
	if (dataToSend) {		
		var sendData = dataToSend;
		pageRequest.open('POST',url,true);
    	pageRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   		pageRequest.send(sendData);
	}
	else {
		pageRequest.open('GET',url,true)
		pageRequest.send(null)	
	}
}


function actualizaLista(url, dataToSend, objectID){
	
	Try.these(
			  function(){return new ActiveXObject('Msxml2.XMLHTTP')},
			  function(){return new ActiveXObject('Microsoft.XMLHTTP')},
			  function(){return new XMLHttpRequest()}
	);
	
	var miAjax = new Ajax.Updater(objectID, url, {method:'post', parameters: dataToSend});
}

function nuevaLista(url, dataToSend, objectID)
{

}

function consultarInventario(dataToSend){
	//alert(dataToSend);
	Try.these(
			  function(){return new ActiveXObject('Msxml2.XMLHTTP')},
			  function(){return new ActiveXObject('Microsoft.XMLHTTP')},
			  function(){return new XMLHttpRequest()}
	);
	
	var miAjax = new Ajax.Updater('contentE', './data/utilidades_realizar_inventario_lista.php', {method:'post', parameters: dataToSend});
}

function consultarUsuario(dataToSend){
	//alert(dataToSend);
	Try.these(
			  function(){return new ActiveXObject('Msxml2.XMLHTTP')},
			  function(){return new ActiveXObject('Microsoft.XMLHTTP')},
			  function(){return new XMLHttpRequest()}
	);
	
	var miAjax = new Ajax.Updater('contentE', './data/consultar_usuario.php', {method:'post', parameters: dataToSend});

}

function consultarUsuarioHistorial(dataToSend){
	//alert(dataToSend);
	Try.these(
			  function(){return new ActiveXObject('Msxml2.XMLHTTP')},
			  function(){return new ActiveXObject('Microsoft.XMLHTTP')},
			  function(){return new XMLHttpRequest()}
	);
	
	var miAjax = new Ajax.Updater('contentE', './data/consultar_usuario_historial.php', {method:'post', parameters: dataToSend});
}

function consultarEntradas(dataToSend){
	//alert(dataToSend);
	Try.these(
			  function(){return new ActiveXObject('Msxml2.XMLHTTP')},
			  function(){return new ActiveXObject('Microsoft.XMLHTTP')},
			  function(){return new XMLHttpRequest()}
	);
	
	var miAjax = new Ajax.Updater('contentE', './data/entradas.php', {method:'post', parameters: dataToSend});
}

function consultarSalidas(dataToSend){
	//alert(dataToSend);
	Try.these(
			  function(){return new ActiveXObject('Msxml2.XMLHTTP')},
			  function(){return new ActiveXObject('Microsoft.XMLHTTP')},
			  function(){return new XMLHttpRequest()}
	);
	
	var miAjax = new Ajax.Updater('contentE', './data/salidas.php', {method:'post', parameters: dataToSend});
}


function consultarArticulo(dataToSend){
	var url = 'data/consultar_articulo_flotante.php?codigo='+dataToSend;
	openWindow(url,"Consultararticulo",1100,730);
}

function consultarIncidencia(dataToSend){
	var url = 'data/consultar_incidencia_flotante.php?codigo='+dataToSend;
	openWindow(url,"Consultarincidencia",1100,730);
}

function elegirImagen(){
	var url = 'data/elegir_imagen_flotante.php';
	openWindow(url,"ElegirImagen",500,300);
}

function muestraError(mensaje){
	alert(mensaje);
}

function openWindow(contentURL,windowName,windowWidth,windowHeight){
	widthHeight= 'height='+ windowHeight +',width='+ windowWidth;
	newWindow= window.open(contentURL,windowName,widthHeight);
	newWindow.focus();
}

function rellenaElemento(objectId, contenido){
	var object = document.getElementById(objectId);
	
	alert(object);
	alert(contenido);
	object.innerHTML = contenido;
}

function log(mensaje){
	object = document.getElementById('logPanel');
	object.innerHTML = mensaje;
}
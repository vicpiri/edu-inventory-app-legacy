function startUpload(){
      document.getElementById('fileSelectionForm').style.display = 'none';
      document.getElementById('fileUploading').style.display = 'block';
      
      
      //alert("startUpload");
      
      return true;
}

function stopUpload(data){
	alert(data);  
    if (data != ''){  
    	document.getElementById('fileUploading').style.display = 'none';
    	document.getElementById('filaUploaded').innerHTML = data;//'<input type="hidden" name="enviado" value="' + data + '" id="enviado"/>';
    	document.getElementById('fileUploaded').style.display = 'block';      
    	return true;
    }else{
    	document.getElementById('fileSelectionForm').style.display = 'block';
        document.getElementById('fileUploading').style.display = 'none';
    }
}
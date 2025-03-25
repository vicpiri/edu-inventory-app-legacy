// nuevoCss
//
// Función que añade una hora de estilos durante el tiempo de ejecución

function nuevoCss(file){
    $.ajax({
    url:file,
    type:'HEAD',
    error: function()
    {
        alert('Error: El archivo ' + file + ' no existe.');
    },
    success: function()
    {
        var style   = document.createElement( 'link' );
        style.rel   = 'stylesheet';
        style.type  = 'text/css';
        style.href  = file;
        document.getElementsByTagName( 'head' )[0].appendChild( style );
    }
    });
}

// nuevoScript
//
// Función que añade un nuevo script a la cabecera en tiempo de ejecución

function nuevoScript(file){
    $.ajax({
    url:file,
    type:'HEAD',
    error: function()
    {
        alert('El archivo ' + file + 'no existe');
    },
    success: function()
    {
        var script   = document.createElement( 'script' );
        script.src  = file;
        document.getElementsById( 'specificvendorscripts' )[0].appendChild( script );
    }
    });
}

// 
// // ajaxUpdate
//
// Función que realiza una petición del servidor y añade la respuesta al destino
// si no existe, y actualiza el contenido del destino si ya existe
function ajaxUpdate(url, destino, id){
    var content;
    if ($(id).length){
        $(id).load(url);
    }else{
        $.get(url, function(data){
            content= data;
            $(destino).append(content);
        });
    }
}

// // ajaxAppend
//
// Función que realiza una petición del servidor y añade la respuesta al contenido
// del destino

function ajaxAppend(url, destino){
    var content;
    $.get(url, function(data){
        content= data;
        $(destino).append(content);
    });
}

// ajaxPrepend
//
// Función que realiza una petición del servidor y añade la respuesta al contenido
// del destino

function ajaxPrepend(url, destino){
    var content;
    $.get(url, function(data){
        content= data;
        $(destino).prepend(content);
    });
}


// 
// // notification
//
// muestra una notificación al usuario. El tipo de notificaciones son:
//  Primary Warning  Success  Info  Error Dark 

function notification(tipo, titulo, texto, icon, addclass){
    new PNotify({
			title: titulo,
			text: texto,
			type: tipo,
			addclass: addclass,
			icon: icon
		});
}

// 
// // enviaFormulario
//
// Esta función envía de forma asíncrona la información de un formulario al servidor
// a una URL determinada
function enviaFormulario(formulario, URL, contenedor){
    // Interceptamos el evento submit
    $(formulario).submit(function(event) {
    // Enviamos el formulario usando AJAX
        event.preventDefault();
        $(contenedor).load(URL, $(formulario).serializeArray());
    });    
}


// 
// // accionMenu
// esta acción ejecuta una petición ajax a partir de la opcion seleccionada en el menú. El resultado del servidor se mostrará
// en el visor principal de la página
// El parámetro mode sirve para condicionar el aspecto de la salida HTML. Frame significa que la salida está prevista para el sector principal
// de la interfaz. Full significa que la salida se realizará a pantalla completa.

function accionMenu (accion){
    $('#mainframe').trigger('loading-overlay:show').find('.loading-overlay').css('background', '#999').css('z-index', 2);
    $('#mainframe').load("code/router.php", {data:accion, mode:'frame'});
}

// accionMenuAppend
// esta acción ejecuta una opción seleccionada en el menú y la anexa al contenido
// del visor principal

function accionMenuAppend (accion){
    //ajaxAppend('" . $baseURLClient . "modules/prestamos/code/plugin_TMP_WIDG_prestamos_totales.php', '#cpwidgets');
    var content;
    $.post("code/router.php", {data:accion, mode:'frame'}, function(data){
        content= data;
        $('#mainframe').append(content);
    });
}

// accionGlobal
// esta acción ejecuta una petición ajax a partir de la opcion seleccionada en la aplicación. El resultado del servidor se mostrará
// en el body de la pagina
function accionGlobal (accion){
    $('body').load("code/router.php", {data:accion, mode:'full'});
}

// enviaFormularioLightbox

function enviaFormularioLightbox(formulario, URL){
    URL = URL.concat('?', $(formulario).serialize());
    //alert($(formulario).serialize());
    controlador = formulario.concat(' button[type=submit]');

    $(controlador).magnificPopup({
        items: {
            src: URL
        },
        type: "ajax"
    });
}

function enviaLightbox(data, URL){
    URL = URL.concat('?', data);
    $('<div>').magnificPopup({
        items: {
            src: URL
        },
        type: "ajax"
    }).trigger('click');
}

//Control de ventanas modales extraido del ejemplo del template PORTO
//Falta revisar para eliminar el código no necesario


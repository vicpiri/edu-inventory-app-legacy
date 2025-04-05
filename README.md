# README #

Este es el repositorio del sistema de gestión de inventario y usuarios para centros educativos.

### Para qué es este repositorio? ###

* Este repositorio se ha creado para el uso docente privado del autor.
* Se trata de una versión Legacy del proyecto que ya no va a tener nuevas actualizaciones
* Version: 0.23 (Producción)
* [Learn Markdown](https://bitbucket.org/tutorials/markdowndemo)

### Configuración para ejecutar la aplicación ###

* Clonar el repositorio
* Instalar Docker (para entornos de desarrollo se recomienda Docker Desktop)
* Ejecutar desde la carpeta del repositorio:
~~~~
docker-compose up -d
~~~~

### Instalación en el servidor ###
La primera vez arrancará el script de instalación. Siga los pasos que indica el asistente:
1. Bienvenida
2. Comprobación de los requisitos del servidor
3. Información de la base de datos
   * Para utilizar la base de datos del contenedor utiliza los siguientes datos:
     1. URL: localhost
     2. Database: (indiferente)
     3. User: root
     4. Password: (dejar este campo en blanco)
4. Creación de la base de datos
5. Creación de las tablas
6. Importación de datos de una versión anterior (Seleccionar NO)
7. Datos del Superusuario
8. Personalización de la aplicación:
   1. URL: http://localhost:8080
   2. Título de la aplicación: (indiferente)
   3. Nombre del Centro: (indiferente)
   4. Código del centro: (indiferente)
   5. Logo del centro: (sube una imagen del logo del centro, preferentemente apaisada)
   6. Finalización

### Instalación de módulos ###
Aunque este repositorio ya incluye módulos, es necesario activarlos para que funcionen.

Para ello ve al apartado "Administración/Configuración/Gestión de módulos". Allí activa el módulo de Préstamos y recarga la página.

### Visualización de errores ###
Durante el proceso de desarrollo, se puede crear un archivo vacío nombrado como 'desarrollo.php' en la raiz del sitio.
Mientras exista este archivo, todos los errores del servidor se mostrarán en la interaz de usuario.

### Instrucciones de publicación ###

* Publicación de Módulos
El paquete debe ir en un archivo ZIP cuyo nombre debe ser el número de versión.
La estructura de archivos debe ser completa, es decir:
/modules/nombredelmodulo  


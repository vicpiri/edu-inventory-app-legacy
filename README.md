# README #

Este es el repositorio del sistema de gestión de inventario y usuarios para centros educativos.

### Para qué es este repositorio? ###

* Este repositorio se ha creado para el usuo privado del autor. Si no eres el autor no estás autorizaco a utilizar ninguno de los archivos contenidos aquí.
* Version: 0.23 (Producción)
* [Learn Markdown](https://bitbucket.org/tutorials/markdowndemo)

### Configuración Vagrant###

* Instalar Virtual Box
* Instalar Vagrant
* Instalar Putty
* Instalar Git para windows
* Utilizar los archivos Vagrantfile y bootstrap.sh incluídos en el repositorio
~~~~
vagrant init ubuntu/xenial64

editamos VagrantFile y añadimos las opciones de 

  config.vm.box = "ubuntu/xenial64"
  config.vm.network :forwarded_port, guest: 80, host: 8080

vagant up

probar a ejecutar vagrant ssh, si no funciona realizar las acciones relacionadas con Putty

vagrant plugin install vagrant-multi-putty

vagrant putty (dará un error, pero generará el archivo clave OpenSSH

ejecutar putty y configurar la conexión con la clave generada

el usuario por defecto es: ubuntu

sudo apt-get update
sudo apt-get install -y apache2

sudo rm -rf /var/www/html
sudo ln -fs /vagrant /var/www/html

sudo apt-get update
sudo apt-get install mysql-server
sudo mysql_secure_installation //prescindible

sudo apt-get install php libapache2-mod-php php-mcrypt php-mysql

sudo apt-get update
sudo apt-get install phpmyadmin php-mbstring php-gettext
sudo apt-get install php-zip

~~~~


### Instrucciones de publicación ###

* Publicación de Módulos
El paquete debe ir en un archivo ZIP cuyo nombre debe ser el número de versión.
La estructura de archivos debe ser completa, es decir:
/modules/nombredelmodulo  

### Who do I talk to? ###

* Repo owner or admin
* Other community or team contact

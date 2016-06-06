# HTML5 Games Hub

Proyecto final de DAW

## Requisitos del proyecto

* [Node.JS](https://nodejs.org)
* [Composer](https://getcomposer.org/download/)

### Instrucciones de instalación en servidor local

1. Crear un host virtual que apunte a la carpeta `htdocs`
2. Ejecutar `composer install` y `npm install` en la raíz del proyecto
3. Hay que dar permisos de escritura en las carpetas `storage`, `htdocs`, `bootstrap/cache`
4. Configurar los datos de acceso a la BD en el fichero `.env`

### Pasos para compilar el tema de Bootstrap con Gulp:

1. Instalar `Node.JS`
2. Ejecutar el comando `npm install`
3. Ejecutar `gulp less` para compilar el LESS a CSS
4. Ejecutar `gulp copy` para copiar el CSS a la carpeta `htdocs`

### Crear la base de datos y rellenarla con datos usando Faker:

1. En la raíz del proyecto ejecutar los siguientes comandos:

- `php artisan migrate`
- `php artisan db:seed --class=DatabaseSeeder`

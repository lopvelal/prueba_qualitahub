# Nombre del Proyecto

Prueba técnica para QualitaHUB 

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:
- PHP (al menos 8.1)
- Composer
- npm 
- Un sistema de gestión de bases de datos (MySQL).

## Instalación

Sigue estos pasos para instalar el proyecto:

1. Clona el repositorio: https://github.com/lopvelal/prueba_qualitahub.git

2. Entra en el directorio del proyecto

3. Instala las dependencias de Composer: composer install

4. Crea una BD en MySQL

5. Copia el archivo .env.example a .env.

6. Genera una nueva clave de aplicación: php artisan key:generate

7. Genera una nueva clave de aplicación: php artisan storage:link

8. Configura tus variables de entorno en el archivo .env (base de datos, APP_URL, etc.).

9. Ejecuta las migraciones (y, opcionalmente, los seeders): php artisan migrate:fresh --seed

10. Instala las dependencias de Node: npm install

11. Compila los ficheros: npm run build

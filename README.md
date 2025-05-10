

🧪 INSTALACIÓN DEL PROYECTO LARAVEL – PRUEBA TÉCNICA

Este documento describe cómo instalar y ejecutar el proyecto Laravel utilizando solo Visual Studio Code, PHP, Composer y MySQL.

📋 REQUISITOS PREVIOS

- PHP >= 8.2 (verifica con: php -v)
- Composer (verifica con: composer -V)
- MySQL (ejecutando localmente)
- Visual Studio Code
- Node.js (opcional, solo si usas Vite)

🚀 PASOS DE INSTALACIÓN

1. Clonar el repositorio:

    git clone https://github.com/juniorferxd/Prueba-tecnica.git
    cd Prueba-tecnica

2. Abrir Visual Studio Code:

    code .

3. Instalar dependencias del proyecto:

    composer install

4. Crear archivo .env desde el ejemplo:

    cp .env.example .env

5. Configurar la base de datos en .env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=midlevel_api
    DB_USERNAME=root
    DB_PASSWORD=

⚠️ Asegúrate de tener la base de datos `prueba_tecnica` creada en tu gestor (phpMyAdmin o CLI de MySQL).

6. Generar la clave de la aplicación:

    php artisan key:generate

7. Ejecutar las migraciones:

    php artisan migrate

8. Levantar el servidor local:

    php artisan serve

Accede desde el navegador en:
    http://localhost:8000

🧪 SWAGGER (Documentación de la API)

1. Generar la documentación:

    php artisan l5-swagger:generate

2. Abrir en navegador:

    http://localhost:8000/api/documentation

🔍 TELESCOPE (Monitoreo de la aplicación)

    http://localhost:8000/telescope

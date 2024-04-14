REM Desplegar la aplicación en Windows

REM Comprobar si la red de contenedores ya existe
docker network inspect app-network >nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    REM Si la red no existe, crearla
    docker network create app-network
)

REM Levantar los contenedores
docker-compose -p micro-app up -d

REM Instalar las dependencias dentro del contenedor PHP
docker exec -it php-fpm composer install
docker exec -it php-fpm npm install
docker exec -it php-fpm npm run dev
docker exec -it php-fpm php bin/console doctrine:migrations:migrate --no-interaction
docker exec -it php-fpm php bin/phpunit --testdox

REM Mensaje de finalización
echo La aplicación ha sido desplegada exitosamente.
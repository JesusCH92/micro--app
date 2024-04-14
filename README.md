# MICRO APP
Stack tecnológico: PHP8.3(Symfony7), Nginx, MySQL y Docker.

La estructura de carpetas está basada en una arquitectura de cortes verticales, mientras que la app se ha trabajado con una arquitectura hexagonal.

## Requisitos previos
> [!IMPORTANT]
> **Debes tener instalado Docker y Docker Compose en tu equipo.**

> [!WARNING]
> **Estamos usando el puerto 8080 para el servidor local, y tiene que estar disponible para levantar nuestro servicio de nginx.**
> 
> **Estamos usando el puerto 3306 de mysql y debe estar disponible, si tiene un servidor en mysql encendido apaguelo para levantar la app.**


## Desplegar en: MAC, Linux, WSL2

- [ ] Debes ejecutar:

```shell
make deploy
```

## Desplegar en: Windows

- [ ] Instalar la network de los contenedores en caso de no tenerla instalada antes:

```shell
docker network create app-network
```

- [ ] Levantar los contenedores:

```shell
docker-compose -p micro-app up -d
```

- [ ] Modo interactivo: acceso al contenedor de PHP(php-fpm):

```shell
docker exec -it php-fpm bash 
```

- [ ] Después de entrar al contenedor de PHP(php-fpm), ver el paso anterior, dentro del contenedor ejecutar:

```shell
make install-in-container
```

## Acceso al sistema

- [ ] Después de desplegar el proyecto correctamente, debe acceder al siguiente enlace:

[**`proyecto web`**](http://localhost:8080/trips)

- [ ] Documentación de los API's usadas en el proyecto:

[**`documentación de las API's`**](http://localhost:8080/api/doc)
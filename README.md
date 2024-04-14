# MICRO APP
Stack tecnológico: PHP8.3(Symfony7), Nginx, MySQL y Docker.

La estructura de carpetas está basada en una arquitectura de cortes verticales, mientras que la app se ha trabajado con una arquitectura hexagonal.

## Requisitos previos
> [!IMPORTANT]
> **Debes tener instalado Docker y Docker Compose en tu equipo.**

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
docker-compose -p app up -d
```

- [ ] Modo interactivo: acceso al contenedor de PHP:

```shell
docker exec -it php-fpm bash 
```

- [ ] Después de entrar al contenedor de php-fpm, dentro del contenedor ejecutar:

```shell
make install-in-container
```

## Acceso al sistema

- [ ] Después de desplegar el proyecto correctamente, debe acceder al siguiente enlace:

[**`proyecto web`**](http://localhost:8080/trips)

- [ ] Documentación de los API's usadas en el proyecto:

[**`documentación de las API's`**](http://localhost:8080/api/doc)
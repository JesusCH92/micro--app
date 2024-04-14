#! /bin/bash

##	create-network:					crete network docker
create-network:
	docker network create app-network | true

##	start:							start containers
start:
	-@$(MAKE) create-network | true
	docker-compose -p micro-app up -d

##	install:						installing dependencies
install:
	-@docker exec -it php-fpm composer install
	-@docker exec -it php-fpm npm install
	-@docker exec -it php-fpm npm run dev
	-@docker exec -it php-fpm php bin/console doctrine:migrations:migrate --no-interaction
	-@docker exec -it php-fpm php bin/phpunit --testdox

##	deploy:							deploying app
deploy:
	-docker network create app-network | true
	-@docker exec -it php-fpm composer install
	-@docker exec -it php-fpm npm install
	-@docker exec -it php-fpm npm run dev
	-@docker exec -it php-fpm php bin/console doctrine:migrations:migrate --no-interaction
	-@docker exec -it php-fpm php bin/phpunit --testdox

##	install-in-container:			instalamos lo que necesita el proyecto
install-in-container:
	- composer install
	- npm install
	- npm run dev
	- php bin/console doctrine:migrations:migrate --no-interaction
	- php bin/phpunit --testdox

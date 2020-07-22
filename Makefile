all: help

help:
	@echo "\t  1. make install          - First installation"
	@echo "\t  2. make build            - Build(update) containers"
	@echo "\t  3. make build-pull       - Stops, gathers and builds docker containers"
	@echo "\t  4. make run              - Launching docker containers"
	@echo "\t  5. make kill             - Stopping docker"
	@echo "\t  6. make run-bg           - Launching docker containers in background"
	@echo "\t  7. make sh-php-fpm       - Access to php-fpm container"
	@echo "\t  8. make sh-nginx         - Access to nginx container"
	@echo "\t  9. make composer         - Launch 'composer install' in php-fpm"
	@echo "\t  10. make init            - Launch 'system:init' in php-fpm"
	@echo "\t  11. make phpunit         - Launch phpunit in php-fpm"
	@echo "\t  12. make phpstan         - Launch phpstan in php-fpm"

install: build-pull run-bg

build:
	@echo "building containers"
	@docker-compose build

build-pull:
	@echo "downloading and building containers"
	@docker-compose stop
	@docker-compose rm -f
	@docker-compose pull && docker-compose build

start-machine:
	@docker-machine start default

run:
	@echo "running dockera"
	@docker-compose up --force-recreate

run-bg:
	@echo "running docker in backgroud"
	@docker-compose up -d

kill:
	@echo "killing containers"
	@docker-compose kill

sh-php-fpm:
	@echo "sh in PHP-FPM"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh

sh-nginx:
	@echo "sh in NGINX"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep nginx` sh

composer:
	@echo "installing composera in php-fpm"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'composer install;'

init:
	@echo "running init"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'php bin/console system:init'

phpunit:
	@echo "running phpunit"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'php -dzend_extension=xdebug.so -dxdebug.coverage_enable=1 vendor/bin/phpunit --configuration phpunit.xml.dist'

phpstan:
	@echo "running phpunit"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'vendor/bin/phpstan analyse src tests --level=7 --memory-limit=-1'


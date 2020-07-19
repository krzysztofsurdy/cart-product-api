all: help

help:
	@echo "\t  1. make install          - Pierwsza instalacja"
	@echo "\t  2. make build            - Budowanie(update) kontenerów"
	@echo "\t  3. make build-pull       - Zatrzymuje, pobiera i buduje kontenery dockera"
	@echo "\t  4. make run              - Uruchamianie dockera"
	@echo "\t  5. make kill             - Ubija kontenery"
	@echo "\t  6. make run-bg           - Uruchamia docker w tle"
	@echo "\t  7. make sh-php-fpm       - Dostęp do kontenera php-fpm"
	@echo "\t  8. make sh-nginx         - Dostęp do kontenera nginx"
	@echo "\t  9. make composer         - Uruchamia 'composer install' w php-fpm"
	@echo "\t  10. make init            - Uruchamia 'system:init' w php-fpm"
	@echo "\t  11. make phpunit         - Uruchamia testy phpunit w php-fpm"
	@echo "\t  12. make phpstan         - Uruchamia testy phpstan w php-fpm"

install: build-pull run-bg

build:
	@echo "Budowanie kontenerow"
	@docker-compose build

build-pull:
	@echo "Pobieranie kontenerów dockera i ich budowanie"
	@docker-compose stop
	@docker-compose rm -f
	@docker-compose pull && docker-compose build

start-machine:
	@docker-machine start default

run:
	@echo "Uruchamiam dockera"
	@docker-compose up --force-recreate

run-bg:
	@echo "Uruchamiam dockera w tle"
	@docker-compose up -d

kill:
	@echo "Ubicie kontenerów"
	@docker-compose kill

sh-php-fpm:
	@echo "sh w PHP-FPM"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh

sh-nginx:
	@echo "sh w NGINX"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep nginx` sh

composer:
	@echo "Instalacja composera w php-fpm"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'composer install;'

init:
	@echo "inicjalizacja systemu"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'php bin/console system:init'

phpunit:
	@echo "odpalenie phpunit"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'php -dzend_extension=xdebug.so -dxdebug.coverage_enable=1 vendor/bin/phpunit --configuration phpunit.xml.dist'

phpstan:
	@echo "odpalenie phpunit"
	@docker exec -it `docker-compose ps |grep -Eo '^[^ ]+' |grep php-fpm` sh  -c \
	'vendor/bin/phpstan analyse src tests --level=7 --memory-limit=-1'


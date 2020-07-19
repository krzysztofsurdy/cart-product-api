# product-catalog-api
Product catalog API

## Uruchamianie
Aby uruchomic projekt, nalezy uruchomic komendy w nastepujacej kolejnosci
    
    1. make build
    2. make run
    3. make composer
    4. make init

## Makefile
MAKEFILE w katalogu / obsługuje następujące polecenia:

          1. make install          - Pierwsza instalacja
          2. make build            - Budowanie(update) kontenerów
          3. make build-pull       - Zatrzymuje, pobiera i buduje kontenery dockera
          4. make run              - Uruchamianie dockera
          5. make kill             - Ubija kontenery
          6. make run-bg           - Uruchamia docker w tle
          7. make sh-php-fpm       - Dostęp do kontenera php-fpm
          8. make sh-nginx         - Dostęp do kontenera nginx
          9. make composer         - Uruchamia 'composer install' w php-fpm
          10. make init            - Uruchamia 'system:init' w php-fpm
          11. make phpunit         - Uruchamia testy phpunit w php-fpm
          12. make phpstan         - Uruchamia testy phpstan w php-fpm

Sposób użycia: $ make polecenie

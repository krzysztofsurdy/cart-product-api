# Sample product / cart API

This is sample REST service that provides simple functionality of product store and shopping
cart. 

# Description

Solution is modelled as two "separate" microservices (although for simplicity living in
one PHP application). Product microservice provides REST endpoints that
allows to manipulate product and persist it in database using Event Sourcing. Cart microservice
provides REST endpoint for manipulating cart and product in cart and persist it in Redis,
separate from product database to allow scalability of both microservices.

## Design

Both APIs are communicating inside each other through Symfony Messenger.
Both Cart and Product are designed using Domain Driven Design and Event Driven Design.
Project communicates using CQRS (Command Query Responsibility Separation) pattern.
Product's persistance layer uses Event Sourcing to store event in DB and replays them each time
it is requested.

## Requirements

### 1. Products catalog API:

Our catalog contains the following products:
* Title Price
* Fallout 1.99
* Don’t Starve 2.99
* Baldur’s Gate 3.99
* Icewind Dale 4.99
* Bloodborne 5.99

The API should expose methods to:
1. Add a new product 
   - Product name should be unique
2. Remove a product
3. Update product title and/or price
4. List all of the products
   - There should be at least 5 products in the catalog (the ones in the table above)
   - This list should be paginated, max 3 products per page

### 2. Cart API

API that allow adding products to the carts. User can add multiple items of the same product
(max 10 units of the same product).

This API should expose methods to:
1. Create a cart
2. Add a product to the cart
3. Remove product from the cart
4. List all the products in the cart
   - User should not be able to add more than 3 products to the cart
   - You should return a total price of all the products in the cart

## API Documentation

API documentation is available under path [/v1/docs](https://cart-product-api.local/v1/docs) when 
Docker containers are running.

## How to run

```bash
# build containers
make build

# run containers
make run

# install dependencies
make composer

# initialize database and products
make init

# add domain to hosts
127.0.0.1 cart-product-api.local

# make sure tests pass (phpunit), code is clean (phpstan) 
make phpunit
make phpstan
```

## Makefile
MAKEFILE in directory delivers commands:

          1. make install          - First installation
          2. make build            - Build(update) container
          3. make build-pull       - Stops, gathers and build docker containers
          4. make run              - Launching docker containers
          5. make kill             - Stopping docker
          6. make run-bg           - Launching docker containers in background
          7. make sh-php-fpm       - Access to php-fpm container
          8. make sh-nginx         - Access to nginx container
          9. make composer         - Launch 'composer install' in php-fpm
          10. make init            - Launch 'system:init' in php-fpm
          11. make phpunit         - Launch phpunit in php-fpm
          12. make phpstan         - Launch phpstan winiphp-fpm

How to use: $ make command

## Libraries / frameworks used:

Software used in project include:

- [Docker](https://www.docker.com/)
- [Symfony 5](https://symfony.com/)
- [Prooph](http://getprooph.org/)
- [ramsey/uuid](https://github.com/ramsey/uuid)
- [webmozart/assert](https://github.com/webmozart/assert)
- [predis/predis](https://packagist.org/packages/predis/predis)
- [Swagger](https://swagger.io/)

## License

[MIT](LICENSE)

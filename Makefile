.PHONY: init start stop clean test format db composer_install

DOCKER_COMPOSE = docker-compose

init: clean
	$(DOCKER_COMPOSE) down --volumes --remove-orphans
	$(DOCKER_COMPOSE) up -d --build
	sleep 10
	$(DOCKER_COMPOSE) exec app php artisan migrate

start:
	$(DOCKER_COMPOSE) up -d

stop:
	$(DOCKER_COMPOSE) down

clean:
	$(DOCKER_COMPOSE) down --rmi all --volumes --remove-orphans
	$(MAKE) composer_install

test:
	$(DOCKER_COMPOSE) exec app php artisan test

format:
	./vendor/bin/php-cs-fixer fix

db:
	$(DOCKER_COMPOSE) exec postgres psql -U laravel -d laravel

composer_install:
	$(DOCKER_COMPOSE) run --rm app rm -rf vendor
	$(DOCKER_COMPOSE) run --rm app composer install

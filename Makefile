DOCKER_COMPOSE = docker-compose

init:
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

test:
	$(DOCKER_COMPOSE) exec app php artisan test

format:
	./vendor/bin/php-cs-fixer fix

db:
	$(DOCKER_COMPOSE) exec postgres psql -U laravel -d laravel

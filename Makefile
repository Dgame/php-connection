DOCKER_PHP_SERVICE = php-fpm

.PHONY: new composer-install composer-up db up kill test analyse

new: kill
	#cp .env.dist .env
	docker-compose up -d --build --remove-orphans
	make install
up:
	docker-compose up -d
kill:
	docker-compose kill
	docker-compose down --volumes --remove-orphans
test:
	docker-compose exec $(DOCKER_PHP_SERVICE) composer test
analyse:
	docker-compose exec $(DOCKER_PHP_SERVICE) composer analyse
install:
	docker-compose exec $(DOCKER_PHP_SERVICE) composer install --no-interaction --no-scripts --prefer-dist
update:
	docker-compose exec $(DOCKER_PHP_SERVICE) composer up --with-all-dependencies
validate:
	docker-compose exec $(DOCKER_PHP_SERVICE) composer validate

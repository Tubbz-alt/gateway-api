docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-build:
	docker-compose build

docker-pull:
	docker-compose pull

docker-push-rebuilt-php:
	docker build --file ./docker/production/php-fpm/Dockerfile --tag <<REGISTRY_NAME_HERE>>/gateway_api:php-fpm_master-1 .
	docker push <<REGISTRY_NAME_HERE>>/gateway_api:php-fpm_master-1

docker-push-rebuilt-mysql:
	docker build --file ./docker/production/mysql/Dockerfile --tag <<REGISTRY_NAME_HERE>>/gateway_api:mysql_master-1 .
	docker push <<REGISTRY_NAME_HERE>>/gateway_api:mysql_master-1

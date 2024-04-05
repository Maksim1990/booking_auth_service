start:
	docker-compose up -d

stop:
	docker-compose down -v

tests:
	docker exec app_php ./vendor/bin/phpunit
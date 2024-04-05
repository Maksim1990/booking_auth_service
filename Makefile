start:
	docker-compose up -d

db-seed:
	docker exec app_php php artisan db:seed

stop:
	docker-compose down -v

tests:
	docker exec app_php ./vendor/bin/phpunit
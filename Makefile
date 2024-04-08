install_and_start:
	docker-compose up -d
	docker exec app_php php artisan key:generate
	docker exec app_php php artisan jwt:secret --force

start:
	docker-compose up -d

db-seed:
	docker exec app_php php artisan db:seed

stop:
	docker-compose down -v

tests-setup:
	docker exec app_php cp .env.testing.example .env.testing
	docker exec app_php php artisan key:generate --env=testing
	docker exec app_php php artisan jwt:secret --env=testing --force

tests:
	docker exec app_php ./vendor/bin/phpunit

api-docs-generate:
	docker exec app_php php artisan l5-swagger:generate

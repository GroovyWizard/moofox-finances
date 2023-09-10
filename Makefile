permission-fix:
	cd backend/laravel && sudo chown -R 1000:1000 . && sudo chown -R www-data:www-data storage bootstrap/* && sudo chmod -R 777 storage

run-backend:
	cd backend/laravel && docker-compose up -d

run-frontend:
	cd moofox-finances && docker-compose up -d

run:
	make run-backend && make run-frontend

sh:
	docker exec -it --user=root laravel-laravel.test-1 /bin/bash

migrate:
	docker exec -it --user=root laravel-laravel.test-1 /bin/bash -c "php artisan migrate"

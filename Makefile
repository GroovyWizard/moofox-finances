permission-fix:
	cd backend/laravel && sudo chown -R www-data:www-data storage bootstrap/* && sudo chmod -R 777 storage

run-backend:
	cd backend/laravel && docker-compose up
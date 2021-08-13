# Appcorp task
Its a movie seeder API Service from https://www.themoviedb.org using laravel 8.
In this project you can create movies and categories using seeder and queue 
also you can filter movies by category id and sort it by popular and rated

## Instrucitons to Run Project

1- Create new mysql database with name "appcorp-task"

2- create .env from .env.example and do these changes
- DB_DATABASE=appcorp-task
- DB_USERNAME=your username
- DB_PASSWORD= yout password
- QUEUE_CONNECTION=database

3- run this commands 
- composer install
- php artisan migrate
- php artisan queue:work
- php artisan db:seed

4- to get all the movies  
- php artisan serve
- http://127.0.0.1:8000/movies   -> to get all movies
- http://127.0.0.1:8000/movies?category_id=5   -> to get all movies by category
- http://127.0.0.1:8000/movies?popular|desc&rated|asc&category_id=878 -> to get movies by category and sorted by popular and rated



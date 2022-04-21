# Laravel API Documentation with OpenAPI/Swagger

- - - - -

## Screenshots 

![Post Employees](https://drive.google.com/file/d/1xJLLKbYnEZqO80MUyEpK5SzragpXP6O0/view?usp=sharing)

- - - - -

## How to use

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan migrate:fresh --seed__ 
- That's it: launch the URL `/api/docs` with local server
- Regenerate documentation with `php artisan l5-swagger:generate` command and launch `php artisan serve` 
- Starting Laravel development server: `http://127.0.0.1:8000`
- - - - -
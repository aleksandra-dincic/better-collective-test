## Installation
1. Clone the repository;
2. Create a virtual host to the public directory;
3. Make .env file from .env.example file;
4. Install dependencies
```
cd 'pathToProject'
composer install
```
4. Run ``` php artisan key:generate ``` to generate APP_KEY for your environment;
5. Run collection _Better Collective Test.postman_collection.json_ to test REST API
6. Run tests 
```
cd 'pathToProject'
php artisan test
```

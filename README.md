# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. Official Documentation
This project is developed in php 8.1.0 version to install this php version checkout this article.

```bash
https://computingforgeeks.com/how-to-install-php-on-ubuntu-linux-system/
```

clone repository:

```bash
git@github.com:harshildave/MPR-Laravel.git
```

Switch to the repo folder:

```bash
cd MPR-Laravel
```

Install all the dependencies using composer:

```bash
composer install
```

Copy the example env file and make the required configuration changes in the .env file:

```bash
cp .env.example .env
```

Generate a new application key:

```bash
php artisan key:generate
```

Run the database migrations (Set the database connection in .env before migrating):

```bash
php artisan migrate
```

Run the database seeder and you're done

```bash
php artisan db:seed
```

Generate encryption keys :

```bash
php artisan passport:keys

```

Start the local development server:

```bash
php artisan serve

```

Now make changes in .env and database changes as per your requirement.  
You can now access the server at http://localhost:8000

## License

[MIT](https://choosealicense.com/licenses/mit/)

# laravel-web-app

## Installation

Clone the repository-
```
git clone https://github.com/davuteryilmaz15/laravel-web-app.git
```

Then cd into the folder with this command-
```
cd laravel-web-app
```

Then do a composer install
```
composer install
```

Then create a environment file using this command-

linux, mac os
```
cp .env.example .env
```
windows
```
copy .env.example .env
```

Then edit `.env` file with appropriate credential for your database server. Just edit these three parameter(`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

Then create a database named `todos` and then do a database migration using this command-
```
php artisan migrate
```

Then run seeders using thins command-

This seeder will add admin to the users table and will define admin and standard roles.
```
php artisan db:seed
```

At last generate application key, which will be used for password hashing, session and cookie encryption etc.
```
php artisan key:generate
```

## Run server

Run server using this command-
```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.
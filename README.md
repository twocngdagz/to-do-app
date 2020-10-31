# ToDo App
ToDo App, that allows users to register, log in, and create tasks that are saved against their account.
## Installation Steps
**Clone the repo**
```
https://github.com/twocngdagz/to-do-app.git
```
**Run composer install**
```
composer install
```
**Run npm install**
```
npm install
```
**Compile Vue.js Components**
```
npm run prod
```
**Create .env**
```
cp .env.example .env
```
**Generate APP_KEY**
```
php artisan key:generate
```

**Configure MySQL connection details in .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database name}
DB_USERNAME={database user}
DB_PASSWORD={database password}
```
**Run database migrations and seeders**
```
php artisan migrate
```

## PHPUnit Test
To run the unit test, go to the project root and run
```
phpunit
```

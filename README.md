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

## Docker Installation
**Run the following command in the root project**
```
./develop up -d
./develop composer install
./develop npm install
```
**Compile Assets**
```
./develop npm run prod
```
**Update .env file**
```
DB_HOST=mysql
DB_DATABASE=todo
DB_USERNAME=root
DB_PASSWORD=secret

./develop art migrate
```

**Run PHPUnit test**
```
./develop test
```
**Open Browser**
```
http://localhost:8000
Login or Register and use the app
```


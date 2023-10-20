# Ghars|Codex-kw.com

## Project Description

## Prerequisite
- PHP 8.0
- Laravel 8.12
- Mysql for database

## Installation

### Step 1.
- Begin by cloning this repository to your machine
```
git clone `repo url` 
```

- Install dependencies
```
composer install,
npm install && npm run dev
```

- Create environmental file and variables
```
cp .env.example .env
```

- Generate app key
```
php artisan key:generate
```

### Step 2
- Next, create a new database and reference its name and username/password in the project's .env file.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

- Run migration
```
php artisan migrate or php artisan migrate:fresh
```

### Step 3
- before start, you need to run table seeders
```
php artisan db:seed
```

### Step 4
- To start the server, run the command below
```
php artisan serve
```

## Application Route
```
http://127.0.0.1:8000
```


## Author
- All rights reserved to Codex-kw.
"# ghars" 
"# ghars" 

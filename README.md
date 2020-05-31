# WGTCRM Backend

## Local Dev installation

### 1. Download Project

Clone the project:

```
git clone https://github.com/WGT-hq/wgtcrm-backend.git
```

And access `wgtcrm-backend` directory.

### 2. Configure your development environment

You must copy the .env.example file to a new file named .env

```
cp .env.example .env
```

### 3. Download and start the containers

[Docker-compose](https://docs.docker.com/compose/install/) must be installed.

Run the following command in your terminal:

```
docker-compose up -d
```

### 4. Access container terminal

```
docker-compose exec wgtcrm-php bash
```

### 5. Download PHP Composer dependencies

```
composer update
```
### 6. Build your database - Run migrations

```
php artisan migrate
```

6.1. Refresh the database and run all database seeds

```
php artisan migrate:refresh --seed
```

### 7. Preloading data (optional)

7.1. Executing All Seeders

```
php artisan db:seed
```

7.2. Executing Individual Seeder

```
php artisan db:seed --class=UsersSeeder
php artisan db:seed --class=ProfanitySeeder
```

### 8. Usage

Open your GraphQL client and run the following query:

```
{
    hello
}
```

The response will be:
```
{
    "data": {
        "hello": "it is working!"
    }
}
```

### Extra commands

#### Regenerate Composer's autoloader:

```
composer dump-autoload
```
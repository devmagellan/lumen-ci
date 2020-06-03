# WGTCRM Backend

## Patterns used

 * [GraphQL pattern](https://graphql.org) (package: [nuwave/lighthouse](https://lighthouse-php.com/))

 * [Service layer pattern](https://en.wikipedia.org/wiki/Service_layer_pattern)
 
 * [Repository pattern](https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5) (package: [prettus/l5-repository](https://github.com/andersao/l5-repository))
 
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

### 7. Usage

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

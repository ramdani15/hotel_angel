# Rest API Project Hotel Angel with Laravel and MongoDB

## Description
Have 2 roles user : Admin (```super```) and Customer (```customer```).

## Requirement
Install ```mongodb``` on your system (``` apt-get ``` or the like) and don't try to install with ```pecl```:
```bash
sudo pecl install mongodb
```

## Installation

Install package with ```composer``` :

```bash
composer install
```

Migrate Table or Collections:
```bash
php artisan migrate
```

Add dummy data with seeder:
```bash
php artisan db:seed
```

For reset data :
```bash
php artisan migrate:refresh --seed
```
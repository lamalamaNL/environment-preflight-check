## Laravel Environment Preflight Check
[![Latest Version on Packagist](https://img.shields.io/packagist/v/lamalama/preflight-check.svg?style=flat-square)](https://packagist.org/packages/lamalama/laravel-wishlist)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://github.styleci.io/repos/371396221/shield?branch=main)](https://github.styleci.io/repos/371396221)
[![Total Downloads](https://img.shields.io/packagist/dt/lamalama/preflight-check.svg?style=flat-square)](https://packagist.org/packages/lamalama/laravel-wishlist)


With this package we can check which .env variables are needed to run this project. 

### Installation 

<br>

```
composer require lamalama/preflight-check
```
then 

```
php artisan vendor:publish --provider="Lamalama\PreflightCheck\PreflightChecksServiceProvider"
```

for adding the check into composer install add this to your composer.json:<br> 

```
"scripts": {

        ...

        "post-install-cmd": [
            "php artisan preflight:check"
        ],

        ...
    },


```

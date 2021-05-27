## Environment Preflight Check


With this package we can check which .env variables are needed to run this project. 

### Installation 

<br>

```
composer require lamalamaNL/environment-preflight-check
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

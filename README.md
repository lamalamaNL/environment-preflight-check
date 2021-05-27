## Environment Preflight Check


With this package we can check which .env variables are needed to run this project. 

### Installation 

<br>


1: composer require lamalamaNL/environment-preflight-check <br>
2: php artisan vendor:publish --provider="Lamalama\PreflightCheck\PreflightChecksServiceProvider"
3: for adding the check into composer install add this to your composer.json:<br> 
<br>'"scripts": {

        ...

        "post-install-cmd": [
            "php artisan preflight:check"
        ],

        ...
    },'


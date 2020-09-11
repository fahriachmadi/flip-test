# FLIP TEST
Disbursement API


##  Features

  - Send disbursement data to 3rd party, _Slightly Big flip_
  - Save detailed disbursement data from 3rd party to local DB
  - Check disbursement status and update information to local DB


### Tech

* [Laravel] - PHP framework all in for API and templating
* [Heroku] - Deployment Service


### Installation

This service requires __PHP__  >= 7.2.5+ and [Composer](https://getcomposer.org/) as dependency manager.

Install the dependencies and devDependencies and start the server.

```sh
$ cd flip-test
$ cp .env-example .env
Configure env with your local DB configuration

Install dependencies and migrate DB
$ composer install
$ php artisan migrate

Run service
$ php artisan serve
```

For testing application ...

```sh
$ php artisan test
```


----

Created by Fahri Achmadi with Laravel

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

Install dependencies, generate key, and migrate DB
$ composer install
$ php artisan key:generate
$ php artisan migrate

Run service
$ php artisan serve
```

For testing application ...

```sh
$ php artisan test
```

### API Endpoint

Base dev url : http://localhost:8000/

_Send Disbursement_

Field:
- `bank_code`
- `account_number`
- `amount`
- `remark`
```http
POST send HTTP/1.1
Content-Type: application/x-www-form-urlencoded
```

_Check Status_
```http
GET /send/{transaction_id} HTTP/1.1
```

### Step to send Request via UI
- Open : http://localhost:8000/
- Fill in field account number, bank code, amount, and remark
- Click Submit Button
- See output in white box

### Step to check status via UI
- Open : http://localhost:8000/check-status
- Fill in field transaction id
- Click Submit Button
- See output in white box 


### Notes
- Can deploy to heroku with configuration first
- Jobs and queue still not work




Created by Fahri Achmadi with Laravel

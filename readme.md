# school-management-system(SMS)


# Features
- Application
- Admission
- Attendance
- Exam
- Result
- Certificate
- Fees
- Accounting
- Library
- Hostel
- Employees
- Leave manage
- Reports
- Front-end website

# Installation and use

## Dependency
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- NodeJS, npm, webpack

```
```
$ cd school-management-system
```
```
$ cp .env.example .env
```
**Change configuration according to your need in ".env" file and create Database**
```
$ composer install
```
```
$ php artisan migrate
```
```
$ php artisan db:seed
```
**Load demo data**
```
$ php artisan db:seed --class DemoSiteDataSeeder
```
**Clear cache**
```
$ sudo php artisan cache:clear
```
```
$ npm install
```
```
$ npm run backend-prod
```
```
$ npm run frontend-prod
```
```
$ php artisan serve
```
Now visit and login: http://localhost:8000 \
username: admin\
password: demo123


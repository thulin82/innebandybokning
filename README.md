# [Innebandybokning](https://github.com/thulin82/innebandybokning)
[![Build Status](https://travis-ci.org/thulin82/innebandybokning.svg?branch=master)](https://travis-ci.org/thulin82/innebandybokning)
[![Build Status](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/build.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/?branch=master)

## Requirements

* [PHP](http://php.net/) - The latest version of PHP is highly recommended
* MySQL or similar dB
* [Bootstrap](http://getbootstrap.com/) - Bootstrap for frontend
* [PHPMailer](https://github.com/PHPMailer/PHPMailer) - In order to use the mailing functions (reminders)

## SQL

### Tables
```SQL
CREATE TABLE `password` (
  `id` int,
  `user` varchar,
  `password` varchar 
);
CREATE TABLE `users` (
  `id` int,
  `name` varchar,
  `mail` varchar,
  `attend` int,
  `guests` int,
  `nbr_of_attends` int
);
CREATE TABLE `variables` (
  `id` int,
  `name` varchar,
  `value` int
);
CREATE TABLE `weekdata` (
  `id` int,
  `week` int,
  `attended_a` int,
  `attended_g` int,
  `currentweek` int,
  `date` varchar
);
```
### User Data
Replace these varibales in connect.php with your dB-info
```php
$mysql_server = "SERVER_NAME";
$mysql_user = "USER_NAME";
$mysql_password = "USER_PASSWORD";
$mysql_database = "DATABASE_NAME";
```

© Markus Thulin 2015-

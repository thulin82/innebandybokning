# [Innebandybokning](https://github.com/thulin82/innebandybokning)
[![Build Status](https://travis-ci.org/thulin82/innebandybokning.svg?branch=master)](https://travis-ci.org/thulin82/innebandybokning)
[![Build Status](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/build.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/?branch=master)

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
  `password_hash` varchar
);
CREATE TABLE `stats` (
  `id` int,
  `name` varchar,
  `total_leader` int,
  `season_leader` int,
  `aut2012` int,
  `spring2013` int,
  `aut2013` int,
  `spring2014` int,
  `aut2014` int,
  `spring2015` int,
  `aut2015` int,
  `spring2016` int,
  `nbr_seasons` int
);
CREATE TABLE `users` (
  `id` int,
  `name` varchar,
  `mail` varchar,
  `attend` int,
  `guests` int,
  `coop` int,
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
Replace these varibales in _maila.php with your mail-info
```php
$gmail_account  = 'GMAIL_ACCOUNT';
$gmail_password = 'GMAIL_PASSWORD';
$gmail_title    = 'GMAIL_TITLE';
$gmail_body     = 'GMAIL_BODY';
```

© Markus Thulin 2015-

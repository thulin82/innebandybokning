# [Innebandybokning](https://github.com/thulin82/innebandybokning)
[![Build Status](https://travis-ci.org/thulin82/innebandybokning.svg?branch=master)](https://travis-ci.org/thulin82/innebandybokning)
[![Build Status](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/build.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/thulin82/innebandybokning/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/thulin82/innebandybokning/?branch=master)

## Requirements

* [Composer](https://getcomposer.org) - Composer is used for dependency management
* MySQL Database

## Install
* Run `composer install` to install dependencies
* Run `vendor/bin/phinx migrate -e development` to set up database
* Run `vendor/bin/phinx seed:run` to seed test data


### User Data
Replace these variables in connect.php with your dB-info
```php
$mysql_server = "SERVER_NAME";
$mysql_user = "USER_NAME";
$mysql_password = "USER_PASSWORD";
$mysql_database = "DATABASE_NAME";
```
Replace these variables in _maila.php with your mail-info
```php
$gmail_account  = 'GMAIL_ACCOUNT';
$gmail_password = 'GMAIL_PASSWORD';
$gmail_title    = 'GMAIL_TITLE';
$gmail_body     = 'GMAIL_BODY';
```

© Markus Thulin 2015-

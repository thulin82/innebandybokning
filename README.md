# [Innebandybokning](https://github.com/thulin82/innebandybokning)
Booking page for Innebandy

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

© Markus Thulin 2015-

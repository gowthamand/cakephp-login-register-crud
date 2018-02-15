# CakePHP Application Login, Register, Crud

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download `git clone https://github.com/gowthamand/cakephp-login-register-crud`.

            If Composer is installed globally, run

2. Run `composer update`.

3. Configure database config/app.php

4. `CREATE TABLE `users` (
      `id` int(10) UNSIGNED NOT NULL,
      `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
      `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
      `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
      `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
      `created` datetime DEFAULT NULL,
      `modified` datetime DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
    ALTER TABLE `users`
      ADD PRIMARY KEY (`id`); 
`
You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration relevant for your application.

## Layout

The app skeleton uses a subset of `Bootstarap 4` custom design 

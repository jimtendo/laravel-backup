# Laravel-Backup


## Installation

Add requirement to your composer file

- "jimtendo/laravel-backup": "dev-master",

Add the Service Provider to file app/config/app.php

- Jimtendo\LaravelBackup\LaravelBackupServiceProvider

Publish the configuration file and insert your keys and desired databases
and folders for backup.

- php artisan config:publish jimtendo/laravel-backup
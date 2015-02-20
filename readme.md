# Laravel-Backup

Amazon S3 backup for Laravel V4.

Can back up:
- Databases
- Folders

... to an S3 account.


## Installation

Add requirement to your composer file

- "jimtendo/laravel-backup": "dev-master",

Add the Service Provider to file app/config/app.php

- Jimtendo\LaravelBackup\LaravelBackupServiceProvider

Publish the configuration file and insert your keys and desired databases
and folders for backup into the resulting file.

- php artisan config:publish jimtendo/laravel-backup


## Usage

The following commands backup the databases

- php artisan backup:database
- php artisan backup:folder
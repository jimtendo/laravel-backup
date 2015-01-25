<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| AWS Key
	|--------------------------------------------------------------------------
	|
	| Find or generate this using Amazon's IAM service.
	|
	*/

	'key' => 'YOURKEY',

	/*
	|--------------------------------------------------------------------------
	| AWS Secret
	|--------------------------------------------------------------------------
	|
	| Find or generate this using Amazon's IAM service.
	|
	*/

	'secret' => 'YOURSECRET',
	
    /*
    |--------------------------------------------------------------------------
    | AWS Region
    |--------------------------------------------------------------------------
    |
    | The region to use. For a full-list of available regions see:
    | http://docs.aws.amazon.com/aws-sdk-php/latest/class-Aws.Common.Enum.Region.html
    |
    */

    'region' => \Aws\Common\Enum\Region::AP_SOUTHEAST_2,
	
    /*
    |--------------------------------------------------------------------------
    | Databases to backup
    |--------------------------------------------------------------------------
    |
    | Associative Array of databases to backup. The index of the array is the
    | Laravel connection name. The value is the bucket and folder it should
    | be put under on S3.
    |
    */
    
    'databases' => [ 'mysql' => 'bucket/path/backup-' . date('Y-m-d_H:i:s') . '.sql' ],
	
    /*
    |--------------------------------------------------------------------------
    | Folders to backup
    |--------------------------------------------------------------------------
    |
    | Associative Array of folders to backup. The index of the array is the
    | path to the local folder. The value is the bucket and folder it should
    | be put under on S3.
    |
    */

    'folders' => [ base_path() . '/public/uploads' => 'bucket/path' ],

);

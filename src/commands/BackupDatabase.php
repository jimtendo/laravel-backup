<?php namespace Jimtendo\LaravelBackup\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BackupDatabaseCommand extends Command {

    /**
    * The console command name.
    *
    * @var string
    */
    protected $name = 'backup:database';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Backup databases to an S3 bucket';
    
    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Get the console command arguments.
    *
    * @return array
    */
    protected function getArguments()
    {
        return array();
    }

    /**
    * Get the console command options.
    *
    * @return array
    */
    protected function getOptions()
    {
        return array();
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function fire()
    {
        $this->info('Backing up databases');
        
        $client = \Aws\S3\S3Client::factory([
            'key' => \Config::get('laravel-backup::key'),
            'secret' => \Config::get('laravel-backup::secret'),
            'region' => \Config::get('laravel-backup::region'),
        ]);
        
        foreach (\Config::get('laravel-backup::databases') as $connection=>$remote) {
            
            // Get the bucket and path
            $bucketAndPath = explode('/', $remote, 2);
            
            // Set the temporary file
            $file = basename($bucketAndPath[1]);
            $tempFile = storage_path() . '/' . $file;
            
            // Get database configuration
            $username = \Config::get('database.connections.' . $connection . '.username');
            $password = \Config::get('database.connections.' . $connection . '.password');
            $database = \Config::get('database.connections.' . $connection . '.database');
            $host = \Config::get('database.connections.' . $connection . '.host');
            $port = \Config::get('database.connections.' . $connection . '.port', 3306);
            
            // Create SQL Dump
            exec("mysqldump --routines --host=$host --port=$port --user=$username --password=$password $database > '$tempFile'");
            
            // Compress the dump
            exec("gzip '$tempFile'");
            
            // Upload to S3
            $client->putObject(array('Bucket'=>$bucketAndPath[0], 'Key'=>$bucketAndPath[1] . '.gz', 'SourceFile'=>$tempFile . '.gz', 'ACL'=>'public-read'));
            
            // Delete temp file
            unlink($tempFile . '.gz');
        }
    }
}

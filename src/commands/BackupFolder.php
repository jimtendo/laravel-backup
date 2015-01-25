<?php namespace Jimtendo\LaravelBackup\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BackupFolderCommand extends Command {

    /**
    * The console command name.
    *
    * @var string
    */
    protected $name = 'backup:folder';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Backup a local folder to S3';
    
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
        $this->info('Backing up folders');

        $client = \Aws\S3\S3Client::factory([
            'key' => \Config::get('laravel-backup::key'),
            'secret' => \Config::get('laravel-backup::secret'),
            'region' => \Config::get('laravel-backup::region'),
        ]);
        
        foreach (\Config::get('laravel-backup::folders') as $local=>$remote) {
        
            // Show message
            $this->info('- ' . $local . ' to ' . $remote);
        
            // Get the bucket and path
            $bucketAndPath = explode('/', $remote, 2);
            
            // If there is a path, upload to it
            if (count($bucketAndPath) > 1) {
                $client->uploadDirectory($local, $bucketAndPath[0], $bucketAndPath[1]);
            }
            
            // Otherwise, just throw it in the root directory
            else {
                $client->uploadDirectory($local, $bucketAndPath[0]);
            }
        }
    }
    
}

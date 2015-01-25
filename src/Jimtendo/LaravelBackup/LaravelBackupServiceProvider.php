<?php namespace Jimtendo\LaravelBackup;

use Illuminate\Support\ServiceProvider;

class LaravelBackupServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('jimtendo/laravel-backup');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerArtisanCommands();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
	
    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerArtisanCommands()
    {
        $this->commands([
            'Jimtendo\LaravelBackup\Commands\BackupFolderCommand',
            'Jimtendo\LaravelBackup\Commands\BackupDatabaseCommand',
        ]);
    }

}

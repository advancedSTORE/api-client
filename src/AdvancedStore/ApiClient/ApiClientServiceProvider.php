<?php namespace AdvancedStore\ApiClient;

use Illuminate\Support\ServiceProvider;
use AdvancedStore\ApiClient\Controllers\ApiClientController;

class ApiClientServiceProvider extends ServiceProvider {

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
		$this->package('advanced-store/api-client');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
        $this->app['apiClient'] = $this->app->share( function(){
            return new ApiClientController;
        });
		return array();
	}

}

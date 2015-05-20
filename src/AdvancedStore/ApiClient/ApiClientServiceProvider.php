<?php namespace AdvancedStore\ApiClient;

use Illuminate\Support\ServiceProvider;
use AdvancedStore\ApiClient\ApiCore\ApiClientController;

class ApiClientServiceProvider extends ServiceProvider {

	const PACKAGE_NAME = 'api-client';

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
		$this->mergeConfigFrom(
			__DIR__.'/../config/apiClientConfig.php',
			self::PACKAGE_NAME
		);
		/*$this->publishes([
			__DIR__.'/../ApiCore/'
		], self::PACKAGE_NAME);*/
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
        $this->app->bindShared('apiClient', function(){
            return new ApiClientController;
        });
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

}

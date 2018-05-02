<?php

namespace Ichikawayac\LogViewer;

use Illuminate\Support\ServiceProvider;

class LogViewerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->loadViewsFrom(__DIR__.'/views', 'logviewer');
		$this->loadTranslationsFrom(__DIR__.'/lang', 'logviewer');

		$this->publishes([
			__DIR__.'/views' => resource_path('views/vendor/logviewer'),
			__DIR__.'/lang' => resource_path('lang/vendor/logviewer'),
		]);

	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}

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

<?php

namespace Ichikawayac\LogViewer;

class Log
{
	public $date;
	public $env;
	public $level;
	public $message;

	protected static $defined_envs = [
			'production'  => 'primary',
			'staging'     => 'primary',
			'test'        => 'primary',
			'development' => 'primary',
			'local'       => 'primary',
	];

	protected static $defined_levels = [
			'EMERGENCY' => 'danger',
			'ALERT'     => 'danger',
			'CRITICAL'  => 'danger',
			'ERROR'     => 'danger',
			'WARNING'   => 'warning',
			'NOTICE'    => 'warning',
			'INFO'      => 'info',
			'DEBUG'     => 'dark',
	];

	public function __construct($content)
	{
		$reg = '/^\[(?P<date>\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2})\] (?P<env>\w+)\.(?P<level>\w+): (?P<message>[\s\S]*$)/';

		preg_match_all($reg, $content, $matches);
		
		$this->date    = $matches['date'][0]    ?? null;
		$this->env     = $matches['env'][0]     ?? null;
		$this->level   = $matches['level'][0]   ?? null;
		$this->message = $matches['message'][0] ?? null;
	}

	public static function create($content)
	{
		return new static($content);
	}

	public function envClass()
	{
		return static::$defined_envs[$this->env];
	}

	public function levelClass()
	{
		return static::$defined_levels[$this->level];
	}
}

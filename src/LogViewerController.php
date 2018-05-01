<?php

namespace Ichikawayac\LogViewer;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LogViewerController extends BaseController
{
	public function index()
	{
		$files = static::getLogFileList();
		return view('logviewer::index', compact('files'));
	}

	public function show(Request $request, $date_str)
	{
		$path = static::getLogFilePath($date_str);
		$logs = static::analyzeLogFile($path);

		return view('logviewer::show', compact('logs'));
	}



	private static function getLogFileList()
	{
		return array_map('basename', glob(storage_path('logs/*.log')));
	}

	private static function getLogFilePath($date_str)
	{
		$file = array_map('realpath', glob(storage_path("logs/{$date_str}")));
		return array_shift($file);
	}

	/**
	 * ログ1件ごとに分割する（複数行対応）
	 */
	private static function analyzeLogFile($path)
	{
		$handle = fopen($path, 'r');

		$contents = [];
		$tmp = '';

		do {
			$current = fgets($handle);
			if (static::isNextLine($current)) {
				// 空行スキップ
				if($tmp) {
					$contents[] = Log::create($tmp);
				}
				$tmp = $current;
			}
			else {
				$tmp .= $current;
			}
		} while ($handle && !feof($handle));

		return $contents;
	}


	private static function isNextLine($str)
	{
		return preg_match('/^\[\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}\]/', $str);
	}
}

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


	public function show(Request $request, $filename)
	{
		$path = static::getLogFilePath($filename);

		if (!$path) {
			return redirect()->route('logviewer::index');
		}

		$logs = static::analyzeLogFile($path);
		return view('logviewer::show', compact('logs', 'filename'));
	}


	/**
	 * get list of the log file name
	 * @return array filename list
	 */
	private static function getLogFileList()
	{
		return array_map('basename', glob(storage_path('logs/*.log')));
	}


	/**
	 * get log file path from filename
	 * @param string $filename
	 * @return string|null full file path
	 */
	private static function getLogFilePath($filename)
	{
		$file = array_map('realpath', glob(storage_path("logs/{$filename}")));
		return array_shift($file);
	}


	/**
	 * explode log contents
	 * @param string $path path to log file
	 * @return array
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


	/**
	 * text contain datetime string
	 * @return bool
	 */
	private static function isNextLine($str)
	{
		return preg_match('/^\[\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}:\d{2}\]/', $str);
	}
}

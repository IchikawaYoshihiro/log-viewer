<?php

// show log file list
Route::get('logs', 'Ichikawayac\LogViewer\Controllers\LogViewerController@index')->name('logviewer::index');

// show contents of the log file
Route::get('logs/{filename}', 'Ichikawayac\LogViewer\Controllers\LogViewerController@show')->name('logviewer::show');

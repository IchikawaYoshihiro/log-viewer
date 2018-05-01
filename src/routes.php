<?php

// show log file list
Route::get('logs', 'Ichikawayac\LogViewer\LogViewerController@index')->name('logviewer::index');

// show contents of a log file
Route::get('logs/{ymd}', 'Ichikawayac\LogViewer\LogViewerController@show')->name('logviewer::show');

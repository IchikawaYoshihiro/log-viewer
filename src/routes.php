<?php

// show log file list
Route::get('logs', 'Ichikawayac\LogViewer\LogViewerController@index')->name('logviewer::index');

// show contents of the log file
Route::get('logs/{filename}', 'Ichikawayac\LogViewer\LogViewerController@show')->name('logviewer::show');

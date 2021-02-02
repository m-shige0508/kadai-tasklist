<?php

Route::get('/', 'TasksController@index');

Route::resource('tasklist', 'TasksController');
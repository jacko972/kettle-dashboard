<?php

Route::group(['middleware' => 'logged_in'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    // Authentication routes
    Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('auth/login', ['as' => 'doLogin', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('auth/logout', ['as' => 'doLogout', 'uses' => 'Auth\AuthController@getLogout']);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']);

        Route::group(['prefix' => 'notes'], function () {
            Route::get('/', ['as' => 'notes.index', 'uses' => 'NotesController@index']);
            Route::get('all', ['as' => 'notes.all', 'uses' => 'NotesController@all']);
            Route::post('/', ['as' => 'notes.save', 'uses' => 'NotesController@save']);
            Route::post('/{id}', ['as' => 'notes.update', 'uses' => 'NotesController@update']);
            Route::delete('/{id}', ['as' => 'notes.destroy', 'uses' => 'NotesController@destroy']);
        });

        Route::group(['prefix' => 'tasks'], function () {
            Route::get('/bycategory/{id}', ['as' => 'tasks.bycategory', 'uses' => 'TasksController@byCategory']);
            Route::get('/categories', ['as' => 'task-categories.all', 'uses' => 'TaskCategoryController@all']);
            Route::post('/categories', ['as' => 'task-categories.save', 'uses' => 'TaskCategoryController@save']);
            Route::post('/categories/{id}', ['as' => 'task-categories.update', 'uses' => 'TaskCategoryController@update']);
            Route::delete('/categories/{id}', ['as' => 'task-categories.destroy', 'uses' => 'TaskCategoryController@destroy']);
            Route::get('/', ['as' => 'tasks.index', 'uses' => 'TasksController@index']);
            Route::get('all', ['as' => 'tasks.all', 'uses' => 'TasksController@all']);
            Route::post('/', ['as' => 'tasks.save', 'uses' => 'TasksController@save']);
            Route::post('/{id}', ['as' => 'tasks.update', 'uses' => 'TasksController@update']);
            Route::delete('/{id}', ['as' => 'tasks.destroy', 'uses' => 'TasksController@destroy']);
        });
    });
});

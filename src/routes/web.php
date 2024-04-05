<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/test', function () {
    class Test
    {
        public function __construct(private readonly object $obj)
        {
        }
    }

    $test = new Test(new stdClass);
// Legal interior mutation.
    $test->objs =1;


    dd($test->objs);

});

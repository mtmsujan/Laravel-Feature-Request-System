<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


Route::get('update', function(){
    Artisan::call('migrate --force');
    File::deleteDirectory(public_path('storage'));
    Artisan::call('storage:link');
    Artisan::call('optimize:clear');

});

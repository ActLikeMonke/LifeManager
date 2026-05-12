<?php

use Illuminate\Support\Facades\Route;

// This tells Laravel: "Any URL that isn't an API call should load the Vue app"
Route::get('/{any}', function () {
    return view('Welcome'); // Or whatever your main blade file is called
})->where('any', '.*');
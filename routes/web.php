<?php

use App\Models\Activity;
use App\Models\Building;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    dd(Building::query()->inRandomOrder()->value('id'));
});

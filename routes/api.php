<?php

use App\Http\Controllers\V1\OrganizationController;
use App\Http\Middleware\CheckTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/{token}')->middleware(CheckTokenMiddleware::class)->group(function () {
    Route::controller(OrganizationController::class)->prefix('organizations')->group(function () {
        Route::get('/building/{building_id}', 'showByBuilding');
        Route::get('/activity/{activity_id}', 'showByActivity');
        Route::get('/activity/{activity_id}/recursive', 'showByActivityRecursive');
        Route::get('/search/{text}', 'searchOrganizations');
        Route::get('/coordinates', 'showByCoordinates');
        Route::get('/{organization_id}', 'show');
    });
});

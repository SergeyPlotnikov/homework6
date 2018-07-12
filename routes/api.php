<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')->get('/currencies', function () {
    $repository = app(\App\Services\CurrencyRepositoryInterface::class);
    $outputData = [];
    foreach ($repository->findActive() as $activeCurrency) {
        array_push($outputData, \App\Services\CurrencyPresenter::present($activeCurrency));
    }
    return response()->json($outputData);
});

Route::middleware('api')->get('/currencies/{id}', function (int $id) {
    $repository = app(\App\Services\CurrencyRepositoryInterface::class);
    $currency = $repository->findById($id);
    if ($currency !== null) {
        return response()->json(\App\Services\CurrencyPresenter::present($currency));
    } else {
        abort(404, 'Currency doesn\'t exist with id = ' . $id);
    }
});



Route::middleware('api')->resource('/admin/currencies', 'CurrencyController',
    ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
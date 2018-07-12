<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/currencies', 'CurrencyController@showCurrencies');


Route::get('/admin')->middleware('redirect');
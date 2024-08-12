<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/guess', function (Request $request) {
    $number = $request->session()->get('number', rand(1, 100));
    $guess = $request->input('guess');

    if ($guess < $number) {
        $response = 'Too Low!';
    } elseif ($guess > $number) {
        $response = 'Too High!';
    } else {
        $response = 'Correct!';
        $request->session()->forget('number');
    }

    return response()->json(['response' => $response]);
});

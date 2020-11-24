<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;



Route::get('/', function () {
    
    
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('Alluser');

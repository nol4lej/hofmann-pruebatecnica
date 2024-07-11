<?php

use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', HomePage::class);
Route::post('/update-transaction', [TransactionController::class, 'update']);

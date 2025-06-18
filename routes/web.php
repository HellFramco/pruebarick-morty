<?php

use App\Http\Controllers\CharacterController;

Route::get ('/characters',                          [CharacterController::class, 'index'])->name('characters.index');
Route::post('/characters/store',                    [CharacterController::class, 'store'])->name('characters.store');
Route::get ('/characters/db',                       [CharacterController::class, 'db'])->name('characters.db');
Route::get ('/characters/{character}/edit',         [CharacterController::class,'edit'])
      ->name('characters.edit');

Route::put ('/characters/{character}',              [CharacterController::class,'update'])
      ->name('characters.update');
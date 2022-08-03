<?php

use Illuminate\Support\Facades\Route;
use ZunFuyuzora\UkyoTable\UkyoTableController;

Route::get('ukyo', function(){
	dd("( >w<)/) ");
});

Route::get('ukyo/super', [UkyoTableController::class, 'superPose']);
Route::get('ukyo/wiggly', [UkyoTableController::class, 'wigglyPose']);
Route::get('ukyo/test', [UkyoTableController::class, 'dataTableTest']);


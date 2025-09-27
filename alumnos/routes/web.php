<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', fn()=>redirect()->route('students.index'));

Route::prefix('estudiantes')->name('students.')->group(function(){
  Route::get('/',            [StudentController::class,'index'])->name('index');
  Route::get('/crear',       [StudentController::class,'create'])->name('create');
  Route::post('/',           [StudentController::class,'store'])->name('store');
  Route::get('/export/pdf',  [StudentController::class,'exportPdf'])->name('export.pdf');
  Route::get('/export/xlsx', [StudentController::class,'exportExcel'])->name('export.xlsx');
});
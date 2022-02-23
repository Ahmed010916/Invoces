<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvocesAttachmentsController;
use App\Http\Controllers\InvocesController;
use App\Http\Controllers\InvocesDitalisController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/get',[HomeController::class,'get']);

Route::get('/', function () {

     $invoces_all = DB::table('invoces')->count();
     $invoces_paid = DB::table('invoces')->where('values_status','=',1)->count();
     $invoces_part = DB::table('invoces')->where('values_status','=',3)->count();
     $invoces_un = DB::table('invoces')->where('values_status','=',2)->count();

    return view('welcome',compact('invoces_all','invoces_paid','invoces_part','invoces_un'));
})->middleware('auth');

Auth::routes();

Route::resource('/invoces', InvocesController::class);
Route::get('/invoces-Paid', [InvocesController::class,'invoces_Paid'])->name('invoces_Paid');
Route::get('/trached-invoces', [InvocesController::class,'trachedinvoces'])->name('trached_invoces');
Route::post('Un-trached-invoces/{id}', [InvocesController::class,'Untrachedinvoces'])->name('Untrachedinvoces');
Route::get('/invoces-Part-Paid', [InvocesController::class,'invoces_part_Paid'])->name('invoces_part_Paid');
Route::get('/invoces-Un-Paid', [InvocesController::class,'invoces_un_Paid'])->name('invoces_un_Paid');
Route::get('/invoces-print/{id}', [InvocesDitalisController::class,'invoces_print'])->name('invoces_print');
Route::get('invocesExport',[InvocesController::class,'invocesExport'])->name('invocesExport');
Route::get('invocesPaidExport',[InvocesController::class,'invocesPaidExport'])->name('invocesPaidExport');
Route::get('invocesUnPaidExport',[InvocesController::class,'invocesUnPaidExport'])->name('invocesUnPaidExport');
Route::get('invocesPartExport',[InvocesController::class,'invocesPartExport'])->name('invocesPartExport');

Route::get('/sectionss_get/{id}', [InvocesController::class,'sections_get'])->middleware('auth');
Route::resource('/invoces-ditalis', InvocesDitalisController::class)->middleware('auth');

Route::post('dawnlode/invoces/{invoces_number}/{filename}',[InvocesDitalisController::class,'dawnfile'])->name('dawnfile');
Route::post('view/invoces/{invoces_number}/{filename}',[InvocesDitalisController::class,'viewfile'])->name('viewfile');
Route::post('deletefile/invoces/{invoces_number}/{filename}/{id}',[InvocesDitalisController::class,'deletefile'])->name('deletefile');
Route::post('AddfileAttachment/{invoces_number}/{id}',[InvocesAttachmentsController::class,'AddfileAttachment'])->name('AddfileAttachment');

Route::post('softdelete/{id}',[InvocesController::class,'softdelete'])->name('softdelete');

Route::get('statusEdite/{id}',[InvocesController::class,'statusEdite'])->name('statusEdite');
Route::post('statusUpdate/{id}',[InvocesController::class,'statusUpdate'])->name('statusUpdate');


Route::resource('/section',SectionController::class)->middleware('auth');

Route::resource('/products',ProductController::class)->middleware('auth');
Route::put('/productsupdatamy',[ProductController::class,'updatamy'])->middleware('auth')->name('updatamy');
#####################
//Reports


Route::get('ReportsInvoces',[ReportsController::class,'indexInvoces'])->name('ReportsInvoces.index');
Route::post('ReportsInvoces/search/',[ReportsController::class,'searchInvoces'])->name('ReportsInvoces.search');
Route::get('invocesReportsExport/{invoces}',[ReportsController::class,'invocesReportsExport'])->name('invocesReportsExport');

//

Route::get('ReportsUsers',[ReportsController::class,'indexUsers'])->name('ReportsUsers.index');
Route::post('ReportsUsers/search',[ReportsController::class,'searchUsers'])->name('ReportsUsers.search');

//

Route::resource('/Users',UserController::class)->middleware('auth');
Route::resource('/Roles',RolesController::class)->middleware('auth');





#####################




<?php

use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Navigation routes
Route::get('/', [NavigationController::class, 'index'])->name('nav.index');
Route::get('/apply/{url}', [NavigationController::class, 'apply'])->name('nav.apply');
Route::get('/company/{url}', [NavigationController::class, 'company'])->name('nav.company');

// Apply route
Route::post('/apply/{url}', [NavigationController::class, 'store'])->name('nav.submit');

// Admin routes
Route::prefix('painel')->group(function (){

    Route::get('/',function(){
        echo "TESTE";
    })->name('admin.index');

    // Organizations routes
    Route::get('organization/form/{url?}', [OrganizationsController::class, 'form'])->name('organization.form');
    Route::post('organization/create', [OrganizationsController::class, 'store'])->name('organization.store');
    Route::post('organization/update/{url}', [OrganizationsController::class, 'update'])->name('organization.update');
    Route::get('organization/delete/{url}', [OrganizationsController::class, 'delete'])->name('organization.delete');

    // Offers routes
    Route::get('offer/form/{url?}', [OffersController::class, 'form'])->name('offer.form');
    Route::post('offer/create', [OffersController::class, 'store'])->name('offer.store');
    Route::post('offer/update/{url}', [OffersController::class, 'update'])->name('offer.update');
    Route::get('offer/delete/{url}', [OffersController::class, 'delete'])->name('offer.delete');

    // Candidates routes
    Route::get('candidates/list', [CandidatesController::class, 'list'])->name('candidate.list');
    Route::get('candidate/list/{url}', [CandidatesController::class, 'offer'])->name('candidate.offer');
    Route::get('candidate/{id?}', [CandidatesController::class, 'single'])->name('candidate.single');
    Route::get('candidates/delete/{id?}', [CandidatesController::class, 'delete'])->name('candidate.delete');
    Route::get('candidate/json/{url?}', [CandidatesController::class, 'listAll'])->name('candidate.list.all');

    // Downloads Routes
    Route::get('download/{url?}', [DownloadController::class, 'download'])->name('download.files');

});


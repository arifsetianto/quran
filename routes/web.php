<?php

use App\Livewire\GetQuranByPage;
use App\Livewire\GetQuranByPart;
use App\Livewire\GetQuranBySubject;
use App\Livewire\ListChapters;
use App\Livewire\GetQuranByChapter;
use App\Livewire\RedirectQrPage;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Welcome::class)->name('welcome');
Route::get('/chapters', ListChapters::class)->name('list-chapters');
Route::get('/chapter/{surah}', GetQuranByChapter::class)->name('get-quran-by-chapter');
Route::get('/page/{page}', GetQuranByPage::class)->name('get-quran-by-page');
Route::get('/juz/{juz}', GetQuranByPart::class)->name('get-quran-by-part');
Route::get('/Q/{page}', RedirectQrPage::class)->name('qr-page');
Route::get('/subject/{subject}', GetQuranBySubject::class)->name('get-quran-by-subject');

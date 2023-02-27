<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScoreController; // 追加

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Add user access routes
Route::middleware(['auth', 'user-access:0'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

    Route::get('/ainu01/ainu01', [App\Http\Controllers\Ainu01\Ainu1Controller::class, 'index'])->name('ainu01.ainu01');
    Route::get('/ainu01/ainu01_study_menu',[App\Http\Controllers\Ainu01\Ainu01StudyMController::class, 'index'])->name('ainu01.ainu01_study_menu');
    Route::get('/ainu01/ainu01_practice_menu',[App\Http\Controllers\Ainu01\Ainu01PracticeMController::class, 'index'])->name('ainu01.ainu01_practice_menu');

    Route::get('/ainu01/ainu01_today_challenge', [App\Http\Controllers\Ainu01\Ainu01TodayChallengeController::class, 'index'])->name('ainu01.ainu01_today_challenge');
    Route::get('/ainu01/ainu01_practice_1', [App\Http\Controllers\Ainu01\Ainu01Practice1Controller::class, 'index'])->name('ainu01.ainu01_practice_1');
    Route::get('/ainu01/ainu01_practice_2', [App\Http\Controllers\Ainu01\Ainu01Practice2Controller::class, 'index'])->name('ainu01.ainu01_practice_2');
    Route::get('/ainu01/ainu01_practice_3', [App\Http\Controllers\Ainu01\Ainu01Practice3Controller::class, 'index'])->name('ainu01.ainu01_practice_3');
    Route::get('/ainu01/ainu01_practice_4', [App\Http\Controllers\Ainu01\Ainu01Practice4Controller::class, 'index'])->name('ainu01.ainu01_practice_4');
    Route::get('/ainu01/ainu01_practice_5', [App\Http\Controllers\Ainu01\Ainu01Practice5Controller::class, 'index'])->name('ainu01.ainu01_practice_5');

    Route::get('/ainu01/ainu01_study_1', [App\Http\Controllers\Ainu01\Ainu01Study1Controller::class, 'index'])->name('ainu01.ainu01_study_1');
    Route::get('/ainu01/ainu01_study_2', [App\Http\Controllers\Ainu01\Ainu01Study2Controller::class, 'index'])->name('ainu01.ainu01_study_2');
    Route::get('/ainu01/ainu01_study_3', [App\Http\Controllers\Ainu01\Ainu01Study3Controller::class, 'index'])->name('ainu01.ainu01_study_3');
    Route::get('/ainu01/ainu01_study_4', [App\Http\Controllers\Ainu01\Ainu01Study4Controller::class, 'index'])->name('ainu01.ainu01_study_4');
    Route::get('/ainu01/ainu01_study_5', [App\Http\Controllers\Ainu01\Ainu01Study5Controller::class, 'index'])->name('ainu01.ainu01_study_5');

    Route::get('/ainu01/ainu01_today_challenge/create', [App\Http\Controllers\Ainu01\Ainu01TodayChallengeController::class, 'create'])->name('ainu01.ainu01_today_challenge.create');
    Route::post('/ainu01/ainu01_today_challenge/create', [App\Http\Controllers\Ainu01\Ainu01TodayChallengeController::class, 'create'])->name('ainu01.ainu01_today_challenge.create');
    Route::get('/ainu01/ainu01_today_challenge/update', [App\Http\Controllers\Ainu01\Ainu01TodayChallengeController::class, 'update'])->name('ainu01.ainu01_today_challenge.update');
    Route::post('/ainu01/ainu01_today_challenge/update', [App\Http\Controllers\Ainu01\Ainu01TodayChallengeController::class, 'update'])->name('ainu01.ainu01_today_challenge.update');
    Route::get('/ainu01/ainu01_today_challenge/click', [App\Http\Controllers\Ainu01\Ainu01TodayChallengeController::class, 'click'])->name('ainu01.ainu01_today_challenge.click');
    Route::post('/ainu01/ainu01_today_challenge/click', [App\Http\Controllers\Ainu01\Ainu01TodayChallengeController::class, 'click'])->name('ainu01.ainu01_today_challenge.click');

    Route::get('/ainu01/ainu01_practice_1/create', [App\Http\Controllers\Ainu01\Ainu01Practice1Controller::class, 'create'])->name('ainu01.ainu01_practice_1.create');
    Route::post('/ainu01/ainu01_practice_1/create', [App\Http\Controllers\Ainu01\Ainu01Practice1Controller::class, 'create'])->name('ainu01.ainu01_practice_1.create');
    Route::get('/ainu01/ainu01_practice_1/update', [App\Http\Controllers\Ainu01\Ainu01Practice1Controller::class, 'update'])->name('ainu01.ainu01_practice_1.update');
    Route::post('/ainu01/ainu01_practice_1/update', [App\Http\Controllers\Ainu01\Ainu01Practice1Controller::class, 'update'])->name('ainu01.ainu01_practice_1.update');

    Route::get('/ainu01/ainu01_practice_2/create', [App\Http\Controllers\Ainu01\Ainu01Practice2Controller::class, 'create'])->name('ainu01.ainu01_practice_2.create');
    Route::post('/ainu01/ainu01_practice_2/create', [App\Http\Controllers\Ainu01\Ainu01Practice2Controller::class, 'create'])->name('ainu01.ainu01_practice_2.create');
    Route::get('/ainu01/ainu01_practice_2/update', [App\Http\Controllers\Ainu01\Ainu01Practice2Controller::class, 'update'])->name('ainu01.ainu01_practice_2.update');
    Route::post('/ainu01/ainu01_practice_2/update', [App\Http\Controllers\Ainu01\Ainu01Practice2Controller::class, 'update'])->name('ainu01.ainu01_practice_2.update');

    Route::get('/ainu01/ainu01_practice_3/create', [App\Http\Controllers\Ainu01\Ainu01Practice3Controller::class, 'create'])->name('ainu01.ainu01_practice_3.create');
    Route::post('/ainu01/ainu01_practice_3/create', [App\Http\Controllers\Ainu01\Ainu01Practice3Controller::class, 'create'])->name('ainu01.ainu01_practice_3.create');
    Route::get('/ainu01/ainu01_practice_3/update', [App\Http\Controllers\Ainu01\Ainu01Practice3Controller::class, 'update'])->name('ainu01.ainu01_practice_3.update');
    Route::post('/ainu01/ainu01_practice_3/update', [App\Http\Controllers\Ainu01\Ainu01Practice3Controller::class, 'update'])->name('ainu01.ainu01_practice_3.update');

    Route::get('/ainu01/ainu01_practice_4/create', [App\Http\Controllers\Ainu01\Ainu01Practice4Controller::class, 'create'])->name('ainu01.ainu01_practice_4.create');
    Route::post('/ainu01/ainu01_practice_4/create', [App\Http\Controllers\Ainu01\Ainu01Practice4Controller::class, 'create'])->name('ainu01.ainu01_practice_4.create');
    Route::get('/ainu01/ainu01_practice_4/update', [App\Http\Controllers\Ainu01\Ainu01Practice4Controller::class, 'update'])->name('ainu01.ainu01_practice_4.update');
    Route::post('/ainu01/ainu01_practice_4/update', [App\Http\Controllers\Ainu01\Ainu01Practice4Controller::class, 'update'])->name('ainu01.ainu01_practice_4.update');

    Route::get('/ainu01/ainu01_practice_5/create', [App\Http\Controllers\Ainu01\Ainu01Practice5Controller::class, 'create'])->name('ainu01.ainu01_practice_5.create');
    Route::post('/ainu01/ainu01_practice_5/create', [App\Http\Controllers\Ainu01\Ainu01Practice5Controller::class, 'create'])->name('ainu01.ainu01_practice_5.create');
    Route::get('/ainu01/ainu01_practice_5/update', [App\Http\Controllers\Ainu01\Ainu01Practice5Controller::class, 'update'])->name('ainu01.ainu01_practice_5.update');
    Route::post('/ainu01/ainu01_practice_5/update', [App\Http\Controllers\Ainu01\Ainu01Practice5Controller::class, 'update'])->name('ainu01.ainu01_practice_5.update');

    Route::get('/ainu02/ainu02', [App\Http\Controllers\Ainu02\Ainu02Controller::class, 'index'])->name('ainu02.ainu02');
    Route::get('/ainu02/ainu02_study',[App\Http\Controllers\Ainu02\Ainu02studyController::class, 'index'])->name('ainu02.ainu_study');
    Route::get('/ainu02/ainu02_practice',[App\Http\Controllers\Ainu02\Ainu02practiceController::class, 'index'])->name('ainu02.ainu02_practice');

    Route::get('/ainu02/ainu02_practice/create', [App\Http\Controllers\Ainu02\Ainu02practiceController::class, 'create'])->name('ainu02.ainu02_practice.create');
    Route::post('/ainu02/ainu02_practice/create', [App\Http\Controllers\Ainu02\Ainu02practiceController::class, 'create'])->name('ainu02.ainu02_practice.create');
    Route::get('/ainu02/ainu02_practice/update', [App\Http\Controllers\Ainu02\Ainu02practiceController::class, 'update'])->name('ainu02.ainu02_practice.update');
    Route::post('/ainu02/ainu02_practice/update', [App\Http\Controllers\Ainu02\Ainu02practiceController::class, 'update'])->name('ainu02.ainu02_practice.update');
});

// Add admin access routes
Route::middleware(['auth', 'user-access:1'])->group(function () {

    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');

    Route::resource('/scores/ainu01', App\Http\Controllers\Scores\Ainu01ScoreController::class);
    Route::resource('/scores/ainu02', App\Http\Controllers\Scores\Ainu02ScoreController::class);
});

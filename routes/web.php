<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\mainpageController;
use App\Http\Controllers\bBoardDelController;
use App\Http\Controllers\bBoardController;
use App\Http\Controllers\LeaderboardController;
use App\Events\GlobalNotif;



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


Route::controller(AuthController::class)->group(function () {
	Route::get('/', 'loginPage')->name('login');
	Route::post('login', 'login')->name('login.aksi');
    // Route::post('home','homePages')->middleware('security')->name('home');
    // Route::get('home', 'homePages')->middleware(['security', 'web'])->name('home');
    Route::get('logout', 'logout')->middleware(['security','logout'])->name('logout');
});

Route::get('/schedule-notifications', [AuthController::class,'sced'])->name('sced');


Route::controller(RegisterController::class)->group(function () {
	Route::get('roleregister', 'roleregister')->name('roleregister');
});

Route::post('/register/role', [RegisterController::class, 'chooseRole']);
Route::get('/register/role', [RegisterController::class, 'chooseRole']);
Route::post('register/trainer', [RegisterController::class, 'createTrainer'])->name('register.trainer');
Route::post('register/trainee', [RegisterController::class, 'createTrainee'])->name('register.trainee');



Route::post('/edittrainee/editdata', [ProfileController::class, 'edittraineedata'])->name('edittraineedata')->middleware(['security','trainee']);
Route::get('/edittrainee',[ProfileController::class,'edittrainee'])->name('edittrainee')->middleware(['security','trainee']);
Route::get('/tdetail',[ProfileController::class,'traineedetail'])->name('traineedetail')->middleware(['security','trainee']);
Route::post('/edittrainerdata',[ProfileController::class,'edittrainerdata'])->name('edittrainerdata')->middleware(['security','trainer']);
Route::get('/edittrainer',[ProfileController::class,'edittrainer'])->name('edittrainer')->middleware(['security','trainer']);
Route::get('/edittrainee/editpass',[ProfileController::class,'editpassview'])->name('editpassview')->middleware('security');
Route::post('/editpass/update',[ProfileController::class,'editpass'])->name('editpass')->middleware('security');

Route::post('users/getUsers', [TraineeController::class, 'getUsers'])->name('users.getUsers')->middleware('security');
Route::get("trainee", [TraineeController::class, 'index'])->name('init')->middleware('security');

// tidak kepakai
Route::get("trainee/{TNumber}", [TraineeController::class, 'show'])->middleware('security');
//

Route::get('/calendar', [CalendarController::class,'getCalendar'])->name('calendar')->middleware('security');

Route::get('/buletin',[mainpageController::class,'index'] )->name('buletin')->middleware('security');

Route::get('/bBoardAdd',[bBoardController::class,'index'])->middleware('security');
Route::post('/bBoardAdd',[bBoardController::class,'store'])->middleware('security');

Route::get('bBoardDelete',[bBoardDelController::class,'index'])->middleware(['security','admin']);
Route::post('/bBoardDelete',[bBoardDelController::class,'delete'])->middleware(['security','admin']);

Route::get('/project', [ProjectController::class, 'index'])->name('project')->middleware('security','trainee');
Route::get('/project1', [ProjectController::class, 'index1'])->name('project1')->middleware('security','trainer');
Route::post('/add', [ProjectController::class, 'store'])->middleware(['security','admin']);
Route::post('/update-status', [ProjectController::class,'updateStatus'])->name('updateStatus')->middleware('security');
Route::post('/updateproids', [ProjectController::class,'backtomodal'])->name('backtomodal')->middleware(['security','trainee']);
Route::post('/updateproids1', [ProjectController::class,'backtomodal1'])->name('backtomodal1')->middleware(['security','trainer']);
Route::post('/destruct', [ProjectController::class,'destroy'])->name('destroy')->middleware(['security','admin']);
Route::post('/editmodal', [ProjectController::class,'edit'])->name('editingmodal')->middleware(['security','admin']);
Route::get('/editmodal', [ProjectController::class,'edit'])->name('editingmodal')->middleware(['security','admin']);
Route::post('/editproject', [ProjectController::class,'editproject'])->name('editproject')->middleware(['security','admin']);
Route::get('/editproject', [ProjectController::class,'editproject'])->name('editproject')->middleware(['security','admin']);


Route::get('/leaderboard', [LeaderboardController::class,'show'])->name('leaderboard')->middleware('security');
Route::get('/leaderboard/{uuid?}', [LeaderboardController::class, 'show'])->name('leaderboard.show')->middleware('security');

Route::post('/calendar', 'App\Http\Controllers\CalendarController@store'); // Example route for storing new events
Route::put('/calendar', 'App\Http\Controllers\CalendarController@update'); // Example route for updating events
Route::delete('/calendar/{id}', 'App\Http\Controllers\CalendarController@destroy')->name('calendar.destroy');
Route::get('/calendar', [CalendarController::class,'getCalendar'])->name('calendar')->middleware('security');
Route::delete('/api/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');




Route::get('/bBoardAdds', function () {
    event(new GlobalNotif('CHECK ANNOUNCEMENT'));
    return view('buletin');
});

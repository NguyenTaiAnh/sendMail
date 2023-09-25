<?php

use App\Models\Email;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

use App\Http\Controllers\{MailContentController, MailSendersController, AuthController, EmailController,ProfileController,UserController};


Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('email_open/{id}',[EmailController::class,'emailOpen'])->name('email.open');


Route::group(['middleware'=>['admin_auth']],function(){

    Route::get('/',[ProfileController::class,'dashboard'])->name('dashboard');
//    Route::get('users',[UserController::class,'index'])->name('users.index');
    Route::get('/sendmail', function () {
        return view('sendmail');
    })->name('sendmail');
    Route::get('/tryagain', [MailContentController::class,'store'])->name('mail.tryagain');
    Route::post('/import', [MailContentController::class,'import'])->name('mail.import');
    Route::post('/store', [MailSendersController::class,'store'])->name('mail.store');

//    Route::get('/emails',[EmailController::class,'index'])->name('email.index');
    Route::group(['prefix'=> 'users'], function (){
        Route::get('/', [UserController::class,'index'])->name('users.index');
        Route::get('/dataTable',[UserController::class,'datatable'])->name('users.dataTable');
        Route::post('/store', [UserController::class,'store'])->name('users.store');
        Route::post('/update', [UserController::class,'update'])->name('users.update');
        Route::post('/destroy/{id}', [UserController::class,'destroy'])->name('users.destroy');
        Route::get('/show/{id}', [UserController::class,'show'])->name('users.show');
    });

//    Route::group(['prefix'=> 'emails'], function (){
//        Route::get('/', [EmailController::class,'index'])->name('email.index');
//        Route::get('/dataTable',[EmailController::class,'datatable'])->name('email.dataTable');
//        Route::post('/store', [EmailController::class,'store'])->name('email.store');
//        Route::post('/update', [EmailController::class,'update'])->name('email.update');
//        Route::post('/destroy/{id}', [EmailController::class,'destroy'])->name('email.destroy');
//        Route::get('/show/{id}', [EmailController::class,'show'])->name('email.show');
//    });
});

Route::group(['middleware'=>['guest']],function(){
    Route::group(['prefix'=> 'emails'], function (){
        Route::get('/', [EmailController::class,'index'])->name('email.index');
        Route::get('/dataTable',[EmailController::class,'datatable'])->name('email.dataTable');
        Route::post('/store', [EmailController::class,'store'])->name('email.store');
        Route::post('/update', [EmailController::class,'update'])->name('email.update');
        Route::post('/destroy/{id}', [EmailController::class,'destroy'])->name('email.destroy');
        Route::get('/show/{id}', [EmailController::class,'show'])->name('email.show');
    });
});

//Route::group(['prefix'=> '/'], function (){
//    Route::get('/', [MailContentController::class,'index'])->name('index');
//    Route::get('/dataTable',[MailContentController::class,'datatable'])->name('dataTable');
//    Route::post('/store', [MailContentController::class,'store'])->name('mail.store');
//    Route::post('/update', [MailContentController::class,'update'])->name('update');
//    Route::post('/destroy/{id}', [MailContentController::class,'destroy'])->name('destroy');
//    Route::get('/show/{id}', [MailContentController::class,'show'])->name('show');
//});

//Route::get('excel-test', function () {
//    // http://localhost/assets/panel/excel/test123.xls
//    // /public/assets/panel/excel/test123.xls
//    $address = public_path('assets/files/1693647029.xls');
//    Excel::load($address, function($reader) {
//        $results = $reader->get();
//        dd($results);
//    });
//});

//Route::get('/send',function (){
//
////        dd(1);
//
//        Mail::send('mailfb',  array('content'=>"abc test mail"), function($message){
//
//
//            $message->to("a1c4b3@gmail.com")->subject('This is test e-mail');
//        });
//
//
//})->name('sendmail');
Route::get("/test",function (){
    dd(1);
});

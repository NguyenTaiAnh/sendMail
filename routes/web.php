<?php

use App\Models\Email;
use Illuminate\Support\Facades\Mail;
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

use App\Http\Controllers\{MailContentController, MailSendersController, AuthController};


Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::group(['middleware'=>['admin_auth']],function(){
    Route::get('/', function () {
        return view('sendmail');
    })->name('home');
    Route::get('/tryagain', [MailContentController::class,'store'])->name('mail.tryagain');
    Route::post('/import', [MailContentController::class,'import'])->name('mail.import');
    Route::post('/store', [MailSendersController::class,'store'])->name('mail.store');
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
//    $getAllMail = Email::all();
////    dd($getAllMail);
//    try {
//        foreach ($getAllMail as $mail) {
////            dump( );
//            $mailSender = str_replace("\u{A0}", '', $mail->email);
////            if (str_replace("\u{A0}", '', $mail->email) !== false) {
////                dump($mail->email);
////                echo 'Có khoảng trắng trong chuỗi.';
////            } else {
////                dump($mail->email);
////
////                echo 'Không có khoảng trắng trong chuỗi.';
////            }
//            Mail::send('welcome', [], function($message) use ($mailSender){
//                dump($mailSender);
////
////                dd(1);
//
//            $message->to($mailSender)->subject('This is test e-mail');
//        });
//        }
////        dd(1);
////        $emails = [
////            'a1c4b3@gmail.com ',
////            'phanvandinh3004@gmail.com ',
////            'mail.adam.phan@gmail.com ',
////            'abc.xe@aaa',
////            'lol@ccc.cc',
////        ];
////        Mail::send('welcome', [], function($message) use ($emails){
////
////
////            $message->to($emails)->subject('This is test e-mail');
////        });
//    }catch (\Exception $exception){
//        dump($exception->getMessage());
//        return 1;
//
//        throw $exception;
//    }
//
//})->name('sendmail');

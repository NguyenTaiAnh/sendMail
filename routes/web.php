<?php

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

use App\Http\Controllers\{MailContentController, MailSendersController};


Route::get('/', function () {
    return view('sendmail');
})->name('home');
//Route::post('/store', [MailContentController::class,'store'])->name('mail.store');
Route::post('/import', [MailContentController::class,'import'])->name('mail.import');
Route::post('/store', [MailSendersController::class,'store'])->name('mail.store');
//Route::group(['prefix'=> '/'], function (){
//    Route::get('/', [MailContentController::class,'index'])->name('index');
//    Route::get('/dataTable',[MailContentController::class,'datatable'])->name('dataTable');
//    Route::post('/store', [MailContentController::class,'store'])->name('mail.store');
//    Route::post('/update', [MailContentController::class,'update'])->name('update');
//    Route::post('/destroy/{id}', [MailContentController::class,'destroy'])->name('destroy');
//    Route::get('/show/{id}', [MailContentController::class,'show'])->name('show');
//});

Route::get('excel-test', function () {
    // http://localhost/assets/panel/excel/test123.xls
    // /public/assets/panel/excel/test123.xls
    $address = public_path('assets/files/1693647029.xls');
    Excel::load($address, function($reader) {
        $results = $reader->get();
        dd($results);
    });
});
Route::post('/send',function (){

    try {
        Mail::send('welcome', [], function($message){
            $emails = [
                'a1c4b3@gmail.com',
                'fakemaiaskdjaskdjhaskjhd@xzy.info.test',
                'abc.xe@aaa',
                'lol@ccc.cc',
                'aa',
                'aa@'
            ];

            $message->to($emails)->subject('This is test e-mail');
        });
    }catch (\Exception $exception){
        return 1;
        dump($exception);
        throw $exception;
    }

})->name('sendmail');

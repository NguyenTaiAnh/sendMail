<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMailContentRequest;
use App\Http\Requests\UpdateMailContentRequest;
use App\Jobs\AddMailFromFileExcelJob;
use App\Jobs\SendMailTryAgain;
use App\Models\Email;
use App\Models\ImportEmail;
use App\Models\MailContent;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MailContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('sendmail');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function import()
    {
        $import = Excel::import(new ImportEmail(),public_path("assets/files/1693647029.xlsx"));
        return redirect()->back()->with('success', 'Success!!!');
    }

    public function store()
    {
//        $addContentMail = new MailContent();
//        $addContentMail->content = $request['content'];
//        if($request->hasFile('filepath')){
//            $file = $request->file('filepath');
//            $name = time().'.'.$file->getClientOriginalExtension();
//            // Thư mục upload
//            $path =public_path() . '/assets/files';
//            // Bắt đầu chuyển file vào thư mục
//            $file->move($path,$name);
//            $addContentMail->filepath =$name;
//        }
        SendMailTryAgain::dispatch();
//        Excel::import(new ImportEmail(), $request->file('filepath'));
//        $addContentMail->save();
        return redirect()->route('sendmail')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(MailContent $mailContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailContent $mailContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMailContentRequest $request, MailContent $mailContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailContent $mailContent)
    {
        //
    }
}

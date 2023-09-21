<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMailSendersRequest;
use App\Http\Requests\UpdateMailSendersRequest;
use App\Jobs\AddMailFromFileExcelJob;
use App\Models\Email;
use App\Models\ImportEmail;
use App\Models\MailContent;
use App\Models\MailSenders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class MailSendersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
//        dd($request);
        //

        $addContentMail = new MailContent();
        $addContentMail->content = $request['content'];
        $addContentMail->subject = $request['subject'];
        if($request->hasFile('filepath')){
//            Excel::import(new ImportEmail(), $request->file('filepath'));
            $file = $request->file('filepath');
            $name = time().'.'.$file->getClientOriginalExtension();
            // Thư mục upload
            $path =public_path() . '/assets/files';
            // Bắt đầu chuyển file vào thư mục
            $file->move($path,$name);
            $addContentMail->filepath =$name;
        }
        $addContentMail->save();
        AddMailFromFileExcelJob::dispatch($addContentMail);

        return redirect()->route('sendmail')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(MailSenders $mailSenders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailSenders $mailSenders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMailSendersRequest $request, MailSenders $mailSenders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailSenders $mailSenders)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Models\Email;
use App\Repositories\EmailsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class EmailController extends Controller
{
    /**
     * @var DataTables
     */
    private $dataTable;

    /**
     * @var EmailsRepository
     */
    private $emailsRepository;

    public function __construct(EmailsRepository $emailsRepository, DataTables $dataTable){
        $this->emailsRepository = $emailsRepository;
        $this->dataTable = $dataTable;
    }
    /**
     * Display a listing of the resource.
     */

    public  function  emailOpen($id){
        Log::debug("Email open . ". $id);
        //Email::where('email',$mail->email)->update(['status'=>Email::SUCCESS]);
        Email::where('id',$id)->update(['opened'=> '1']);
    }

    public function index()
    {
        //
        return view('emails.index');
    }


    public function datatable(){

        $email = $this->emailsRepository->getEmails();
        //   const SUCCESS = '1';
        //    const WAITING = '0';
        //    const FAILED = '2';
        //    const ERROR = '3';
        return $this->dataTable->eloquent($email)
            ->editColumn('status', function ($email){
                switch ($email->status){
                    case '0':
                        return "<span class='text-info'>WAITING</span>";
                    case '1':
                        return "<span class='text-primary'>SUCCESS</span>";
                    case '2':
                        return "<span class='text-warning'>FAILED</span>";
                    case '3':
                        return "<span class='text-success'>ERROR</span>";
                    default:
                        return "<span class='text-danger'>ERROR</span>";
                };
            })
            ->editColumn('opened', function ($email){
                switch ($email->opened){
                    case '0':
                        return "<span class='text-info'>NEW</span>";
                    case '1':
                        return "<span class='text-primary'>OPENED</span>";
                };
            })
            ->editColumn('created_at', function ($time) {
//                dd($parseNow = date('Y-m-d', strtotime($time->created_at)) + env('TIMEZONE_VALUE','+7') * 3600);
                return date('Y-m-d H:i:s', strtotime($time->created_at)+ env('TIMEZONE_VALUE','+7') * 3600);
            })
            ->editColumn('updated_at', function ($time) {
                return date('Y-m-d H:i:s', strtotime($time->updated_at));
            }) ->rawColumns(['opened','status'])->make(TRUE);
//            ->addColumn('action',function($category){
//                return '<div class="btn-group action">
//                    <form action="' . route('categories.destroy', ['id' => $category->id]) . '"
//                    method="POST" onsubmit="return confirm(' . "'" . 'Are You Sure' . "'" . ');"
//                    style="display: inline-block;">
//                        <input type="hidden" name="_method" value="POST">
//                        <input type="hidden" name="_token" value="' . csrf_token() . '">
//                        <input type="submit" class="btn btn-sm btn-danger" value="' . 'Delete'. '">
//                    </form>
//                    <button data-toggle="modal" data-target="#myModalEdit" class="category-edit btn btn-info btn-sm" data-id="'.$category->id.'">'.'Edit'.'</button>
//                </div>';
//            })
//            ->rawColumns(['action'])->make(TRUE);
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
    public function store(StoreEmailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailRequest $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        //
    }
}

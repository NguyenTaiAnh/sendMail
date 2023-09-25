<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * @var DataTables
     */
    private $dataTable;

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository, DataTables $dataTable){
        $this->usersRepository = $usersRepository;
        $this->dataTable = $dataTable;
    }
    public function index(){
        $data=[
            'title'=>'Users'
        ];
        return view('user.index',$data);
    }

    public function datatable(){
        $users = $this->usersRepository->getUsers();
        //   const SUCCESS = '1';
        //    const WAITING = '0';
        //    const FAILED = '2';
        //    const ERROR = '3';
        return $this->dataTable->eloquent($users)
            ->editColumn('created_at', function ($time) {
//                dd($parseNow = date('Y-m-d', strtotime($time->created_at)) + env('TIMEZONE_VALUE','+7') * 3600);
                return date('Y-m-d H:i:s', strtotime($time->created_at)+ env('TIMEZONE_VALUE','+7') * 3600);
            })
            ->editColumn('updated_at', function ($time) {
                return date('Y-m-d H:i:s', strtotime($time->updated_at));
            })->make(TRUE);
    }
}

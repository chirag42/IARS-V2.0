<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\UserController;

class UserController extends Controller 
{
    public function export() 
    {
        //return (new UsersExport(12,1))->download('marks.xlsx');
        //return Excel::download(new UsersExport, 'marks.xlsx');
        return Excel::download(new UsersExport(12), 'users.xlsx');
    }
}

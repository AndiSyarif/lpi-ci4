<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $title  = 'Dashboard';

        $user = new UserModel();
        $countuser = $user->countAllResults();

        $employee = new EmployeeModel();
        $countemployee = $employee->countAllResults();

        return view('dashboard/dashboard', [
            'title' => $title,
            'countuser' => $countuser,
            'countemployee' => $countemployee
        ]);
    }
}

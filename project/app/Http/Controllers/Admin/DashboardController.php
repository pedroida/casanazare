<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DashboardRequest;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function getData(DashboardRequest $request)
    {
        $requestData = $request->all(['type', 'date']);
        $responseData = (new DashboardService(...array_values($requestData)))->getData();

        return response()->json($responseData, 200);
    }
}

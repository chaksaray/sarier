<?php

/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 2/9/2018
 * Time: 9:46 AM
 */
namespace App\Http\Controllers\Platform;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('platform');
    }

    /**
     * Display platform dashboard view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboardView(){
        return View('platform.dashboard');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $appVersion = 'Laravel Version: ' . app()->version();
            DB::connection()->getPdo();
            if (DB::connection()->getDatabaseName())
            {
                $dbConnect = 'Connected to the Database: ' . DB::connection()->getDatabaseName();
            }
        } catch (Exception $e) {
            $dbConnect = 'Database not connect';
        }

        return view('home', compact('dbConnect', 'appVersion'));
    }
}

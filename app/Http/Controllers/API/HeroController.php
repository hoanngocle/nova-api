<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function __construct()
    {

    }

    public function index() {
        return 'list';
    }

    public function detail() {
        return 'detail';
    }

    public function store() {
        return 'add';
    }

    public function delete() {

    }
}

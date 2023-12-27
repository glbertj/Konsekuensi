<?php

namespace App\Http\Controllers;

use App\Models\bBoard;
use Illuminate\Http\Request;

class mainpageController extends Controller
{
    public function index(){
        return view("mainpage",["marque"=> bBoard::all()]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\bBoard;
use Illuminate\Http\Request;

class bBoardController extends Controller
{
    public static function index(){
        return view('bBoardAdd');
    }
    public static function store(Request $request){
        $data = $request->all();
        bBoard::create(['title'=>$data['title'],'description'=>$data['description']]);
        return redirect('/buletin');
    }
}

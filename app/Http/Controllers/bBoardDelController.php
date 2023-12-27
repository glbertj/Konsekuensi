<?php

namespace App\Http\Controllers;

use App\Models\bBoard;
use Illuminate\Http\Request;


class bBoardDelController extends Controller
{
    public function index(Request $request){
        return view("bBoardDel",['data'=>bBoard::all()]);
    }
    public function delete(Request $request){
        bBoard::where('id',$request->id)->delete();
        return redirect()->back()->with('success','');
}
}

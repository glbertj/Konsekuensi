<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Trainee;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TraineeController extends Controller
{
    public $rowperpage = 2;

    public function active(Request $req){
        $active = $req->input('data2');
        $userid = $req->input('data1');
        $curruser = Trainee::with('users')->where('uuid', $userid)->first();
        // dd($userid);
        $curruser->status = $active? $active:$curruser->status;
        // dd($curruser);
        $curruser->save();

        return redirect()->route('init1');


    }

    public function inactive(Request $req){
        $active = $req->input('data2');
        $userid = $req->input('data1');
        // dd($userid);
        $curruser = Trainee::with('users')->where('uuid', $userid)->first();
        $curruser->status = $active? $active:$curruser->status;
        $curruser->save();

        return redirect()->route('init1');

    }

    public function index()
    {

        $user = Auth::user();
        // $curruser = Trainee::with('users')->
        $curruser = Trainee::with('users')->where('uuid', $user->id)->first();
        // echo($user->id);
        $data['rowperpage'] = $this->rowperpage;
        $data['totalrecords'] = Trainee::with('users')->select('*')->count();
        $data['trainees'] = Trainee::select('*')
            ->skip(0)
            ->take($this->rowperpage)
            ->get();

        return view('traineelist', compact('data','curruser'));
    }

    public function index1()
    {

        $user = Auth::user();
        // $curruser = Trainee::with('users')->
        $curruser = Trainee::with('users')->where('uuid', $user->id)->first();
        // echo($user->id);
        $data['rowperpage'] = $this->rowperpage;
        $data['totalrecords'] = Trainee::with('users')->select('*')->count();
        $data['trainees'] = Trainee::select('*')
            ->skip(0)
            ->take($this->rowperpage)
            ->get();

        return view('traineelist1', compact('data','curruser'));
    }

    public function getUsers(Request $request)
    {
        $start = $request->get("start");

        $records = Trainee::with('users')->select('*')
            ->skip($start)
            ->take($this->rowperpage)
            ->get();

        $chunkedRecords = $records->chunk(4);

        $html = '';

        foreach ($chunkedRecords as $chunk) {
            $html .= '<div class="card w-150 h-150 post">';
            $html .= '<div class="card-body">';
            $html .= '<div class="row" style="border: none; border-radius: 0.5%; padding: 12px; display: flex; justify-content: center;">';

            foreach ($chunk as $user) {
                if ($user->status == "Inactive") {
                    $html .= '<div class="card2-inactive" style="width: 40rem; display: flex; flex-direction: row;margin-top:5rem;">';
                } else {
                    $html .= '<div class="card2" style="width: 40rem; display: flex; flex-direction: row;margin-top:5rem;">';
                }

                $html .= '<div class="text-center">';
                if ($user->status == "Inactive") {
                    $html .= '<img src="' . $user->image . '" class="card-img-top-inactive" style=" width:80%; object-fit:cover;" alt="...">';
                } else {
                    $html .= '<img src="' . $user->image . '" class="card-img-top" style=" width:80%; object-fit:cover;" alt="...">';
                }
                $html .= '</div><hr>';
                $html .= '<div class="id-details" style="height:70%; width::75%; padding:12px;">
                        <h5 class="card-title">T' . $user->kode_trainee . ' - ' . $user->users['nama_lengkap'] . '</h5>
                        <h5 class="card-title">Email    :' . $user->users['email'] . '</h5>
                        <h5 class="card-title">Jurusan  :' . $user->users['jurusan'] . '</h5>
                        <h5 class="card-title">Binusian  :B' . $user->users['binusian'] . '</h5>
                        <h5 class="card-title">Tanggal Lahir  :' . $user->tanggal_lahir . '</h5>
                        <h5 class="card-title">Alamat:' . $user->alamat . '</h5>
                        <h5 class="card-title">Contact:' . $user->contact . '</h5>
                        <h5 class="card-title">Status:' . $user->status . '</h5>
                        </div>
                </div>';
            }

            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        return response()->json(['html' => $html]);
    }

    public function getUsersadmin(Request $request)
    {
        $start = $request->get("start");

        $records = Trainee::with('users')->select('*')
            ->skip($start)
            ->take($this->rowperpage)
            ->get();

        $chunkedRecords = $records->chunk(4);

        $html = '';

        foreach ($chunkedRecords as $chunk) {
            $html .= '<div class="card w-150 h-150 post">';
            $html .= '<div class="card-body">';
            $html .= '<div class="row" style="border: none; border-radius: 0.5%; padding: 12px; display: flex; justify-content: center;">';

            foreach ($chunk as $user) {
                if ($user->status == "Inactive") {
                    $html .= '<div class="card2-inactive" style="width: 40rem; display: flex; flex-direction: row;margin-top:5rem;">';
                } else {
                    $html .= '<div class="card2" style="width: 40rem; display: flex; flex-direction: row;margin-top:5rem;">';
                }

                $html .= '<div class="text-center">';
                if ($user->status == "Inactive") {
                    $html .= '<img src="' . $user->image . '" class="card-img-top-inactive" style=" width:80%; object-fit:cover;" alt="...">';
                } else {
                    $html .= '<img src="' . $user->image . '" class="card-img-top" style=" width:80%; object-fit:cover;" alt="...">';
                }
                $html .= '</div>';
                $html .= '<div style="height:70%; width:75%;padding:12px;"><hr>';
                $html .= '<div class="id-details">';
                $html .= '<h5 class="card-title">T' . $user->kode_trainee . ' - ' . $user->users->nama_lengkap . '</h5>';
                $html .= '<h5 class="card-title">Email             : ' . $user->users->email . '</h5>';
                $html .= '<h5 class="card-title">Jurusan           : ' . $user->users->jurusan . '</h5>';
                $html .= '<h5 class="card-title">Binusian          : B' . $user->users->binusian . '</h5>';
                $html .= '<h5 class="card-title">Tanggal Lahir     : ' . $user->tanggal_lahir . '</h5>';
                $html .= '<h5 class="card-title">Alamat            : ' . $user->alamat . ' </h5>';
                $html .= '<h5 class="card-title">Contact           : ' . $user->contact . '</h5>';
                $html .= '<h5 class="card-title">Status            : ' . $user->status . '</h5>';
                $html .= '<h5 class="card-title">';
                $html .= '<button><a class="btn btn-danger" href="' . route('inactive', ['data1' => $user->uuid, 'data2' => "Inactive"]) . '">Inactive</a></button>';
                $html .= '<button><a class="btn btn-success" href="' . route('active', ['data1' => $user->uuid, 'data2' => "active"]) . '">Active</a></button>';
                $html .= '</h5>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            }

            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        return response()->json(['html' => $html]);
    }

    public function initialize()
    {
        $traineeasc = Trainee::with('users')->orderBy('status')->orderBy('kode_trainee')->get();

        if ($traineeasc->isEmpty()) {
            return "No Records Found";
        } else {
            return view("traineelist", compact("traineeasc"));
        }
    }

    public function show(Request $request, string $TNumber)
    {
        $traineeasc = Trainee::with('users')->find($TNumber);

        if ($traineeasc) {
            return view("trainee", compact("traineeasc"));
        } else {
            return "404 Page Not Found";
        }
    }
}

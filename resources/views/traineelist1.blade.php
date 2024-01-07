<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NAR24-1 Trainee List</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Add other stylesheets or scripts as needed -->
</head>
<style type="text/css">
    .body{

    }
    .row,.card-body{
        background-color:transparent;
    }
    .card{
        padding:6px;
        height:200%;
        width:100%;
        margin: 0 auto;
        background-color:#dceaf3;
        border:none;
    }
    .text-center card-img-top{
        width: 100%;
        max-width: 150px;
        max-height: 150px;
        border-radius: 10%;
        margin-bottom: 10px;

    }
    .card2{
        background-color:#bae1f7;
        margin:12px;
        padding:12px;
        width: 75%;
        border-radius:4%;
        border:4px solid #25333b;
        box-shadow:10px 10px 10px rgba(75, 92, 102,0.8);
    }
    .card2-inactive{
        background-color:grey;
        margin:12px;
        padding:12px;
        width: 75%;
        border:4px dashed black;
        border-radius:4%;
        filter:grayscale(100%);
        box-shadow:10px 10px 10px rgba(0,0,0,0.5);
    }
    .card-img-top-inactive{
        border:2px dashed black;
        border-radius:4%;
        width:300px;
        height:400px;
        filter:grayscale(100%);
    }
    .card-img-top{
        border:2px solid black;
        border-radius:4%;
        width:300px;
        height:400px;
    }
    .nav-bar {
        display: flex;
        width: 80%;
        height: 100%;
        background-color: white;
        border-radius: 15px;
        padding: 8px;
        margin: 8px;
        margin-right: 16px;
        align-items: center;
        justify-content: space-evenly;

    }
    .nav-main {
        width: 80%;
        height: 5rem;
        background-color: white;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
    .nav-button {
        height: 100%;
        width: 100%;
        border: 3px solid black;
        border-radius: 15px;
        background-color: #bae1f7;
        transition: border-color 0.3s ease-in-out;
        text-transform: uppercase;
        font-weight: bold;
    }
    .nav-button:hover {
        background-color: white;
        transition: background-color 0.3s ease-in-out;
    }
    .profile{

        height:70px;
        width :70px;
        object-fit:cover;
    }
    .holder{
        display: flex;
        justify-content: center;
        width: 100%;
        position: fixed;
        z-index: 99;
        top: 0;
    }
</style>
<body>
@extends("layout.main")

@section('mainContent')
    @foreach($data['trainees']->chunk(3) as $chunk)
    <div class="card w-150 h-150 post" >
        <div class="card-body" >
            <div class="row" style="border: none; border-radius: 0.5%;  padding: 12px; display: flex; justify-content: center;">
                @foreach($chunk as $traineeasc)
                    @if($traineeasc->status == "Inactive")
                        <div class="card2-inactive" style="width: 40rem; display: flex; flex-direction: row; margin-top:5rem;">
                    @else
                        <div class="card2" style="width: 40rem; display: flex; flex-direction: row; margin-top:5rem;">
                    @endif
                        <div class="text-center" >
                        @if($traineeasc->status == "Inactive")
                            <img src="{{ $traineeasc->image }}" class="card-img-top-inactive" style=" width:80%; object-fit: cover;" alt="...">
                        @else
                            <img src="{{$traineeasc->image }}" class="card-img-top" style=" width:80%; object-fit: cover;" alt="...">
                        @endif
                        </div>
                        <div class="id-details" style="height:70%; width:75%;padding:12px;">
                            {{-- {{dd($traineeasc)}} --}}
                            <h5 class="card-title">T{{$traineeasc->kode_trainee}} - {{$traineeasc->users->nama_lengkap}}</h5>
                            <h5 class="card-title">Email             : {{$traineeasc->users->email}}</h5>
                            <h5 class="card-title">Jurusan           : {{$traineeasc->users->jurusan}}</h5>
                            <h5 class="card-title">Binusian          : B{{$traineeasc->users->binusian}}</h5>
                            <h5 class="card-title">Tanggal Lahir     : {{ $traineeasc->tanggal_lahir}}</h5>
                            <h5 class="card-title">Alamat            : {{$traineeasc->alamat}} </h5>
                            <h5 class="card-title">Contact           : {{$traineeasc->contact}}</h5>
                            <h5 class="card-title">Status            : {{$traineeasc->status}}</h5>
                            <h5 class="card-title"><button ><a class="btn btn-danger" href="{{route('inactive',['data1' => $traineeasc->uuid,'data2' => "Inactive"])}}" >Inactive</a></button>
                                <button><a class="btn btn-success" href="{{route('active',['data1' => $traineeasc->uuid,'data2' => "active"])}}">Active</a></button></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

    <div>
        <input type="hidden" id="start" value="0">
        <input type="hidden" id="rowperpage" value="{{ $data['rowperpage'] }}">
        <input type="hidden" id="totalrecords" value="{{ $data['totalrecords'] }}">
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        checkWindowSize();

        function checkWindowSize(){
            if ($(window).height() >= $(document).height()) {
                fetchData();
            }
        }

        function fetchData(){
            var start = Number($('#start').val());
            var allcount = Number($('#totalrecords').val());
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var rowperpage = Number($('#rowperpage').val());
            start = start + rowperpage;

            if(start <= allcount){
                $('#start').val(start);

                // Get session data
                var sessionData = {!! json_encode(Session::get('mysession')) !!};

                $.ajax({
                    method: 'post',
                    url: "{{ route('users.getUsers1') }}",
                    data: { start: start, sessionData: sessionData },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Authorization': 'Bearer YOUR_API_TOKEN',
                    },
                    success: function (response) {
                        $(".post:last").after(response.html).show().fadeIn("slow");
                        checkWindowSize();
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }
        }

        $(window).scroll(function(){
            if($(window).scrollTop() > $(document).height() - $(window).height() - 100) {
                fetchData();
            }
        });
    });
</script>

@endsection
</body>
</html>


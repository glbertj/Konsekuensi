@extends("layout.main")

@section('mainContent')
    <div class="mymain">
        <div class="bg-primary" id="bBoardCont">
            <marquee behavior="scroll" direction="left">
                @foreach ( $marque as $data )
                <span class="p-3 fs-2 text-white fw-bold">
                {{$data['title'].": ".$data["description"]}}
                </span>
                @endforeach
            </marquee>
        </div>

        <a href="/bBoardAdd" class="mycircleBtn bg-primary m-0  text-white" id="bBoardAdd"><span class="myposition-center" id="circleBtn1">+</span></a>
        <a href="/bBoardDelete" class="mycircleBtn bg-danger m-0  text-white" id="bBoardMin" ><span class="myposition-center" id="circleBtn2">-</span></a>
    </div>
@endsection

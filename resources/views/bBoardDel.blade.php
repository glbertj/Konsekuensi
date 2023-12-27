@extends('layout.main')
@section('mainContent')
<div class="myposition-centerx" >
    <h1 class="text-center">Delete Board</h1>
    <div id="bBoardDelCont">
        @csrf
        <form action="/bBoardDelete" method="POST" >
        @csrf
        @foreach ( $data as $board)
            <div class="myflex listContainer">
                    <span class="d-block mylabelList-item">{{$board['title']}}</span>
                    <p class="d-block mylabelList-item">{{$board['description']}}</p>
                    <button class="btn btn-danger" name="id" value="{{$board['id']}}">Del</button>
            </div>
        @endforeach
        </form>

    </div>

</div>
<a href="/buletin" class="mycircleBtn bg-primary m-0  text-white" id="bBoardBack"><span class="myposition-center" id="circleBtn3"><</span></a>
@endsection

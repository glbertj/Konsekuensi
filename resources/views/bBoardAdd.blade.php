@extends('layout.main')

@section('mainContent')
    <div class="myposition-center" >
        <h1>Add Board</h1>
        <form action="/bBoardAdd" method="post" class="myflex-column myjustify-content-center myalign-items-center" id="bBoardIn" >
            @csrf
            <input type="text" name="title" placeholder="title" id="title" required>
            <br>
            <textarea name="description" cols="51" rows="10" placeholder="description" id="description" required></textarea>
            <br>
            <button onclick="callNotification('title', 'description', 'title')" type="submit" class="btn btn-success" id="bBoardSubmit">Submit </button>
            <br>
        </form>
    </div>
@endsection


<?php
$i = 1
?>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@foreach ($project_table as $item)
<div class="col-lg">
    <div class="card  border border-secondary border-2" style="width: auto;">
        <div class="card-body">
            <h5 class="card-title fw-bold border-bottom py-2">Project {{ $i }}</h5>
            <p class="card-text fw-bold">Due: {{$item->end_date}}</p>
            <!-- Modal -->
            <div class="d-flex flex-row justify-content-between align-items-center">
                <form action="{{route('backtomodal')}}" method = "POST">
                    @csrf
                    <input type="hidden" value = "{{$item->id}}" name = "kokgada">
                    <button type="submit" value ="{{$item->id}}"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        View
                    </button>
                </form>
                @if(Auth::user()->role == "trainee admin")
                <form action="{{route('editingmodal')}}" method = "POST">
                    @csrf
                    <input type="hidden" value = "{{$item->id}}" name = "id">
                    <input type="hidden" value = "{{$i}}" name = "counting">

                    <button type="submit" value ="{{$item->id}}"class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Edit
                    </button>
                </form>
                <form action="{{route('destroy')}}" method = "POST">
                    @csrf
                    <input type="hidden" value = "{{$item->id}}" name = "id">
                    <button type="submit" value ="{{$item->id}}"class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete
                    </button>
                </form>
                @endif
                @php
                $i++;
                @endphp
            </div>
        </div>
    </div>
</div>
@endforeach









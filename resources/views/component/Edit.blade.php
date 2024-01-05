<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Project</title>
    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center my-3">
        <div class="row justify-content-md-center">
            <div class="card m-0 p-0" style="width: 30%;">
                <div class="card-header">
                    {{-- HEADER --}}
                    <h1 class="modal-title fs-3" id="createModalLabel">Project {{$count}}</h1> <br>
                    {{-- END HEADER --}}
                </div>
                <div class="card-body">
                {{-- BODY --}}
                <form action="{{route('editproject')}}" method="post">
                    @csrf
                    <input type="hidden" name = "id" value = "{{$id}}">

                    <input type="hidden" value = "{{$lists->first()->id}}" name = "listidpertama">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" value ="{{$table->first()->title}}"  name="name" aria-label="project-title">
                    </div>

                    <div class="input-group">
                        <input type="datetime-local" class="form-control" name="deadline" aria-describedby="basic-addon4" value="{{$table->first()->end_date}}">
                    </div>
                    <div class="form-text mb-2" id="basic-addon4">Due date for the project.</div>
                    @php
                        $i = 1;
                        $listidterakhir = 1;
                    @endphp
                    @foreach($lists as $list)

                        <div class="mb-3 grid">
                            <input type="text" class="form-control col-9" name="task{{$i}}" id="task{{$i}}" value="{{$list->list}}">
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" style="resize: none;" name="desc{{$i}}" id="desc{{$i}}" placeholder="{{$list->desc}}">{{$list->desc}}</textarea>
                        </div>

                        <div class="mb-4">
                            <input type="number" class="form-control col-3" name="score{{$i}}" id="score{{$i}}" value="{{$list->score}}">
                        </div>


                        @php
                            $listidterakhir = $list->id;
                            $i++;
                        @endphp
                    @endforeach
                    @php
                        $i--;
                    @endphp
                    <input type="hidden" value = "{{$i}}" id = "jumlahtask" name = "count">
                    <input type="hidden" value = "{{$listidterakhir}}" name ="listidterakhir">

                    {{-- Nanti task baru muncul disini --}}
                    <div id="new">
                    </div>

                    <button type="button" id="add" class="btn btn-primary">Add Task</button>

                    {{-- END BODY --}}
                    </div>
                    <div class="card-footer">
                        {{-- FOOTER --}}
                        <div class="modal-footer">
                            <a href="{{route('project')}}">
                                <button type="button" class="btn btn-danger m-2">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary my-2">Edit Project</button>
                    </div>
                    {{-- END FOOTER --}}
                    </div>
                </form>


            </div>
        </div>
    </div>

    <script>
        document.getElementById('add').addEventListener('click', function () {
            // Hitung jumlah kolom formulir text yang sudah ada
            var task = document.querySelectorAll('.mb-3 input[type="text"]').length;
            var scoreCount = document.querySelectorAll('.mb-4 input[name^="score"]').length;
            var count = document.getElementById('jumlahtask')

            // Buat elemen input text baru
            var newTextElement = document.createElement('div');
            newTextElement.className = '.input-group mb-3';
            newTextElement.innerHTML = `
                <input type="text" class="task form-control" id="task${task + 1}" name="task${task + 1}" placeholder="Task ${task + 1}">
            `;

            // Hitung jumlah kolom formulir textarea yang sudah ada
            var existingTextareaFields = document.querySelectorAll('.mb-3 textarea').length;

            // Buat elemen textarea baru
            var newTextareaElement = document.createElement('div');
            newTextareaElement.className = 'mb-3';
            newTextareaElement.innerHTML = `
            <textarea class="form-control" style="resize: none;" id="desc${existingTextareaFields + 1}" name="desc${existingTextareaFields + 1}" placeholder="Description..."></textarea>
            `;

            var newScoreElement = document.createElement('div');
            newScoreElement.className = 'mb-4';
            newScoreElement.innerHTML = `
                <input type="number" class="form-control" name="score${scoreCount + 1}" placeholder="Score ${scoreCount + 1}">
            `;

            // Tambahkan elemen input text baru ke dalam new
            document.getElementById('new').appendChild(newTextElement);
            // Tambahkan elemen textarea baru ke dalam new
            document.getElementById('new').appendChild(newTextareaElement);
            document.getElementById('new').appendChild(newScoreElement);
            count.value = scoreCount+1;
            console.log (count);
        });
    </script>
</body>
    {{-- BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>

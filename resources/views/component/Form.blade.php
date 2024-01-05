@if(Auth::user()->role == "trainee admin")
    <div class="col-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateModal">
            Add Project
        </button>
    </div>
@endif

<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="createModalLabel">Project title</h1> <br>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/add" method="post">
                    @csrf
                    <input type="hidden" value = 1 id = "jumlahtask" name = "count">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="Project Name" name="name" aria-label="project-title">
                    </div>

                    <div class="input-group">
                        <input type="datetime-local" class="form-control" id ="deadline" name="deadline" aria-describedby="basic-addon4">
                    </div>
                    <div class="form-text mb-2" id="basic-addon4">Due date for the project.</div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="task1" id="task1" placeholder="Task 1" required>
                    </div>

                    <div class="mb-3">
                        <textarea required class="form-control" style="resize: none;" name="desc1" id="desc1" placeholder="Description..."></textarea>
                    </div>

                    <div class="mb-4">
                        <input type="number" class="form-control" name="score1" id="score1" placeholder="Score 1" required>
                    </div>

                    {{-- Nanti task baru muncul disini --}}
                    <div id="new">
                    </div>
                    <button type="button" id="add" class="btn btn-primary">Add Task</button>
            </div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="closeModal()">Create Project</button>
                    <button id="bt1" hidden type="button" class="btn btn-primary" onclick="scheduleNotification('task1', 'desc1', 'task1', 'deadline', generalNotification, 0.1)">Create Project (5 minutes before)</button>
                    <button id="bt2" hidden type="button" class="btn btn-primary" onclick="scheduleNotification('task1', 'desc1', 'task1', 'deadline', generalNotification, 0.5)">Create Project (10 minutes before)</button>
                    <button id="bt3" hidden type="button" class="btn btn-primary" onclick="scheduleNotification('task1', 'desc1', 'task1', 'deadline', generalNotification, 1)">Create Project (15 minutes before)</button>
            </div>
                </form>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        document.querySelector('#bt1').click();
        document.querySelector('#bt2').click();
        document.querySelector('#bt3').click();
    }
    document.getElementById('add').addEventListener('click', function () {
        // Hitung jumlah kolom formulir text yang sudah ada
        var taskCount = document.querySelectorAll('.mb-3 input[name^="task"]').length;
        var scoreCount = document.querySelectorAll('.mb-4 input[name^="score"]').length;
        var count = document.getElementById('jumlahtask')

        // Buat elemen input text baru untuk task
        var newTextElement = document.createElement('div');
        newTextElement.className = 'mb-3';
        newTextElement.innerHTML = `
            <input type="text" class="form-control" name="task${taskCount + 1}" placeholder="Task ${taskCount + 1}" required>
        `;

        // Buat elemen textarea baru untuk description
        var newTextareaElement = document.createElement('div');
        newTextareaElement.className = 'mb-3';
        newTextareaElement.innerHTML = `
            <textarea required class="form-control" style="resize: none;" name="desc${taskCount + 1}" placeholder="Description..."></textarea>
        `;

        // Buat elemen input text baru untuk score
        var newScoreElement = document.createElement('div');
        newScoreElement.className = 'mb-4';
        newScoreElement.innerHTML = `
            <input type="number" class="form-control" name="score${scoreCount + 1}" placeholder="Score ${scoreCount + 1} required">
        `;

        // Tambahkan elemen input text baru untuk task ke dalam new
        document.getElementById('new').appendChild(newTextElement);
        // Tambahkan elemen textarea baru ke dalam new
        document.getElementById('new').appendChild(newTextareaElement);
        // Tambahkan elemen input text baru untuk score ke dalam new
        document.getElementById('new').appendChild(newScoreElement);
        count.value = scoreCount+1;
    });

</script>

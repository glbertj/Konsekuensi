<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your meta tags, title, and stylesheets here -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

    <style>
   :root {
        --fc-border-color: black;
        --fc-daygrid-event-dot-width: 15px;
        --fc-list-event-hover-bg-color: lightblue;
        --fc-page-bg-color: #c6ffa4;
        --fc-theme-standard-bg-color: #2c3e50;
        --fc-theme-standard-border-color: #34495e;
        --fc-daygrid-day-bg-color: #2c3e50;
        --fc-daygrid-day-top-bg-color: #34495e;
        --fc-daygrid-dot-event-bg-color: #e74c3c;
        --fc-list-day-text-color: #ecf0f1;
        --fc-list-event-text-color: #ecf0f1;
    }

    .fc-event {
        background: none !important;
        border: none !important;
        color: blue !important;
        max-width: 10px;
    }

    .fc-daygrid-event-harness {
        max-width: 10px;
    }
    .container {
        display: flex;
    }

    #calendar {
        flex: 1; /* Take remaining space */
        margin-right: 20px; /* Adjust the spacing between calendar and table */
    }

    #event-table {
        flex: 0 0 300px; /* Fixed width for the table */
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    td:last-child {
        border-bottom: none;
        color: black;
        white-space: pre-wrap;
    }
    .panel-body{
        width: 500px;
        height:auto;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #495057;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #343a40;
        font : "roboto";
    }

    .container {
        display: flex;
        justify-content: space-between; /* Adjust the spacing between calendar and table */
        max-width: 1000px; /* Adjust the maximum width of the container */
        margin: 30px 0;

    }

    .panel-body {
        width: 40%; /* Adjust the width of the calendar */
        height: auto;
    }

    .leaderboard-container {
        width: 60%; /* Adjust the width of the leaderboard container */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background-color: #ffffff;
    }

    .leaderboard-container th, .leaderboard-container td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .leaderboard-container th {
        background-color: #343a40;
        color: #ffffff;
    }

    .leaderboard-container tbody tr:hover {
        background-color: #f8f9fa;
    }

    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Task list item colors */
    .green-item {
        width: 100px;
        height: 50px;
        background-color: #4caf50;
        color: #ffffff;
        padding: 8px;
        border-radius: 4px;
    }

    .red-item {
        width:100px;
        height: 50px;
        background-color: #f44336;
        color: #ffffff;
        padding: 8px;
        border-radius: 4px;
    }

    .table-wrapper {
        max-height: 1000px;
        overflow-y: auto;
    }

    .task-list-item{
        display:flex;
        width:150px;
        height:50px;
    }

</style>

</head>
<body>
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
        @if(Auth::user()->role == "trainee admin")
            <a href="/bBoardAdd" class="mycircleBtn bg-primary m-0  text-white" id="bBoardAdd"><span class="myposition-center" id="circleBtn1">+</span></a>
            <a href="/bBoardDelete" class="mycircleBtn bg-danger m-0  text-white" id="bBoardMin" ><span class="myposition-center" id="circleBtn2">-</span></a>
        @endif
    </div>
    <div class="container">
        @if(session('error'))
            <script>
                alert("{{ session('error') }}");
            </script>
        @endif
        <div class = "box">

        </div>
        <div class="panel-body">
            <div id="calendar"></div>
        </div>
        <?php
    $uniqueListIds = [];
    ?>
    <div class="leaderboard-container">
        <div class="table-wrapper">

            <table class="leaderboard-table">
                <thead>
                <tr>
                    <th>Rank</th>
                    <th>Trainee</th>
                    <th>Total Score</th>
                    <?php foreach ($leaderboard1 as $task): ?>
                        <?php if (!in_array($task->list_id, $uniqueListIds)): ?>
                            <th>{{$task->list_title}}</th>
                            <?php $uniqueListIds[] = $task->list_id; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php
                // Sort $trainees by total score in descending order
                $sortedTrainees = $trainees->sortByDesc(function ($trainee) use ($leaderboard1) {
                    $total_score_per_trainee = 0;

                    foreach ($leaderboard1 as $task) {
                        if ($task->trainee_uuid == $trainee->uuid && $task->status == true) {
                            $total_score_per_trainee += $task->score;
                        }
                    }

                    return $total_score_per_trainee;
                });
                ?>
                <?php $i = 1; ?>
                <?php foreach ($sortedTrainees as $trainee): ?>
                    <tr>
                        <?php $total_score_per_trainee = 0; ?>
                        <td>{{$i++}}</td>
                        <td>{{$trainee->kode_trainee}}</td>
                        <td>
                            <?php
                            $total_score_per_trainee = $trainee->calculateTotalScore($leaderboard1);
                            ?>
                            {{$total_score_per_trainee}}
                        </td>
                        {{-- {{dd($uniqueListIds)}} --}}
                        <?php foreach ($uniqueListIds as $idss): ?>
                            <?php
                            $taskScore = $leaderboard1->first(function ($item) use ($trainee, $idss) {
                                return $item->trainee_uuid == $trainee->uuid && $item->list_id == $idss;
                            });
                            ?>
                            <td>
                                <div class="task-list-item <?php echo ($taskScore && $taskScore->status == true) ? 'green-item' : 'red-item'; ?>">
                                    <p><?php echo $taskScore? $taskScore->score:'N/A'; ?></p>
                                </div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function get_time(date) {
            return `${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                initialView: 'listMonth', // Set initial view to listMonth
                headerToolbar: {
                    left: 'title', // Display only the title in the header
                    right: 'prev,next,today'
                },
                events: '/api/events',
                editable: false,
                selectable: false,
                dateClick: function ({ date, jsEvent, view }) {
                    $('#start').val(date.toISOString());
                    $('#end').val(new Date(date.getTime() + (60 * 60 * 1000)).toISOString());
                    $('listMonth').modal('show');
                },
                eventContent: function (arg) {
                    const start = arg.event.start;
                    const end = arg.event.end;
                    start.setHours(start.getHours() - 14);
                    end.setHours(end.getHours() - 14);

                    const dueTime = end ? (end - start) / (60 * 1000) : 0;

                    const hours = Math.floor(dueTime / 60);
                    const minutes = dueTime % 60;
                    let dueTimeString = '';

                    if (hours > 0) {
                        dueTimeString += `${hours}h `;
                    }
                    if (minutes > 0) {
                        dueTimeString += `${minutes}m`;
                    }

                    const title = arg.event.title;

                    return {
                            html: `</div>-${title} </div>`,
                            backgroundColor: arg.event.backgroundColor,
                        };
                },
            });

            calendar.render();
        });
    </script>
    @endsection
</body>
</html>

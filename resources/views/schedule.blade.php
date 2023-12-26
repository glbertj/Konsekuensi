    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
        <title>Calendar</title>
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
        </style>
    </head>
    <body>
        <div class = "container">   
            <h1>
                DAILY SCHEDULE NAR 24-1 (PLEASE READ AND CHECK THE DEADLINES!   )
            </h1>
            @if(session('error'))
                <script>
                    alert("{{ session('error') }}");
                </script>
            @endif
            <div class = "panel-body">
                <div id = "calendar"></div>
            </div>
        </div>
        <div id = "eventmodal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Insert New Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" data-bs-dismiss="modal">&times;</span>
                        </button>
                    </div>
                    <form action="/api/events" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start time</label>
                                <input class="form-control" type="time" name="start_time" id="start_time">
                            </div>

                            <div class="mb-3">
                                <label for="end_time" class="form-label">End time</label>
                                <input class="form-control" type="time" name="end_time" id="end_time">
                            </div>

                            {{-- <div class="mb-3">
                                <label for="due_time" class="form-label">Due Time</label>
                                <input class="form-control" type="datetime-local" name="end_time" id="end_time">
                            </div> --}}

                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="color" class="form-control form-control-color" name="color" id="color" value="#0082e5">
                            </div>

                            <input type="hidden" name="start" id="start">
                            <input type="hidden" name="end" id="end">
                            {{-- <input type="hidden" name="due" id="due"> --}}

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id = "eventmodal2" class="modal" tabindex="-1+" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" data-bs-dismiss="modal">&times;</span>
                        </button>
                    </div>
                    <form id="formedit" action="/api/events" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control" id="title2" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="start_time2" class="form-label">Start time</label>
                                <input class="form-control" type="time" name="start_time" id="start_time2">
                            </div>

                            <div class="mb-3">
                                <label for="end_time2" class="form-label">End time</label>
                                <input class="form-control" type="time" name="end_time" id="end_time2">
                            </div>

                            {{-- <div class="mb-3">
                                <label for="due_time2" class="form-label">Due</label>
                                <input class="form-control" type="time" name="end_time" id="end_time2">
                            </div> --}}

                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="color" class="form-control form-control-color" name="color" id="color2" value="#0082e5">
                            </div>

                            <input type="hidden" name="start" id="start2">
                            <input type="hidden" name="end" id="end2">
                            <input type="hidden" name="id" id="id2">
                            {{-- <input type="hidden" name="due" id="due2"> --}}
                            <input type="hidden" name="_method" value="PUT">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete</button>  
                        </div>
                    </form>
                </div>
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
                    headerToolbar: {
                        left: 'dayGridMonth, timeGridWeek, timeGridDay, listMonth',
                        center: 'title',
                        right: 'prev,next,today'
                    },
                    events: '/api/events',
                    editable: false,
                    selectable: true,
                    views: {
                        dayGridMonth: {
                            titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' }
                        }
                    },
                    dateClick: function ({ date, jsEvent, view }) {
                        $('#start').val(date.toISOString());
                        $('#end').val(new Date(date.getTime() + (60 * 60 * 1000)).toISOString());
                        $('#eventmodal').modal('show');
                    },
                    eventClick: function ({ event, jsEvent, view }) {
                        const start = new Date(event.start);
                        const end = new Date(event.end);
                        const id = event.id;
                        const due = (end-start)/(60 * 1000);
                        console.log(due);

                        console.log("start:", start);
                        console.log("end:", end);
                        
                        console.log("start_time:", $('#start2').val());
                        console.log("end_time:", $('#end2').val());
        
                        $('#formedit').attr('action', '/api/events/' + event.id);
                        $('#id2').val(event.id);
                        $('#start2').val(event.start.toISOString());
                        $('#end2').val(event.end.toISOString());
                        $('#due2').val(due);
                        $('#title2').val(event.title);
                        $('#color2').val(event.backgroundColor);
                        // $('#start_time2').val(get_time(start));
                        // $('#end_time2').val(get_time(end));
                        $('#eventmodal2').modal('show');

                        console.log("id: ", $('#id2').val());
                    },
                    eventContent: function (arg) {
                        const start = arg.event.start;
                        const end = arg.event.end;
                        //const dueTime = (end - start) / (60 * 1000);
                        console.log(end);
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
                        const maxCharacters = 16;
        
                        let formattedTitle = '';
                        for (let i = 0; i < title.length; i += maxCharacters) {
                            const line = title.substr(i, maxCharacters);
                            formattedTitle += line + '<br>';
                        }
        
                        return {
                            html: `<div style="color : blue;"><div><span style="display:inline-block; width:10px; height:10px; background-color:${arg.event.backgroundColor};">
                                </span>&nbsp;<b>Start:</b> ${start.toLocaleTimeString()}</div>
                                    </div<br><div style="display:flex;"><b>End:</b> &nbsp;${end.toLocaleTimeString()}&nbsp;
                                    <p style="color: red;">(${dueTimeString})
                                </p> </div><div style="white-space; pre-wrap; color: black;">- 
                                    ${formattedTitle}</div><br> </div>`,
                            backgroundColor: arg.event.backgroundColor, 
                        };

                    },
                    
                });
                function updateEventSource(viewType) {
                    var ajax = new XMLHttpRequest();
                    ajax.open('GET', '/api/events?view=' + viewType, true);
                    ajax.onload = function () {
                        var schedule = JSON.parse(this.response);
                        calendar.removeAllEvents();
                        calendar.addEventSource(schedule);
                    };
                    ajax.send();
                }
        
                $('#formedit').submit(function (event) {
                    event.preventDefault();

                    var start = new Date($('#start2').val());
                    var end = new Date($('#end2').val());
                    var id = $('#id2').val();
                    //end.setHours(end.getHours() - 24);
                    var startUTC = new Date(start.getTime() - (start.getTimezoneOffset() * 60000)).toISOString();
                    var endUTC = new Date(end.getTime() - (end.getTimezoneOffset() * 60000)).toISOString();

                    console.log(id);
                    
                    $('#start2').val(startUTC);
                    $('#end2').val(endUTC);

                    var diffInMs = end - start;
                    var diffInHours = diffInMs / (1000 * 60 * 60);

                    $('#due2').val(diffInHours + ' hours');


                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function (response) {
                            $('#eventmodal2').modal('hide');
                            location.reload();
                        },
                        error: function (error) {
                            console.error('Error:', error);
                        }
                    });
                });
                $('#deleteEventBtn').click(function () {
                    var confirmation = confirm("Are you sure you want to delete this event?");
                    if (confirmation) {
                        var eventId = $('#id2').val();
                        $.ajax({
                            type: 'DELETE',
                            url: '/api/events/' + eventId,
                            success: function (response) {
                                $('#eventmodal2').modal('hide');
                                location.reload();
                            },
                            error: function (error) {
                                console.error('Error:', error);
                                console.log(eventId);
                                location.reload();
                            }
                        });
                    }
                });
                $('#form').submit(function (event) {
                    event.preventDefault();
        
                    var start = new Date($('#start').val());
                    var end = new Date($('#end').val());
        
                    console.log(start)
                    console.log(end)
                    if (end <= start) {
                        $('#eventmodal').modal('show');
                        return;
                    }
                    var diffInMs = end - start;
                    var diffInHours = diffInMs / (1000 * 60 * 60);


                    $('#due').val(diffInHours + ' hours');

                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function (response) {
                            $('#eventmodal').modal('hide');
                            location.reload();
                        },
                        error: function (error) {
                            console.error('Error:', error);
                        }
                    });
                });
                calendar.render();
            });
        </script>
    </body>
    </html>

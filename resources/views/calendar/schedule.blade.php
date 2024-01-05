    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @extends('layout.main')
        @section('mainContent')
            <div class = "container">
                <h1>
                    DAILY SCHEDULE NAR 24-1 (PLEASE READ AND CHECK THE DEADLINES! )
                </h1>
                @if (session('error'))
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
                        <form id="form" action="/api/events" method="POST">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input class="form-control" id="title" name="title" required>
                                </div>

                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Start time</label>
                                    <input class="form-control" type="time" name="start_time" id="start_time">
                                    {{-- <select name="start_am_pm" id="start_am_pm" class="form-select">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select> --}}
                                </div>

                                <div class="mb-3">
                                    <label for="end_time" class="form-label">End time</label>
                                    <input class="form-control" type="time" name="end_time" id="end_time">
                                    {{-- <select name="end_am_pm" id="end_am_pm" class="form-select">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select> --}}
                                </div>

                                <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="color" class="form-control form-control-color" name="color"
                                        id="color" value="#0082e5">
                                </div>

                                <input type="hidden" name="start" id="start">
                                <input type="hidden" name="end" id="end">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
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
                            @csrf
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

                                <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="color" class="form-control form-control-color" name="color"
                                        id="color2" value="#0082e5">
                                </div>

                                <input type="hidden" name="start" id="start2">
                                <input type="hidden" name="end" id="end2">
                                <input type="hidden" name="id" id="id2">
                                <input type="hidden" name="_method" value="PUT">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                            <form id="formedit" action="/api/events" method="POST">
                                <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function get_time(date) {
                    return `${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
                }

                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        timeZone: 'UTC',
                        eventTimeFormat: {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: false
                        },
                        slotLabelFormat: {
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: false
                        },
                        headerToolbar: {
                            left: 'dayGridMonth, timeGridWeek, timeGridDay, listMonth',
                            center: 'title',
                            right: 'prev,next,today'
                        },
                        events: '/api/events',
                        editable: false,
                        views: {
                            dayGridMonth: {
                                titleFormat: {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }
                            }
                        },
                        dateClick: function({
                            date,
                            jsEvent,
                            view
                        }) {
                            $('#start').val(date.toISOString());
                            $('#end').val(new Date(date.getTime() + (60 * 60 * 1000)).toISOString());
                            $('#eventmodal').modal('show');
                        },
                        eventClick: function({
                            event
                        }) {
                            const start = new Date(event.start);
                            const end = new Date(event.end);
                            const id = event.id;
                            const due = (end - start) / (60 * 1000);

                            $('#formedit').attr('action', '/api/events/' + event.id);
                            $('#id2').val(event.id);
                            $('#start2').val(event.start.toISOString());
                            $('#end2').val(event.end.toISOString());
                            $('#due2').val(due);
                            $('#title2').val(event.title);
                            $('#color2').val(event.backgroundColor);

                            const startTime = start.getHours() + ':' + ('0' + start.getMinutes()).slice(-2);
                            const endTime = end.getHours() + ':' + ('0' + end.getMinutes()).slice(-2);

                            $('#start_time2').val(startTime);
                            $('#end_time2').val(endTime);

                            $('#eventmodal2').modal('show');
                        },
                        eventContent: function(arg) {
                            const start = arg.event.start ? new Date(arg.event.start) : null;
                            const end = arg.event.end ? new Date(arg.event.end) : null;

                            if (start && end) {
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

                                dueTimeString = (hours > 24 ? (hours % 24).toString() : hours) + 'h ' + (
                                    minutes < 10 ? '0' + minutes : minutes) + 'm';
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
                            }
                        }
                    });

                    $('#form').submit(function(event) {
                        var start = new Date($('#start').val());
                        var startHours = parseInt($('#start_time').val().split(':')[0]);
                        var startMinutes = parseInt($('#start_time').val().split(':')[1]);

                        if (startHours >= 17 && startHours <= 24 && startMinutes >= 0 && startMinutes <= 59) {
                            start.setDate(start.getDate() - 1); // Subtract 1 day from the start date
                            $('#start').val(start.toISOString()); // Update the start date input value

                            // Your AJAX request to post data to the server including the modified start date
                            $.ajax({
                                type: 'POST',
                                url: $(this).attr('action'),
                                data: $(this).serialize(),
                                success: function(response) {
                                    $.ajax({
                                        type: 'POST',
                                        url: '/api/events',
                                        data: $(this)
                                            .serialize(), // Send data to the API including the modified start date
                                        success: function(apiResponse) {
                                            console.log('Data posted to API:', apiResponse);
                                        },
                                        error: function(apiError) {
                                            console.error('Error posting data to API:',
                                                apiError);
                                        }
                                    });
                                },
                                error: function(error) {
                                    // Error handling logic here...
                                }
                            });

                            $('#eventmodal').modal('hide');
                            location.reload();
                            return false;
                        }

                        // Continue with your form submission logic for other cases...
                    });



                    $('#formedit').submit(function(event) {
                        var startHours = parseInt($('#start_time2').val().split(':')[0]);
                        var startMinutes = parseInt($('#start_time2').val().split(':')[1]);
                        var start = new Date($('#start2').val());
                        var end = new Date($('#end2').val());

                        if (end <= start) {
                            $('#eventmodal2').modal('show');
                            return;
                        }

                        if (startHours >= 17 && startHours <= 24 && startMinutes >= 0 && startMinutes <= 59) {
                            start.setDate(start.getDate() - 1); // Subtract 1 day from the start date
                            $('#start2').val(start.toISOString()); // Update the start date input value
                        }

                        var eventId = $('#id2').val();
                        var eventIdPlusOne = parseInt(eventId) + 1; // Increment the ID by 1
                        var apiUrl = '/api/events/' + eventIdPlusOne; // Update the API URL

                        var diffInMs = end - start;
                        var diffInHours = diffInMs / (1000 * 60 * 60);

                        $('#due2').val(diffInHours + ' hours');

                        $.ajax({
                            type: 'POST',
                            url: apiUrl, // Use the updated URL
                            data: $(this).serialize(),
                            success: function(response) {
                                $('#eventmodal2').modal('hide');
                                location.reload();
                            },
                            error: function(error) {
                                console.error('Error:', error);
                            }
                        });
                    });


                    $(document).ready(function() {
                        $('#deleteBtn').click(function() {
                            var eventId = $('#id2').val(); // Get the ID of the event to delete

                            // Get CSRF token from the meta tag
                            var token = $('meta[name="csrf-token"]').attr('content');

                            $.ajax({
                                type: 'DELETE',
                                url: '/api/events/' + eventId,
                                headers: {
                                    'X-CSRF-TOKEN': token // Set CSRF token in request header
                                },
                                success: function(response) {
                                    // Handle success, such as hiding the modal or displaying a success message
                                    $('#eventmodal2').modal('hide');
                                    location
                                .reload(); // Refresh the page after successful deletion
                                },
                                error: function(error) {
                                    console.error('Error deleting event:', error);
                                    // Handle the error, show a message, or take appropriate action
                                }
                            });
                        });
                    });




                    calendar.render();
                });
            </script>
        @endsection
    </body>

    </html>

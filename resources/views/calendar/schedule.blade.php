<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
                crossorigin="anonymous">
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

                /*
                .fc-event {
                    background: none !important;
                    border: none !important;
                    color: blue !important;
                    max-width: 10px;
                }

                .fc-daygrid-event-harness {
                    max-width: 10px;
                } */
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
                            <form id="form" action="{{ route('store') }}" method="POST">
                                @csrf
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
                            <form id="formedit" action="" method="POST">
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                            </form>
                            <form id="deletBtn" action="/api/events" method="POST">
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
                            timeZone: 'Asia/Jakarta',
                            eventTimeFormat: {
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: false,
                            },
                            height: 'auto',
                            scrollTime: '00:00',
                            scrollTimeEnd: '24:00',

                            slotLabelFormat: {
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: false
                            },
                            headerToolbar: {
                                left: 'prev,next',
                                center: 'title',
                                right: 'dayGridMonth,timeGridDay,listMonth'
                            },
                            eventDidMount: function(info) {
                                var {
                                    view,
                                    el
                                } = info;
                                if (view.type === 'dayGrid' && el.nextElementSibling === null) {
                                    calendar.next();
                                }
                            },

                            events: '/api/events',
                            editable: true,
                            views: {
                                dayGridMonth: {
                                    titleFormat: {
                                        year: 'numeric',
                                        month: '2-digit',
                                        day: '2-digit'
                                    }
                                },
                                day: {
                                    dayMaxEventRows: 1
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
                                const start = arg.event.start;
                                const end = arg.event.end;

                                // console.log(arg.event.start);

                                if (start && end) {
                                    start.setHours(start.getHours() + 17);
                                    end.setHours(end.getHours() + 17);

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
                                        html: `
                                        <div style="background-color:${arg.event.backgroundColor}; padding: 0%; margin:0px;">
                                            <div style="color: white; padding: 5px"><div>
                                            <p style="color: yellow;">&nbsp;${start.toLocaleTimeString()} - ${end.toLocaleTimeString()}&nbsp;
                                            </p> </div><div style="white-space; pre-wrap; color: white;">
                                                ${formattedTitle}</div></div>
                                        </div>`,
                                        backgroundColor: arg.event.backgroundColor,
                                    };
                                }
                            }
                        });

                        $(document).ready(function() {
                            $('#deleteBtn').click(function() {
                                var eventId = $('#id2').val();

                                var token = $('meta[name="csrf-token"]').attr('content');

                                $.ajax({
                                    type: 'DELETE',
                                    url: '/api/events/' + eventId,
                                    headers: {
                                        'X-CSRF-TOKEN': token
                                    },
                                    success: function(response) {
                                        $('#eventmodal2').modal('hide');
                                        location
                                            .reload();
                                    },
                                    error: function(error) {
                                        console.error('Error deleting event:', error);
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

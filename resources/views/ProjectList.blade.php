<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project List</title>
    {{-- <script src="{{ asset('js/notification-scheduler.js') }}"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .checks {
            margin-right: 6px;
            color: rgb(6, 185, 6);
            padding-top: 0;
            margin-top: 0;
            width: 30px;
            height: 30px;
        }

        label {
            font-weight: 500;
            color: #f50000;
            cursor: pointer;
        }

        .checks::before {
            accent-color: rgb(138, 0, 0);
        }

        .checks:checked {
            accent-color: rgb(0, 135, 20);
        }

        .checks:checked ~ label {
            color: rgb(0, 135, 20);
        }
    </style>
</head>
<body>
    @extends("layout.main")
    @section('mainContent')
    <div class="container text-center py-3">
        <div class="row">
        <div class="col-md-4 ms-auto"></div>
        </div>
        <div class="row">
            @include('component.Form', ['users' => $users, 'project_user' => $project_user, 'project_table' => $project_table, 'list' => $list])
        </div>
    </div>

    <div class="d-flex">
        <main class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-2">
                @include('component.Card', ['users' => $users, 'project_user' => $project_user, 'project_table' => $project_table, 'list' => $list,'aku' =>$aku])
            </div>
        </main>
    </div>
    @endsection

  <!-- Modal -->
  {{-- @include('component.Modal', ['users' => $users, 'project_user' => $project_user, 'project_table' => $project_table, 'list' => $list]) --}}
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>

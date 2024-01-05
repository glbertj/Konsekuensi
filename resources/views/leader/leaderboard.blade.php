<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #333;
            color: #fff;
        }

        h1 {
            margin: 0;
            text-align: center;
            font: "roboto";
        }

        .leaderboard-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        select {
            width: 80%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            line-height: 2; /* Set the line height to control vertical alignment */
        }

        .horiz{
            display: flex;
            flex-direction: row;
        }


    </style>
    @if(!$leaderboard->isEmpty())
    <title>Leaderboard - {{$leaderboard->first()->project_title}}</title>
    @else
    <title>Leaderboard - 24 1</title>
    @endif

</head>
@extends("layout.main")

<body>
    @section('mainContent')
        @if(!$leaderboard->isEmpty())
            @include('leader.leaderboardNav',['leader' => $leaderboard,'projecttit' =>$projecttitle])
            <br>
                @if ($projectId == 0)
                    <h1>Leaderboard NAR 24-1</h1>
                @else
                    <h1>{{$leaderboard1[0]->project_title}}</h1>
                @endif

            <br>
            @include('leader.project',['leader' => $leaderboard1,'trainees' => $trainee])
        @else
            <h1 style="font-size: 100px">Leaderboard NAR 24-1</h1>

            <br>
            <br>
            <br>

            <h1 style="font-size: 75px">No Current Leaderboard</h1>
        @endif


    @endsection
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard Styles</title>
    <style>
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
        }

        .leaderboard-container {
            width: 80%;
            margin: 20px auto;
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
            background-color: #4caf50;
            color: #ffffff;
            padding: 8px;
            border-radius: 4px;
        }

        .red-item {
            background-color: #f44336;
            color: #ffffff;
            padding: 8px;
            border-radius: 4px;
        }

    </style>
</head>
<body>

    <?php
    $uniqueListIds = [];
    ?>
    <div class="leaderboard-container">
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
                    <?php foreach ($uniqueListIds as $idss): ?>
                        <?php
                        $taskScore = $leaderboard1->first(function ($item) use ($trainee, $idss) {
                            return $item->trainee_uuid == $trainee->uuid && $item->list_id == $idss;
                        });
                        ?>
                        <td>
                            <div class="task-list-item <?php echo ($taskScore && $taskScore->status == true) ? 'green-item' : 'red-item'; ?>">
                                <?php echo $taskScore ? $taskScore->score : 'N/A'; ?>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

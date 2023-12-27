<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"></script>
    <script src="{{ asset('js/notification-scheduler.js') }}"></script>
</head>
<body>
    <label for="taskTime">Task Time:</label>
    <input type="datetime-local" id="taskTime">
    <input type="text" id="taskTitle" placeholder="Task Title">
    <input type="text" id="taskBody" placeholder="Task Body">
    <input type="text" id="taskTarget" placeholder="On-click-direct-to link">

<<<<<<< HEAD
    <button onclick="callNotification('taskTitle', 'taskBody', 'taskTarget', generalNotification)">Instant Task</button>
    <button onclick="scheduleNotification('taskTitle', 'taskBody', 'taskTarget', 'taskTime')">Schedule Task</button>
=======
    <button onclick="callNotification('taskTitle', 'taskBody', 'taskTarget')">Instant Task</button>
    <button onclick="callNotification('taskTitle', 'taskBody', 'taskTarget', 'taskTime')">Schedule Task</button>
>>>>>>> c8af0f18b041b1a08bf1bd25cc69bf535d709f7f

    <br> <br>

    <button onclick="generalNotification('Binusmaya time', 'This opens binusmaya website', 'https\://binusmaya.binus.ac.id/')">BinusMaya notification demo</button>
</body>
</html>
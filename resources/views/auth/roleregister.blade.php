<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #4e73df;
        }

        form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label, select, button {
            font-size: 1.2em;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            background-color: #65AFFF;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form action="register/role" method="post">
        @csrf
        <label for="role">I am a:</label>
        <select name="role" id="role">
            <option value="trainer">Trainer</option>
            <option value="trainee">Trainee</option>
        </select>
        <button type="submit">Choose Role</button>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">Back to Login</a>
        </div>
    </form>

</body>
</html>

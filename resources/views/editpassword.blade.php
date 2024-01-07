<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>

        body {
            background-color: #000bff;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        

        h1{
            text-align: center;
            color: darkblue;
        }

        img {
            padding: 10px;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            margin: 0 auto;
            box-sizing: border-box;
            border: 5px solid #000bff;
            display: block;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        input[type="text"]{
            width: 100%;
            box-sizing: border-box;
            background: none;
            color: darkblue;
            margin-bottom: 20px;
            padding: 10px;
            border: none;
            border-bottom: 1px solid darkred;
            font-weight: bolder;
            font-size: medium;
        }
        input[type="password"]{
            width: 100%;
            box-sizing: border-box;
            background: none;
            color: darkblue;
            margin-bottom: 20px;
            padding: 10px;
            border: none;
            border-bottom: 1px solid darkred;
            font-weight: bolder;
            font-size: medium;
        }


        #tombol2 {
            width: 150px;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 30px;
            margin-left: 125px;
        }
    </style>
</head>
<body>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('change_password_failed'))
            <div class="alert alert-danger">
                {{ session('change_password_failed') }}
            </div>
        @endif
    <div class ="box">
    <form action="{{ route('editpass') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>CHANGE YOUR PASSWORD</h1>
        <input type="text" name = "email" placeholder="Email">
        <input type="password" name = "password" placeholder="New Password">
        <input type="password" name = "confirmpassword" placeholder="Confirm Password">
        <button id="tombol2">Change Password</button>
        @if(Session::get('mysession')['role'] == "trainee" || Session::get('mysession')['role'] == "trainee admin")
            <a class="small" href="{{ route('edittrainee') }}">Back!</a>
        @endif
        @if(Session::get('mysession')['role'] == "trainer" )
            <a class="small" href="{{ route('edittrainer') }}">Back!</a>
        @endif
    </form>
    </div>

</body>
</html>

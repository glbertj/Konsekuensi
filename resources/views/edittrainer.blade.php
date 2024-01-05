<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Profile</title>
    <style>

        body {
           background-color: #376eff;
           margin: 0;
           font-family: 'Arial', sans-serif;
           display: flex;
           justify-content: center;
           align-items: center;
           height: 100vh;
        }

        .box{
            border: 2px solid darkblue;
            border-radius: 5px;
            box-sizing: border-box;
            height: 500px;
            width: 300px;
            background-color: whitesmoke;
            overflow: hidden;
            padding: 20px;
            text-align: center;
        }

        img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            box-sizing: border-box;
            border: 5px solid #376eff;
            display: block;
            margin: 0 auto 20px;
        }

        input[type="text"]{
            width: 100%;
            box-sizing: border-box;
            background: none;
            color: black;
            margin-bottom: 20px;
            padding: 10px;
            border: none;
            border-bottom: 1px solid darkred;
            font-size: 16px;
        }

        input[type="file"]{
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .btn{
            display: flex;
            justify-content: space-around;
       }

        button {
            flex: 1;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s ease;
            max-width: 300px;
        }

        button:hover {
            background-color: #45a049;
        }
        #button2 {
            flex: 1;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s ease;
            max-width: 300px;
        }

    </style>
</head>
<body>

    <div class="box">
        @if(session('change_password_failed'))
        <div class="alert alert-danger">
            <p>{{ session('change_password_success') }}</p>
        </div>
        @endif
        <form action="{{ route('edittrainerdata') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name = "nama" placeholder="Nama Lengkap">
            <input type="text" name = "jurusan" placeholder="Jurusan">
            <input type="text" name = "binusian" placeholder="Binusian(Angka)">
            <input type="text" name = "inisial" placeholder="Inisial">
            <input type="text" name = "jabatan" placeholder="Jabatan">
            <div class="btn">
                <button id="tombol1">Update</button>
            </div>
        </form>
        <br>
        <form action="{{ route('editpassview') }}">
            <div class = "btn">
                <button id="tombol2">Change Password</button>
            </div>
        </form>
        <a class="small" href="{{ route('buletin') }}">Back!</a>
    </div>

</body>
</html>

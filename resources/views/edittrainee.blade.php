<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            background-color: #4064d4;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .box {
            /* border: 4px solid #1B2845; */
            border-radius: 5px;
            box-sizing: border-box;
            height: 900px;
            width: 400px;
            background-color: #F7EBE8;
            margin: 75px auto;
            overflow: hidden;
            padding: 20px;
            text-align: center; /* Center align text */
        }

        img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 5px solid #1B2845;
            margin: 0 auto 20px;
            display: block;
            cursor: pointer;
        }

        h3 {
            margin-bottom: 20px;
            color: #1B2845;
            font-size: 1.2em;
        }

        input[type="text"],
        input[type="file"],
        input[type="date"] {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
            padding: 10px;
            border: none;
            border-bottom: 1px solid darkred;
            font-weight: bolder;
            font-size: medium;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        .radio label {
            margin-right: 15px;
        }

        .btn {
            display: flex;
            justify-content: space-between;
        }

        button {
            flex: 1;
            padding: 10px;
            background-color: #4064d4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s ease;
            max-width: 350px;
        }
        button:hover{
            background-color: #4e73df;

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
        @if(session('change_password_failed'))
        <div class="alert alert-danger">
            {{ session('change_password_failed') }}
        </div>
        @endif
        <form action="{{ route('edittraineedata') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Add an ID to the image for easier reference in JavaScript -->
            <img id="profileImage" src="{{Session::get('mysession')['image']}}">
            <h3>Welcome, {{Session::get('mysession')['name']}}</h3>
            <!-- Hidden file input -->
            <input type="file" name="image" id="file" accept="image/*">
            <input type="text" name="nama" placeholder="Nama">
            <input type="text" name="jurusan" placeholder="Jurusan">
            <input type="text" name="binusian" placeholder="Binusian">
            <input type="text" name="kodetrainee" placeholder="Kode Trainee">
            <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir">
            <input type="text" name="alamat" placeholder="Alamat">
            <input type="text" name="contact" placeholder="Contact">
            <div class="radio">
                <input type="radio" name="status" id="active" value = "Active" checked>
                <label for="active">Active</label>
                <input type="radio" name="status" id="inactive" value = "Inactive">
                <label for="inactive">Inactive</label>
            </div>
            <br>
            <br>
            <div class="btn">
                <button id="button1">Update</button>
            </div>
        </form>
        <br>
        <form action="{{ route('editpassview') }}">
            <div class="btn">
                <button id="button2">Change Password</button>
            </div>
        </form>
        <br>
        <a class="small" href="{{ route('buletin') }}">Back!</a>

        <script>
            // JavaScript to trigger the file input when the image is clicked
            const profileImage = document.getElementById('profileImage');
            const fileInput = document.getElementById('file');

            profileImage.addEventListener('click', () => {
                fileInput.click();
            });

            // Update the label text when a file is selected
            fileInput.addEventListener('change', () => {
                const fileLabel = document.getElementById('fileLabel');
                fileLabel.textContent = fileInput.files[0] ? fileInput.files[0].name : 'Change Profile Picture';
            });
        </script>
    </div>

</body>

</html>

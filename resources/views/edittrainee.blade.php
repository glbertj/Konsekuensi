<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            background-color: #39A7FF;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .box {
            border: 4px solid #39A7FF;
            border-radius: 2rem;
            box-sizing: border-box;
            height: 700px;
            width: 400px;
            background-color: rgb(245, 245, 245, 0.8);
            margin: 75px auto;
            overflow: hidden;
            padding: 20px;
            text-align: center;
        }

        img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 3px solid #39A7FF;
            margin: 0 auto 20px;
            display: block;
            cursor: pointer;
        }

        h3 {
            margin-bottom: 20px;
            color: darkblue;
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
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s ease;
            max-width: 350px;
        }
    </style>
</head>

<body>

    <div class="box">
        
        {{-- {{ $user }} --}}
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
            <img id="profileImage" src="{{Session::get('mysession')['image']}}" style="object-fit: cover;">
            <h3>Welcome, {{Session::get('mysession')['name']}}</h3>
            <!-- Hidden file input -->
            <input type="file" name="image" id="file" accept="image/*">

            <input type="text" name="alamat" placeholder="Alamat" value="{{ $trainee['alamat'] }}">
            <input type="text" name="contact" placeholder="Contact" value="{{ $trainee['contact'] }}">
            {{-- <div class="radio">
                <input type="radio" name="status" id="active" value = "Active" checked>
                <label for="active">Active</label>
                <input type="radio" name="status" id="inactive" value = "Inactive">
                <label for="inactive">Inactive</label>
            </div> --}}
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

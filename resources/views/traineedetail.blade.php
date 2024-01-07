<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    {{-- <link rel="stylesheet" href="{{asset('css/auth-home-style.css')}}"> --}}
    <style>
        body{
    top: 0;
}

#outer-container{
    position: absolute;
    width: 100%;
    height: 100vh;
    background-color: rgb(148, 174, 208);
}

#inner-container{
    margin: 0 auto;
    width: 85%;
    height: 85%;
    background-color: #c0d4e0;
    border-style: solid;
    border-width: thin;
    border-radius: 20px;
    margin-top:50px;
    display: flex;
    justify-content: space-between;
}

.display-container{
    width: 50%;
    display: flex;
    flex-direction: row;
}

#img-container{
    margin: auto;
}

#img-display{
    min-width: 300px;
    max-width: 400px;
    min-height: 300px;
    max-height: 400px;
    border-radius: 20px;
    border-style: solid;
    border-color: rgb(220, 161, 88);
    border-width: 5px;
    /* margin-top:100px; */
    margin: 0 auto;

}

#data-container{
    text-align: left;
    flex-direction: column  ;
}

#myProfile{
   text-align: center;
   margin-top: 75px;
   font-size: 35px;
   font-family: Verdana, Geneva, Tahoma, sans-serif

}

#data-text{
    font-size: 20px;
    /* padding-top: 10px; */
}

#edit-button {
	background-color:#aedaf5;
	border-radius:10px;
	border:2px solid #3ba1cc;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:17px;
	padding:15px 35px;
	text-decoration:none;
}
#edit-button:hover {
	background-color:#3695b5;
}

#logout-button {
	background-color:#eb7c63;
	border-radius:10px;
	border:2px solid #a14f2c;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:17px;
	padding:15px 35px;
	text-decoration:none;
}
#logout-button:hover {
	background-color:#ff5454;
}
#button-container{
    margin-top: 30px;
    display: flex;
    justify-content: space-evenly;
}
    </style>
</head>
<body>
    {{-- Hi, {{Auth::user()->name}}  --}}
    <div class="container" id="outer-container">
        <div class="container" id="inner-container">
            <div class="display-container" id="img-container">
               <img id="img-display" src="{{Session::get('mysession')['image']}}">
            </div>
            <div class="display-container" id="data-container">
                <span id="myProfile">Profile</span>
                <div id="data-text">
                    <p>Nama : {{Session::get('mysession')['name']}}</p>
                    <p>Kode Trainee : {{Session::get('mysession')['kode']}}</p>
                    <p>Jurusan : {{Session::get('mysession')['jurusan']}}</p>
                    <p>Binusian :{{Session::get('mysession')['binusian']}}</p>
                    <p>DOB :{{Session::get('mysession')['dob']}}</p>
                    <p>Alamat :{{Session::get('mysession')['alamat']}}</p>
                    <p>Contact :{{Session::get('mysession')['contact']}}</p>
                </div>
                <div  id="button-container">
                    <form action="{{ route('edittrainee') }}">
                    <button id="edit-button" type="submit">Edit Profile</button>
                    </form>
                    <form action="{{ route('buletin') }}">
                        <button id="edit-button" type="submit">Go Back</button>
                        </form>
                    <form action="/logout" method="GET">
                    <button id="logout-button"type="submit">Log Out</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>
</html>

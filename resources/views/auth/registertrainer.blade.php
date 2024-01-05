<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
  <meta name="author" content="">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('register.trainer') }}" method="POST" class="user" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name = "roles" id = "roles" value = "{{$role}}">
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <div class="form-group">
                                    <input name="nama" type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="exampleInputName" placeholder="Name">
                                    @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Email Address">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="initial" type="text" class="form-control form-control-user @error('initial') is-invalid @enderror" id="InisialTrainer" placeholder="Insial Trainer">
                                    @error('initial')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="jabatan" type="text" class="form-control form-control-user @error('jabatan') is-invalid @enderror" id="JabatanTrainer" placeholder="Jabatan Trainer">
                                    @error('jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="binusian" type="text" class="form-control form-control-user @error('binusian') is-invalid @enderror" id="exampleInputAddress" placeholder="binusian">
                                    @error('binusian')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="jurusan" type="text" class="form-control form-control-user @error('jurusan') is-invalid @enderror" id="exampleInputAddress" placeholder="jurusan">
                                    @error('jurusan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="confirmpassword" type="password" class="form-control form-control-user @error('confirmpassword') is-invalid @enderror" id="exampleRepeatPassword" placeholder="Repeat Password">
                                        @error('confirmpassword')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                                </div>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    </form>

</body>
</html>

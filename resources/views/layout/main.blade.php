{{-- this is layout that should have been used for all page --}}
{{-- to use it: --}}
{{-- 1. created new file with your page name
2. create extends this file (@extends('layout.main'))
3. put your page body between @section('mainContent')..@endsection --}}

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- custom css --}}
    <link rel="stylesheet" href="myCss.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"></script>
    <script src="{{ asset('js/notification-scheduler.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
    <header>
        {{-- calling navbar component --}}
        @include('layout.nav')
    </header>
    <main>
        {{-- container web content --}}
        @yield('mainContent')
    </main>

    <footer>
        {{-- container for web footer --}}
        @yield('footer')
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

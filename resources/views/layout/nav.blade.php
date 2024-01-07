<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<div class="bg-gray-900">
    <nav class="mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('buletin') }}" class="text-white font-bold transition duration-300 transform hover:scale-110 hover:text-gray-300">Home</a>
            @if (Auth::user()->role == 'trainee' || Auth::user()->role == 'trainee admin')
                <a href="{{ route('project') }}" class="text-white font-bold hover:text-gray-300 transition duration-300 transform hover:scale-105">Project List</a>
            @endif

            @if (Auth::user()->role == 'trainer')
                <a href="{{ route('project1') }}" class="text-white font-bold hover:text-gray-300 transition duration-300 transform hover:scale-105">Project List</a>
            @endif

            <a href="{{ route('leaderboard') }}" class="text-white font-bold hover:text-gray-300 transition duration-300 transform hover:scale-105">Leaderboard</a>

            <a href="{{ route('calendar') }}" class="text-white font-bold hover:text-gray-300 transition duration-300 transform hover:scale-105">Schedule</a>
            @if(Session::get('mysession')['role'] == "trainee")
                <a href="{{ route('init') }}" class="text-white font-bold hover:text-gray-300 transition duration-300 transform hover:scale-105">Trainee List</a>

            @endif
            @if(Session::get('mysession')['role'] == "trainee admin")
                <a href="{{ route('init1') }}" class="text-white font-bold hover:text-gray-300 transition duration-300 transform hover:scale-105">Trainee List</a>

            @endif

            <a href="{{ route('logout') }}" class="text-red-500 font-bold transition duration-300 transform hover:scale-110 hover:text-gray-300">Log Out</a>
        </div>

        <div class="flex items-center">
            @if(Session::get('mysession')['role'] == "trainee" || Session::get('mysession')['role'] == "trainee admin")
                <a href="{{ route("traineedetail") }}">
                    <img id="file" src="{{ Session::get('mysession')['image'] }}" alt="Profile" class="h-10 w-10 rounded-full border-2 border-white transition duration-300 transform hover:scale-110 hover:border-gray-300">
                </a>
                <a href="{{ route('traineedetail') }}" class="text-white font-bold ml-4 transition duration-300 transform hover:scale-105 hover:text-gray-300">
                    <span class="text-sm">Welcome,</span>
                    <span class="text-lg text-white">{{ Session::get('mysession')['name'] }}</span>
                </a>
            @endif

            @if(Session::get('mysession')['role'] == "trainer")
                <a href="{{ route('edittrainer') }}" class="text-white font-bold ml-4 transition duration-300 transform hover:scale-105 hover:text-gray-300">
                    <span class="text-sm">Welcome,</span>
                    <span class="text-lg text-white">{{ Session::get('mysession')['name'] }}</span>
                </a>
            @endif
        </div>
    </nav>
</div>

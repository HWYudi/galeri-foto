<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite(['resources/css/app.css','resources/js/app.jsx'])
    <style>
        body {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body class="bg-black text-white">
    <div class="min-h-screen flex justify-center items-center">
        <div class="w-full max-w-sm mx-auto">
            @if (session()->has('success'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded-lg shadow-lg flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.style.display='none'"
                    class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            @endif

            @if (session()->has('error'))
            <div class="mb-4 p-4 bg-red-500 text-white rounded-lg shadow-lg flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.style.display='none'"
                    class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-xl">
                @csrf
                <div class="mb-4 relative">
                    <label for="nama_lengkap" class="block text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" id="nama_lengkap"
                        value="{{ old('nama_lengkap') }}"
                        class="w-full p-2 bg-gray-700 text-white border @error('nama_lengkap') border-red-500 @enderror rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nama_lengkap')
                    <p class="absolute text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="username" class="block text-sm font-medium mb-2">Username</label>
                    <input type="text" name="username" placeholder="Username" id="username"
                        value="{{ old('username') }}"
                        class="w-full p-2 bg-gray-700 text-white border @error('username') border-red-500 @enderror rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('username')
                    <p class="absolute text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="alamat" class="block text-sm font-medium mb-2">Alamat</label>
                    <textarea name="alamat" id="alamat" placeholder="Alamat"
                        class="w-full p-2 bg-gray-700 text-white border @error('alamat') border-red-500 @enderror rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <p class="absolute text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="email" class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" placeholder="Email" id="email" value="{{ old('email') }}"
                        class="w-full p-2 bg-gray-700 text-white border @error('email') border-red-500 @enderror rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                    <p class="absolute text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label for="level" class="block text-sm font-medium mb-2">Level</label>
                    <select name="level" id="level"
                        class="w-full p-2 bg-gray-700 text-white border @error('level') border-red-500 @enderror rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                    @error('level')
                    <p class="absolute text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 relative">
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" placeholder="Password" id="password"
                        class="w-full p-2 bg-gray-700 text-white border @error('password') border-red-500 @enderror rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                    <p class="absolute text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full p-2 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-300">Register</button>
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-blue-400 hover:underline">Already have an
                        account? Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

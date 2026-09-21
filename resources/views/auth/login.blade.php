<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Connexion</h2>

        @if (session('status'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>
            <div class="mb-2">
                <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>

            <div class="flex items-center justify-between mb-6 text-sm">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm">
                    <span class="ml-2 text-gray-600">Se souvenir de moi</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">Mot de passe oublié ?</a>
                @endif
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Se connecter</button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">Pas encore de compte ? <a href="{{ route('register') }}" class="text-indigo-600 underline">S'inscrire</a></p>
    </div>
</body>
</html>

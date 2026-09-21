<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Inscription</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">S'inscrire</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">Déjà un compte ? <a href="{{ route('login') }}" class="text-indigo-600 underline">Se connecter</a></p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Défi 2FA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-96">
        <h2 class="text-xl font-bold mb-4 text-center text-gray-800">Sécurité 2FA</h2>
        <p class="text-sm text-gray-600 mb-6 text-center">Veuillez entrer le code d'authentification fourni par votre application.</p>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Code d'authentification</label>
                <input type="text" name="code" autofocus autocomplete="one-time-code" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">
                Valider
            </button>
        </form>
    </div>
</body>
</html>

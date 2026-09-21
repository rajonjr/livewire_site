<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-96">
        <h2 class="text-xl font-bold mb-4 text-center text-gray-800">Mot de passe oublié</h2>
        <p class="text-sm text-gray-600 mb-6 text-center">Entrez votre email pour recevoir un lien de réinitialisation.</p>

        @if (session('status'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm text-center">
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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Envoyer le lien</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600"><a href="{{ route('login') }}" class="text-indigo-600 underline">Retour à la connexion</a></p>
    </div>
</body>
</html>

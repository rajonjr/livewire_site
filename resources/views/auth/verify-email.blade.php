<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification de l'email</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-96 text-center">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Vérifiez votre e-mail</h2>

        <p class="text-sm text-gray-600 mb-6">
            Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ?
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm">
                Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
            @csrf
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">
                Renvoyer l'e-mail de vérification
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-600 underline hover:text-gray-900">
                Se déconnecter
            </button>
        </form>
    </div>
</body>
</html>

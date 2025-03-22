<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .welcome-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .welcome-message {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .auth-links a {
            margin: 0 10px;
            font-size: 1.2rem;
            color: #34a83a;
            text-decoration: none;
        }
        .auth-links a:hover {
            text-decoration: none;
            color: #127216
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <!-- Welcome Message -->
        <div class="welcome-message">
            Bienvenue sur notre application !
        </div>

        <!-- Login and Register Links -->
        <div class="auth-links">
            @if (Route::has('login'))
                <a href="{{ route('login') }}">Connexion</a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Inscription</a>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
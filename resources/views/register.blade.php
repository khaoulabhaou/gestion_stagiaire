<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .forgot-password, .already-account {
            text-align: center;
            margin-top: 10px;
        }
        .form-check {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="logo">
            <img style="width: 25%" src='https://i.ibb.co/qHFwmv8/Whats-App-Image-2025-04-02-at-13-01-08-fb041c0e-removebg-preview.png' alt='Logo'/>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" name="name" class="form-control @error('email') is-invalid @enderror" id="username" placeholder="Entrez votre nom d'utilisateur">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" placeholder="Entrez votre e-mail" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>            
            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label">Mot de passe</label>
                </div>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" placeholder="Entrez votre mot de passe">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                {{-- <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Se souvenir de moi</label> --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('login') }}" class="text-decoration-none already-account">Vous avez déjà un compte ?</a>
                <button type="submit" class="btn btn-success text-white">S'inscrire</button>
            </div>
        </form>
    </div>
    
</body>
</html>

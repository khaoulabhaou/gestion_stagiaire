<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>
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
        .forgot-password,
        .already-account {
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
        <img style="width: 25%" src="https://i.postimg.cc/TwQ8RCyY/Whats-App-Image-2025-02-11-at-10-38-33-526755f1-1-Copy-removebg-preview-removebg-preview.png" alt="Logo" />
    </div>

    <!-- Displaying general login errors in Bootstrap alert -->
    @if ($errors->has('loginError'))
        <div class="alert alert-danger text-center">
            {{ $errors->first('loginError') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Field with Bootstrap Validation -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" placeholder="Entrez votre e-mail" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>      

        <!-- Password Field with Bootstrap Validation -->
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label for="password" class="form-label">Mot de passe</label>
                <a href="{{route('password.request')}}" class="text-decoration-none mt-1" style="font-size: 12px">Mot de passe oublié ?</a>
            </div>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" placeholder="Entrez votre mot de passe">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me Checkbox 
        <div class="form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Se souvenir de moi</label>
        </div>-->

        <!-- Submit Button & Register Link -->
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('register') }}" class="text-decoration-none already-account">Vous n'avez pas de compte ?</a>
            <button type="submit" class="btn btn-success text-white">Se connecter</button>
        </div>
    </form>
</div>

</body>
</html>

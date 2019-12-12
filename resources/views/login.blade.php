<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giriş Yap</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/popper.min.js') }}"></script>

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="container">
        <div class="login">
            <div class="login-content">
                <h2 style="text-align: center; margin-bottom: 25px; font-size: 1.9rem; padding-bottom: 10px; border-bottom: 1px solid #e5e5e5;">Giriş Yap</h2>
                <div class="login-form">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Sicil Numarası</label>
                            <input class="login-input w-100" type="text" name="registration_number" placeholder="Sicil Numarası">
                        </div>
                        <div class="form-group">
                            <label>Şifre</label>
                            <input class="login-input w-100" type="password" name="password" placeholder="Şifre">
                        </div>
                        <button type="submit" class="btn login-button">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </div>            
    </div>
    
</body>
</html>
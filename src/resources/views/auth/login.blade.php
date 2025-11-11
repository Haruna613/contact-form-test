<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-inner__title">
                FashionablyLate
            </h1>
        </div>
        <a class="header-inner__link" href="/register">register</a>
    </header>
    <main class="main">
        <div class="main-inner">
            <div class="main-inner__header">
                <h2 class="main-inner__header-title">
                    Login
                </h2>
            </div>
            <form class="form" action="/login" method="post" novalidate>
                @csrf
                <div class="form__group">
                    <div class="form__group-inner">
                        <div class="form__group-item">
                            <div class="group__title">
                                <span class="group__title-name">
                                    メールアドレス
                                </span>
                            </div>
                            <input class="group__input" type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                        </div>
                        <div class="error__message">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form__group-item">
                            <div class="group__title">
                                <span class="group__title-name">
                                    パスワード
                                </span>
                            </div>
                            <input class="group__input" type="password" name="password"  placeholder="例：coachtech1106">
                        </div>
                        <div class="error__message">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">
                        ログイン
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
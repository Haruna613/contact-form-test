<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-inner__title">
                FashionablyLate
            </h1>
        </div>
    </header>
    <main class="main">
        <div class="main-inner">
            <div class="main-inner__header">
                <h2 class="main-inner__header-title">
                    Contact
                </h2>
            </div>
            <form class="form" action="/confirm" method="POST">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            お名前
                        </span>
                        <span class="form__label--required">
                            ※
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input class="form__input--name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：山田" />
                            <input class="form__input--name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：太郎">
                        </div>
                        <div class="form__error">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            性別
                        </span>
                        <span class="form__label--required">
                            ※
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <label>
                                <input class="form__input--gender" type="radio" name="gender" value="1" {{ old('gender') === '1' ? 'checked' : '' }} >男性
                            </label>
                            <label>
                                <input class="form__input--gender" type="radio" name="gender" value="2" {{ old('gender') === '2' ? 'checked' : '' }} >女性
                            </label>
                            <label>
                                <input class="form__input--gender" type="radio" name="gender" value="3" {{ old('gender') === '3' ? 'checked' : '' }} >その他
                            </label>
                        </div>
                        <div class="form__error">
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            メールアドレス
                        </span>
                        <span class="form__label--required">
                            ※
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input class="form__input--email" type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                        </div>
                        <div class="form__error">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            電話番号
                        </span>
                        <span class="form__label--required">
                            ※
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input class="form__input--tel" type="tel" name="tel_first" value="{{ old('tel_first') }}" placeholder="080">
                            -
                            <input class="form__input--tel" type="tel" name="tel_middle" value="{{ old('tel_middle') }}" placeholder="1234">
                            -
                            <input class="form__input--tel" type="tel" name="tel_last" value="{{ old('tel_last') }}"  placeholder="5678">
                        </div>
                        <div class="form__error">
                            @error('tel_first')
                                {{ $message }}
                            @enderror
                            @error('tel_middle')
                                {{ $message }}
                            @enderror
                            @error('tel_last')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            住所
                        </span>
                        <span class="form__label--required">
                            ※
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input class="form__input--address" type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                        </div>
                        <div class="form__error">
                            @error('address')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            建物名
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input class="form__input--building" type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101">
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            お問い合わせの種類
                        </span>
                        <span class="form__label--required">
                            ※
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <select class="form__select--category" name="category"  id="">
                                @foreach($categories as $category)
                                    <option value="" hidden>
                                        選択してください
                                    </option>
                                    <option value="{{ $category['id'] }}" {{ old('category') == $category['id'] ? 'selected' : '' }}>
                                        {{ $category['content'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form__error">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            お問い合わせの内容
                        </span>
                        <span class="form__label--required">
                            ※
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <textarea class="form__input--detail" name="detail" placeholder="例：お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('detail')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group--button">
                    <button class="form__button--submit" type="submit">
                        確認画面
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
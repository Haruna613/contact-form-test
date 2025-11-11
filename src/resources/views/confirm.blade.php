<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
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
                    Confirm
                </h2>
            </div>
            <form class="form" action="/thanks" method="POST">
                @csrf
                <div class="form__group">
                    <table class="form__table" style="border: 1px solid #bda393;">
                        <tr class="form__table-row">
                            <th class="form__table--title">お名前</th>
                            <td class="form__table-data">
                                <input class="form__table--name" type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly>
                                <input class="form__table--name" type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="form__table-row">
                            <th class="form__table--title">性別</th>
                            <td class="form__table-data">
                                <div class="form__table--item">
                                    <?php
                                    if ($contact['gender'] == '1') {echo '男性';
                                    } else if($contact['gender'] == '2') {echo '女性';
                                    } else if ($contact['gender'] == '3') {echo 'その他';}
                                    ?>
                                    <input class="form__table--item" type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr class="form__table-row">
                            <th class="form__table--title">メールアドレス</th>
                            <td class="form__table-data">
                                <input class="form__table--item" type="email" name="email" value="{{ $contact['email'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="form__table-row">
                            <th class="form__table--title">電話番号</th>
                            <td class="form__table-data">
                                <input class="form__table--tel" type="tel" name="tel_first" value="{{ $contact['tel_first'] }}" readonly>
                                <input class="form__table--tel" type="tel" name="tel_middle" value="{{ $contact['tel_middle'] }}" readonly>
                                <input class="form__table--tel" type="tel" name="tel_last" value="{{ $contact['tel_last'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="form__table-row">
                            <th class="form__table--title">住所</th>
                            <td class="form__table-data">
                                <input class="form__table--item" type="text" name="address" value="{{ $contact['address'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="form__table-row">
                            <th class="form__table--title">建物名</th>
                            <td class="form__table-data">
                                <input class="form__table--item" type="text" name="building" value="{{ $contact['building'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="form__table-row">
                            <th class="form__table--title">お問い合わせの種類</th>
                            <td class="form__table-data">
                                <input class="form__table--item" type="hidden" name="category" value="{{ $category['id'] }}" readonly>
                                <input class="form__table--item" type="text" name="category" value="{{ $category['content'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="form__table-row">
                            <th class="form__table--title">お問い合わせ内容</th>
                            <td class="form__table-data">
                                <input class="form__table--item" type="text" name="detail" value="{{ $contact['detail'] }}" readonly>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form__buttons">
                    <button class="form__buttons-send" type="submit" name="send" value="send">
                        送信
                    </button>
                    <button class="form__buttons-edit"  type="button" onClick="history.back()" name="edit" value="edit">
                        修正
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
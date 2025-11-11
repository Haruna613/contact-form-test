<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-inner__title">
                FashionablyLate
            </h1>
        </div>
        @if (Auth::check())
        <form class="form__logout" action="/logout" method="post">
            @csrf
            <button class="form__logout-button">
                logout
            </button>
        </form>
        @endif
    </header>
    <main class="main">
        <div class="main-inner">
            <div class="main-inner__header">
                <h2 class="main-inner__header-title">
                    Admin
                </h2>
            </div>
            <form class="search-form" action="/search" method="get">
                <div class="search-form__item">
                    <input class="search-form__item-keyword" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                    <select class="search-form__item-gender" name="gender">
                        <option value="">性別</option>
                        <option value="1" ...>男性</option>
                        <option value="2" ...>女性</option>
                        <option value="3" ...>その他</option>
                    </select>
                    <select class="search-form__item-category" name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                    <input class="search-form__item-date" type="date" name="created_at">
                </div>
                <div class="search-form__button">
                    <button class="search-form__button-submit" type="submit">検索</button>
                </div>
                <div class="search-form__button">
                    <a class="search-form__button-reset" href="/admin">リセット</a>
                </div>
            </form>
            <style>
                svg.w-5.h-5 {
                    width: 20px;
                    height: 20px;
                }
            </style>
            <div class="paginate">
                {{ $contacts->links() }}
            </div>
            <div class="contact-table">
                <table class="contact-table__inner">
                    <tr class="contact-table__row">
                        <th class="contact-table__header">
                            お名前
                        </th>
                        <th class="contact-table__header">
                            性別
                        </th><th class="contact-table__header">
                            メールアドレス
                        </th>
                        <th class="contact-table__header">
                            お問い合わせの種類
                        </th>
                        <th class="contact-table__header">
                        </th>
                    </tr>
                    @foreach ($contacts as $contact)
                    <tr class="contact-table__row">
                        <td class="contact-table__item">
                            {{ $contact['last_name'] }}{{ $contact['first_name']}}
                        </td>
                        <td class="contact-table__item">
                            {{ $contact['gender'] }}
                        </td>
                        <td class="contact-table__item">
                            {{ $contact['email'] }}
                        </td>
                        <td class="contact-table__item">
                            {{ $contact->category->content ?? 'N/A' }}
                        </td>
                        <td class="contact-table__item">
                            <button
                                class="detail-button" data-id="{{ $contact['id'] }}"
                                data-fullname="{{ $contact['last_name'] }}{{ $contact['first_name']}}"
                                data-gender="{{ $contact['gender'] }}"
                                data-email="{{ $contact['email'] }}" data-tel="{{ $contact['tel'] }}" data-address="{{ $contact['address'] }}" data-building="{{ $contact['building'] }}"
                                data-category="{{ $contact->category->content ?? 'N/A' }}"
                                data-detail="{{ $contact['detail'] ?? '' }}"
                                onclick="showContactModal(this)">
                                詳細
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- モーダルウィンドウのHTML構造 -->
        <div id="contactModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
            <div style="background-color: white; padding: 20px 70px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 80%; max-width: 700px; position: relative;">
                <!-- 閉じるボタン -->
                <button onclick="closeContactModal()" style="margin-top: 1rem; margin-left: 35rem;background-color: #fff; color: #ddd; padding: 0.25rem 0.5rem; border-radius: 50%; border: 1px solid #ddd; cursor: pointer;">
                    ×
                </button>
                <!-- 詳細情報を表示するエリア -->
                <p class="detail-item">
                    <strong class="detail-item__title">お名前</strong>
                    <span class="detail-item__main" id="modalFullName"></span>
                </p>
                <p>
                    <strong class="detail-item__title">性別</strong>
                    <span class="detail-item__main" id="modalGender"></span>
                </p>
                <p>
                    <strong class="detail-item__title">メールアドレス</strong>
                    <span class="detail-item__main" id="modalEmail"></span>
                </p>
                <p>
                    <strong class="detail-item__title">電話番号</strong>
                    <span class="detail-item__main" id="modalTel"></span>
                </p>
                <p>
                    <strong class="detail-item__title">住所</strong>
                    <span class="detail-item__main" id="modalAddress"></span>
                </p>
                <p>
                    <strong class="detail-item__title">建物名</strong>
                    <span class="detail-item__main" id="modalBuilding"></span>
                </p>
                <p>
                    <strong class="detail-item__title">お問い合わせの種類</strong>
                    <span class="detail-item__main" id="modalCategory"></span>
                </p>
                <p>
                    <strong class="detail-item__title">お問い合わせの内容</strong>
                    <span class="detail-item__main" id="modalDetail" class="block mt-2 p-2 bg-gray-100 rounded"></span>
                </p>
                <form class="delete-form" action="/delete" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="delete-form__button">
                        <input type="hidden" name="id" id="modalContactId" value="">
                        <button class="delete-form__button-submit" type="submit">削除</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            const modal = document.getElementById('contactModal');
            const modaContactlId = document.getElementById('modalContactId');
            const modalFullName = document.getElementById('modalFullName');
            const modalGender = document.getElementById('modalGender');
            const modalEmail = document.getElementById('modalEmail');
            const modalTel = document.getElementById('modalTel');
            const modalAddress = document.getElementById('modalAddress');
            const modalBuilding = document.getElementById('modalBuilding');
            const modalCategory = document.getElementById('modalCategory');
            const modalDetail = document.getElementById('modalDetail');
            function showContactModal(button) {
                modalFullName.textContent = button.getAttribute('data-fullname');
                modalGender.textContent = button.getAttribute('data-gender');
                modalEmail.textContent = button.getAttribute('data-email');
                modalTel.textContent = button.getAttribute('data-tel');
                modalAddress.textContent = button.getAttribute('data-address');
                modalBuilding.textContent = button.getAttribute('data-building');
                modalCategory.textContent = button.getAttribute('data-category');
                modalDetail.textContent = button.getAttribute('data-detail');
                modal.style.display = 'flex';

                if (modalContactId) {
                    modalContactId.value = button.getAttribute('data-id');
                }
                modal.style.display = 'flex';
            }
            function closeContactModal() {
                modal.style.display = 'none';
            }
        </script>
    </main>
</body>
</html>
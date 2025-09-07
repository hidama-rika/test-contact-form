@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('header-nav')
<div class="form__button-nav">
    <nav>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="form__button-logout" type="submit">logout</button>
        </form>
    </nav>
</div>
@endsection

@section('content')
    <div class="admin__content">
        <div class="admin__heading">
            <h2>Admin</h2>
        </div>

        <form class="search-form" action="{{ route('admin.index') }}" method="GET">
            <div class="search-form__group">
                <input type="text" class="search-form__input" placeholder="名前やメールアドレスを入力してください" name="keyword" value="{{ request('keyword') }}">
                <select class="search-form__select" name="gender">
                    <option value="">性別</option>
                    <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                    <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
                    <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
                <select class="search-form__select" name="category">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                    @endforeach
                </select>
                <input type="date" class="search-form__input" name="date" value="{{ request('date') }}">
            </div>
            <div class="search-form__button-group">
                <button class="search-form__button search-form__button--search" type="submit">検索</button>
                <button type="button" class="search-form__button search-form__button--reset" onclick="window.location='{{ route('admin.index') }}'">リセット</button>
            </div>
        </form>

        <div class="bottom-controls">
            <form action="{{ route('admin.export') }}" method="POST" id="exportForm">
                @csrf
                <input type="hidden" name="keyword">
                <input type="hidden" name="gender">
                <input type="hidden" name="category">
                <input type="hidden" name="date">
                <button class="export-button" type="submit">エクスポート</button>
            </form>
            <div class="pagination">
                {{ $contacts->appends(request()->input())->links() }}
            </div>
        </div>

        <div class="admin-table">
            <table class="admin-table__inner">
                <tr class="admin-table__row">
                    <th class="admin-table__header">お名前</th>
                    <th class="admin-table__header">性別</th>
                    <th class="admin-table__header">メールアドレス</th>
                    <th class="admin-table__header">お問い合わせの種類</th>
                    <th class="admin-table__header"></th>
                </tr>
                @foreach($contacts as $contact)
                <tr class="admin-table__row"
                    data-id="{{ $contact->id }}"
                    data-name="{{ $contact->last_name . ' ' . $contact->first_name }}"
                    data-gender="{{ $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他') }}"
                    data-email="{{ $contact->email }}"
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}"
                    data-category="{{ $contact->category->content }}"
                    data-detail="{{ $contact->detail }}">
                    <td class="admin-table__text">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td class="admin-table__text">
                        @if($contact->gender === 1)
                            男性
                        @elseif($contact->gender === 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                    <td class="admin-table__text">{{ $contact->email }}</td>
                    <td class="admin-table__text">{{ $contact->category->content }}</td>
                    <td class="admin-table__text"><button wire:click="openModal({{ $contact->id }})" type="button" class="admin-table__detail-button">詳細</button></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<dialog id="detailModal" class="modal">
    <div class="modal-content">
        <button class="modal-close-button">&times;</button>
        <div class="modal-item">
            <label>お名前</label>
            <p id="modalName"></p>
        </div>
        <div class="modal-item">
            <label>性別</label>
            <p id="modalGender"></p>
        </div>
        <div class="modal-item">
            <label>メールアドレス</label>
            <p id="modalEmail"></p>
        </div>
        <div class="modal-item">
            <label>電話番号</label>
            <p id="modalTel"></p>
        </div>
        <div class="modal-item">
            <label>住所</label>
            <p id="modalAddress"></p>
        </div>
        <div class="modal-item">
            <label>建物名</label>
            <p id="modalBuilding"></p>
        </div>
        <div class="modal-item">
            <label>お問い合わせの種類</label>
            <p id="modalCategory"></p>
        </div>
        <div class="modal-item">
            <label>お問い合わせ内容</label>
            <p id="modalContent"></p>
        </div>
        <div class="modal-buttons">
            <form action="/admin/destroy" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteId">
                <button class="delete-button" type="submit">削除</button>
            </form>
        </div>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('detailModal');
        const closeBtn = document.querySelector('.modal-close-button');
        const detailButtons = document.querySelectorAll('.admin-table__detail-button');

        // 詳細ボタンをクリックしたときの処理
        detailButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const row = e.target.closest('.admin-table__row');
                const name = row.dataset.name;
                const gender = row.dataset.gender;
                const email = row.dataset.email;
                const tel = row.dataset.tel;
                const address = row.dataset.address;
                const building = row.dataset.building;
                const category = row.dataset.category;
                const detail = row.dataset.detail;
                const id = row.dataset.id;

                // モーダル内の要素にデータをセット
                document.getElementById('modalName').textContent = name;
                document.getElementById('modalGender').textContent = gender;
                document.getElementById('modalEmail').textContent = email;
                document.getElementById('modalTel').textContent = tel;
                document.getElementById('modalAddress').textContent = address;
                document.getElementById('modalBuilding').textContent = building;
                document.getElementById('modalCategory').textContent = category;
                document.getElementById('modalContent').textContent = detail;
                document.getElementById('deleteId').value = id;

                // <dialog>タグの showModal() メソッドでモーダルを表示
                modal.showModal();
            });
        });

        // 閉じるボタンをクリックしたときの処理
        closeBtn.addEventListener('click', () => {
            // <dialog>タグの close() メソッドでモーダルを閉じる
            modal.close();
        });

        // エクスポートフォームの値を動的に更新する処理
        const exportForm = document.getElementById('exportForm');
        const searchForm = document.querySelector('.search-form');

        if (exportForm && searchForm) {
            exportForm.addEventListener('submit', (e) => {
                const keyword = searchForm.querySelector('input[name="keyword"]').value;
                const gender = searchForm.querySelector('select[name="gender"]').value;
                const category = searchForm.querySelector('select[name="category"]').value;
                const date = searchForm.querySelector('input[name="date"]').value;

                exportForm.querySelector('input[name="keyword"]').value = keyword;
                exportForm.querySelector('input[name="gender"]').value = gender;
                exportForm.querySelector('input[name="category"]').value = category;
                exportForm.querySelector('input[name="date"]').value = date;
            });
        }
    });
</script>
@endsection

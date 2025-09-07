<div>
    <button wire:click="openModal()" type="button" class="admin-table__detail-button">
        詳細
    </button>

    @if($showModal)
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
    @endif
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class AdminModal extends Component
{
    // モーダルの表示状態を制御するプロパティ
    public $showModal = false;
    // モーダルに表示するデータ
    public $selectedItem = null;

    // Livewireのリスナーを定義。openModalイベントを受け取る
    protected $listeners = ['openModal'];

    // openModalイベントを受け取った際に実行されるメソッド
    public function openModal($contactId)
    {
        $contact = Contact::find($contactId);

        if ($contact) {
            $this->selectedItem = [
                'id' => $contact->id,
                'name' => $contact->last_name . ' ' . $contact->first_name,
                'gender' => $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
                'email' => $contact->email,
                'tel' => $contact->tel,
                'address' => $contact->address,
                'building' => $contact->building,
                'category' => $contact->category->content,
                'content' => $contact->detail
            ];
            $this->showModal = true;
        }
    }

    // モーダルを閉じる
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedItem = null;
    }

    // データを削除する
    public function deleteItem()
    {
        // $this->selectedItemがnullでないか確認
        if ($this->selectedItem && isset($this->selectedItem['id'])) {
            // お問い合わせデータをIDで検索して削除
            Contact::destroy($this->selectedItem['id']);

            // 削除成功メッセージをセッションにフラッシュ
            session()->flash('message', 'お問い合わせを削除しました。');

            // 削除後、親コンポーネントにイベントを発火させて一覧を更新させる
            $this->emit('contactDeleted');
        } else {
            // エラーメッセージをセッションにフラッシュ
            session()->flash('error', '削除するデータが見つかりませんでした。');
        }

        // 削除処理が終わった後、モーダルを閉じる
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin-modal');
    }
}

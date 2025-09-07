<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class InquiryModal extends Component
{
    // モーダルの表示状態を管理するプロパティ
    public $showModal = false;

    // 表示する詳細データを格納するプロパティ
    public $contact = null;

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

    // モーダルを閉じるメソッド
    public function closeModal()
    {
        $this->showModal = false;
        $this->contact = null; // データをクリア
    }

    // 「削除」ボタンをクリックした時の処理
    public function deleteData()
    {
        // データが存在すれば削除
        if ($this->contact) {
            $this->contact->delete();
        }

        // 削除後にモーダルを閉じ、完了メッセージを送信
        $this->closeModal();
        $this->emit('contactDeleted');
    }

    public function render()
    {
        return view('livewire.inquiry-modal');
    }
}

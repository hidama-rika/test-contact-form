<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {

        // ContactRequestでバリデーションが完了しているので、
        // `$request->validated()` でバリデーション済みのデータを取得します。
        $validatedData = $request->validated();

        // 姓と名を結合して'name'キーを作成
        $validatedData['name'] = $validatedData['lastname'] . ' ' . $validatedData['firstname'];

        // 3つの電話番号を結合して'tel'キーを作成
        $validatedData['tel'] = $validatedData['tel_part1'] . '-' . $validatedData['tel_part2'] . '-' . $validatedData['tel_part3'];

        return view('confirm', compact('validatedData'));
    }

    public function store(Request $request)
    {
        // 姓と名を結合して一つの 'name' にする
        $name = $request->input('lastname') . ' ' . $request->input('firstname');

        // 3つの電話番号を結合して一つの 'tel' にする
        $tel = $request->input('tel_part1') . $request->input('tel_part2') . $request->input('tel_part3');

        // 必要なデータを全て取得
        $contact = $request->only([
            'email',
            'address',
            'building',
            'category',
            'detail'
        ]);

        // 結合した 'name' と 'tel' を追加
        $contact['name'] = $name;
        $contact['tel'] = $tel;

        // データベースに保存
        Contact::create($contact);

        return view('thanks');
    }

    public function thanks()
    {
        return view('/thanks');
    }
}

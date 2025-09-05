<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
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
        // 問い合わせフォームのカテゴリを取得
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {

        // ContactRequestでバリデーションが完了しているので、
        // `$request->validated()` でバリデーション済みのデータを取得します。
        $validatedData = $request->validated();

        // 姓と名を結合して'name'キーを作成
        $validatedData['name'] = $validatedData['last_name'] . ' ' . $validatedData['first_name'];

        // 3つの電話番号を結合して'tel'キーを作成
        $validatedData['tel'] = $validatedData['tel_part1'] . $validatedData['tel_part2'] . $validatedData['tel_part3'];

        // category_idを使ってカテゴリ情報を取得
        $category = Category::find($validatedData['category_id']);

        // 取得したカテゴリ情報とバリデーション済みのデータをビューに渡す
        return view('confirm', compact('validatedData', 'category'));
    }

    public function store(ContactRequest $request)
    {
        // storeメソッドもContactRequestを使う
        $contact = $request->validated();

        // データベースに保存するための性別の値を、文字列から数字に変換します。
        $genderValue = match ($contact['gender']) {
            '男性' => 1,
            '女性' => 2,
            'その他' => 3,
            default => null, // 予期しない値の場合
        };

        // データベースに保存するためのデータ配列を作成
        $contactData = [
            'last_name' => $contact['last_name'],
            'first_name' => $contact['first_name'],
            'email' => $contact['email'],
            'gender' => $genderValue, // 変換した数字の値を代入
            'address' => $contact['address'],
            'building' => $contact['building'],
            'detail' => $contact['detail'],
            // category_idを明示的に含める
            'category_id' => $contact['category_id'],
            // 3つの電話番号を結合してtelとして保存
            'tel' => $contact['tel_part1'] . $contact['tel_part2'] . $contact['tel_part3'],
        ];

        // データベースに保存
        Contact::create($contactData);

        return view('thanks');
    }

    public function thanks()
    {
        return view('/thanks');
    }
}

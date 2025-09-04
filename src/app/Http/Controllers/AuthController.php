<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * 登録フォームの表示
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * ユーザー登録処理
     */
    // RegisterRequestを引数として受け取る
    public function register(RegisterRequest $request)
    {
        // バリデーションが成功した場合、ここに到達
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', '登録が完了しました。');
    }

    /**
     * ログインフォームの表示
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * ログイン処理
     */
    public function login(LoginRequest $request)
    {
        // LoginRequestによるバリデーションが自動的に行われる
        // バリデーションに失敗した場合は、このメソッドは呼び出されずに
        // 自動で元のフォームにリダイレクトされる
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証に成功したら、管理画面へリダイレクト
            return redirect()->intended('/admin');
        }

        // 認証に失敗したら、ログインページに戻り、エラーメッセージをセッションに保存
        return redirect()->back()->withErrors([
            'email' => '入力された認証情報が一致しません。',
        ])->withInput($request->only('email'));
    }
}

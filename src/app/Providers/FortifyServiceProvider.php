<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User; // これを追加
use Illuminate\Support\Facades\Hash; // これを追加
use Illuminate\Validation\ValidationException; // これを追加

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fortifyにユーザー作成を任せる。引数には文字列のクラス名を渡す。
        // これにより、app/Actions/Fortify/CreateNewUser.php が使用される。
        Fortify::createUsersUsing(CreateNewUser::class);

        // ログイン認証ロジックを定義
        Fortify::authenticateUsing(function (Request $request) {
            // Laravelの組み込みバリデーション機能を使用
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Auth::attempt()で認証を試みる
            if (Auth::attempt($validated)) {
                return Auth::user();
            }

            // 認証失敗時、カスタムメッセージをスローしてリダイレクトさせる
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        });

        Fortify::registerView(function () {
            return view('register');
        });

        Fortify::loginView(function () {
            return view('login');
        });

        RateLimiter::for('login', function (Request $request) {
        $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });
    }
}

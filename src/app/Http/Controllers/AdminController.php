<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // エクスポートボタンが押された場合、exportメソッドへリダイレクト
        if ($request->has('export')) {
            return $this->export($request);
        }

        // カテゴリーデータを取得（検索フォーム用）
        $categories = Category::all();

        // 検索クエリの構築
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender') && $request->input('gender') !== '全て') {
            $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
            $genderValue = $genderMap[$request->input('gender')] ?? null;
            if ($genderValue) {
                $query->where('gender', $genderValue);
            }
        }

        // カテゴリー検索
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // ページネーションを適用
        $contacts = $query->paginate(7);

        // データをビューに渡してレンダリングします
        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender') && $request->input('gender') !== '全て') {
            $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
            $genderValue = $genderMap[$request->input('gender')] ?? null;
            if ($genderValue) {
                $query->where('gender', $genderValue);
            }
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->get();

        $callback = function () use ($contacts) {
            $stream = fopen('php://output', 'w');
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            fputcsv($stream, [
                'ID',
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '登録日時'
            ]);

            foreach ($contacts as $contact) {
                $gender = '';
                if ($contact->gender === 1) {
                    $gender = '男性';
                } elseif ($contact->gender === 2) {
                    $gender = '女性';
                } else {
                    $gender = 'その他';
                }
                fputcsv($stream, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content,
                    $contact->detail,
                    $contact->created_at
                ]);
            }
            fclose($stream);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(Request $request)
    {
        $contact = Contact::find($request->id);
        if ($contact) {
            $contact->delete();
            return redirect()->back()->with('success', 'お問い合わせ情報を削除しました。');
        }
        return redirect()->back()->with('error', 'お問い合わせ情報が見つかりませんでした。');
    }
}
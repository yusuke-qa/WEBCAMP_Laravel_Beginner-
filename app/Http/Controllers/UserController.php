<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterPost;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 会員登録画面 を表示する
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.register');
    }

    /**
     * 会員登録処理
     */
    public function register(UserRegisterPost $request)
    {
        // validate済みのデータの取得
        $datum = $request->validated();

        // パスワードのハッシュ化
        $datum['password'] = Hash::make($datum['password']);

        // テーブルへのINSERT
        try {
            UserModel::create($datum);
        } catch (\Throwable $e) {
            // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
            echo $e->getMessage();
            exit;
        }

        // 会員登録成功
        $request->session()->flash('front.user_register_success', true);

        // リダイレクト
        return redirect('/');
    }
}

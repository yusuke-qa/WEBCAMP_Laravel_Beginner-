<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedTask as CompletedTaskModel;

class CompletedTaskController extends Controller
{
    /**
     * 完了タスク一覧を表示する
     */
    public function list()
    {
        // 1Page辺りの表示アイテム数を設定
        $per_page = 2;

        // 1. completed_tasks テーブルからログインユーザーのデータを取得
        $completedTasks = CompletedTaskModel::where('user_id', Auth::id())
            ->orderBy('updated_at', 'DESC')
            ->paginate($per_page);

        // 2. テンプレートファイルにデータを渡して画面を表示
        return view('task.completed_list', [
            'completedTasks' => $completedTasks
        ]);
    }
}
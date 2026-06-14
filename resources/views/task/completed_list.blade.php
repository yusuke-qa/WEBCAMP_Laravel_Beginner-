@extends('layout')

{{-- タイトル --}}
@section('title')(完了タスクの一覧)@endsection

{{-- メインコンテンツ --}}
@section('contents')
    <h1>完了タスクの一覧</h1>

    <a href="/task/list">タスク一覧に戻る</a><br>

    @if($completedTasks->isEmpty())
        <p>完了したタスクはありません。</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>タスク名</th>
                    <th>期限</th>
                    <th>重要度</th>
                    <th>タスク終了日</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completedTasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->period }}</td>
                        <td>{{ $task->getPriorityString() }}</td>
                        <td>{{ $task->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- ページネーション -->
    現在 {{ $completedTasks->currentPage() }} ページ目<br>
    @if ($completedTasks->onFirstPage() === false)
    <a href="/completed_tasks/list">最初のページ</a>
    @else
    最初のページ
    @endif
    /
    @if ($completedTasks->previousPageUrl() !== null)
        <a href="{{ $completedTasks->previousPageUrl() }}">前に戻る</a>
    @else
        前に戻る
    @endif
    /
    @if ($completedTasks->nextPageUrl() !== null)
        <a href="{{ $completedTasks->nextPageUrl() }}">次に進む</a>
    @else
        次に進む
    @endif
    <br>
    <hr>
    <menu label="リンク">
    <a href="/logout">ログアウト</a><br>
    </menu>
@endsection
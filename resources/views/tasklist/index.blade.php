@extends('layouts.app')

@section('content')

    @if (Auth::check())
        {{ Auth::user()->name }}
        <h1>リスト一覧</h1>
        @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>予定一覧</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{!! link_to_route('tasklist.show', $task->id, ['tasklist' => $task->id]) !!}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
       @endif
             {{-- メッセージ作成ページへのリンク --}}
    {!! link_to_route('tasklist.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}
    
     @else
     
      <div class="center jumbotron">
            <div class="text-center">
                <h1>タスクリストへようこそ</h1>
                <p>タスクリストをご利用になるには会員登録が必要です</p>
      {{-- ユーザ登録ページへのリンク --}}
    {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
                <p>既に会員の方はこちら</p>
    {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
                </div>
        </div>
    @endif


@endsection

@extends('layouts.app')

@section('content')

<h1>リスト一覧</h1>

    @if (count($tasklist1) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>予定一覧</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasklist1 as $task)
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
      {{-- ユーザ登録ページへのリンク --}}
    {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}



@endsection

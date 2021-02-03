@extends('layouts.app')

@section('content')

    <h1>id = {{ $tasklist3->id }} の予定詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $tasklist3->id }}</td>
        </tr>
                <tr>
            <th>ステータス</th>
            <td>{{ $tasklist3->status }}</td>
        </tr>
        <tr>
            <th>予定</th>
            <td>{{ $tasklist3->content }}</td>
        </tr>
    </table>

    {{-- メッセージ編集ページへのリンク --}}
    {!! link_to_route('tasklist.edit', 'このタスクを編集', ['tasklist' => $tasklist3->id], ['class' => 'btn btn-primary']) !!}

    {{-- メッセージ削除フォーム --}}
    {!! Form::model($tasklist3, ['route' => ['tasklist.destroy', $tasklist3->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection
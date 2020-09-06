@extends('layouts.default')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    <p>現在のユーザー名: {{ Auth::user()->name }} </p>
    <form action="{{ url('/logout') }}" method="post">
        {{ csrf_field() }}
        <button type="submit">ログアウト</button>
    </form>

    {{-- エラーメッセージを出力 --}}
    @foreach($errors->all() as $error)
    <p class="error">{{ $error }}</p>
    @endforeach

    @if ($tweet = Session::get('success'))
    <p>{{ $tweet }}</p>
    @endif


    {{-- 以下にフォームを追記します。 --}}
    <form method="post" action="{{ url('/messages') }}">
        {{-- LaravelではCSRF対策のため以下の一行が必須です。 --}}
        {{ csrf_field() }}
        <div>
            <label>
                感情:
                <input type="radio" name="passion" value= "喜" checked="checked">喜
                <input type="radio" name="passion" value= "怒" >怒
                <input type="radio" name="passion" value= "哀" >哀
                <input type="radio" name="passion" value= "楽" >楽
            </label>
        </div>
        <div>
            <label>
                点数:
                <select name="point">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                </select>
            </label>
        </div>

        <div>
            <label>
                内容：
                <input type="text" name="body" class="comment_field" placeholder="コメントを入力">
            </label>
        </div>

        <div>
            <input type="hidden" name ="user_id" value="{{ Auth::id() }}">
            <input type="submit" value="投稿">
        </div>
    </form>

    <style>
        table.passion {
        border: solid 1px #000000;
        border-collapse: separate;
        border-spacing: 100px 10px;
        }
    </style>


    <table class ="passion">
        <caption>今までの感情一覧</caption>
            <tr>
                <th>感情</th>
                <th>点数</th>
                <th>内容</th>
                <th>記入日時</th>
                <th>削除</th>
            </tr>
        @forelse($messages as $message)
            <tr>
                <td>{{ $message->passion }}</td>
                <td>{{ $message->point }}</td>
                <td>{{ $message->body }}</td>
                <td>{{ $message->created_at }}</td>
                <td>
                    <form action="{{ route('messages.destroy', $message->id)}}" method="POST"> 
                    @csrf
                    @method('DELETE')
                     <input type="submit" value="削除">
                    </form>
                </td>
            </tr>
        @empty
            <tr><th>まだ記入されていません！</th><td>
    </table>
    @endforelse

@endsection 

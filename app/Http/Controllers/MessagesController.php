<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function show($id)
{
    return view('/messages', ['messages' => Message::findOrFail($id)]);
}
    public function index(){
        //取得したユーザーID
        $user_id = Auth::id();
        $title = 'ドキドキ☆毎日数値化報告ページ♪';

        // Messageモデルを利用してmessageの一覧を取得
        $messages = \App\Message::all();

        // views/messages/index.blade.phpを指定
        return view('messages.index',[
            'title' => $title,
            'messages' => $messages,
        ]);
    }

    public function create(Request $request){
        //取得したユーザーID
        $user_id = Auth::id();
        // requestオブジェクトのvalidateメソッドを利用。
        $request->validate([
            'passion' => 'required|max:1', // passionは必須、1文字以内
            'point' => 'required|max:3', // pointは必須、3文字以内
            'user_id' => 'required|max:5', // passionは必須、5文字以内
            'body' => 'required|max:100', // bodyは必須、100文字以内
        ]);

        // Messageモデルを利用して空のMessageオブジェクトを作成
        $message = new \App\Message;

        // フォームから送られた値でnameとbodyを設定
        $message->passion = $request->passion;
        $message->point = $request->point;
        $message->user_id = $request->user_id;
        $message->body = $request->body;

        // messagesテーブルにINSERT
        $message->save();

        // メッセージ一覧ページにリダイレクト
        return redirect('/messages');
    }

    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    

}

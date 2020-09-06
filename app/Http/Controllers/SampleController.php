<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function sample_action(){
        $title = 'コントローラーを利用したサンプル';
        $description = 'コントローラーを利用するとルーティン';
        return view('blade_sample',[
            'title' => $title,
            'description' => $description,
        ]);
    }

    public function message_sample(){
        $message = \App\Message::all()->first();
        return view('message_sample',[
            'message' => $message,
        ]);
    }

    public function blade_example(){
        $title = 'bladeテンプレートの様々な機能';
        $num = 10;
        $messages = \App\Message::all();
        return view('blade_example',[
            'title' => $title,
            'num' => $num,
            'messages' => $messages,
        ]);
    }
}

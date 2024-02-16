<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us', // 任意の国を指定
            'apiKey' => '567c3d7f56df413999532283c2ccad92', // 事前に取得したAPIキーを使用
        ]);

        $news = $response->json()['articles'];

        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us', // 任意の国を指定
            'apiKey' => '567c3d7f56df413999532283c2ccad92', // 事前に取得したAPIキーを使用
        ]);

        $news = $response->json()['articles'][$id];

        return view('news.show', compact('news'));
    }
}


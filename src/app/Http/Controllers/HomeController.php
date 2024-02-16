<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get('https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default');

        $data = $response->json();

        return view('api.index', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $contents = Content::withTrashed()->get();
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content_name' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
        ]);

        Content::create([
            'content_name' => $request->content_name,
            'color_code' => $request->color_code,
        ]);

        return redirect()->route('contents.index')->with('success', 'Content created successfully!');
    }

    public function edit(Content $content)
    {
        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'content_name' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
        ]);

        $content->update([
            'content_name' => $request->content_name,
            'color_code' => $request->color_code,
        ]);

        return redirect()->route('contents.index')->with('success', 'Content updated successfully!');
    }

    // public function destroy(Content $content)
    // {
    //     $content->delete();

    //     return redirect()->route('contents.index')->with('success', 'Content deleted successfully!');
    // }

    //論理削除の実装
        public function delete(Content $content)
    {
        $content->delete();

        return redirect()->route('contents.index')->with('success', 'Content deleted successfully!');
    }

    public function restore(Content $content)
    {
        $content->restore();

        return redirect()->route('contents.index')->with('success', 'Content restored successfully!');
    }
}

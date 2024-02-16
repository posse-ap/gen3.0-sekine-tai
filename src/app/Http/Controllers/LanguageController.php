<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $languages = Language::withTrashed()->get();
        return view('languages.index', compact('languages'));
    }

    public function create()
    {
        return view('languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'language_name' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
        ]);

        Language::create([
            'language_name' => $request->language_name,
            'color_code' => $request->color_code,
        ]);

        return redirect()->route('languages.index')->with('success', 'Language created successfully!');
    }

    public function edit(Language $language)
    {
        return view('languages.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'language_name' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
        ]);

        $language->update([
            'language_name' => $request->language_name,
            'color_code' => $request->color_code,
        ]);

        return redirect()->route('languages.index')->with('success', 'Language updated successfully!');
    }

    // public function destroy(Language $language)
    // {
    //     $language->delete();

    //     return redirect()->route('languages.index')->with('success', 'Language deleted successfully!');
    // }

    //論理削除の実装
    
    public function delete(Language $language)
    {
        $language->delete();

        return redirect()->route('languages.index')->with('success', 'Language deleted successfully!');
    }

    public function restore(Language $language)
    {
        $language->restore();

        return redirect()->route('languages.index')->with('success', 'Language restored successfully!');
    }
}

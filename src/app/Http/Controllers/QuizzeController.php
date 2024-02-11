<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Quizze;
use App\Models\Quizze_questions;
use App\Models\Quizze_choices;
use Illuminate\Support\Facades\Redirect;

class QuizzeController extends Controller
{

    public function quizzes()
    {
        $quizzes = Quizze::withTrashed()->paginate(20);
        // ↑withtrashedを削除すれば通常
        return view('quizzes', compact('quizzes'));
    }


    public function show(Quizze $quizze)
    {
        $questions = Quizze_questions::withTrashed()->with('questions')->where('quiz_id', $quizze->id)->get();

        $questionChoices = [];

        foreach ($questions as $question) {
            // 各質問に関連する選択肢を取得し、配列に追加
            $choices = Quizze_choices::with('choices')->where('question_id', $question->id)->get();
            $questionChoices[$question->id] = $choices;
        }

        return view('quizze.show', compact('quizze','questions', 'questionChoices'));
        // ↑compactでちゃんとviewさんに渡してあげましょう。
    }

    public function edit(Quizze $quizze)
    {
        return view('quizze.edit', compact('quizze'));
    }

    public function update(Request $request, Quizze $quizze)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);

        $validated['id'] = auth()->id();

        session()->flash('message', '更新しました');

        $quizze->update($validated);
        return redirect('/quizzes');
    }

    public function destroy(Quizze $quizze)
    {
        $quizze->delete();
        session()->flash('message', '削除しました');
        return redirect('/quizzes');
    }

    public function create(){
        return view('quizze.create');
    }

    public function store(Request $request,Quizze $quizze){

        
        $validated = $request->validate([
            'name'=> 'required|max:30',
        ]);
        
        
        $quizze = Quizze::create($validated);
        
        return back()->with('message','保存しました');
    }

    public function editQuestion($quizze, $question)
    {
        $quizze = Quizze::find($quizze); 
        $quizzesAll = Quizze::all();
        $question = Quizze_questions::find($question); 

        $questionChoices = Quizze_choices::with('choices')->where('question_id',$question->id)->get();
        
    
        return view('quizze.edit-question', compact('quizze', 'question','questionChoices','quizzesAll'));
    }
    
    // public function updateQuestion(Request $request, $quizze, $question)
    // {
    //     // $quizze と $question は文字列でなく、モデルオブジェクトとして取得
    //     $quizzeModel = Quizze::find($quizze);
    //     $questionModel = Quizze_questions::find($question);
    
    //     if (!$quizzeModel || !$questionModel) {
    //         // モデルが見つからない場合の処理をここに追加するか、エラーを返すなどしてください
    //     }
    
    //     // リクエストデータを使ってモデルを更新するコードを記述
    //     $questionModel->quiz_id = $request->input('quiz_id');
    //     $questionModel->save();
    
    //     // 問題文を更新
    //     $questionModel->text = $request->input('text');
    //     $questionModel->save();
    
    //     // 選択肢を更新
    //     $choiceValues = $request->input('choices');
    //     foreach ($questionModel->choices as $index => $choice) {
    //         $choice->text = $choiceValues[$index];
    //         $choice->save();
    //     }

    //     return redirect()->route('quizze.edit-question', ['quizze' => $quizzeModel->id, 'question' => $questionModel->id]);
    // }

    public function updateQuestion(Request $request, $quizze, $question)
{
    // $quizze と $question は文字列でなく、モデルオブジェクトとして取得
    $quizzeModel = Quizze::find($quizze);
    $questionModel = Quizze_questions::find($question);

    if (!$quizzeModel || !$questionModel) {
        // モデルが見つからない場合の処理をここに追加するか、エラーを返すなどしてください
    }

    // バリデーションルールを定義
    $rules = [
        'quiz_id' => 'required', // 必須フィールド（必要に応じてルールを変更）
        'text' => 'required|max:30', // 30文字以内
    ];

    // バリデーションを実行
    $validator = Validator::make($request->all(), $rules);

    // バリデーションエラーがある場合は、エラーメッセージと入力値をビューに渡す
    if ($validator->fails()) {
        return redirect()
            ->route('quizze.edit-question', ['quizze' => $quizzeModel->id, 'question' => $questionModel->id])
            ->withErrors($validator)
            ->withInput();
    }

    // リクエストデータを使ってモデルを更新するコードを記述
    $questionModel->quiz_id = $request->input('quiz_id');
    $questionModel->text = $request->input('text');
    $questionModel->save();

    // 選択肢を更新
    $choiceValues = $request->input('choices');
    foreach ($questionModel->choices as $index => $choice) {
        $choice->text = $choiceValues[$index];
        $choice->save();
    }

    return redirect()->route('quizze.edit-question', ['quizze' => $quizzeModel->id, 'question' => $questionModel->id]);
}


    public function deleteQuestion($quizze,$question){
        $quizzeModel=Quizze::find($quizze);
        $questionModel=Quizze_questions::find($question);

        $questionModel->delete();

        return Redirect::route('quizze.show',['quizze'=>$quizzeModel->id])->with('message','問題を削除しました');
    }

}
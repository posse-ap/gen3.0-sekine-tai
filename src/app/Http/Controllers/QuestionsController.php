<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quizze;
use App\Models\Quizze_questions;
use App\Models\Quizze_choices;
use Database\Seeders\Quizze_choicesSeeder;
use Database\Seeders\Quizze_questionsSeeder;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class QuestionsController extends Controller
{
    public function index()
    {
        $questionsList = Quizze_questions::all();
        return view('questionsList', compact('questionsList'));
    }

    public function create(){
        return view('questionsList.create');
    }

    public function store(Request $request){
        
        $validated = $request->validate([
            'text'=> 'required|max:30',
            'quiz_id'=> 'required',
            'choice1'=>'required',
            'choice2'=>'required',
            'choice3'=>'required',
        ]);
        
        $questions = Quizze_questions::create([
            'text'=>$validated['text'],
            'image'=>'image.png',
            'quiz_id'=>$validated['quiz_id'],
        ]);

        $selectedChoice = $request->input('choiceRadio');

        $choices = Quizze_choices::create([
            'text'=>$validated['choice1'],
            'question_id'=>$questions->id,
            'is_collect'=>($selectedChoice == 1)?1:0,
        ]);
        $choices = Quizze_choices::create([
            'text'=>$validated['choice2'],
            'question_id'=>$questions->id,
            'is_collect'=>($selectedChoice == 2)?1:0,
        ]);
        $choices = Quizze_choices::create([
            'text'=>$validated['choice3'],
            'question_id'=>$questions->id,
            'is_collect'=>($selectedChoice == 3)?1:0,
        ]);
        
        return back()->with('message','保存しました');
    }

    public function quizzesSelect(){
        $quizzesSelect = Quizze::all();
        return view('questionsList.create',compact('quizzesSelect'));
    }
}

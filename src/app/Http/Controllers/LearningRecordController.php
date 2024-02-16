<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningRecord;
use App\Models\Content;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
// app/Http/Controllers/LearningRecordController.php

class LearningRecordController extends Controller
{
    public function create()
    {
        $contents = Content::whereNull('deleted_at')->get();
        $languages = Language::whereNull('deleted_at')->get();
        return view('learning_records.create', compact('contents', 'languages'));
    }

    public function store(Request $request)
    {
        try{

            $request->validate([
                'learning_date' => 'required|date',
                'learning_time' => 'required|numeric',
            'contents' => 'required|array',
            'languages' => 'required|array',
        ]);
        
        $learningRecord = LearningRecord::create([
            'user_id' => auth()->user()->id,
            'learning_date' => $request->input('learning_date'),
            'learning_time' => $request->input('learning_time'),
        ]);
        
        $learningRecord->contents()->attach($request->input('contents'));
        $learningRecord->languages()->attach($request->input('languages'));
        
        return redirect()->route('learning_records.statistics')->with('success', 'Learning record created successfully!');
        }catch (ValidationException $e) {
            return redirect()->route('learning_records.create')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // その他の例外が発生した場合
            return abort(500, 'An unexpected error occurred. Please try again later.');
        }
    }

    public function showStatistics()
    {
        $user = auth()->user();
        $learningRecords = LearningRecord::where('user_id', $user->id)->get();

        $todayTotal = $this->calculateTotalTime($learningRecords, now()->format('Y-m-d'));
        $monthTotal = $this->calculateTotalTime($learningRecords, now()->startOfMonth()->format('Y-m-d'));

        $monthlyChartData = $this->generateMonthlyChartData($learningRecords);

        $contentChartData = $this->generateContentChartData($learningRecords);
        $languageChartData = $this->generateLanguageChartData($learningRecords);

        return view('learning_records.statistics', compact('todayTotal', 'monthTotal', 'monthlyChartData', 'contentChartData', 'languageChartData'));
    }

    private function calculateTotalTime($learningRecords, $date)
    {
        $totalTime = 0;

        foreach ($learningRecords as $record) {
            if ($record->learning_date == $date) {
                $totalTime += $record->learning_time;
            }
        }

        return $totalTime;
    }

    private function generateMonthlyChartData($learningRecords)
    {
        $monthlyChartData = [];

        foreach ($learningRecords as $record) {
            $date = Carbon::parse($record->learning_date)->format('Y-m-d');

            if (!isset($monthlyChartData[$date])) {
                $monthlyChartData[$date] = $record->learning_time;
            } else {
                $monthlyChartData[$date] += $record->learning_time;
            }
        }

        return $monthlyChartData;
    }

    private function generateContentChartData($learningRecords)
    {
        $contentChartData = [];

        foreach ($learningRecords as $record) {
            $contents = $record->contents;
            $timePerContent = $record->learning_time / count($contents);

            foreach ($contents as $content) {
                if (!isset($contentChartData[$content->id])) {
                    $contentChartData[$content->id] = [
                        'label' => $content->content_name,
                        'value' => $timePerContent,
                        'color' => $content->color,
                    ];
                } else {
                    $contentChartData[$content->id]['value'] += $timePerContent;
                }
            }
        }

        return array_values($contentChartData);
    }

    private function generateLanguageChartData($learningRecords)
    {
        $languageChartData = [];

        foreach ($learningRecords as $record) {
            $languages = $record->languages;
            $timePerLanguage = $record->learning_time / count($languages);

            foreach ($languages as $language) {
                if (!isset($languageChartData[$language->id])) {
                    $languageChartData[$language->id] = [
                        'label' => $language->language_name,
                        'value' => $timePerLanguage,
                        'color' => $language->color,
                    ];
                } else {
                    $languageChartData[$language->id]['value'] += $timePerLanguage;
                }
            }
        }

        return array_values($languageChartData);
    }

    // public function showStatistics()
    // {
    //     $user = auth()->user();
    //     $learningRecords = LearningRecord::where('user_id', $user->id)->get();
    //     $contentStatistics = $this->calculateContentStatistics($learningRecords);
    //     $languageStatistics = $this->calculateLanguageStatistics($learningRecords);

    //     return view('learning_records.statistics', compact('contentStatistics', 'languageStatistics'));
    // }

    // private function calculateContentStatistics($learningRecords)
    // {
    //     $contentStatistics = [];

    //     foreach ($learningRecords as $record) {
    //         $contents = $record->contents;
    //         $timePerContent = $record->learning_time / count($contents);

    //         foreach ($contents as $content) {
    //             if (!isset($contentStatistics[$content->id])) {
    //                 $contentStatistics[$content->id] = [
    //                     'name' => $content->content_name,
    //                     'total_time' => $timePerContent,
    //                 ];
    //             } else {
    //                 $contentStatistics[$content->id]['total_time'] += $timePerContent;
    //             }
    //         }
    //     }

    //     return $contentStatistics;
    // }

    // private function calculateLanguageStatistics($learningRecords)
    // {
    //     $languageStatistics = [];

    //     foreach ($learningRecords as $record) {
    //         $languages = $record->languages;
    //         $timePerLanguage = $record->learning_time / count($languages);

    //         foreach ($languages as $language) {
    //             if (!isset($languageStatistics[$language->id])) {
    //                 $languageStatistics[$language->id] = [
    //                     'name' => $language->language_name,
    //                     'total_time' => $timePerLanguage,
    //                 ];
    //             } else {
    //                 $languageStatistics[$language->id]['total_time'] += $timePerLanguage;
    //             }
    //         }
    //     }

    //     return $languageStatistics;
    // }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Hours;
use App\Models\Hours_contents;
use App\Models\Hours_languages;
use App\Models\Languages;
use App\Models\Contents;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
  public function sumAll()
  {
    $sumAll = Hours::sum('hour');

    $todayDate = Carbon::now();
    $todayDateFormat = ('2023-10-02');
    // $todayDateFormat = $todayDate->format('Y-m-d');

    $todayMonthFormat = ('2023-10');

    $sumToday = Hours::where('date', $todayDateFormat)->sum('hour');
    $sumMonth = Hours::where('date', 'LIKE', '%' . $todayMonthFormat . '%')->sum('hour');

    $each_day_dates = Hours::where('date', 'LIKE', '%' . $todayMonthFormat . '%')->orderBy('date', 'asc')->get(['date']);
    $json_each_day_dates = json_encode($each_day_dates);

    $each_day_hours = Hours::where('date', 'LIKE', '%' . $todayMonthFormat . '%')->orderBy('date', 'asc')->get(['hour']);
    $json_each_day_hours = json_encode($each_day_hours);

    $learning_language = $learning_language = DB::table('hours_languages as origin1')
      ->select('languages.language', DB::raw('ROUND(sum(hours.hour / origin3.count), 1) AS hours'), 'languages.color')
      ->join('languages', 'origin1.language_id', '=', 'languages.id')
      ->leftJoin('hours', 'hours.id', '=', 'origin1.hour_id')
      ->leftJoin(DB::raw('(SELECT origin2.hour_id, COUNT(hour_id) AS count FROM hours_languages as origin2 GROUP BY hour_id) as origin3'), 'origin3.hour_id', '=', 'origin1.hour_id')
      ->groupBy('origin1.language_id')
      ->get();

    $learningLanguageArray = $learning_language->toArray();
    $colorArray = array_column($learningLanguageArray, 'color');
    $json_learning_language = json_encode(array_column($learningLanguageArray, 'language'));
    $json_learning_language_color = json_encode(array_column($learningLanguageArray, 'color'));

    $learning_content = DB::table('hours_contents as origin1')
      ->select('contents.content', DB::raw('ROUND(sum(hours.hour / origin3.count), 1) AS hours'), 'contents.color')
      ->join('contents', 'origin1.content_id', '=', 'contents.id')
      ->leftJoin('hours', 'hours.id', '=', 'origin1.hour_id')
      ->leftJoin(DB::raw('(SELECT origin2.hour_id, COUNT(hour_id) AS count FROM hours_contents as origin2 GROUP BY hour_id) as origin3'), 'origin3.hour_id', '=', 'origin1.hour_id')
      ->groupBy('origin1.content_id')
      ->get();

    $learningContentArray = $learning_content->toArray();
    $json_learning_content = json_encode(array_column($learningContentArray,'content'));
    $json_learning_content_color = json_encode(array_column($learningContentArray,'color'));

    $language_sum = array_sum(array_column($learningLanguageArray, 'hours'));
    $content_sum = array_sum(array_column($learningContentArray, 'hours'));


    $language_sum_int=intval($language_sum);

    $per_language = array_map(function($hour){
      global $language_sum_int;
      return round($hour/284 * 100,0);
    },array_column($learningLanguageArray, 'hours'));

    $per_content = array_map(function($hour){
      global $content_sum;
      return round($hour/284 * 100,0);
    },array_column($learningContentArray, 'hours'));

    $json_learning_language_hours = json_encode($per_language);
    $json_learning_content_hours = json_encode($per_content);


    return view('record', compact('sumAll', 'sumToday', 'sumMonth', 'json_each_day_dates', 'json_each_day_hours', 'json_learning_language', 'json_learning_language_color', 'json_learning_content','json_learning_content_color','json_learning_language_hours','json_learning_content_hours'));
  }
}

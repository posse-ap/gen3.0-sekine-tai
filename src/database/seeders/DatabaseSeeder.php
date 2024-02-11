<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            ['language' => 'HTML', 'color' => '#0445EC'],
            ['language' => 'CSS', 'color' => '#0F70BC'],
            ['language' => 'JavaScript', 'color' => '#20BDDE'],
            ['language' => 'PHP', 'color' => '#3CCEFE'],
            ['language' => 'Laravel', 'color' => '#B29EF3'],
            ['language' => 'SQL', 'color' => '#6C46EB'],
            ['language' => 'SHELL', 'color' => '#4A17EF'],
            ['language' => '情報システム基礎知識(その他)', 'color' => '#3005C0'],
        ]);

        // contents テーブルにデータを挿入
        DB::table('contents')->insert([
            ['content' => 'N予備校', 'color' => '#0445EC'],
            ['content' => 'ドットインストール', 'color' => '#0F70BC'],
            ['content' => 'POSSE課題', 'color' => '#20BDDE'],
        ]);


        DB::table('hours')->insert([
            ['hour' => 3, 'date' => '2022-06-14'],
            ['hour' => 4, 'date' => '2022-10-15'],
            ['hour' => 5, 'date' => '2023-10-02'],
            ['hour' => 6, 'date' => '2023-10-28'],
            ['hour' => 7, 'date' => '2023-10-27'],
            ['hour' => 9, 'date' => '2023-10-26'],
            ['hour' => 0, 'date' => '2023-10-25'],
            ['hour' => 1, 'date' => '2023-10-24'],
            ['hour' => 2, 'date' => '2023-10-23'],
            ['hour' => 3, 'date' => '2023-10-02'],
            ['hour' => 12, 'date' => '2023-10-03'],
            ['hour' => 17, 'date' => '2023-10-04'],
            ['hour' => 10, 'date' => '2023-10-05'],
            ['hour' => 24, 'date' => '2023-10-06'],
            ['hour' => 22, 'date' => '2023-10-07'],
            ['hour' => 24, 'date' => '2023-10-08'],
            ['hour' => 20, 'date' => '2023-10-09'],
            ['hour' => 19, 'date' => '2023-10-10'],
            ['hour' => 7, 'date' => '2023-10-11'],
            ['hour' => 18, 'date' => '2023-10-12'],
            ['hour' => 17, 'date' => '2023-10-13'],
            ['hour' => 13, 'date' => '2023-10-03'],
            ['hour' => 13, 'date' => '2023-10-15'],
            ['hour' => 0, 'date' => '2023-10-16'],
            ['hour' => 0, 'date' => '2023-10-17'],
            ['hour' => 0, 'date' => '2023-10-18'],
            ['hour' => 1, 'date' => '2023-10-19'],
            ['hour' => 1, 'date' => '2023-09-20'],
            ['hour' => 14, 'date' => '2023-09-21'],
            ['hour' => 12, 'date' => '2023-09-22'],
        ]);

        // hours_languages テーブルにデータを挿入
        DB::table('hours_languages')->insert([
            ['hour_id' => 1, 'language_id' => 7],
            ['hour_id' => 2, 'language_id' => 1],
            ['hour_id' => 3, 'language_id' => 3],
            ['hour_id' => 4, 'language_id' => 4],
            ['hour_id' => 5, 'language_id' => 2],
            ['hour_id' => 6, 'language_id' => 1],
            ['hour_id' => 7, 'language_id' => 7],
            ['hour_id' => 8, 'language_id' => 1],
            ['hour_id' => 9, 'language_id' => 3],
            ['hour_id' => 10, 'language_id' => 4],
            ['hour_id' => 11, 'language_id' => 2],
            ['hour_id' => 12, 'language_id' => 1],
            ['hour_id' => 13, 'language_id' => 7],
            ['hour_id' => 14, 'language_id' => 1],
            ['hour_id' => 15, 'language_id' => 3],
            ['hour_id' => 16, 'language_id' => 4],
            ['hour_id' => 17, 'language_id' => 2],
            ['hour_id' => 18, 'language_id' => 1],
            ['hour_id' => 19, 'language_id' => 7],
            ['hour_id' => 20, 'language_id' => 1],
            ['hour_id' => 21, 'language_id' => 3],
            ['hour_id' => 22, 'language_id' => 8],
            ['hour_id' => 23, 'language_id' => 2],
            ['hour_id' => 24, 'language_id' => 1],
            ['hour_id' => 25, 'language_id' => 7],
            ['hour_id' => 26, 'language_id' => 1],
            ['hour_id' => 27, 'language_id' => 3],
            ['hour_id' => 28, 'language_id' => 4],
            ['hour_id' => 29, 'language_id' => 2],
            ['hour_id' => 30, 'language_id' => 8],
        ]);

        // hours_contents テーブルにデータを挿入
        DB::table('hours_contents')->insert([
            ['hour_id' => 1, 'content_id' => 1],
            ['hour_id' => 2, 'content_id' => 1],
            ['hour_id' => 3, 'content_id' => 3],
            ['hour_id' => 4, 'content_id' => 2],
            ['hour_id' => 5, 'content_id' => 2],
            ['hour_id' => 6, 'content_id' => 1],
            ['hour_id' => 7, 'content_id' => 1],
            ['hour_id' => 8, 'content_id' => 1],
            ['hour_id' => 9, 'content_id' => 3],
            ['hour_id' => 10, 'content_id' => 2],
            ['hour_id' => 11, 'content_id' => 2],
            ['hour_id' => 12, 'content_id' => 1],
            ['hour_id' => 13, 'content_id' => 2],
            ['hour_id' => 14, 'content_id' => 1],
            ['hour_id' => 15, 'content_id' => 3],
            ['hour_id' => 16, 'content_id' => 1],
            ['hour_id' => 17, 'content_id' => 2],
            ['hour_id' => 18, 'content_id' => 1],
            ['hour_id' => 19, 'content_id' => 1],
            ['hour_id' => 20, 'content_id' => 1],
            ['hour_id' => 21, 'content_id' => 3],
            ['hour_id' => 22, 'content_id' => 3],
            ['hour_id' => 23, 'content_id' => 3],
            ['hour_id' => 24, 'content_id' => 3],
            ['hour_id' => 25, 'content_id' => 3],
            ['hour_id' => 26, 'content_id' => 1],
            ['hour_id' => 27, 'content_id' => 3],
            ['hour_id' => 28, 'content_id' => 3],
            ['hour_id' => 29, 'content_id' => 2],
            ['hour_id' => 30, 'content_id' => 3],
        ]);


        // \App\Models\Quizze::factory(100)->create();
        // ↑ここの個数でダミーデータの個数を変えれるよ
    }
}

<?php

namespace Database\Seeders;

// chatGPTのコピペ
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Chart;

class ChartCsvSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/charts.csv');
        $csv = fopen($path, 'r');

        // ヘッダ行をスキップ
        fgetcsv($csv);

        while (($row = fgetcsv($csv)) !== false) {
            Chart::updateOrCreate(
                ['song_id' => $row[0], 'difficulty' => $row[1]],
                [
                    'song_id' => $row[0],
                    'difficulty' => $row[1],
                    'level' => $row[2],
                ]
            );
        }

        fclose($csv);
    }
}

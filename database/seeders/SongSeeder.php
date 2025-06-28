<?php

namespace Database\Seeders;

// chatGPTのコピペ
use Illuminate\Database\Seeder;
use App\Models\Song;

class SongCsvSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/songs.csv');
        $csv = fopen($path, 'r');

        // ヘッダ読み飛ばし
        fgetcsv($csv);

        while (($row = fgetcsv($csv)) !== false) {
            Song::updateOrCreate(['id' => $row[0]], [
                'id' => $row[0],
                'name' => $row[1],
            ]);
        }

        fclose($csv);
    }
}

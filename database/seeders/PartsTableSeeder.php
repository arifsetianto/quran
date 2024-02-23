<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class PartsTableSeeder extends Seeder
{
    public function run(): void
    {
        $file = __DIR__ . '/data/quran_parts.csv';
        $contents = file_get_contents($file);

        foreach (str_getcsv($contents, "\n") as $line) {
            $row = str_getcsv($line, ',');

            DB::table('parts')->insertOrIgnore(
                [
                    'id'         => $row[0],
                    'chapter_id' => $row[1],
                    'verse'      => $row[2],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}

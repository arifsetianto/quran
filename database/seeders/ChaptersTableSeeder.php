<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class ChaptersTableSeeder extends Seeder
{
    public function run(): void
    {
        $file = __DIR__ . '/data/quran_chapters.csv';
        $contents = file_get_contents($file);

        foreach (str_getcsv($contents, "\n") as $line) {
            $row = str_getcsv($line, ',');

            DB::table('chapters')->insertOrIgnore(
                [
                    'id'           => $row[0],
                    'total_verses' => $row[1],
                    'start'        => $row[2],
                    'name'         => $row[3],
                    'tname'        => $row[4],
                    'ename'        => $row[5],
                    'type'         => $row[6],
                    'order'        => $row[7],
                    'rukus'        => $row[8],
                    'created_at'   => Carbon::now(),
                    'updated_at'   => Carbon::now(),
                ]
            );
        }
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class CommentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $file = __DIR__ . '/data/quran_comments.csv';
        $contents = file_get_contents($file);

        foreach (str_getcsv($contents, "\n") as $line) {
            $row = str_getcsv($line, ',');

            DB::table('comments')->insertOrIgnore(
                [
                    'id'         => $row[0],
                    'quran_id'   => $row[1],
                    'chapter_id' => $row[2],
                    'verse'      => $row[3],
                    'text'       => $row[4],
                    'code'       => $row[5],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}

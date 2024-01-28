<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class SubjectsTableSeeder extends Seeder
{
    const DATA = [
        [
            'id'             => 1,
            'total_verses'   => 27,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Knowing Allah is the innate character of mankind',
            'chapter_verses' => [
                [
                    'chapter_id' => 96,
                    'start'      => 3,
                    'end'        => 7
                ],
                [
                    'chapter_id' => 17,
                    'start'      => 85,
                    'end'        => 85
                ],
                [
                    'chapter_id' => 39,
                    'start'      => 8,
                    'end'        => 8
                ],
                [
                    'chapter_id' => 39,
                    'start'      => 49,
                    'end'        => 49
                ],
                [
                    'chapter_id' => 31,
                    'start'      => 32,
                    'end'        => 32
                ],
                [
                    'chapter_id' => 17,
                    'start'      => 66,
                    'end'        => 69
                ],
                [
                    'chapter_id' => 30,
                    'start'      => 30,
                    'end'        => 43
                ]
            ]
        ],
        [
            'id'             => 2,
            'total_verses'   => 23,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Knowing Allah by way of the universe and His creation',
            'chapter_verses' => [
                [
                    'chapter_id' => 3,
                    'start'      => 190,
                    'end'        => 191
                ],
                [
                    'chapter_id' => 16,
                    'start'      => 65,
                    'end'        => 83
                ],
                [
                    'chapter_id' => 51,
                    'start'      => 20,
                    'end'        => 21
                ]
            ]
        ],
        [
            'id'             => 3,
            'total_verses'   => 15,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Knowing Allah and His characteristics Wujud (Allah is Exist)',
            'chapter_verses' => [
                [
                    'chapter_id' => 13,
                    'start'      => 2,
                    'end'        => 2
                ],
                [
                    'chapter_id' => 20,
                    'start'      => 5,
                    'end'        => 5
                ],
                [
                    'chapter_id' => 57,
                    'start'      => 1,
                    'end'        => 4
                ],
                [
                    'chapter_id' => 2,
                    'start'      => 186,
                    'end'        => 186
                ],
                [
                    'chapter_id' => 50,
                    'start'      => 16,
                    'end'        => 16
                ],
                [
                    'chapter_id' => 6,
                    'start'      => 103,
                    'end'        => 103
                ],
                [
                    'chapter_id' => 7,
                    'start'      => 143,
                    'end'        => 143
                ],
                [
                    'chapter_id' => 67,
                    'start'      => 12,
                    'end'        => 14
                ],
                [
                    'chapter_id' => 50,
                    'start'      => 32,
                    'end'        => 33
                ]
            ]
        ],
        [
            'id'             => 4,
            'total_verses'   => 11,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Knowing Allah and His characteristics Wahdaniya (Allah is One)',
            'chapter_verses' => [
                [
                    'chapter_id' => 112,
                    'start'      => 1,
                    'end'        => 4
                ],
                [
                    'chapter_id' => 16,
                    'start'      => 51,
                    'end'        => 52
                ],
                [
                    'chapter_id' => 23,
                    'start'      => 91,
                    'end'        => 91
                ],
                [
                    'chapter_id' => 21,
                    'start'      => 21,
                    'end'        => 22
                ],
                [
                    'chapter_id' => 21,
                    'start'      => 24,
                    'end'        => 25
                ]
            ]
        ],
        [
            'id'             => 5,
            'total_verses'   => 4,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Knowing Allah and His characteristics Al-Awwal wal Akhir (Allah, the First and the Last)',
            'chapter_verses' => [
                [
                    'chapter_id' => 57,
                    'start'      => 3,
                    'end'        => 3
                ],
                [
                    'chapter_id' => 55,
                    'start'      => 26,
                    'end'        => 27
                ],
                [
                    'chapter_id' => 28,
                    'start'      => 88,
                    'end'        => 88
                ]
            ]
        ],
        [
            'id'             => 6,
            'total_verses'   => 5,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Allah is different to that which He created (Makhluq)',
            'chapter_verses' => [
                [
                    'chapter_id' => 42,
                    'start'      => 11,
                    'end'        => 11
                ],
                [
                    'chapter_id' => 112,
                    'start'      => 1,
                    'end'        => 4
                ]
            ]
        ],
        [
            'id'             => 7,
            'total_verses'   => 13,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Allah is omnipotent (Qudrah)',
            'chapter_verses' => [
                [
                    'chapter_id' => 54,
                    'start'      => 49,
                    'end'        => 50
                ],
                [
                    'chapter_id' => 36,
                    'start'      => 83,
                    'end'        => 83
                ],
                [
                    'chapter_id' => 50,
                    'start'      => 38,
                    'end'        => 38
                ],
                [
                    'chapter_id' => 25,
                    'start'      => 1,
                    'end'        => 2
                ],
                [
                    'chapter_id' => 54,
                    'start'      => 49,
                    'end'        => 49
                ],
                [
                    'chapter_id' => 22,
                    'start'      => 5,
                    'end'        => 6
                ],
                [
                    'chapter_id' => 24,
                    'start'      => 45,
                    'end'        => 45
                ],
                [
                    'chapter_id' => 35,
                    'start'      => 44,
                    'end'        => 45
                ],
                [
                    'chapter_id' => 2,
                    'start'      => 255,
                    'end'        => 255
                ]
            ]
        ],
        [
            'id'             => 8,
            'total_verses'   => 10,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Allah is the Will',
            'chapter_verses' => [
                [
                    'chapter_id' => 28,
                    'start'      => 68,
                    'end'        => 68
                ],
                [
                    'chapter_id' => 2,
                    'start'      => 34,
                    'end'        => 34
                ],
                [
                    'chapter_id' => 3,
                    'start'      => 26,
                    'end'        => 27
                ],
                [
                    'chapter_id' => 42,
                    'start'      => 49,
                    'end'        => 50
                ],
                [
                    'chapter_id' => 2,
                    'start'      => 117,
                    'end'        => 117
                ],
                [
                    'chapter_id' => 3,
                    'start'      => 47,
                    'end'        => 47
                ],
                [
                    'chapter_id' => 36,
                    'start'      => 82,
                    'end'        => 82
                ],
                [
                    'chapter_id' => 40,
                    'start'      => 68,
                    'end'        => 68
                ]
            ]
        ],
        [
            'id'             => 9,
            'total_verses'   => 7,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Allah the Everything (Al-Hayyu) stands alone',
            'chapter_verses' => [
                [
                    'chapter_id' => 40,
                    'start'      => 64,
                    'end'        => 65
                ],
                [
                    'chapter_id' => 25,
                    'start'      => 58,
                    'end'        => 58
                ],
                [
                    'chapter_id' => 2,
                    'start'      => 255,
                    'end'        => 255
                ],
                [
                    'chapter_id' => 20,
                    'start'      => 111,
                    'end'        => 111
                ],
                [
                    'chapter_id' => 3,
                    'start'      => 1,
                    'end'        => 2
                ]
            ]
        ],
        [
            'id'             => 10,
            'total_verses'   => 2,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Allah the All-Knower (Al-Alim)',
            'chapter_verses' => [
                [
                    'chapter_id' => 10,
                    'start'      => 61,
                    'end'        => 61
                ],
                [
                    'chapter_id' => 31,
                    'start'      => 27,
                    'end'        => 27
                ]
            ]
        ],
        [
            'id'             => 11,
            'total_verses'   => 3,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Allah\'s Word (Kalamullah)',
            'chapter_verses' => [
                [
                    'chapter_id' => 4,
                    'start'      => 164,
                    'end'        => 164
                ],
                [
                    'chapter_id' => 7,
                    'start'      => 143,
                    'end'        => 143
                ],
                [
                    'chapter_id' => 42,
                    'start'      => 51,
                    'end'        => 51
                ]
            ]
        ],
        [
            'id'             => 12,
            'total_verses'   => 6,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Allah is the All-hearing and the All-Seeing (As-SAmi wal Basir)',
            'chapter_verses' => [
                [
                    'chapter_id' => 42,
                    'start'      => 11,
                    'end'        => 11
                ],
                [
                    'chapter_id' => 20,
                    'start'      => 46,
                    'end'        => 46
                ],
                [
                    'chapter_id' => 58,
                    'start'      => 1,
                    'end'        => 1
                ],
                [
                    'chapter_id' => 41,
                    'start'      => 36,
                    'end'        => 36
                ],
                [
                    'chapter_id' => 42,
                    'start'      => 27,
                    'end'        => 27
                ],
                [
                    'chapter_id' => 6,
                    'start'      => 103,
                    'end'        => 103
                ]
            ]
        ],
        [
            'id'             => 13,
            'total_verses'   => 3,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Knowing the Names and Attributes of Allah',
            'chapter_verses' => [
                [
                    'chapter_id' => 28,
                    'start'      => 68,
                    'end'        => 70
                ],
                [
                    'chapter_id' => 20,
                    'start'      => 14,
                    'end'        => 14
                ]
            ]
        ],
        [
            'id'             => 14,
            'total_verses'   => 7,
            'arname'         => 'Chapter1',
            'ensname'        => 'Tawheed',
            'idsname'        => 'Allah, Ilm, and Makhluq',
            'thsname'        => 'Al-Rahman (The Most Lovingly Beneficient, The Infinitely Good)',
            'chapter_verses' => [
                [
                    'chapter_id' => 1,
                    'start'      => 3,
                    'end'        => 3
                ],
                [
                    'chapter_id' => 2,
                    'start'      => 163,
                    'end'        => 163
                ],
                [
                    'chapter_id' => 13,
                    'start'      => 30,
                    'end'        => 30
                ],
                [
                    'chapter_id' => 20,
                    'start'      => 5,
                    'end'        => 5
                ],
                [
                    'chapter_id' => 20,
                    'start'      => 109,
                    'end'        => 109
                ],
                [
                    'chapter_id' => 50,
                    'start'      => 33,
                    'end'        => 33
                ],
                [
                    'chapter_id' => 78,
                    'start'      => 38,
                    'end'        => 38
                ]
            ]
        ],
    ];

    public function run(): void
    {
        foreach (self::DATA as $row) {
            DB::table('subjects')->insertOrIgnore(
                array_merge($row, ['chapter_verses' => json_encode($row['chapter_verses']), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()])
            );
        }
    }
}

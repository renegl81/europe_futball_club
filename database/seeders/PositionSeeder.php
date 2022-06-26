<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'name' => 'Goalkeeper',
                'code' => 'GK'
            ],
            [
                'name' => 'Defense',
                'code' => 'DEF'
            ],
            [
                'name' => 'Midfield',
                'code' => 'MC'
            ],
            [
                'name' => 'Offence',
                'code' => 'OF'
            ]
        ];

        foreach ($positions as $pos){
            $position = Position::firstOrCreate(
                [
                    "name" => $pos['name'],
                    "code" => $pos['code']
                ]
            );

            $position->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {DB::table('developer')->insert([
        
        ['id'=>1,
        'name'=>'DEV 1',
        'capacity_per_hour'=>1],
         ['id'=>2,
        'name'=>'DEV 2',
        'capacity_per_hour'=>2
        ],
        ['id'=>3,
        'name'=>'DEV 3',
        'capacity_per_hour'=>3],
         ['id'=>4,
        'name'=>'DEV 4',
        'capacity_per_hour'=>4
        ],
        ['id'=>5,
        'name'=>'DEV 5',
        'capacity_per_hour'=>5],
        
    ]);
    }
}

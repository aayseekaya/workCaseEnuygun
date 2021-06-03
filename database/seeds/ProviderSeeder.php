<?php

use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([ [
            'id'=>2,
            'name'=>'Provider 2',
            'url'=>'http://www.mocky.io/v2/5d47f235330000623fa3ebf7'
        ],
            ['id'=>1,
            'name'=>'Provider 1',
            'url'=>'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa']
           
        ]);
       
    }
}


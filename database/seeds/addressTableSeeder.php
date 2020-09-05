<?php

use Illuminate\Database\Seeder;
use App\address;

class addressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Address::insert([
            ['province'=>'Province 1','district'=>'ilam'],
            ['province'=>'Province 1','district'=>'bhojpur'],
            ['province'=>'Province 1','district'=>'dhankuta'],
            ['province'=>'Province 1','district'=>'jhapa'],
            ['province'=>'Province 2','district'=>'parsa'],
            ['province'=>'Province 2','district'=>'bara'],
            ['province'=>'Province 2','district'=>'rautahat'],
            ['province'=>'Province 2','district'=>'siraha'],
            ['province'=>'Bagmati Pradesh','district'=>'kathmandu'],
            ['province'=>'Bagmati Pradesh','district'=>'bhaktapur'],
            ['province'=>'Bagmati Pradesh','district'=>'lalitpur'],
            ['province'=>'Bagmati Pradesh','district'=>'chitwan'],
            ['province'=>'Gandaki Pradesh','district'=>'baglung'],
            ['province'=>'Gandaki Pradesh','district'=>'gorkha'],
            ['province'=>'Gandaki Pradesh','district'=>'kaski'],
            ['province'=>'Gandaki Pradesh','district'=>'lamjung'],
            ['province'=>'Karnali Pradesh','district'=>'dolpa'],
            ['province'=>'Karnali Pradesh','district'=>'humla'],
            ['province'=>'Karnali Pradesh','district'=>'jumla'],
            ['province'=>'Karnali Pradesh','district'=>'jajarkot'],
            ['province'=>'Sudurpaschim Pradesh','district'=>'doti'],
            ['province'=>'Sudurpaschim Pradesh','district'=>'kailali'],
            ['province'=>'Sudurpaschim Pradesh','district'=>'kanchanpur'],
            ['province'=>'Sudurpaschim Pradesh','district'=>'darchula'],
            ['province'=>'Province_5','district'=>'bake'],
            ['province'=>'Province_5','district'=>'bardiya'],
            ['province'=>'Province_5','district'=>'rolpa'],
            ['province'=>'Province_5','district'=>'dang'],
        ]);
    }
}

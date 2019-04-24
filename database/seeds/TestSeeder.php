<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Affirmation;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryList = [
            "social", "intellectual", "physical", "emotional",
            "spiritual", 
        ];

        foreach ($categoryList as $c) { 
            DB::table('categories')->insert([
                'category_title' => $c,
            ]);
        }

        for ($i=0; $i < 8; $i++) { 
            DB::table('affirmations')->insert([
                'aff_content' => '<p> Hello world'.$i.'</p>',
            ]);
        }

        foreach( Category::all() as $c ){
            $c->AffList()->attach( Affirmation::find( rand(0, 9) ) );
        }

        foreach( Affirmation::all() as $a ){
            $a->CatList()->attach( Category::find( rand(0, 6) ) );
        }

    }
}

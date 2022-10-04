<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            'Pizzeria',
            'Sushi',
            'Fast Food',
            'Asian',
            'Vegetariano',
            'Italiano',
            'Dolci',
        ];
        // Per ogni elemento dell'array creo una nuova riga nel db
        foreach($categories as $category_name){
            $new_category = new Category();
            $new_category->name = $category_name;
            $new_category->save();
        }
    }
}

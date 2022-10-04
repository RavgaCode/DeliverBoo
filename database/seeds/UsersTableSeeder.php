<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;
use Faker\Provider\it_IT\Company;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        
        $collection = collect([
            [ 
                'restaurant_name' => 'Hamerica',
                'email'=> 'hamerica@email.it',
                'categories'=> [3,7], //fast food e dolci
            ],
            [ 

                'restaurant_name' => 'Pinseria',
                'email'=> 'pinseria@email.it',
                'categories'=> [3,5], //fast food e vegetariano
            ],
            [ 
                'restaurant_name' => 'Pizzeria Napoli',
                'email'=> 'pizzerianapoli@email.it',
                'categories'=> [1,6,7], //pizzeria,italiano e dolci
            ],
            [ 

                'restaurant_name' => 'Il Vegetariano',
                'email'=> 'ilvegetariano@email.it',
                'categories'=> [5,6], //vegetariano ed italiano
            ],
            [ 

                'restaurant_name' => 'Ai-Sushi',
                'email'=> 'aisushi@email.it',
                'categories'=> [2,4,5], //sushi,asian e vegetariano
            ],
            [ 

                'restaurant_name' => 'Dolce Peccato',
                'email'=> 'dolcepeccato@email.it',
                'categories'=> [7],  //dolci
            ],
            [ 

                'restaurant_name' => 'Sushi e Noodles',
                'email'=> 'sushienoodles@email.it',
                'categories'=> [2,4], //sushi ed asian
            ],
            [ 

                'restaurant_name' => 'FrittFood',
                'email'=> 'frittfood@email.it',
                'categories'=> [3,6], //fastfood ed italiano
            ],
            [ 

                'restaurant_name' => 'Alce Nero',
                'email'=> 'alcenero@email.it',
                'categories'=> [5,6,7], //vegetariano, italiano e dolci
            ],
            [ 

                'restaurant_name' => 'Yogurt Lab',
                'email'=> 'yogurtlab@email.it',
                'categories'=> [3,7], //fastfood e dolci
            ],
            
        ]);

        foreach ($collection as $user) {
            $new_user = new User;
            $new_user->name = $faker->name();;
            $new_user->email = $user['email'];
            $new_user->password = Hash::make('1234');
            $new_user->restaurant_name = $user['restaurant_name'];
            $new_user->slug = Str::slug($new_user->restaurant_name, '-');
            $new_user->restaurant_vat = '123456789101';
            $new_user->restaurant_address = $faker->address();
            $new_user->restaurant_cover = $faker->image('public/storage/restaurant_cover', 400, 300);

            $new_user->category()->sync($new_user['categories']);
            $new_user->save();

            
        }
    }
}

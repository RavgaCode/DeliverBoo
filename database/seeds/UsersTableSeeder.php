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
                'restaurant_name' => 'McDonald',
                'restaurant_cover' => 'https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/zaxbr04ccp1w6pasvexg',
            ],
            [ 

                'restaurant_name' => 'Pinseria',
                'restaurant_cover' => 'https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/wcwop3y3ohgdqiuywuud',

            ],
            [ 
                'restaurant_name' => 'Pizzeria 2.0',
                'restaurant_cover' => '"https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/p8stype2bxmhuocnpfx3',

            ],
            [ 

                'restaurant_name' => 'Penelope',
                'restaurant_cover' => 'https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/wcwop3y3ohgdqiuywuud',
 
            ],
            [ 

                'restaurant_name' => 'Ai-Sushi',
                'restaurant_cover' => 'https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/diygfswlavabrspv0kyv',

            ],
            [ 

                'restaurant_name' => '3 punto 0 Exclusive Restaurant',
                'restaurant_cover' => 'https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/x6egbarpwkbluk305lh9',

            ],
            [ 

                'restaurant_name' => 'Ristorante Cinese Giapponese La Primavera',
                'restaurant_cover' => 'https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/wcwop3y3ohgdqiuywuud',

            ],
            [ 

                'restaurant_name' => 'FrittFood',
                'restaurant_cover' => 'https://res.cloudinary.com/glovoapp/w_450,h_250,c_fill,f_auto,q_30/Stores/rqoqu2qgn8tlj1rgsdcz',
            ],
            
        ]);

        foreach ($collection as $user) {
            $new_user = new User;
            $new_user->name = $faker->name();;
            $new_user->email = $faker->email();
            $new_user->password = Hash::make('1234');
            $new_user->restaurant_name = $user['restaurant_name'];
            $new_user->slug = $user['restaurant_name'];
            $new_user->restaurant_vat = '12345678910';
            $new_user->restaurant_address = $faker->address();
            $new_user->restaurant_cover = $user['restaurant_cover'];

            $new_user->save();
        }
    }
}

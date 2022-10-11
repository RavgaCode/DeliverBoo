<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    //     $collection = collect([
    //         [
    //             'customer_name'=>'Test',
    //             'customer_email'=>'test@email.it',
    //             'customer_address'=>'Via Dei Test, 42',
    //             'customer_telephone'=>'1234567890',
    //             'cart'=> '[{"id":1,"name":"Cheese Burger","price":"12.34","user_id":1,"quantity":1}]',
    //             'total_price'=> '12.34',
    //             'user_id'=>'1',
    //             'created_at'=> '2022-09-08 21:26:59',
    //         ],
    //         [
    //             'customer_name'=>'Test2',
    //             'customer_email'=>'test2@email.it',
    //             'customer_address'=>'Via Dei Test, 42',
    //             'customer_telephone'=>'1234567890',
    //             'cart'=> '[{"id":1,"name":"Cheese Burger","price":"12.34","user_id":1,"quantity":1}]',
    //             'total_price'=> '12.34',
    //             'user_id'=>'1',
    //             'created_at'=> '2022-09-08 21:26:59',
    //         ],
    //     ]);

    //     foreach ($collection as $order) {
    //         $new_order = new Order;
    //         $new_order->customer_name = $order['customer_name'];
    //         $new_order->customer_email = $order['customer_email'];
    //         $new_order->customer_address = $order['customer_address'];
    //         $new_order->customer_telephone = $order['customer_telephone'];
    //         $new_order->cart = $order['cart'];
    //         $new_order->total_price = $order['total_price'];
    //         $new_order->user_id = $order['user_id'];
    //         $new_order->created_at = $order['created_at'];

    //         $new_order->save();
    //  }

    
    for($i = 0; $i < 25; $i++) {
        $month = $faker->randomElement(['2022-09-08 21:26:59', '2022-08-08 21:26:59', '2022-07-08 21:26:59','2022-06-08 21:26:59','2022-05-08 21:26:59','2022-04-08 21:26:59','2022-03-08 21:26:59','2022-02-08 21:26:59','2022-01-08 21:26:59']);
        $new_order = new Order();
        $new_order->customer_name = $faker->name;
        $new_order->customer_email = $faker->safeEmail;
        $new_order->customer_address = $faker->address;
        $new_order->customer_telephone = $faker->phoneNumber;
        $new_order->cart = '[{"id":1,"name":"Cheese Burger","price":"12.34","user_id":1,"quantity":1}]';
        $new_order->total_price = '12.34';
        $new_order->user_id = '1';
        $new_order->created_at=$month;

        $new_order->save();
    }

    }
}

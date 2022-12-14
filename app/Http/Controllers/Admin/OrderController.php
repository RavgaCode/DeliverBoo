<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Leggo l'id dell'utente attualmente loggato e prendo solamente i plates corrispondenti al suo id
        $current_user_id = Auth::user()->getId();
        $orders = Order::where('user_id', '=', $current_user_id)->orderBy('created_at', 'DESC')->get();
       
        // $subset = $users->map(function ($user) {
        //     return collect($user->toArray())
        //         ->only(['id', 'name', 'email'])
        //         ->all();
        // });
       
        $list_of_items = $orders->map(function($order){
            return collect($order->toArray())
            ->only(['cart'])
            ->all();
        });
        $data = [
            'orders' => $orders,
            'list_of_items'=>$list_of_items,
        ];
    
        return view('admin.orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

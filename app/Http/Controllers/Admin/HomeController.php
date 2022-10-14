<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use DB;

class HomeController extends Controller
{
    public function index(){
        $current_user_id = Auth::user()->getId();
        $user = User::where('id', '=', $current_user_id)->first();

        // Prendo tutti gli ordini corrispettivi dell'utente loggato
        $orders = Order::where('user_id', '=', $current_user_id);

        // Conto il numero totale di ordini dello specifico utente
        $orders_count = $orders->count();

        // Calcolo il fatturato totale
        $total_revenue = $orders->sum('total_price');

        // Prendo tutti gli ordini raggruppati per mese/anno

        $number_of_orders = $orders->select(DB::raw('count(id) as `orders`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
        ->groupby('year','month')
        ->get();

        
        $data = [
            'user'=> $user,
            'orders_count'=> $orders_count,
            'total_revenue'=> $total_revenue,
            'number_of_orders'=> $number_of_orders,
        ];
        return view('admin.home', $data);
    }
    public function edit($id)
    {   
        
        // leggo l'id corrente
        $current_user_id = Auth::user()->getId();
        $user = User::findOrFail($id);



    
        $data = [
            'user' => $user,
        ];

        return view('admin.users.edit', $data);
    }

}

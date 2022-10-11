<?php

namespace App\Http\Controllers\Api;

use Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{

    public function generate(Request $request,Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        
        $data = [
            'success' => true,
            'token' => $token
        ];
        return response()->json($data,200);;

    }
    public function makePayment(OrderRequest $request,Gateway $gateway){

        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => "fake-valid-nonce",
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => "Transazione eseguita con Successo!"
            ];
            return response()->json($data,200);
        }else{
            $data = [
                'success' => false,
                'message' => "Transazione Fallita!!"
            ];
            return response()->json($data,401);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request){
        $data = $request->all();
    
        //  $validator=Validator::make($data,[
        //      'customer_name'=>'required',
        //      'customer_email'=>'required|email',
        //      'customer_address'=>'required',
        //      'customer_telephone'=>'required',
            
        //  ]);
        
        //  if($validator->fails()){
        //      return response()->json(
        //          [
        //          'success'=>false,
        //          'errors'=>$validator->errors()
        //          ]
        //      );
        //  }else{
            $order = new Order();
            $order->customer_name = $data['customer_name'];
            $order->customer_address = $data['customer_address'];
            $order->customer_telephone = $data['customer_telephone'];
            $order->customer_email = $data['customer_email'];
            $order->cart = $data['cart'];
            $order->total_price = $data['total_price'];
            $order->user_id = $data['user_id'];
            $order->save();
        // }
            return response()->json(
                [
                'success'=>true
                ]
            );
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

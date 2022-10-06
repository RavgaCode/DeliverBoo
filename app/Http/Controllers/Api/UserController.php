<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Input;
use App\Category;
use App\User;
use App\Plate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $restaurants = User::with('category')->get();

         foreach($restaurants as $restaurant){
            $restaurant->restaurant_cover = asset('storage/' . $restaurant->restaurant_cover);
        };
        
        $data = [
            'success' => true,
            'results' => $restaurants,
        ];

        return response()->json($data);
    }

    public function filter(){

        $id = 2;
        $restaurants = Category::with('users')->where('id',$id)->get();
        $data = [
            'success' => true,
            'results' => $restaurants,
        ];

        return response()->json($data);
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
    public function show($slug)
    {
        $user = User::where('slug','=', $slug)->first();

        $plates = Plate::where('user_id','=',$user['id'])->with(['user'])->get();

        foreach($plates as $plate){
            $plate->cover = asset('storage/' . $plate->cover);
        };

        if($user){
            $data = [
                'success' => true,
                'results' => $plates,
            ];
       } else { //tengo conto del caso di uno slug errato/non presente nel db
            $data = [
                'success' => false,
            ];
       };
       return response()->json($data);
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

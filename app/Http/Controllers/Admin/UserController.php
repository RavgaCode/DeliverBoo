<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Input;
use App\User;

class UserController extends Controller
{
    public function edit(){

        $current_user_id = Auth::user()->getId();
        $user = User::findOrFail($current_user_id);

        $data = [
            'user' => $user,
        ];

        return view('admin.users.edit', $data);
    }
    public function update(Request $request){
        $form_data = $request->all();

        $current_user_id = Auth::user()->getId();
        $user_to_update = User::findOrFail($current_user_id); 


        // Se c'è una nuova immagine, cancello la vecchia ed inserisco la nuova
        if(isset($form_data['restaurant_cover'])) {
            if($user_to_update->cover) {
                Storage::delete($user_to_update->restaurant_cover);
            }

            $img_path = Storage::put('restaurant_cover', $form_data['restaurant_cover']);
            $form_data['restaurant_cover'] = $img_path;
        }

        $user_to_update->update($form_data);

        return redirect()->route('admin.home');
    }
}

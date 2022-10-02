<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Input;
use App\Category;
use App\User;


class UserController extends Controller
{
    public function edit(){

        $current_user_id = Auth::user()->getId();
        $user = User::findOrFail($current_user_id);

        // Impedisco tentativi di hackeraggio tramite url
        if($user->id != $current_user_id){
            abort(403);
        }
        $categories = Category::all();

        $data = [
            'user' => $user,
            'categories'=> $categories,
        ];

        return view('admin.users.edit', $data);
    }
    public function update(Request $request){
        $form_data = $request->all();

        $current_user_id = Auth::user()->getId();
        $user_to_update = User::findOrFail($current_user_id); 

        // Impedisco tentativi di hackeraggio tramite url
        if($user_to_update->id != $current_user_id){
            abort(403);
        }

        // Se c'è una nuova immagine, cancello la vecchia ed inserisco la nuova
        if(isset($form_data['restaurant_cover'])) {
            if($user_to_update->cover) {
                Storage::delete($user_to_update->restaurant_cover);
            }

            $img_path = Storage::put('restaurant_cover', $form_data['restaurant_cover']);
            $form_data['restaurant_cover'] = $img_path;
        }

        // Una volta aggiornato il nuovo piatto, devo attaccare le nuove categorie, SOLO se ci sono
        if(isset($form_data['categories'])){
            $user_to_update->category()->sync($form_data['categories']);
        } else{
            $user_to_update->category()->sync([]);
        }

        $user_to_update->update($form_data);

        return redirect()->route('admin.home');
    }
}

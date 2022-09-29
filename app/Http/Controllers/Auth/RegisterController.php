<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Category;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\Storage;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'restaurant_name' => ['required', 'string', 'max:255'],
            'restaurant_vat' => ['required', 'integer', 'digits:11'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Se c'è un immagine la salvo nella cartella cover
        if(isset($data['restaurant_cover'])) {
            $img_path = Storage::put('cover', $data['restaurant_cover']);
            $data['restaurant_cover'] = $img_path;
        };
        // Creo un nuovo User
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'restaurant_name' => $data['restaurant_name'],
            'slug' =>Str::slug($data['restaurant_name']),
            'restaurant_vat' => $data['restaurant_vat'],
            'restaurant_address' => $data['restaurant_address'],
            'restaurant_cover' => $data['restaurant_cover'],
        ]);
        // Appendo le categorie al nuovo User creato
        $user->category()->sync($data['categories']);
        return $user;
    }

    // Importo le categorie nel form di registrazione
    protected function showRegistrationForm()
    {

        $categories = Category::all();
        $data = [
            'categories' => $categories
        ];
        
        return view('auth.register', $data);
    }

    

}



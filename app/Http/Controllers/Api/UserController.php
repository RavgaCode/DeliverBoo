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
use Illuminate\Database\Eloquent\Builder;

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

    public function test(Request $request){
        // Leggo i dati. Se sono vuoti  richiamo tutti i ristoranti
        $data = $request->all();

        $filteredRestaurants = [];
        
        if ($data == []) {
            $restaurants = User::with('category')->get();
            // Altrimenti uso il metodo explode per creare un array dove ogni singolo elemento è un il numero di category id che è stato passato
        }else {
            $queryParams = [];
            if (isset($data['category'])) {
                $queryParams = explode(',', $data['category']);
            } 
            // Ricerco tutti i ristoranti che hanno ALMENO una relazione con ALMENO uno dei category id passati
            $restaurants = User::whereHas('category', function ($q) use ($queryParams) {
                $q->whereIn('category_id', $queryParams);
            })->with(['category'])->get();

            // Elimino l'elemento vuoto creato dall'ultima virgola non eliminata dall'explode, altrimenti l'array queryParams avrebbe sempre un elemento in più, ed invalidarebbe il filtraggio seguente.
            $filteredQuery =array_pop($queryParams);
           
            // Ciclo tutti i ristoranti filtrati con metodo OR. Per ciascuno di essi, ciclo tutte le category. Verifico tramite in_array, se ogni category id presente in nell'array queryParams é presente nella categoria. Per ogni risposta positiva/true ottenuta, aumento il counter della variabile d'appoggio. Se alla fine del ciclo del singolo ristorante, il counter della variabile d'appoggio, è uguale alla lunghezza dell'array queryParams, allora pusho il ristorante nell'array dei ristoranti filtrati finale.
            foreach($restaurants as $restaurant){
                $counting = 0;
                foreach ($restaurant->category as $category){
                    $isQueryContained = in_array($category['id'], $queryParams);
                    if($isQueryContained){
                        $counting++;
                        if($counting == count($queryParams)){
                            array_push($filteredRestaurants, $restaurant);
                        } 
                    }   
                }
            }
        }
        
        
        // Aggiungo il link alla cover
        foreach($filteredRestaurants as $singleRestaurant){
            $singleRestaurant->restaurant_cover = asset('storage/' . $singleRestaurant->restaurant_cover);
         };

        $data = [
            'success' => true,
            'results' => $filteredRestaurants,
        ];
        return response()->json($data);
    }



    public function search($name)
    {
        $restaurants = User::where('restaurant_name', 'like', $name )->get();
       
        foreach($restaurants as $restaurant){
           $restaurant->restaurant_cover = asset('storage/' . $restaurant->restaurant_cover);
       };
       
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

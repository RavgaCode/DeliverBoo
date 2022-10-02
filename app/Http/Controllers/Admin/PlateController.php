<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Plate;
use App\Category;
use App\Http\Controllers\Admin\Input;
use Mockery\Undefined;

class PlateController extends Controller
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
        $plate = Plate::where('user_id', '=', $current_user_id)->get();
        
        $data = [
            'plates' => $plate
        ];
       
        return view('admin.plates.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        

        $data = [
            'categories' => $category,
        ];

        return view('admin.plates.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Richiamo la funzione con i parametri di validazione
        $request->validate($this->validationRules());  
        $current_user_id = Auth::user()->getId();
        $form_data = $request->all();

        // Se c'è un immagine la salvo nella cartella cover
        if(isset($form_data['cover'])) {
            $img_path = Storage::put('cover', $form_data['cover']);
            $form_data['cover'] = $img_path;
        };

        // Verifico se la checkbox della visibility esiste, ed inserisco il dato corrispondente in new_plate
        if(isset($form_data['visibility'])) {
            $form_data['visibility'] = 1;
            $value_to_insert = $form_data['visibility'];
        } else {
            $value_to_insert = 0;
        }

        
        // Creo un nuovo piatto e lo collego automaticamente all'user_id dell'utente loggato
        $new_plate = new Plate();
        $new_plate->fill($form_data);
        $new_plate->user_id = $current_user_id;
        $new_plate['visibility'] = $value_to_insert;
        $new_plate->save();

        // return redirect()->route('admin.plates.index');
        return redirect()->route('admin.plates.show', ['plate' => $new_plate->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // leggo l'id corrente
        $current_user_id = Auth::user()->getId();
        $current_plate = Plate::findOrFail($id);
        // Impedisco tentativi di hackeraggio tramite url
        if($current_plate->user_id != $current_user_id){
            abort(403);
        }

        // se l'user_id di plate corrisponde a current_user_id, la show mostra
        // il piatto desiderato
        if($current_plate->user_id === $current_user_id) {
            $plate = Plate::findOrFail($id); 
        }

        $data = [
            'plate' => $plate
        ];

        return view('admin.plates.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        
        // leggo l'id corrente
        $current_user_id = Auth::user()->getId();
        $plate_to_edit = Plate::findOrFail($id);

        // Impedisco tentativi di hackeraggio tramite url
        if($plate_to_edit->user_id != $current_user_id){
            abort(403);
        }
        

        $data = [
            'plate' => $plate_to_edit,
        ];

        return view('admin.plates.edit', $data);
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
        // Richiamo la funzione di validazione
        $request->validate($this->validationRules()); 

        $form_data = $request->all();
        $plate_to_update = Plate::findOrFail($id); 

        // leggo l'id corrente
        $current_user_id = Auth::user()->getId();
        // Impedisco tentativi di hackeraggio tramite url
        if($plate_to_update->user_id != $current_user_id){
            abort(403);
        }

      // Verifico se la checkbox della visibility esiste, ed inserisco il dato corrispondente in plate_to_update
        if(isset($form_data['visibility'])) {
            $form_data['visibility'] = 1;
            $value_to_insert = $form_data['visibility'];
        } else {
            $value_to_insert = 0;
        }
       
        $plate_to_update['visibility'] = $value_to_insert;


        // Se c'è una nuova immagine, cancello la vecchia ed inserisco la nuova
        if(isset($form_data['cover'])) {
            if($plate_to_update->cover) {
                Storage::delete($plate_to_update->cover);
            }

            $img_path = Storage::put('cover', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }

        $plate_to_update->update($form_data);

        return redirect()->route('admin.plates.show', ['plate' => $plate_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plate_delete = Plate::findOrFail($id);

        // leggo l'id corrente
        $current_user_id = Auth::user()->getId();
        // Impedisco tentativi di hackeraggio tramite url
        if($plate_delete->user_id != $current_user_id){
            abort(403);
        }

        // Prima di cancellare il piatto, cancello eventuali immagini ad esso legate
        if($plate_delete->cover) {
            Storage::delete($plate_delete->cover);
        };

        $plate_delete->delete();

        return redirect()->route('admin.plates.index');
    }

    protected function validationRules() {
        return [
            'name' => 'required|max:50',
            'user_id' => 'nullable|exists:users,id',
            'description' => 'required | max: 60000',
            'price' => 'required|numeric|between: 0.01, 10000',
            'cover' => 'file|mimes:jpeg,png,jpg,gif,svg|max:256000|nullable'
        ];
    }
}

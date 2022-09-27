<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Plate;
use App\Category;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        // $request->validate($this->validationRules());  
        $current_user_id = Auth::user()->getId();
        $form_data = $request->all();

        if(isset($form_data['image'])) {
            $img_path = Storage::put('plates-cover', $form_data['image']);
            $form_data['cover'] = $img_path;
        };

        $new_plate = new Plate();
        $new_plate->fill($form_data);
        $new_plate->user_id = $current_user_id;
        $new_plate->save();

        return redirect()->route('admin.plates.index');
        // return redirect()->route('admin.posts.show', ['plate' => $new_plate->id]);

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

    protected function validationRules() {
        return [
            'name' => 'required|max:50',
            'decription' => 'required|max:60000',
            'user_id' => 'nullable|exists:users,id',
            'cover' => 'image|max:1024|nullable'
        ];
    }
}

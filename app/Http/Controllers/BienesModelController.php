<?php

namespace App\Http\Controllers;

use App\Models\BienesModel;
use App\Models\Users_Model;
use Illuminate\Http\Request;

class BienesModelController extends Controller
{
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
    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'articulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);
        $users = Users_Model::find($request->user_id);
        if(is_object($users)){
            $bien = BienesModel::create([
                'articulo' => $request->articulo,
                'descripcion' => $request->descripcion,
                'usuario_id' => $request->hasMany('user_id')
            ]);
            $response = [
                'message'=>"Bien agregado",
                $bien
            ];
        return response()->json($response,200);
        }
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
     * @param  \App\Models\BienesModel  $bienesModel
     * @return \Illuminate\Http\Response
     */
    public function show(BienesModel $bienesModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BienesModel  $bienesModel
     * @return \Illuminate\Http\Response
     */
    public function edit(BienesModel $bienesModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BienesModel  $bienesModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BienesModel $bienesModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BienesModel  $bienesModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BienesModel $bienesModel)
    {
        //
    }
}

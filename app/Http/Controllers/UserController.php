<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = User::all();
        return response()->json([
            'clientes' => $clientes
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'company' => $request->company,
            'notes' => $request->notes
        ]);

        

        if(is_null($cliente)){
            return response()->json(["message"=>"Hubo un problema al registrar el nuevo cliente"]
            ,500);
        }
        return response()->json([
            'cliente' => $cliente
        ], 201);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = User::find($id);
        if(is_null($cliente)){
            return response()->json(["message"=>"No se ha encontrado el cliente."]
            ,404);
        }
        return response()->json([
            'cliente' => $cliente
        ], 200);
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
        $cliente = User::find($id);
        if(is_null($cliente)){
            return response()->json(["message"=>"Hubo un problema al actualizar la información del cliente"]
            ,500);
        }
        $cliente->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'company' => $request->company,
            'notes' => $request->notes
        ]);
        return response()->json([
            'cliente' => $cliente
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = User::findOrFail($id);
        if(is_null($cliente)){
            return response()->json(["message"=>"Hubo un problema al eliminar el cliente"]
            ,404);
        }
        $cliente->delete();
        return response()->json(["message"=>"Se ha eliminado el cliente"], 200);
    }
}

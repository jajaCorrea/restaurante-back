<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Platillo_Mesa;
use App\Mesas;

class PlatilloMesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $platillo_mesa = Mesas::with('platillos.infoPlatillo')->select('id', 'status', 'number')->get();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response($platillo_mesa, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if($request->platillo_id==null||$request->nombre==null||
            $request->tipo==null||$request->precio==null|| $request->mesa_id==null){
                return response('Need more data', 409);
            }
            $platillo_mesa = new Platillo_Mesa;
            $platillo_mesa->platillo_id = $request->platillo_id;
            $platillo_mesa->mesa_id = $request->mesa_id;
            $platillo_mesa->nombre = $request->nombre;
            $platillo_mesa->tipo = $request->tipo;
            $platillo_mesa->precio = $request->precio;
            $platillo_mesa->save();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response('Successful', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $platillo_mesa = Platillo_Mesa::with('infoPlatillo')->select('id', 'platillo_id', 'mesa_id')->get();
            return response($platillo_mesa, 201);
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
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
        try{
            $platillo_mesa = Platillo_Mesa::findOrFail($id);
            if($request->platillo_id!=null){
                $platillo_mesa->platillo_id = $request->platillo_id;
            }if($request->mesa_id!=null){
                $platillo_mesa->mesa_id = $request->mesa_id;
            }if($request->nombre!=null){
                $platillo_mesa->nombre = $request->nombre;
            }if($request->tipo!=null){
                $platillo_mesa->tipo = $request->tipo;
            }if($request->precio!=null){
                $platillo_mesa->precio = $request->precio;
            }
            $platillo_mesa->save();
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
        return response('Successful', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $platillo_mesa = Platillo_Mesa::findOrFail($id);
            $platillo_mesa->delete();
    
            return response("El recurso ha sido borrado",201);
        } catch(QueryException $e) {
            return response( $e->getMessage(), 501);
        }
    }
}
